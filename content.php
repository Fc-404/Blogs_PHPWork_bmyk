<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="js/rootVar.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/root.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<title></title>
</head>
	
<?php
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
				--><span id="hot">热门</span><!--
				--><span id="new">最新</span>
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
						if ($userObj->getUserInfo($_COOKIE['bmykBlogs'])['userpass'] != $_COOKIE[$_COOKIE['bmykBlogs']])
							echo('<script>window.location.href="user.php?is=signup"</script>');
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
			<?php
				if ($_GET['is'] == 'new'){
				?>
					<form method="post" action="php/upcontent.php?is=add&id=<?php echo($userInfo['id'])?>">
						<div id="new_clue" class="dimDiv" style="">
							<font color="#ee0" style="font-size: 18px;">提示：</font><br>标题最长为 32 字符<br>内容最长为 10240 字符
							<div>关闭</div>
						</div>
						<div id="new_title" class="dimDiv">标题
							<input name="new_title" type="text" maxlength="32">
						</div>
						<div id="new_content" class="dimDiv">正文
							<textarea name="new_content" maxlength="10240"></textarea>
						</div>
						<div id="comeOut" class="dimDiv">发表</div>
					</form>
					
				<?php
				}
				if ($_GET['is'] == 'show'){
					if ($_GET['id'] == null){
						?>
						<div class="dimDiv" style="height: 500px; text-align: center;">
							<div style="width: 100%; height: 200px;"></div>
							<font style="font-size: 48px; color: #f52;">内容不存在</font>
							<br><br><br>
							<p><span id="content_return_count" style="color: red">5</span>秒后返回主页</p>
						</div>
						<script>
							setInterval(
								function(){
									if (document.getElementById('content_return_count').innerText <= 0)
										window.location.href = "index.php";
									else
										document.getElementById('content_return_count').innerText -= 1;							
								}, 1000);
						</script>
						<?php
					}
					else{
						$contentObj = new userModel();
						$contentInfo = $contentObj->getContent($_GET['id']);
						if ($contentInfo == false)
							echo('<script>window.location.href="content.php?is=show"</script>')
						?>
						<div class="dimDiv" style="padding: 12px 20px 32px; position: sticky; top: 36px; z-index: 10; user-select: text; -webkit-user-select: text;">
							<h1 style="text-align: center; color: #f51; font-weight: 600;"><?php echo($contentInfo['title'])?></h1>
							<span style="float: left; font: 100 16px/18px sontti; color: #521;">作者：<?php 
								echo($contentObj->getUserInfo_id($contentInfo['userid'])['username']);
							?></span>
							<span style="float: right; font: 100 16px/18px sontti; color: #521;">日期：<?php echo($contentInfo['mktime'])?></span>
						</div>
						<div class="dimDiv" style="padding: 60px; user-select: text; -webkit-user-select: text;">
							<pre style="height: auto; width: 100%; white-space: pre-wrap; word-wrap: break-word;"><!--
								--><?php echo($contentInfo['content'])?><!--
							--></pre>
						</div>
						<?php
					}
				}
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
<script type="text/javascript" src="./js/content.js"></script>
	
<?php
?>
	
</html>
