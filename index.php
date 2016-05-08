<?php 
require_once 'include/config.inc.php';
session_start();
$sql = "select id,title,pic,summary from news where slide_position>0 and rubbish=0 order by slide_position";
$news_list = $db->selectLimit($sql,5,0);
$sql = "select id,title,pic,event_time,event_location from event where rubbish=0 order by created_date desc";
$event_list = $db->selectLimit($sql,2,0);
$sql = "select id,title,pic,summary from news where rubbish=0 order by created_date desc";
$news_list_latest = $db->selectLimit($sql,3,0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Geng Table Tennis Academy</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="icon" href="images/logo_icon.jpg" type="image/x-icon" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.slidepanel.setup.js"></script>
<script type="text/javascript" src="js/jquery.cycle.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.setup.js"></script>
<script type="text/javascript" src="js/gen_validatorv4.js"></script>
	<link rel="stylesheet" href="styles/uibase/jquery.ui.all.css">
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
	<script src="js/ui/jquery.ui.tabs.js"></script>
	<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="programs.php">Programs</a></li>
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
  <div id="featured_slide">
	<?php
	foreach ( $news_list as $al ) {
	?>
    <div class="featured_box"><a href="news.php?id=<?php echo $al ['id'];?>"><img src="./<?php echo $al ['pic'];?>" alt="" /></a>
      <div class="floater">
        <h2><?php echo $al ['title'];?></h2>
        <p><?php echo $al ['summary'];?></p>
        <p class="readmore"><a href="news.php?id=<?php echo $al ['id'];?>">Continue Reading &raquo;</a></p>
      </div>
    </div>
	<?php
	}
	?>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="homecontent">
    <div class="fl_left">
      <div class="event">
	  
		<h2>Upcoming Events</h2>
        <ul>
          <li>
            <div class="imgholder"><img src="./<?php $token = explode(".",$event_list[0]['pic']);echo $token[0]."_240.". $token[1];?>" alt="" /></div>
			<p>Event: <a href="event.php?id=<?php echo $event_list[0]['id'];?>"><?php echo $event_list[0]['title'];?></a></p>
            <p>Time: <?php echo $event_list[0]['event_time'];?></p>
            <p>Location: <?php echo $event_list[0]['event_location'];?></p>
            <p class="readmore"><a href="event.php?id=<?php echo $event_list[0]['id'];?>">Continue Reading &raquo;</a></p>
          </li>
          <?php if (isset($event_list[1])) {?>
            <li class="last">
                <div class="imgholder"><img src="./<?php $token = explode(".",$event_list[1]['pic']);echo $token[0]."_240.". $token[1];?>" alt="" /></div>
    			<p>Event: <a href="event.php?id=<?php echo $event_list[1]['id'];?>"><?php echo $event_list[1]['title'];?></a></p>
                <p>Time: <?php echo $event_list[1]['event_time'];?></p>
                <p>Location: <?php echo $event_list[1]['event_location'];?></p>
                <p class="readmore"><a href="event.php?id=<?php echo $event_list[1]['id'];?>">Continue Reading &raquo;</a></p>
            </li>
          
          <?php
          }
          ?>
        </ul>
        <br class="clear" />
      </div>
	  <h2>Latest Notices</h2>
		<?php 
			if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
				include_once 'notice_list.php';
			else
				include_once 'notice_member.php';	
		?>
    </div>
    <div class="fl_right">
      <h2>Latest News</h2>
      <ul>
		<?php
		foreach ( $news_list_latest as $al ) {
		?>
        <li>
          <div class="imgholder"><a href="news.php?id=<?php echo $al ['id'];?>"><img src="./<?php $token = explode(".",$al['pic']);echo $token[0]."_125.". $token[1];?>" alt="" /></a></div>
          <p><strong><a href="news.php?id=<?php echo $al ['id'];?>"><?php echo $al ['title'];?></a></strong></p>
          <p><?php echo $al ['summary'];?></p>
        </li>
		<?php
		}
		?>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<?php include_once 'col45.php';?>

</body>
</html>
