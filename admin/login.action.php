<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once ("../include/config.inc.php");

if (isset ( $_POST ["username"] )) {
	$username = mysql_real_escape_string($_POST ["username"]);
} else {
	$username = "";
}
if (isset ( $_POST ["password"] )) {
	$password = mysql_real_escape_string($_POST ["password"]);
} else {
	$password = "";
}

if (empty($username)||empty($password)){
	exit("<script>alert('Username or Password Cannot Be Empty!');window.location.href='login.php';</script>");
}

if ($_POST ["vcode"] != $_SESSION['code']){
	exit("<script>alert('Verifying Code Not Correct!');window.location.href='login.php';</script>");
}

$user_row = $db->find("select admin_id from admin where username = '".$username."' and password='".md5 ( $password ) ."'");
if (!empty($user_row )) {
	$_SESSION['admin_id'] = $user_row['admin_id'];
	setcookie("username",$username,time()+60*60*24*365);
	if(isset($_COOKIE['lastURL'])&&!empty($_COOKIE['lastURL'])){
		header("Location: ".$_COOKIE['lastURL']);	
	}else{
		header("Location: index.php");
	}
}else{
	exit("<script>alert('Username or Password Incorrect!');window.location.href='login.php';</script>");
}
?>
