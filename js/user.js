// JavaScript Document
//IE、Edge
if (window.navigator.userAgent.indexOf("Edge") > 0) {
	for (var i = 0; i < document.getElementsByClassName('dimDiv').length; i++){
		document.getElementsByClassName('dimDiv')[i].style.borderRadius = '0';
	}
}
if (window.navigator.userAgent.indexOf("rv") > 0) {
	for (var i = 0; i < document.getElementsByClassName('dimDiv').length; i++){
		//document.getElementsByClassName('dimDiv')[i].style.borderRadius = '0';
		document.getElementsByClassName('dimDiv')[i].style.background = "rgba(255,255,255,.8)";
	}
}
//使 sundry 模块底部对齐
{
	var sundry_top = document.getElementById('sundry').offsetHeight - window.innerHeight;
	document.getElementById('sundry').style.top = '-' + sundry_top + 'px';
}

//错误区 以下勿踩雷
//注册登录绑定
var signIn = document.getElementById('signin');
var signUp = document.getElementById('signup');
signIn.onclick = function(){
	window.location.href = './user.php?is=signin';
}
signUp.onclick = function(){
	window.location.href = './user.php?is=signup';
}

//isNull
function isNULL(form){
	if (form.userName.value == ''){
		form.userName.focus();
		document.getElementById('userNameInfo').innerText = '请输入账号！';
		return false;
	}
	document.getElementById('userNameInfo').innerText = '';
	if (form.userPass.value == ''){
		form.userPass.focus();
		document.getElementById('userPassInfo').innerText = '请输入密码！';
		return false;
	}
	document.getElementById('userPassInfo').innerText = '';
	
	if (!userNameFun(1))
		return false;
	if (!userPassFun(1))
		return false;
	
	form.submit();
}

//失去焦点后执行判断是否合法
var userName = document.getElementById('userName');
userName.onblur = userNameFun;
function userNameFun(on = 0){
	if (on == 0)
		return true;
	document.getElementById('userNameInfo').innerText = '';
	var regular = /^([0-9a-zA-Z]|[-_]){2,16}$/;
	if (regular.exec(userName.value))
		return true;
	document.getElementById('userNameInfo').innerHTML = 
		'<p style="font-size:16px;line-height:28px;">用户名必须由 2 至 16 位 数字、字母、- 或 _ 组成</p>';
	return false;
}
var userPass = document.getElementById('userPass');
userPass.onblur = userPassFun;
function userPassFun(on = 0){
	if (on == 0)
		return true;
	document.getElementById('userPassInfo').innerText = '';
	var regular = /^([0-9a-zA-Z]|[-_]){6,16}$/;
	if (regular.exec(userPass.value))
		return true;
	document.getElementById('userPassInfo').innerHTML = 
		'<p style="font-size:16px;line-height:28px;">密码必须由 6 至 16 位 数字、字母、- 或 _ 组成</p>';
	return false;
}