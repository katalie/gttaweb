<?php
//require_once 'include/config.inc.php';
$sql = "select * from user where user_id = '".$_SESSION['user_id']."'";
$user = $db->find($sql);
?>
	<link rel="stylesheet" href="styles/uibase/jquery.ui.all.css">
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
<div class="wrapper col0">
  <div id="topbar">
    <div id="slidepanel">
	<form action="editinfo.action.php" name="form" id="form" method="post">
      <div class="topbox">
        <h2>Personal Information</h2>
		<fieldset>
			<label for="nickname">Nick Name*: (Max. 9 Letters)<div id='form_nickname_errorloc' class="error_strings"></div>
              <input type="text" name="nickname" id="nickname" maxlength="9" value="<?php echo $user['nick_name'];?>" disabled />
            </label>
			<label for="firstname">First Name:
              <input type="text" name="firstname" id="firstname" value="<?php echo $user['first_name'];?>" disabled />
            </label>
			<label for="lastname">Last Name:
              <input type="text" name="lastname" id="lastname" value="<?php echo $user['last_name'];?>" disabled />
            </label>
			<label for="age">Date of Birth:<div id='form_age_errorloc' class="error_strings"></div>
              <input type="text" name="age" id="age" value="<?php echo $user['date_of_birth'];?>" disabled />
            </label>
            <label for="gender">Gender*:</br>
              <select name = "gender" id= "gender" disabled>
				<option value="Male" <?php echo $user ['gender']=="Male"?selected:"";?>>Male</option>
				<option value="Female" <?php echo $user ['gender']=="Female"?selected:"";?>>Female</option>
			  </select>
            </label>
        </fieldset>
      </div>
      <div class="topbox">
        <h2>Contact Information</h2>
		<fieldset>
			<label for="email">Email*:<div id='form_email_errorloc' class="error_strings"></div>
              <input type="text" name="email" id="email" value="<?php echo $user['email'];?>" disabled />
            </label>
			<label for="phone">Phone Number:<div id='form_phone_errorloc' class="error_strings"></div>
              <input type="text" name="phone" id="phone" value="<?php echo $user['phone'];?>" disabled />
            </label>
			<label for="address">Address:
              <input type="text" name="address" id="address" value="<?php echo $user['address'];?>" disabled />
            </label>
            <label for="postalcode">Postal Code:            
				<input type="text" name="postalcode" id="postalcode" value="<?php echo $user['postal_code'];?>" disabled />
            </label>
		</fieldset>
      </div>
      <div class="topbox last">
        <h2>Other Information</h2>
        <fieldset>
			<label for="rating">Rating:<div id='form_rating_errorloc' class="error_strings"></div>
              <input type="text" name="rating" id="rating" value="<?php echo $user['rating'];?>" disabled />
            </label>
			<p>
              <button type="button" name="edit" id="edit" onclick="enable_edit()">Edit</button>
              &nbsp;
              <input type="submit" name="submit" id="submit" value="Submit" disabled />
			  &nbsp;
			  <a href="login.out.php">Log Out</a>
            </p>
		</fieldset>
      </div>
      <br class="clear" />
	</form>
    </div>
    <div id="loginpanel">
      <ul>
        <li class="left" id="toggle"><a id="slideit" href="#slidepanel">Hello, <?php echo $user['nick_name'];?>!</a><a id="closeit" style="display: none;" href="#slidepanel">Hello, <?php echo $user['nick_name'];?>!</a></li>
		<li class="right"></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<script type="text/javascript">
var frmvalidator  = new Validator("form");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
  
	frmvalidator.addValidation("nickname","req", "Please enter your nick name!");
	frmvalidator.addValidation("email","req", "Please enter your email!");
	frmvalidator.addValidation("email","email", "Please enter a valid email!");
	frmvalidator.addValidation("phone","numeric", "Please enter a number!");
	frmvalidator.addValidation("rating","numeric", "Please enter a number!");
function enable_edit(){
	$("input:text", document.forms[0]).each(function(){this.disabled=false;});
	$("select", document.forms[0]).each(function(){this.disabled=false;});
	$("input:submit", document.forms[0]).each(function(){this.disabled=false;});
	$("#nickname").focus();
}
</script>