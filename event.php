<?php 
require_once 'include/config.inc.php';
require_once 'include/function.admin.php';
session_start();
$sql = "select a.*,b.name
		from event a, category_event b 
		where a.id=".$_GET ['id']." and a.rubbish = 0 and a.cid=b.id";
$event= $db->find($sql);
$sql = "select a.*
		from event a, category_event b 
		where a.rubbish = 0 and a.cid=b.id";
$event_list = $db->selectLimit($sql,2,rand(-1, $db->getRowsNum($sql)-2));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>GTTA - Event</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="stylesheet" href="styles/uibase/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="styles/fg_membersite.css" />
<link rel="icon" href="images/logo_icon.jpg" type="image/x-icon" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.slidepanel.setup.js"></script>
<script type="text/javascript" src="js/jquery.cycle.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.setup.js"></script>
<script type="text/javascript" src="js/gen_validatorv4.js"></script>

<script src="js/ui/jquery.ui.core.js"></script>
<script src="js/ui/jquery.ui.widget.js"></script>
<script src="js/ui/jquery.ui.mouse.js"></script>
<script src="js/ui/jquery.ui.draggable.js"></script>
<script src="js/ui/jquery.ui.position.js"></script>
<script src="js/ui/jquery.ui.resizable.js"></script>
<script src="js/ui/jquery.ui.dialog.js"></script>
<script src="js/ui/jquery.ui.effect.js"></script>
<script src="js/ui/jquery.ui.effect-blind.js"></script>
<script src="js/ui/jquery.ui.effect-explode.js"></script>
<script src="js/ui/jquery.ui.button.js"></script>

<script src="js/ui/jquery.ui.datepicker.js"></script>
<script>
	$(function() {
		$( "#age" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: "-100y"
		});
	});
</script>

