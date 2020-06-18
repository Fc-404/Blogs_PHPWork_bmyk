<?php
//获取配置文件路径
$iniPath = __DIR__;
$iniPath = substr($iniPath, 0, -3).'ini/config.ini';
function getIniPath(){
	global $iniPath;
	return $iniPath;
}
if (!file_exists(getIniPath())){
	touch(getIniPath());
	setKeyValue('作者', 'Fc_404', '元');
	setKeyValue('日期', '贰零二零四月有余', '元');
}
//设置配置文件
function setKeyValue($key, $value, $group = ''){	
	$keyArr = parse_ini_file(getIniPath(), true);
	//print_r($keyArr);
	if ($key != '' && $value != ''){
		if ($group == ''){
			$keyArr[$key] = $value;
		}
		else{
			$keyArr[$group][$key] = $value;
		}

		//echo('<br>');
		//print_r($keyArr);
	}

	copy(getIniPath(), getIniPath().'.bak');
	$file = fopen(getIniPath(), 'r+');
	$str = "";

	$keyTemp = array();
	$keyTemp = array_keys($keyArr);
	//print_r($keyTemp);
	for ($i = 0; $i < count($keyTemp); $i++){
		if ( is_array($keyArr[$keyTemp[$i]]) ){
			$keyInKey = array();
			$keyInKey = array_keys($keyArr[$keyTemp[$i]]);
			$str = '['.$keyTemp[$i]."]\n";
			fwrite($file, $str);
			for ($j = 0; $j < count($keyArr[$keyTemp[$i]]); $j++){
				$str = $keyInKey[$j].'='.$keyArr[$keyTemp[$i]][$keyInKey[$j]]."\n";
				fwrite($file, $str);
			}
		}
		else {
			$str = $keyTemp[$i].'='.$keyArr[$keyTemp[$i]]."\n";
			fwrite($file, $str);
		}
	}
}
//获取配置文件
function getKeyValue($key = '', $group = ''){
	$keyArr = parse_ini_file(getIniPath(), true);
	//print_r($keyArr);
	if ($group != ''){
		if ($key != '')
			return(is_null($keyArr[$group][$key]) ? false : $keyArr[$group][$key]);
		return(is_null($keyArr[$group]) ? false : $keyArr[$group]);
	}
	if ($key != '')
		return(is_null($keyArr[$key]) ? false : $keyArr[$key]);
	return(is_null($keyArr) ? false : $keyArr);
}

class userModel {
	protected $DB;
	protected $fields = array();
	
	public function __construct(){
		$userHost = getKeyValue('db_host', 'linkInfomation');
		$userName = getKeyValue('db_user', 'linkInfomation');
		$userPass = getKeyValue('db_pass', 'linkInfomation');
		$baseName = getKeyValue('db_basename', 'linkInfomation');
		$this->DB = mysqli_connect($userHost, $userName, $userPass, $baseName) or die('
		<script>window.alert("\n\n连接错误\n\n\n请检查数据库");</script>
		');
		//print_r($this->DB);
	}
	//关闭数据库
	public function close(){
		mysqli_close($this->DB);
	}
	//用户是否存在
	public function beUser($userName){
		$sql = "select * from m_user where username = '".$userName."'";
		//echo($sql);
		$result = mysqli_query($this->DB, $sql);
		//print_r($result);
		if ($result->num_rows == 0)
			return false;
		$info = mysqli_fetch_assoc($result);
		return($info);
	}
	//新建用户
	public function addUser($username, $userpass){
		$sql = 'insert into m_user (username,userpass,intime,gid) 
				value (\''.$username.'\',\''.md5($userpass).'\',\''.date("Y-m-d-H-i-s").'\',\'1\')';
		$isOK = mysqli_query($this->DB, $sql);
		if ($isOK == true)
			return true;
		return false;
	}
	//核实用户
	public function verifyUser($username, $userpass){
		$sql = "select * from m_user where username = '$username' and userpass = '".md5($userpass)."'";
		$result = mysqli_query($this->DB, $sql);
		//print_r($result);
		if ($result->num_rows == 0)
			return false;
		return true;
	}
	//获取用户信息
	public function getUserInfo($username, $key = ''){
		if ($key == '')
			$sql = "select * from m_user where username = '$username'";
		else
			$sql = "select $key from m_user where username = '$username'";
		$result = mysqli_query($this->DB, $sql);
		$info = mysqli_fetch_assoc($result);
		return $info;
	}
	public function getUserInfo_id($id){
		if ($id == null)
			return false;
		$sql = "select * from m_user where id = '$id'";
		$result = mysqli_query($this->DB, $sql);
		if ($result->num_rows == 0)
			return false;
		$info = mysqli_fetch_assoc($result);
		return $info;
	}
	//修改用户名
	public function modifyName($userid, $newName){
		if ($this->beUser($newName) != false)
			return false;
		$sql = "update m_user set username = '$newName' where id = '$userid'";
		$isOK = mysqli_query($this->DB, $sql);
		if ($isOK == true)
			return true;
		return false;
	}
	//修改密码
	public function modifyPass($username, $newPass){
		$sql = "update m_user set userpass = '".md5($newPass)."' where username = '$username'";
		$isOK = mysqli_query($this->DB, $sql);
		if ($isOK == true)
			return true;
		return false;
	}
	//修改签名
	public function modifySign($userid, $newSign){
		$sql = "update m_user set sign = '$newSign' where id = '$userid'";
		$isOK = mysqli_query($this->DB, $sql);
		if ($isOK == true)
			return true;
		return false;
	}
	//删除账号
	public function userDel($userid){
		$sql = "delete from m_user where id = '$userid'";
		$isOK = mysqli_query($this->DB, $sql);
		if ($isOK == true)
			return true;
		return false;
	}
	
	//上传文章
	public function addContent($userid, $title, $content){
		if ($userid == null || $title == null || $content == null)
			return false;
		$sql = "insert into m_content (userid,title,content,mktime)
				value ('$userid', '$title', '$content', '".date("Y-m-d-H-i-s")."')";
		$isOK = mysqli_query($this->DB, $sql);
		if ($isOK == true)
			return true;
		return false;
	}
	//获取文章
	public function getContent($id){
		if (!is_numeric($id))
			return false;
		$sql = "select * from m_content where id = '$id'";
		$result = mysqli_query($this->DB, $sql);
		if ($result->num_rows == 0)
			return false;
		$info = mysqli_fetch_assoc($result);
		return($info);
	}
	//获取文章集
	public function getContents($page, $order = ''){
		if (!is_numeric($page))
			return false;
		if ($page < 1)
			return false;
		$up = ($page - 1) * 10;
		$down = $page * 10;
		$sql = "select * from m_content limit $up,$down";
		
		if ($order == 'new')
			$sql = "select * from m_content order by mktime desc limit $up,$down";
			
		$result = mysqli_query($this->DB, $sql);
		if ($result->num_rows == 0)
			return false;
		$info = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return($info);
	}
}

?>