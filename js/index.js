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
//标题名
document.title = BRAND;
document.getElementById('BRAND').innerText = BRAND;
//使 sundry 模块底部对齐
{
	var sundry_top = document.getElementById('sundry').offsetHeight - window.innerHeight;
	document.getElementById('sundry').style.top = sundry_top + 'px';
}
//
window.onscroll = function(){
	//console.log(window.pageYOffset);
	if (window.pageYOffset > window.innerHeight)
		document.getElementById('goTop').style.display = 'block';
	else
		document.getElementById('goTop').style.display = 'none';
}
//注册登录绑定
var signIn = document.getElementById('signin');
var signUp = document.getElementById('signup');
signIn.onclick = function(){
	window.location.href = './user.php?is=signin';
}
signUp.onclick = function(){
	window.location.href = './user.php?is=signup';
}