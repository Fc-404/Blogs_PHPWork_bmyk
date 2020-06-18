<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/root.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/user.css">
<script type="text/javascript" src="./js/rootVar.js"></script>
<title>登录</title>
</head>

<body>
	
	<?php
	include('./php/tools.php');
	//检测是否安装数据库
	if (!getKeyValue('db_user', 'linkInfomation')){
	?>
	<script>
		window.confirm("\n\n您的网站似乎没有安装服务！\n\n\n请单击确认安装服务！")
		window.location.href = 'install.php';
	</script>
	<?php
	}
	?>
	
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
				<span id="hot">热门</span>
				<span id="new">最新</span>
				<form action="" method="get">
					<input type="text" name="keyword" style="background-color: rgba(0, 0, 0, .2);" value="<!?php echo($_GET['keyword']);?>"><!--
					<input type="submit" value="搜索">
				</form>-->
			</div>
		</div>
		
		<div style="width: 100%; height: 20px"></div>
		<div id="sundry" class="">
			<!--用户-->
			<div id="userBrief" class="dimDiv">
				<div id="userHeadImg">
					<div></div>
					<div></div>
					
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
			</style>
			<!--日历模块-->
			<link rel="stylesheet" type="text/css" href="css/cldFrame.css">
			<div id="cldFrame"  class="dimDiv">
        		<div id="cldBody">
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
			<?php
				if ($_GET['is'] == 'signin'){
			?>
				<div id="userSign" class="dimDiv">
					<div style="width: 100%; height: 50px;"></div>
					<div id="userHeadImg">
						<div></div>
						<div></div>
					</div>
					<p>头像功能待开发...</p>
					<div style="width: 100%; height: 20px;"></div>
					<form action="./php/signinup.php?is=signin" method="post">
						<!--input type="file" name="userHeadImg"-->
						<div id="userNameFar">
							<span>账号：</span>
							<input id="userName" type="text" name="userName">
							<span id="userNameInfo"></span>
						</div>
						<br>
						<div id="userPassFar">
							<span>密码：</span>
							<input id="userPass" type="password" name="userPass">
							<span id="userPassInfo"></span>
						</div>
						<br>
						<div style="width: 100%; height: 10px;"></div>
						<div id="userSubmitFar">
							<input id="userSubmit" type="submit" name="userInfoSub" value="注册" onClick="return isNULL(form);">
						</div>
						<div style="width: 100px; height: 50px;"></div>
					</form>
				</div>
			<?php
					if ($_GET['error'] == 'occupy'){
						echo('<script>document.getElementById("userNameInfo").innerText="用户名已存在"</script>');
					}
				}
				if ($_GET['is'] == 'signup'){
			?>
				<div id="userSign" class="dimDiv">
					<div style="width: 100%; height: 50px;"></div>
					<div id="userHeadImg">
						<div></div>
						<div></div>
					</div>
					<p>头像功能待开发...</p>
					<div style="width: 100%; height: 20px;"></div>
					<form action="./php/signinup.php?is=signup" method="post">
						<!--input type="file" name="userHeadImg"-->
						<div id="userNameFar">
							<span>账号：</span>
							<input id="userName" type="text" name="userName">
							<span id="userNameInfo"></span>
						</div>
						<br>
						<div id="userPassFar">
							<span>密码：</span>
							<input id="userPass" type="password" name="userPass">
							<span id="userPassInfo"></span>
						</div>
						<br>
						<div style="width: 100%; height: 10px;"></div>
						<div id="userSubmitFar">
							<input id="userSubmit" type="submit" name="userInfoSub" value="登录"  onClick="return isNULL(form);">
						</div>
						<div style="width: 100px; height: 50px;"></div>
					</form>
				</div>
			<?php
					if ($_GET['error'] == 'nologin')
						echo('<script>document.getElementById("userNameInfo").innerText="登录失败"</script>');
				}
				if ($_GET['is'] == 'homepage'){
					//echo($_COOKIE[$_GET['username']]);
					include_once('./php/tools.php');
					$userObj = new userModel();
					if ($userObj->getUserInfo($_COOKIE['bmykBlogs'])['userpass'] != $_COOKIE[$_COOKIE['bmykBlogs']])
						echo('<script>window.location.href="user.php?is=signup"</script>');
					$userInfo = $userObj->getUserInfo($_COOKIE['bmykBlogs']);
				?>
				<script>
					var userBrief = document.getElementById('userBrief');
					userBrief.getElementsByClassName('infoId')[0].innerText = '<?php echo($userInfo['id']);?>';
					userBrief.getElementsByClassName('infoId')[0].style.backgroundColor = 'transparent';
					userBrief.getElementsByClassName('infoId')[0].style.color = '#f51';
					userBrief.getElementsByClassName('infoId')[0].style.fontWeight = '600';
					userBrief.getElementsByClassName('infoNa')[0].innerText = '<?php echo($userInfo['username']);?>';
					userBrief.getElementsByClassName('infoNa')[0].style.backgroundColor = 'transparent';
					userBrief.getElementsByClassName('infoNa')[0].style.color = '#f51';
					userBrief.getElementsByClassName('infoNa')[0].style.fontWeight = '600';
					userBrief.getElementsByClassName('infoSi')[0].innerText = '<?php echo($userInfo['sign']);?>';
					//
					document.getElementById('signin').innerText = '';
					document.getElementById('signup').id = 'exit';
					document.getElementById('exit').innerText = '退出';
					document.getElementById('exit').onclick = function(){
						window.location.href = 'index.php?clear=true';
					}
				</script>
					<?php 
						if($userInfo['sign'] != '')
							echo('<script>userBrief.getElementsByClassName("infoSi")[0].style.backgroundColor = "transparent"</script>');
					?>
				<script>
					userBrief.getElementsByClassName('infoSi')[0].style.color = '#f51';
					userBrief.getElementsByClassName('infoSi')[0].style.fontWeight = '600';
				</script>
				<!--homepage-->
				<div id="homepage">
					<div class="dimDiv">
						<p style="font-size: 32px;"><span style="font-weight: 700">·</span>&nbsp;基本信息</p><br>
						
						<form method="post" action="php/signinup.php?is=userNameM&id=<?php echo($userInfo['id'])?>">
						<tab></tab><span>昵称：</span>
						<input name="userNameM" type="text" class="myinput" value="<?php echo($userInfo['username'])?>">
						<tab></tab><mybutton id="userNameM">修改</mybutton>
						<br><br>
						</form>
						
						<form method="post" action="php/signinup.php?is=userSignM&id=<?php echo($userInfo['id'])?>">
						<tab></tab><span>签名：</span>
						<textarea name="userSignM" class="myinput" maxlength="64" style="resize: none; height: 100px; position: relative; bottom: -12px;"><?php echo($userInfo['sign'])?></textarea>
						<tab></tab><mybutton id="userSignM">修改</mybutton>
						<br><br>
						</form>
						
						<tab></tab><span>头像：</span>
						<span style="font-weight: 700; color: #666;">待开发...</span>
						<br><br>
								
						<tab></tab><span>ID 号：</span>
						<span style="user-select: all; -webkit-user-select: all; font-weight: 700; color: #666"><?php echo($userInfo['id'])?></span>
						<br><br>
						
						<tab></tab><span>用户组：</span>
						<span style="user-select: text; -webkit-user-select: text; color: #222; font-weight: 700; color: #666;"><?php echo($userInfo['gid'])?></span>
						<br><br>
						
						<tab></tab><span>注册时间：</span>
						<span style="user-select: text; -webkit-user-select: text; color: #222; font-weight: 700; color: #666;"><?php echo($userInfo['intime'])?></span>
					</div>
					
					<div class="dimDiv">
						<p style="font-size: 32px;"><span style="font-weight: 700">·</span>&nbsp;账号管理</p><br>
						<form method="post" action="php/signinup.php?is=userPassM&username=<?php echo($userInfo['username'])?>">
						<div style="padding: 0; margin: 0;">
							<tab></tab><span>原密码：<div style="display: inline-block; height: 2px; width: 26px; padding: 0;"></div></span><!--
							--><input name="userPassMold" type="text" class="myinput"><br>
							<tab></tab><span>新密码：<div style="display: inline-block; height: 2px; width: 26px; padding: 0;"></div></span><!--
							--><input name="userPassMnew" type="password" class="myinput"><br>
							<tab></tab><span>确认密码：</span>
							<input type="password" class="myinput">
							<tab></tab><mybutton id="userPassM">修改</mybutton>
						</div>
						</form>
						<br><br>
						<form method="post" action="php/signinup.php?is=userDel">
							<input name="userId" value="<?php echo($userInfo['id'])?>" style="display: none">
						<mybutton id="userDel" style="width: 200px">删除账号</mybutton>
						</form>
					</div>
					
					<script>
						//
						var NAME = document.getElementById('userNameM').previousElementSibling.previousElementSibling.value;
						var SIGN = document.getElementById('userSignM').previousElementSibling.previousElementSibling.value;
						//console.log(NAME);
						//console.log(SIGN);
						//toHref
						document.getElementById('userNameM').onclick = function(){ 
							if (this.previousElementSibling.previousElementSibling.value == NAME)
								return 0;
							//window.location.href = 'php/signinup.php?is=userNameM&id=<php echo($userInfo['id'])?>&newName='+this.previousElementSibling.previousElementSibling.value; 
							this.parentElement.submit();
						}
						document.getElementById('userSignM').onclick = function(){ 
							if (this.previousElementSibling.previousElementSibling.value == SIGN)
								return 0;
							//window.location.href = 'php/signinup.php?is=userSignM&id=<php echo($userInfo['id'])?>'; 
							this.parentElement.submit();
						}
						document.getElementById('userPassM').onclick = function(){ 
							var old = this.parentElement.getElementsByTagName('input');
							var regular = /^([0-9a-zA-Z]|[-_]){6,16}$/;
							
							if (old[1].value == old[2].value){
								if (regular.exec(old[1].value))
									//window.location.href = 'php/signinup.php?is=userPassM&id=<php echo($userInfo['id'])?>'; 
									this.parentElement.parentElement.submit();
								else
									window.alert('密码必须由 6 至 16 位 数字、字母、- 或 _ 组成')
							}
							else
								window.alert('两次密码不正确\n请重试');
						}
						document.getElementById('userDel').onclick = function(){ 
							if (window.confirm('\n确定要删除账号吗？\n'))
								if (window.confirm('\n请三思！！！\n'))
									//window.location.href = 'php/signinup.php?is=userDel&id=<php echo($userInfo['id'])?>'; 
									this.parentElement.submit();
						}
					</script>
				</div>
				<?php
				}
			?>
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
<script type="text/javascript" src="./js/user.js"></script>
<script type="text/javascript">
	//动态改标题
	document.title = '用户<?php if($_GET['is']=="signin")echo('注册'); if($_GET['is']=="signup")echo('登录'); if($_GET['is']=="homepage")echo('主页');?>';
	document.getElementById('BRAND').innerText = '用户<?php if($_GET['is']=="signin")echo('注册'); if($_GET['is']=="signup")echo('登录');if($_GET['is']=="homepage")echo('主页');?>';
</script>
	
<?php
?>
	
</html>