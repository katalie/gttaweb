<?php
require_once 'include/config.inc.php';
require_once 'include/function.admin.php';
session_start();
$cid 		= !empty($cid) ? intval($cid) : 0;
$page 		= !empty($page) ? intval($page) : 1;
$page_size 	= 5;
$mpurl 		= $_SERVER['PHP_SELF']."?cid=".$cid;

//��ѯSQL
$sql = "select a.*,b.name
		from event a, category_event b 
		where a.rubbish = 0 and a.cid=b.id";
if($cid != 0){
	$sql .= " and a.cid=".$cid;
}

$sql .= " order by created_date desc";

//�ܼ�¼��
$total_nums = $db->getRowsNum ($sql);

//ִ�з�ҳ��ѯ
$event_list = $db->selectLimit ( $sql, $page_size, ($page - 1) * $page_size );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>GTTA - Events</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
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
        <li><a href="programs.php">Programs</a></li>
        <li><a href="newslist.php">News</a></li>
        <li class="active"><a href="eventlist.php">Events</a></li>
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
	  <li><a href="eventlist.php">Events</a></li>
      <li><?php echo $cid==''?"":"<li>&#187;</li> ".$event_list[0]['name'];?></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="content">
      <h2>Events List</h2>
      <ul>
		<?php
		if ($event_list==null)
			echo "<p>Oops! Nothing been found! Please try a sub-category.</p>";
		else{
		foreach ( $event_list as $al ) {
		?>
        <li>
          <div class="imgholder"><a href="event.php?id=<?php echo $al ['id'];?>"><img src="./<?php $token = explode(".",$al['pic']);echo $token[0]."_125.". $token[1];?>" alt="" /></a></div>
          <p>Event: <a href="event.php?id=<?php echo $al ['id'];?>"><?php echo $al['title'];?></a></p>
          <p>Time: <?php echo $al['event_time'];?></p>
          <p>Location: <?php echo $al['event_location'];?></p>
        </li>
		<?php
		}
		}
		?>
      </ul>
	  <div style="float: left; padding-right: 50px"> 
			<?php echo multi ( $total_nums, $page_size, $page, $mpurl, 0, 5 );?></div>
    </div>
    <div id="column">
      <div class="subnav">
        <h2>Event Category</h2>
		
		<?php echo getCategoryList_front_event($id = 0, $level = 0);?>
        
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!-- ####################################################################################################### -->
<?php include_once 'col45.php';?>
</body>
</html>
