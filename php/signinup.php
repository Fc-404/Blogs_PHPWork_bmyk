<?php
include('./tools.php');

$userObj = new userModel();
if ($_GET['is'] == 'signin'){
	//echo('signin');
	if ($userObj->beUser($_POST['userName']) == false){
		if ($userObj->addUser($_POST['userName'], $_POST['userPass']) == true){
			setcookie($_POST['userName'], md5($_POST['userPass']), time() + 3600 * 24, '/');
			$userObj->close();
			setcookie('bmykBlogs', $_POST['userName'], time() + 3600 * 24, '/');
			echo('<script>window.location.href="../user.php?is=homepage&username='.$_POST['userName'].'"</script>');
		}
		else{
			$userObj->close();
			echo('<script>window.alert("注册失败！");wondow.location.href="user.php?is=signin";</script>');
		}
	}
	else{
		echo('<script>window.location.href="../user.php?is=signin&error=occupy"</script>');
	}
	
}
if ($_GET['is'] == 'signup'){
	//echo('signup');
	if ($userObj->verifyUser($_POST['userName'], $_POST['userPass'])){
		setcookie($_POST['userName'], md5($_POST['userPass']), time() + 3600 * 24, '/');
		setcookie('bmykBlogs', $_POST['userName'], time() + 3600 * 24, '/');
		$userObj->close();
		echo('<script>window.location.href="../user.php?is=homepage&username='.$_POST['userName'].'"</script>');
	}
	else{
		$userObj->close();
		echo('<script>window.location.href="../user.php?is=signup&error=nologin"</script>');
	}
}
//账户功能
if ($_GET['is'] == 'userNameM'){
	//echo($_GET['user']);
	if ($_POST['userNameM'] == null){
		echo('<script>window.alert("\n错误！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
	if ($userObj->modifyName($_GET['id'], $_POST['userNameM'])){
		$userObj->close();
		echo('<script>window.alert("\n修改成功！\n请重新登录！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage&username='.$_POST['userNameM'].'"</script>');
	}
	else{
		$userObj->close();
		echo('<script>window.alert("\n用户名被占用！\n修改失败！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
}
if ($_GET['is'] == 'userSignM'){
	//echo($_GET['user']);
	if ($_POST['userSignM'] == null){
		echo('<script>window.alert("\n错误！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
	if ($userObj->modifySign($_GET['id'], $_POST['userSignM'])){
		$userObj->close();
		//echo('<script>window.alert("\n修改成功！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
	else{
		$userObj->close();
		echo('<script>window.alert("\n修改失败！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
}
if ($_GET['is'] == 'userDel'){
	//echo($_POST['userId']);
	if ($_POST['userId'] == null){
		echo('<script>window.alert("\n错误！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
	if ($userObj->userDel($_POST['userId'])){
		$userObj->close();
		echo('<script>window.alert("\n删除成功！\n");</script>');
		echo('<script>window.location.href="../user.php?is=signup"</script>');
	}
	else{
		$userObj->close();
		echo('<script>window.alert("\n删除失败！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
}
if ($_GET['is'] == 'userPassM'){
	if ($userObj->verifyUser($_GET['username'], $_POST['userPassMold'])){
		if ($userObj->modifyPass($_GET['username'], $_POST['userPassMnew']) == true){
			echo('<script>window.alert("\n修改成功！\n请重新登录！\n");</script>');
			echo('<script>window.location.href="../user.php?is=signup"</script>');
		}
	}
	else{
		echo('<script>window.alert("\n原密码验证失败！\n");</script>');
		echo('<script>window.location.href="../user.php?is=homepage"</script>');
	}
}
?>