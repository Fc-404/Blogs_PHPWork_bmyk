<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/root.css">
<script type="text/javascript" src="js/rootVar.js"></script>
<title></title>
</head>

<style>
	* {
		margin: 0;
		padding: 0;
		user-select: none;
	}
	body {
		background-image: url("img/meinv001.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
	.panel {
		width: 400px;
		height: auto;
		padding: 50px;
		margin: 50px 100px 50px auto;
	}
	.panel form {
		width: 100%;
		height: 100%;
		font: normal 100 30px/40px 宋体;
	}
	.panel form input {
		height: 36px;
		width: 100%;
		margin: 20px 0 50px;
		padding: 2px 5px;
		border: none;
		font-size: 24px;
	}
	input:last-child {
		background: #60aeff;
	}
	input:last-child:hover {
		background: #0064ff;
		color: #fff;
	}
</style>

<body>
<?php
include('./php/tools.php');
	if ($_GET['install'] == null){
		if (file_exists('data/DB/blogs.sql'))
			echo('<script>window.location.href="install.php?install=1"</script>');
		else
			echo('<script>window.location.href="install.php?install=0"</script>');
	}
	if ($_GET['install'] == 1){
?>
	<div class="dimDiv panel" id="panel">
		<p style="font:normal 100 20px/30px 宋体">
			检测到您有备份数据库文件
			<br>
			<br>
			若不想使用备份文件&nbsp;请点击<a href="install.php?install=0">重新安装</a>
			<br>
			<br>
			若要从备份数据库文件恢复
			<br>
			<br>
			1、请打开并登陆你的 phpMyAdmin 后台
			<br>
			<br>
			2、选择&nbsp;&nbsp;<i><b>导入</b></i>
			<br>
			<br>
			3、点击&nbsp;&nbsp;<i><b>导入文件<b></i>
			<br>
			<i><p style="font-size: 16px">文件请选择本博客文件夹中的&nbsp;data/DB/blogs.sql</p>
			<br>
			<p style="font:normal 100 20px/30px 宋体">4、确认导入</p>
		</p>
	</div>
	<?php
	}
	else{
	?>
	<div class="dimDiv panel" id="panel">
		<h1>博客数据库安装界面</h1>
		<form action="" method="post">
			<br><span>请输入数据库地址</span><br>
			<input type="text" name="db_host" onBlur="isBlur(0)" onFocus="isFocus(0)" placeholder="默认为 localhost">
			<br><span>请输入数据库用户名</span><br>
			<input type="text" name="db_user" onBlur="isBlur(1)" onFocus="isFocus(1)" placeholder="您数据库的用户名">
			<br><span>请输入数据库密码</span><br>
			<input type="password" name="db_pass" onBlur="isBlur(2)" onFocus="isFocus(2)" placeholder="您数据库的用户密码">
			<br><span>请输入博客数据库名称</span><br>
			<input type="text" name="db_basename" onBlur="isBlur(3)" onFocus="isFocus(3)" placeholder="默认为 Blogs">
			<br>
			<input type="submit" name="install" value="安装" onClick="return isNULL(form);" style="height:auto;">
		</form>
	</div>
	<?php
	}
	
	if ($_POST['db_host'] && $_POST['db_user'] && $_POST['db_pass']){
		//echo($_POST['db_host'].$_POST['db_user'].$_POST['db_pass']);
		@$DB = mysqli_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pass']);
		//print_r($DB);
		if ($DB){
			//echo('<script>window.alert("您的数据库连接ok");</script>');
			?>
			<script>
				var panel = document.getElementById('panel');
				panel.style.color = 'green';
				panel.innerText = '连接数据库成功---[ok]';
			</script>
			<?php
			if ($_POST['db_basename'])
				$sql = 'create database '.$_POST['db_basename'];
			else
				$sql = 'create database Blogs';
			
			//把数据库信息写入ini配置文件
			setKeyValue('db_host', $_POST['db_host'], 'linkInfomation');
			setKeyValue('db_user', $_POST['db_user'], 'linkInfomation');
			setKeyValue('db_pass', $_POST['db_pass'], 'linkInfomation');
			setKeyValue('localpath', getcwd(), 'system');
			
			if (mysqli_query($DB, $sql)){
				echo('<script>panel.innerHTML += "<br>创建数据库成功---[ok]"</script>');
				if ($_POST['db_basename']){
					mysqli_select_db($DB, $_POST['db_basename']);
					setKeyValue('db_basename', $_POST['db_basename'], 'linkInfomation');
				}
				else{
					mysqli_select_db($DB, 'blogs');
					setKeyValue('db_basename', 'Blogs', 'linkInfomation');
				}

				$sql = 'create table m_user (
				id INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(32) COLLATE utf8mb4_0900_as_cs NOT NULL,
				userpass VARCHAR(32) COLLATE utf8mb4_0900_as_cs NOT NULL,
				age INT(3) DEFAULT 000,
				sign VARCHAR(64) COLLATE utf8mb4_0900_as_cs,
				intime DATETIME NOT NULL,
				gid INT(2) DEFAULT 0
				)';

				if (mysqli_query($DB, $sql)){
					echo('<script>panel.innerHTML += "<br>创建用户表成功---[ok]"</script>');
					$sql = 'create table m_content (
					id INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					userid INT(16) NOT NULL,
					title VARCHAR(32) NOT NULL,
					content VARCHAR(10240) NOT NULL,
					mktime DATETIME NOT NULL,
					readed INT(16) DEFAULT 0,
					gid INT(2) DEFAULT 0
					)';
					if (mysqli_query($DB, $sql)){
						echo('<script>panel.innerHTML += "<br>创建内容表成功---[ok]"</script>');
						//新建文章模板
						$contentTemp = new userModel();
						$contentTemp->addContent('1', '一、作者信息', '
						作者：郭佳龙
						学校：西安高新科技职业学院
    					专业：软件技术
    					班级：四班
    					学号：1805030454
						');
						$contentTemp->addContent('1', '二、程序信息', '
						程序名：博美雅客
						开发语言：
							HTML
							CSS 
							JavaScript
							PHP
							SQL
						版本：1.0
						');
						$contentTemp->addContent('1', '三、环境', '
						本程序需要 
							Apache、MySQL、phpMyAdmin、PHP  服务支持

						我的测试环境 
							Apache 2.4.39
							MySQL 8.0.12
							PHP 7.3.9 nts
							phpMyAdmin 4.8.5

						请尽量使用以上环境运行
						');
						$contentTemp->addContent('1', '四、安装', '
						注意：新部署博客时必须保证 ini 文件夹是空的，安装前请检查站点目录下的 ini 文件夹是否为空；
						1、把程序解压至网站站点
						2、访问 站点的 install.php 网页
						3、按照要求填写数据库信息
						4、完成安装
						');
						$contentTemp->addContent('1', '五、兼容性', '
						测试环境为 Chrome 浏览器最新稳定版；
						对 IE 浏览器兼容性极差；
						对 Edge 浏览器兼容不友好
						对 手机端 浏览器兼容性不友好
						其他浏览器请自行测试
						');
						$contentTemp->addContent('1', '六、问题', '
						1、博客内容使用 textarea 标签进行编辑，暂未使用专业的编辑器，所以非常有可能被不良访问者注入、破坏；
						2、博客用户采用用户名加密码实现登录，且唯一关键字为 id 或 用户名，也没有部署用户找回机制和忘记密码机制，所以需牢记用户名，丢失不可找回；
						3、登录使用的浏览器端 Cookie 机制，所以不支持 Cookie 的浏览器无法登录，并且 Cookie 有效时间为 1 天，过时自动退出，所以写稿时尽量自行保存；
						');
						$contentTemp->addContent('1', '七、声明', '
						由于个人精力有限、能力有限，有很多功能规划了但没实现，例如：热门选项、浏览量、个人博客删除及浏览、搜索功能、评论功能、图片及文件等等；
    					目前程序能实现部分基本功能，用作学业大作业，未来极大可能重写博客；
						');
						$contentTemp->addContent('1', '八、使用合约', '
						作者保留程序所有版权；
						程序由个人完成，部分功能使用互联网上的技术，例如：日历功能；如有侵权，请联系作者；
						网站图片使用的互联网图片，如有侵权联系作者；
						联系方式见第九条
						程序源码可自行研究及发文讨论，但不可用于商业；
						程序免费使用，但不可违反所在国家法律；
						');
						$contentTemp->addContent('1', '九、联系方式', '
						QQ：2601721443
    					微信：m17398643051
						');
						$contentTemp->addContent('1', '十、致谢', '
						感谢互联网中的所有技术奉献
						感谢专业老师 王鹏程 的教导
						感谢学校 高新科技学院 的教育
						');
						$contentTemp->addContent('1', '十一、尾言', '
						只为触碰更大的世界
    					这梦想无休无止
						');
						//
						$sql = 'insert into m_user (username,userpass,sign,intime,gid) 
						value (\'root\',\''.md5('123456').'\',\'I am administrator!\',\''.date("Y-m-d-H-i-s").'\',\'99\')';
						mysqli_query($DB, $sql);
						mysqli_close($DB);
						?>
						<script>
							panel.innerHTML += "<br><br><p style=\"color:blue\">已经为你自动创建了一个超级账户<br>账号：root<br>密码：123456</p>";
							panel.innerHTML += "<br><br><span id=\"time\">60</span>&nbsp;秒后返回&nbsp;<a href=\"index.php\">首页</a>";
							var retu = setInterval("retime()", 1000);
							function retime(){
								var time = document.getElementById('time').innerText;
								time = Number(time);
								console.log(time);
								if (time > 0){
									time--;
									document.getElementById('time').innerText = time;
								}
								else{
									clearInterval(retu);
									window.location.href = 'index.php';
								}
							}
						</script>
						<?php
					}
					else
						echo('<script>panel.innerHTML += "<br><span style=\\"color:red;\\">创建内容表失败---[error]</span>&nbsp;&nbsp;<a href=\\"install.php\\">返回</a><br>"</script>');
				}
				else
					echo('<script>panel.innerHTML += "<br><span style=\\"color:red;\\">创建用户表失败---[error]</span>&nbsp;&nbsp;<a href=\\"install.php\\">返回</a><br>"</script>');
			}
			else{
				echo('<script>panel.innerHTML += "<br><span style=\\"color:red;\\">创建数据库失败---[error]</span>&nbsp;&nbsp;<a href=\\"install.php\\">返回</a><br>"</script>');
				echo('<script>panel.innerHTML += "<br><p style=\\"color:yellow;font-style:italic;\\">[!]建议您检查一下您数据库系统是否有和本系统数据库冲突的数据库[!]<p>"</script>');
			}
			mysqli_close($DB);
			?>
			<?php
		}
		else{
			?>
			<script>
				var panel = document.getElementById('panel');
				panel.style.color = 'red';
				panel.innerText = '连接数据库失败---[error]';
				panel.innerHTML = panel.innerText + '&nbsp;&nbsp;<a href="install.php">重试</a>'
			</script>
			<?php
		}
	}
	
	?>
</body>
	
<script>
	document.title = BRAND;
	
	function isFocus(No, color = '#0064ff'){
		document.getElementsByTagName('span')[No].style.fontSize = '38px';
		document.getElementsByTagName('span')[No].style.color = color;
	}
	function isBlur(No){
		document.getElementsByTagName('span')[No].style.fontSize = '30px';
		document.getElementsByTagName('span')[No].style.color = '#000';
	}
	
	function isNULL(form){
		if (form.db_host.value == ''){
			form.db_host.focus();
			isFocus(0, 'red');
			return false;
		}
		if (form.db_user.value == ''){
			form.db_user.focus();
			isFocus(1, 'red');
			return false;
		}
		if (form.db_pass.value == ''){
			form.db_pass.focus();
			isFocus(2, 'red');
			return false;
		}
		form.submit();
	}
	
</script>
	
</html>