<?php
require_once 'include/config.inc.php';
$sql = "select * from user where email = '".$_POST['registeremail']."'";
if($db->getRowsNum($sql)>0){
	exit("<script>alert('Sorry! The email you entered has existed! Please use another one.');window.location.href='index.php';</script>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>GTTA - Member Registration</title>
	
	<link rel="stylesheet" type="text/css" href="styles/registration.css" media="screen" />
	<link rel="stylesheet" href="styles/uibase/jquery.ui.all.css">
	<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/form-fun.jquery.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/gen_validatorv4.js"></script>
	
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
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
	<!--[if IE]>
		<style type="text/css">
			legend { 
				position: relative;
				top: -30px;
			}
			
			fieldset {
				margin: 30px 10px 0 0;
			}
		</style>
		
		<script type="text/javascript">
			$(function(){
				$("#step_2 legend").css({ opacity: 0.5 });
				$("#step_3 legend").css({ opacity: 0.5 });
			});
		</script>
	<![endif]-->
</head>


<body>
	
	<div id="page-wrap">
		
		<h1>GTTA <span>Member Registration</span></h1>
		<p style="text-align:left; color:white">Hi, <?php echo $_POST ['registeremail'];?>! To enjoy more services, we recommend filling complete information!</p>
		<br/>
		<form action="editinfo.action.php" method="post" name="form" id="form">

			<fieldset id="step_1">
			
				<legend>Personal Information</legend>
				<input type="hidden" id="act" name="act" value="add"></input>
				<div id="nn" class="nn">		
					<label for="nickname">
							Nick Name*: (Max. 9 Letters)
					</br>
					<div id='form_nickname_errorloc' class="error_strings"></div>
					<input type="text" name="nickname" class="nickname" maxlength="9"></input>
				</div>
				
				<div id="fn" class="fn">		
					<label for="firstname">
							First Name:
					</br>
					<input type="text" name="firstname" class="firstname"></input>
				</div>
				
				<div id="ln" class="nn">		
					<label for="lastname">
							Last Name:
					</br>
					<input type="text" name="lastname" class="lastname"></input>
				</div>
				
				<div id="ag" class="ag">		
					<label for="age">
							Date of Birth:
					</br>
					<input type="text" id="age" name="age" class="age"></input>
				</div>
				
				<div id="gen" class="gen">		
					<label for="gender">
							Gender*:
					</br>
					<select name = "gender" id= "gender">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</fieldset>
		
			<fieldset id="step_2">
			
				<legend>Contact Information</legend>
			
				<div id="em" class="em">		
					<label for="email">
							Email*:
					</br>
					<input type="text" name="email" class="email" value="<?php echo $_POST ['registeremail'];?>" readonly></input>
				</div>
				
				<div id="ph" class="ph">		
					<label for="phone">
							Phone Number:
					</br>
					<input type="text" name="phone" class="phone"></input>
				</div>
				
				<div id="ad" class="ad">		
					<label for="address">
							Address:
					</br>
					<input type="text" name="address" class="address"></input>
				</div>
				
				<div id="pc" class="pc">		
					<label for="postalcode">
							Postal Code:
					</br>
					<input type="text" name="postalcode" class="postalcode"></input>
				</div>
			</fieldset>
		
			<fieldset id="step_3">
				<legend>Other Information</legend>
			
				<div id="ra" class="ra">		
					<label for="rating">
							Rating (Numberic):
					</br>
					<input type="text" name="rating" class="rating"></input>
				</div>
				
				<div id="pw" class="pw">		
					<label for="password">
							Password*:
					</br>
					<input type="password" name="password" class="password"></input>
				</div>
				
				<div id="pw" class="pw">		
					<label for="password">
							Re-enter Password*:
					</br>
					<input type="password" name="repassword" class="password"></input>
				</div>
				
				<div id="ro" class="ro">		
					<label for="rock">
							Are you ready to rock?
					<input type="checkbox" id="rock"></input>
				</div>
			
				<input type="submit" id="submit_button" class="push" value="Complete Registration"></input>
			</fieldset>

		</form>
	
	</div>
<div class="wrapper col5">
  <div id="copyright">
    <p style=" text-align:center">Copyright &copy; 2013 - All Rights Reserved - <a href="http://lijuangeng.com" target="_blank">GTTA</a></p>
  </div>
</div>
<script type="text/javascript">
var frmvalidator  = new Validator("form");
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("nickname","req", "Please enter your nick name!");
	frmvalidator.addValidation("email","req", "Please enter your email!");
	frmvalidator.addValidation("email","email", "Please enter a valid email!");
	frmvalidator.addValidation("password","req", "Please enter your password!");
	frmvalidator.addValidation("phone","numeric", "Please enter a number for phone number!");
	frmvalidator.addValidation("rating","numeric", "Please enter a number for rating!");
	frmvalidator.addValidation("repassword","eqelmnt=password","The two passwords should be the same!");
</script>
</body>
</html>