<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		$( "#register_dialog" ).dialog({
			autoOpen: false,
			position:"top",
			show: "blind",
			hide: "explode",
			modal: true,
			height: 500,
			width: 360
		});
		
		$( "#opener" ).button().click(function() {
			$( "#register_dialog" ).dialog( "open" );
			return false;
		});
		
		$( "#cancel" ).button().click(function() {
			$( "#register_dialog" ).dialog( "close" );
			return false;
		});
		
		$( "#submit_button" ).button();
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
		<img src="images/logo.jpg" width="160" height="85"/>	</div>
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
	  <li><a href="eventlist.php">Event</a></li>
      <li>&#187;</li>
      <li><a href="eventlist.php?cid=<?php echo $event ['cid'];?>"><?php echo $event ['name'];?></a></li>
      <li>&#187;</li>
      <li><?php echo $event ['title'];?></a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="eventcontent">
      <h2 align="center"><?php echo $event ['title'];?></h2>
	  <div  style="float:right">
		<?php echo $event ['registration_due_date']<date("Y-m-d ")?'<p style="float:left;color:red">This event is not open for registration online currently.</p>':"";?>
		<button id="opener" style="float:right" <?php echo $event ['registration_due_date']<date("Y-m-d ")?disabled:"";?>>Join Now!</button>
	  </div></br></br>
      <p><?php echo $event ['content'];?></p>
    </div>
    <div id="column">
		<div id="featured">
			<ul>
			  <li>
				<h2>Related Events</h2>
				</br>
				<div ><img src="./<?php $token = explode(".",$event_list[0]['pic']);echo $token[0]."_240.". $token[1];?>" alt="" /></div></br>
				<p>Event: <a href="event.php?id=<?php echo $event_list[0]['id'];?>"><?php echo $event_list[0]['title'];?></a></p>
				<p>Time: <?php echo $event_list[0]['event_time'];?></p>
				<p>Location: <?php echo $event_list[0]['event_location'];?></p>
				<p class="readmore"><a href="event.php?id=<?php echo $event_list[0]['id'];?>">Continue Reading &raquo;</a></p>
			  </li>
			  <li>
				</br>
				<div><img src="./<?php $token = explode(".",$event_list[1]['pic']);echo $token[0]."_240.". $token[1];?>" alt="" /></div></br>
				<p>Event: <a href="event.php?id=<?php echo $event_list[1]['id'];?>"><?php echo $event_list[1]['title'];?></a></p>
				<p>Time: <?php echo $event_list[1]['event_time'];?></p>
				<p>Location: <?php echo $event_list[1]['event_location'];?></p>
				<p class="readmore"><a href="event.php?id=<?php echo $event_list[1]['id'];?>">Continue Reading &raquo;</a></p>
			  </li>
			</ul>
		</div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div id="register_dialog" title="Register for <?php echo $event['title'];?>">
		<div id='fg_membersite'>
		<form id='register' action='editinfo.action.php' method='post' accept-charset='UTF-8'>
		<fieldset >
		<div class='short_explanation'>* required fields</div>
		<input type='hidden' name='eid' id='eid' value='<?php echo $event['id'];?>' />
		<input type='hidden' name='act' id='act' value='join_event' />
		<div class='container'>
			<label for='firstname' >First Name*: </label><br/>
			<input type='text' name='firstname' id='firstname' value='<?php echo $user['first_name'];?>' maxlength="50" /><br/>
			<span id='register_firstname_errorloc' class='error'></span>
		</div>

		<div class='container'>
			<label for='lastname' >Last Name*: </label><br/>
			<input type='text' name='lastname' id='lastname' value='<?php echo $user['last_name'];?>' maxlength="50" /><br/>
			<span id='register_lastname_errorloc' class='error'></span>
		</div>

		<div class='container'>
			<label for='gender' >Gender*: </label><br/>
			<select name = "gender" id= "gender" <?php echo isset($_SESSION['user_id'])?disabled:"";?>>
				<option value="Male" <?php echo $user ['gender']=="Male"?selected:"";?>>Male</option>
				<option value="Female" <?php echo $user ['gender']=="Female"?selected:"";?>>Female</option>
			</select>
		</div>

		<div class='container'>
			<label for='age' >Date of Birth*: </label><br/>
			<input type='text' name='age' id='age' value='<?php echo $user['date_of_birth'];?>' maxlength="50" <?php echo isset($_SESSION['user_id'])?disabled:"";?>/><br/>
			<span id='register_age_errorloc' class='error'></span>
		</div>

		<div class='container'>
			<label for='phone' >Phone Number*: </label><br/>
			<input type='text' name='phone' id='phone' value='<?php echo $user['phone'];?>' maxlength="50" /><br/>
			<span id='register_phone_errorloc' class='error'></span>
		</div>

		<div class='container'>
			<label for='address' >Address*: </label><br/>
			<input type='text' name='address' id='address' value='<?php echo $user['address'];?>'/><br/>
			<span id='register_address_errorloc' class='error'></span>
		</div>

		<div class='container'>
			<label for='postalcode' >Postal Code*: </label><br/>
			<input type='text' name='postalcode' id='postalcode' value='<?php echo $user['postal_code'];?>' maxlength="7" /><br/>
			<span id='register_postalcode_errorloc' class='error'></span>
		</div>

		<div class='container'>
			<label for='email' >Email Address*:</label><br/>
			<input type='text' name='email' id='email' value='<?php echo $user['email'];?>' maxlength="50" <?php echo isset($_SESSION['user_id'])?disabled:"";?> /><br/>
			<span id='register_email_errorloc' class='error'></span>
		</div>
		<div class='container'>
			<label for='rating' >Rating:</label><br/>
			<input type='text' name='rating' id='rating' value='<?php echo $user['rating'];?>' maxlength="50" /><br/>
			<span id='register_rating_errorloc' class='error'></span>
		</div>

		<div class='container' style="float:right">
			<input type='submit' name='submit_button' id='submit_button' value='Submit' />
			<input type='button' name='cancel' id='cancel' value='Cancel' />
		</div>


		</fieldset>
		</form>

		</div>
</div>
<!-- ####################################################################################################### -->
<?php include_once 'col45.php';?>
<!-- ####################################################################################################### -->
<script type='text/javascript'>
// <![CDATA[
    
    var frmvalidator  = new Validator("register");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("firstname","req","Please provide your first name!");
	frmvalidator.addValidation("lastname","req","Please provide your last name!");
	frmvalidator.addValidation("age","req","Please provide your date of birth!");
	frmvalidator.addValidation("rating","num","Please provide a valid rating!");
	frmvalidator.addValidation("phone","req","Please provide your phone number!");
	frmvalidator.addValidation("phone","num","Please provide a valid phone number!");
	frmvalidator.addValidation("email","req","Please provide an email!");
	frmvalidator.addValidation("email","email","Please provide a valid email!");
	frmvalidator.addValidation("password","req","Please provide a password!");
	frmvalidator.addValidation("address","req","Please provide your address!");
	frmvalidator.addValidation("postalcode","req","Please provide your postal code!");
// ]]>
</script>
</body>
</html>
