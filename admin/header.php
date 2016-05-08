<?php
include_once 'global.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="images/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function editPassword(){
	parent.mainFrame.location="admin.editpwd.php?act=editpwd&hlink="+encodeURIComponent(parent.mainFrame.location);
}
</script>
<style type="text/css">
<!--

a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
#logo {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 20px;
	color: #2588AD;
}
#phpcms2 {
	font-family: Tahoma, Geneva, sans-serif;
	font-weight: bold;
}
-->
</style>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="300" height="40" align="center" valign="middle"><font id="logo">Geng Table Tennis Academy</font></td>
    <td align="right" valign="bottom" style="padding-right:30px; padding-top:0px; font-size:12px">
      Welcome：<strong>Admin</strong>&nbsp!&nbsp; 
      <a style="color:#6285FF" href="../" target="_blank"><strong>Home Page |</strong></a>
      <a style="color:#6285FF" href="javascript:editPassword()"><strong>Change Password |</strong></a>&nbsp; 
      <a style="color:#6285FF" href="login.out.php"><strong>Logout</strong></a>&nbsp; 
    </td>
  </tr>
</table>
</body>
</html>

