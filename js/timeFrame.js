/*时间模块js*/
upHour();
upMinute();
upSecont();

setInterval("upSecont()", 1000);

var date = new Date();
function upHour(){
	date = new Date();
	var week;
	switch(date.getDay()){
		case 1:week = '一'; break;
		case 2:week = '二'; break;
		case 3:week = '三'; break;
		case 4:week = '四'; break;
		case 5:week = '五'; break;
		case 6:week = '六'; break;
		case 0:week = '日'; break;
	}
	document.getElementById('timeYear').innerText = date.getFullYear();
	document.getElementById('timeMonth').innerText = date.getMonth() + 1;
	document.getElementById('timeDay').innerText = date.getDate();
	document.getElementById('timeHour').innerText = date.getHours();
	document.getElementById('timeWeek').innerText = week;
}
function upMinute(){
	date = new Date();
	document.getElementById('timeMinute').innerText = date.getMinutes();
	if (date.getMinutes() == 0)
		upHour();
}
function upSecont(){
	date = new Date();
	document.getElementById('timeSecont').innerText = date.getSeconds();
	if (date.getSeconds() == 0)
		upMinute();
}