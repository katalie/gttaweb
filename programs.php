<?php 
require_once 'include/config.inc.php';
session_start();
$sql = "select * from notice where id=1";
$result= $db->find($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>GTTA - Programs</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="icon" href="images/logo_icon.jpg" type="image/x-icon" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.slidepanel.setup.js"></script>
<script type="text/javascript" src="js/jquery.cycle.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.setup.js"></script>
<script type="text/javascript" src="js/gen_validatorv4.js"></script>
</head>
<body>
<?php 
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
	include_once 'col0.php';
else
	include_once 'col0_login.php';	
?>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <img src="images/logo.jpg" width="160" height="85"/>
	</div>
    <div id="topnav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="programs.php">Programs</a></li>
        <li><a href="newslist.php">News</a></li>
        <li><a href="eventlist.php">Events</a></li>
		<li><a href="https://plus.google.com/photos/111772324553579024097/albums?banner=pwa" target="_blank">Photo Gallery</a></li>
		<li><a href="./archives/" target="_blank">Archives</a></li>
        <li class="last"><a href="about.php">About Us</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">You Are Here</li>
      <li>&#187;</li>
      <li><a href="index.php">Home</a></li>
      <li>&#187;</li>
      <li><?php echo $result ['title'];?></a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <h1 align="center"><?php echo $result ['title'];?></h1>
    <p><?php echo $result ['content'];?></p> 
  </div>
</div>
<!-- ####################################################################################################### -->
<?php include_once 'col45.php';?>
</body>
</html>
