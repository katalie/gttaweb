<?php 
require_once 'include/config.inc.php';
session_start();

$sql = "select a.*,b.name
		from news a, category b 
		where a.id=".$_GET ['id']." and a.rubbish = 0 and a.cid=b.id";
$news= $db->find($sql);

//$sql = "select * from comment where nid='".$_GET ['id']."'";
//$comment_list = $db->findAll($sql);

$sql = "select a.*
		from news a, category b 
		where a.rubbish = 0 and a.cid=b.id";
$news_list = $db->selectLimit($sql,2,rand(-1, $db->getRowsNum($sql)-2));

$hits = array('hits'=>($news['hits']+1));
$db->update('news',$hits,"id=".$_GET ['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>GTTA - News</title>
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <img src="images/logo.jpg" width="180" height="80"/>
	</div>
    <div id="topnav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="programs.php">Programs</a></li>
        <li class="active"><a href="newslist.php">News</a></li>
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
	  <li><a href="newslist.php">News</a></li>
      <li>&#187;</li>
      <li><a href="newslist.php?cid=<?php echo $news ['cid'];?>"><?php echo $news ['name'];?></a></li>
      <li>&#187;</li>
      <li><?php echo $news ['title'];?></a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="eventcontent">
      <h1 align="center"><?php echo $news ['title'];?></h1>
	  <p align="center">Created Time: <?php echo $news ['created_date'];?>&nbsp; &nbsp; Hits: <?php echo $news ['hits'];?></p> 
	  <p><?php echo $news ['content'];?></p>
	  </br>
<!--  	  <div id="comments">
        <h2>Comments</h2>
      <ul class="commentlist">
		<?php
		foreach ( $comment_list as $al ) {
		?>
          <li class="comment_even">
            <div class="author"><img class="avatar" src="images/demo/avatar.gif" width="32" height="32" alt="" /><span class="name"><a href="#"><?php echo $al ['name'];?></a></span> <span class="wrote">wrote:</span></div>
            <div class="submitdate"><a href="#"></a><?php echo $al ['comment_time'];?></div>
            <p><?php echo $al ['content'];?></p>
          </li>
		 <?php
		}
		?>
        </ul>

      </div>-->
<!--
	  <h2>Write A Comment</h2>
      <div id="respond">
        <form action="comment.action.php" id="comment_form" name="comment_form" method="post">
          <p>
			<input type="hidden" name="nid" id="nid" value="<?php echo $news['id'];?>" size="22" />
            <input type="text" name="name" id="name" value="<?php echo $user['nick_name'];?>" size="22" />
            <label for="name"><small>Name (required)</small></label><div id='comment_form_name_errorloc' class="error_strings"></div>
          </p>
          <p>
            <textarea id="elm1" name="comment" rows="10" cols="100%"></textarea>
			<div id='comment_form_comment_errorloc' class="error_strings"></div>
          </p>
          <p>
            <input name="submit" type="submit" id="submit" value="Submit Form" />
            &nbsp;
            <input name="reset" type="reset" id="reset" tabindex="5" value="Reset Form" />
          </p>
        </form>
      </div>
-->
	  </br>
	</div>

	<div id="column">
		<div id="featured">
			<ul>
			  <li>
				<h2>Related News</h2>
				</br>
				<div ><img src="./<?php $token = explode(".",$news_list[0]['pic']);echo $token[0]."_240.". $token[1];?>" alt="" /></div></br>
				<p><a href="news.php?id=<?php echo $news_list[0]['id'];?>"><?php echo $news_list[0]['title'];?></a></p></br>
				<p><?php echo $news_list[0]['summary'];?></p>
				<p class="readmore"><a href="news.php?id=<?php echo $news_list[0]['id'];?>">Continue Reading &raquo;</a></p>
			  </li>
			  <li>
				</br>
				<div ><img src="./<?php $token = explode(".",$news_list[1]['pic']);echo $token[0]."_240.". $token[1];?>" alt="" /></div></br>
				<p><a href="news.php?id=<?php echo $news_list[1]['id'];?>"><?php echo $news_list[1]['title'];?></a></p></br>
				<p><?php echo $news_list[1]['summary'];?></p>
				<p class="readmore"><a href="news.php?id=<?php echo $news_list[1]['id'];?>">Continue Reading &raquo;</a></p>
			  </li>
			</ul>
		</div>
    </div>
  </div>
    
	<div class="clear"></div>
</div>

<!-- ####################################################################################################### -->

<?php include_once 'col45.php';?>
<script type="text/javascript">
/*
var frmvalidator  = new Validator("comment_form");
	frmvalidator.EnableMsgsTogether();
	frmvalidator.EnableOnPageErrorDisplay();

	frmvalidator.addValidation("name","req", "Please enter your name!");
	frmvalidator.addValidation("comment","req", "Please enter your comment!");
	frmvalidator.addValidation("comment","maxlen=1500","For comment, Max length is 1000 letters!");
*/
</script>
</body>
</html>
