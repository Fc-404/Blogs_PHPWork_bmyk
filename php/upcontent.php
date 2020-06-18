<?php
include('tools.php');
$userObj = new userModel();

if ($_GET['is'] == 'add'){
	$content = $_POST['new_content'];
	$content = str_replace("'", "''", $content);

	if ($userObj->addContent($_GET['id'], $_POST['new_title'], $content) == false){
		$userObj->close();
		echo('<script>window.alert("新建博客失败！\n请重试！")</script>');
		echo('<script>window.history.go(-1);</script>');
	}
	else{
		$userObj->close();
		echo('<script>window.alert("新建博客成功！")</script>');
		echo('<script>window.location.href="../index.php?order=new";</script>');
	}
}
?>