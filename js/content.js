//关闭提示
{
	var new_clue_close = document.getElementById('new_clue');
	new_clue_close.lastElementChild.onclick = function(){
		new_clue_close.style.display = 'none';
	}
}
//发表内容检测
{
	document.getElementById('comeOut').onclick = function(){
		if (
			document.getElementById('new_title').lastElementChild.value != '' &&
			document.getElementById('new_content').lastElementChild.value != ''
		)
			document.forms[1].submit();
		else
			window.alert("标题 和 内容 不能为空");
	}
}