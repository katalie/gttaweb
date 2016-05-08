<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once ("include/config.inc.php");

if (isset ( $_POST ["email"] )) {
	$email = mysql_real_escape_string($_POST ["email"]);
} else {
	$email = "";
}
if (isset ( $_POST ["password"] )) {
	$password = mysql_real_escape_string($_POST ["password"]);
} else {
	$password = "";
}

$user_row = $db->find("select user_id from user where email = '".$email."' and password='".md5 ( $password ) ."' and registered = 1");
if (!empty($user_row )) {
	$_SESSION['user_id'] = $user_row['user_id'];
	setcookie("email",$email,time()+60*60*24*365);
	redirect('index.php',$time=3,$msg='You have login successfully! The System will redirect you to Home Page in 3 seconds!');
}else{
	exit("<script>alert('Email or Password Incorrect!');window.location.href='index.php';</script>");
}
?>
