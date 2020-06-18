<!doctype html>
<!--
   ___                __ __       __   __ __      
 /'___\              /\ \\ \    /'__`\/\ \\ \     
/\ \__/  ___         \ \ \\ \  /\ \/\ \ \ \\ \    
\ \ ,__\/'___\ _______\ \ \\ \_\ \ \ \ \ \ \\ \_  
 \ \ \_/\ \__//\______\\ \__ ,__\ \ \_\ \ \__ ,__\
  \ \_\\ \____\/______/ \/_/\_\_/\ \____/\/_/\_\_/
   \/_/ \/____/            \/_/   \/___/    \/_/ 
你只是馋人家的身子
你下贱
2020-4-21 至 2020-5-26
-->
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="js/rootVar.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/root.css">
<title></title>
</head>
	
<?php
	if ($_GET['clear'] == 'true'){
		setcookie('bmykBlogs', '0', time() + 3600*24*30, '/');
		setcookie($_COOKIE['bmykBlogs'], '0', -1, '/');
		echo('<script>window.location.href="index.php"</script>');
	}
	//
	include_once('./php/tools.php');
	
	if (!getKeyValue('db_user', 'linkInfomation')){
		?>
		<script>
			window.confirm("\n\n您的网站似乎没有安装服务！\n\n\n请单击确认安装服务！")
			window.location.href = 'install.php';
		</script>
		<?php
	}
	//
	if (!isset($_COOKIE['bmykBlogs'])){
		setcookie('bmykBlogs', '0', time() + 3600 * 24 * 30, '/');
		echo('<script>window.location.href="index.php"</script>');
	}
?>
	
<body>
	<a name="this_top"></a>
	<div id="canvas">
		<div style="width: 100%; height: 50px;"></div>
		<div id="head" class="dimDiv">
			<div id="BRAND"></div>
			<div id="user">
				<span id="signin">注册</span><!--
				--><span id="signup">登录</span>
			</div>
			<div id="navigation">
				<span id="home" onClick="window.location.href='index.php'">首页</span><!--
				--><span id="hot" title="待开发">热门</span><!--
				--><span id="new" onclick="window.location.href='index.php?order=new'">最新</span>
				<form action="index.php" method="get">
					<input type="text" name="keyword" style="background-color: rgba(0, 0, 0, .2);" value="<?php if(isset($_GET['keyword'])) echo($_GET['keyword']);?>"><!--
					--><input type="submit" value="搜索">
				</form>
			</div>
		</div>
		
		<div style="width: 100%; height: 20px"></div>
		<div id="sundry_content" style="height: auto;">
			<div id="sundry" class="">
				<!--用户-->
				<?php
				if ($_COOKIE['bmykBlogs'] != '0'){
				?>
				<div id="userBrief" class="dimDiv">
					<div id="userHeadImg">
						<div></div>
						<div></div>
						<div>点击进入个人主页<div></div></div>
					</div>
					<div style="width: calc(100% - 140px);">
						<div class="info">ID：
							<p class="defaultText infoId" style="min-width: 40px; width: calc(100% - 100px); height: auto; min-height: 24px; user-select: all; -webkit-user-select: all;"></p>
						</div>
						<br>
						<div class="info">昵称：
							<p class="defaultText infoNa" style="min-width: 80px; width: calc(100% - 90px); height: auto; min-height: 24px; user-select: all; -webkit-user-select: all;"></p>
						</div>
					</div>
					<br>
					<div class="info">签名：
						<p class="defaultText infoSi" style="display: inline-block; min-width: 160px; width: calc(100% - 130px); height: auto; min-height: 24px; user-select: all; -webkit-user-select: all;"></p>
					</div>
					<div style="width: 100%;height: 40px;display: block;"></div>
				</div>
				<style>
					#userBrief *{
						display: inline-block;
						vertical-align: top;
						position: relative;
						font-size: 20px;
						user-select: none;
						-webkit-user-select: none;
					}
					#userBrief {
						width: 100%;
						height: auto;
						position: sticky;
						top: 36px;
						z-index: 10;
					}
					#userBrief #userHeadImg{
						margin: 0;
						position: relative;
						top: 20px;
						left: 20px;
						display: inline-block;
					}
					#userBrief .info{
						top: 20px;
						left: 40px;
						min-width: 100px;
					}
					#userBrief p{
						top: 12px;
						line-height: 24px;
						font-size: 18px;
						word-break: keep-all;
						white-space: nowrap;
					}
					#userHeadImg div:nth-child(3){
						position: absolute;
						top: -30px;
						left: -25px;
						font: 100 16px/24px songti;
						text-align: center;
						width: 150px;
						border-radius: 12px;
						background: rgba(255, 119, 255,.9);
						display: none;
					}
					#userHeadImg div:nth-child(3) div{
						width: 10px;
						height: 10px;
						border-radius: 0;
						position: absolute;
						top: 16px;
						left: 70px;
						transform: rotate(45deg);
						background: rgba(255, 119, 255,.9);
					}
					#userHeadImg:hover div:nth-child(3){
						display: block;

					}
				</style>
				<?php
						$userObj = new userModel();
						if ($userObj->getUserInfo($_COOKIE['bmykBlogs'])['userpass'] != $_COOKIE[$_COOKIE['bmykBlogs']]){
							//echo('<script>window.location.href="user.php?is=signup"</script>');
							echo('<script>window.alert("登录已失效！")</script>');
							setcookie('bmykBlogs', '0', time() + 3600*24*30, '/');
							echo('<script>window.location.href="index.php"</script>');
						}
						$userInfo = $userObj->getUserInfo($_COOKIE['bmykBlogs']);
					?>
					<script>
						var userBrief = document.getElementById('userBrief');
						userBrief.getElementsByClassName('infoId')[0].innerText = '<?php echo($userInfo['id']);?>';
						userBrief.getElementsByClassName('infoId')[0].style.backgroundColor = 'transparent';
						userBrief.getElementsByClassName('infoId')[0].style.color = '#0bf';
						userBrief.getElementsByClassName('infoId')[0].style.fontWeight = '600';
						userBrief.getElementsByClassName('infoNa')[0].innerText = '<?php echo($userInfo['username']);?>';
						userBrief.getElementsByClassName('infoNa')[0].style.backgroundColor = 'transparent';
						userBrief.getElementsByClassName('infoNa')[0].style.color = '#0bf';
						userBrief.getElementsByClassName('infoNa')[0].style.fontWeight = '600';
						userBrief.getElementsByClassName('infoSi')[0].innerText = '<?php echo($userInfo['sign']);?>';
						//
						document.getElementById('signin').innerText = '';
						document.getElementById('signup').id = 'exit';
						document.getElementById('exit').innerText = '退出';
						document.getElementById('exit').onclick = function(){
							window.location.href = 'index.php?clear=true';
						}
						document.getElementById('userHeadImg').onclick = function(){
							window.location.href = 'user.php?is=homepage';
						}
					</script>
						<?php 
							if($userInfo['sign'] != '')
								echo('<script>userBrief.getElementsByClassName("infoSi")[0].style.backgroundColor = "transparent"</script>');
						?>
					<script>
						userBrief.getElementsByClassName('infoSi')[0].style.color = '#0bf';
						userBrief.getElementsByClassName('infoSi')[0].style.fontWeight = '600';
					</script>
				<?php
				}
				?>
				<!--日历模块-->
				<link rel="stylesheet" type="text/css" href="css/cldFrame.css">
				<div id="cldFrame" class="dimDiv">
					<div id="cldBody" class="">
						<table>
							<thead>
								<tr>
									<td colspan="7">
										<div id="top">
											<span id="left">&lt;</span>
											<span id="topDate"></span>
											<span id="right">&gt;</span>
										</div>
									</td>
								</tr>
								<tr id="week">
									<td>日</td>
									<td>一</td>
									<td>二</td>
									<td>三</td>
									<td>四</td>
									<td>五</td>
									<td>六</td>
								</tr>
							</thead>
							<tbody id="tbody">
							</tbody>
						</table>
					</div>
				</div>
				<script type="text/javascript" src="js/cldFrame.js"></script>
				<!--时间模块-->
				<link rel="stylesheet" type="text/css" href="./css/timeFrame.css">
				<div id="timeFrame" class="dimDiv">
					<p>
						<span id="timeYear" class="color"></span>年
						<span id="timeMonth" class="color"></span>月
						<span id="timeDay" class="color"></span>日
						<br>
						<span id="timeHour" class="color"></span>时
						<span id="timeMinute" class="color"></span>分
						<span id="timeSecont" class="color"></span>秒
						<br>
						今天星期<span id="timeWeek" class="color"></span>
						<br>
						<span id="timeDeep"></span>
					</p>
				</div>
				<script type="text/javascript" src="./js/timeFrame.js"></script>
				<!--待开发-->
				<div class="dimDiv" style="text-align: center;height: 48px;">待开发</div>
			</div><!--消除空节点，释放 inline 间隔
			--><div id="content" class="">
				<div class="dimDiv" id="newBlog" onClick="window.location.href = 'content.php?is=new'">新建博客</div>
				<!---->
			<?php
			if ($_GET['page'] == null)
				$page = 1;
			else
				$page = $_GET['page'];
			
			$contentsObj = new userModel();
			if($_GET['order'] == 'new')
				$contents = $contentsObj->getContents($page, 'new');
			else
				$contents = $contentsObj->getContents($page);
			if ($contents == false)
				echo('<script>window.location.href="index.php"</script>');
			$contentsLength = count($contents);
			for ($i = 0; $i < $contentsLength; $i++){
			?>
				<div class="dimDiv blogContent" style="padding: 50px;" onClick="window.location.href='content.php?is=show&id=<?php echo($contents[$i]['id'])?>'">
					<div style="height: 100%; width: 100px; margin: 0 30px 0 0; display: inline-block; vertical-align: middle;">
						<div id="userHeadImg">
							<!--div></div>
							<div></div-->
						</div>
					</div>
					<p style="display: inline-block; line-height: 50px; height: 100px; width: calc(100% - 160px); vertical-align: top; word-wrap: break-word; word-break: break-all; overflow: hidden;">
						<?php echo($contents[$i]['title'])?>
					</p>
					<div style="width: 100%; height: 30px;"></div>
					<span style="font: 100 16px/20px songti; float: left;"><?php 
						echo($contentsObj->getUserInfo_id( $contents[$i]['userid'] )['username'] )
					?></span>
					<span style="font: 100 16px/20px songti; float: right;"><?php echo($contents[$i]['mktime'])?></span>					
				</div>
			<?php 
			}
			?>
			<div id="page_on" class="dimDiv">上一页</div>
			<div id="page_down" class="dimDiv">下一页</div>
			<script>
				var page = <?php echo($page)?>;
				document.getElementById('page_on').onclick = function(){
					page--;
					window.location.href = 'index.php?page=' + page;
				}
				document.getElementById('page_down').onclick = function(){
					page++;
					window.location.href = 'index.php?page=' + page;
				}
				if (document.getElementsByClassName('blogContent').length < 10)
					document.getElementById('page_down').style.display = 'none';
			</script>
			<?php
			if ($page <= 1)
				echo("<script>document.getElementById('page_on').style.display = 'none';</script>");
			?>
			
			</div>
			<a href="#this_top"><div id="goTop" class="dimDiv"><div style="width: 100%; height: 10px;"></div>返回<br>顶部</div></a>
		</div>
	</div>
	<div style="width: 100%; height: 80px;"></div>
	<div id="end" class="dimDiv">
		<p style="font-size: 18px; user-select: none; text-align: center;">
			版权所有：<span name="owner" style="user-select: all; color: #06F;">Fc-404</span>
			&nbsp;&nbsp;&nbsp;&nbsp;
			联系管理员：
			<span name="way" style="color: #59F">邮箱</span>&nbsp;
			<span name="wayPath" style="user-select: all;  color: #06F;">2601721443@qq.com</span>
		</p>
	</div>
</body>

<script type="text/javascript" src="./edit/wangEditor.min.js"></script>
<script type="text/javascript" src="./js/index.js"></script>
	
<?php
?>
	
</html>
