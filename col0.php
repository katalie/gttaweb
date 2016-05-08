<div class="wrapper col0">
  <div id="topbar">
    <div id="slidepanel">
      <div class="topbox">
        <h2>Be a Registed Member!</h2>
        <p>Hello! We are providing more for regestered memebers! If you are already a member of Geng Table Tennis Academy or interested in it, you can register here to check out our amazing news and register for our wonderful events quickly! More beneficial features are waiting for you!</p>
       
      </div>
      <div class="topbox">
        <h2>Member Login Here</h2>
        <form action="login.action.php" name="loginform" id="loginform" method="post">
          <fieldset>
            <legend>Member Login Form</legend>
            <label for="email">Email: <div id='loginform_email_errorloc' class="error_strings"></div>
            <input type="text" name="email" id="email" value="" />
            </label>
            <label for="password">Password: <div id='loginform_password_errorloc' class="error_strings"></div>
              <input type="password" name="password" id="password" value="" />
            </label>
            <label>
              <input class="checkbox" type="checkbox" name="remember" id="remember" checked="checked" />
              Remember me
             </label>
            
            <p>
              <input type="submit" name="login" id="login" value="Login" />
              &nbsp;
              <input type="reset" name="reset" id="reset" value="Reset" />
            </p>
          </fieldset>
        </form>
      </div>
      <div class="topbox last">
        <h2>New Settler Register Here</h2>
        <form action="registration.php" method="post" name="registerform" id="registerform">
          <fieldset>
            <legend>>New Settler Register Form</legend>
			<input type="hidden" name="act" value="check">
            <label for="registeremail">Email: <div id='registerform_registeremail_errorloc' class="error_strings"></div>
              <input type="text" name="registeremail" id="registeremail" value="" />
            </label>
            <label for="reenterregisteremail">Re-enter Your Email: <div id='registerform_reenterregisteremail_errorloc' class="error_strings"></div>
              <input type="text" name="reenterregisteremail" id="reenterregisteremail" value=""/>
            </label>
            <label for="agreement">
              <input class="checkbox" type="checkbox" name="agreement" id="agreement" checked="checked" />I Have Read the 
              <a href="#">Member Agreement</a></label><div id='registerform_agreement_errorloc' class="error_strings"></div>
            <p>
              <input type="submit" name="registernextstep" id="registernextstep" value="Next Step" />
              &nbsp;
              <input type="reset" name="reset" id="reset" value="Reset" />
            </p>
          </fieldset>
        </form>
      </div>
      <br class="clear" />
    </div>
    <div id="loginpanel">
      <ul>
        <li class="left" id="toggle"><a id="slideit" href="#slidepanel">&nbsp;Register/Login Here</a><a id="closeit" style="display: none;" href="#slidepanel">&nbsp;Register/Login Here</a></li>
		<li class="right"></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<script type="text/javascript">
  var frmvalidator  = new Validator("loginform");
  frmvalidator.EnableOnPageErrorDisplay();
  frmvalidator.EnableMsgsTogether();
  
  frmvalidator.addValidation("email","req", "Please enter your email");
  frmvalidator.addValidation("email","email", "Please enter a valid email!");
  frmvalidator.addValidation("password","req", "Please enter your password!");
  
  var frmvalidator1  = new Validator("registerform");
  frmvalidator1.EnableOnPageErrorDisplay();
  frmvalidator1.EnableMsgsTogether();
  
  frmvalidator1.addValidation("registeremail","req", "Please enter your email");
  frmvalidator1.addValidation("registeremail","email", "Please enter a valid email!");
  frmvalidator1.addValidation("reenterregisteremail","req", "Please enter your email");
  frmvalidator1.addValidation("reenterregisteremail","email", "Please enter a valid email!");
  frmvalidator1.addValidation("reenterregisteremail","eqelmnt=registeremail","The two emails should be the same!");
  
  var chktestValidator  = new Validator("registerform");
  chktestValidator.EnableOnPageErrorDisplay();
  chktestValidator.EnableMsgsTogether();
  chktestValidator.addValidation("agreement","shouldselchk=y","Sorry, you should read the agreement!");
</script>