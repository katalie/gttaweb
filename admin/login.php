<?php
if(isset($_COOKIE['username'])){
	$username = $_COOKIE['username'];
}else{
	$username="";
}
$finput=empty($username)?"username":"password";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
window.onload=function(){
	document.getElementById('<?php echo $finput;?>').focus();
}
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GTTA Admin Login Box</title>

<link href="images/login-box.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form action="login.action.php" method="post">
<div align="center">


<div id="login-box">

<H2>Login</H2>
Welcome to GTTA's Administrator Login Page.
<br />
<br />

	<div id="login-box-name" style="margin-top:20px;">Username:</div>
	<div id="login-box-field" style="margin-top:20px;"><input name="username" class="username" title="Username" value="" size="30" maxlength="2048" /></div>
	
	<div id="login-box-name">Password:</div>
	<div id="login-box-field"><input name="password" type="password" class="password" title="Password" value="" size="30" maxlength="2048" /></div>
	
	<div id="login-box-name">Security Code:</div>
	<div id="login-box-field"><input type="text" name="vcode" class="vcode" title="Security Code" value="" size="30" maxlength="20" />
	</div><div><img src="../include/verifying_code.php"></div>
	<input name="image" type="image" src="images/login-btn.png" width="103" height="40" style="margin-top:5px;"/>
</div>
</div>
</form>


</body>
</html>
