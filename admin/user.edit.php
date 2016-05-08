<?php
include ("global.php");

$id		= trim($_GET ['id'])?trim($_GET ['id']):0;

$user = $db->find ( "select * from user where user_id=" . $id );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit User</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<form action="user.action.php" method="post" name="form1">
  <input type="hidden" name="act" value="edit">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
    <tr>
      <td height="31"><strong>Edit User</strong></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td height="40" align="right" class="form_list">First Name: </td>
      <td class="form_list"><input name="first_name" type="text" class="form" style="width: 300px" value="<?php echo $user ['first_name'];?>"></td>
	 <tr>
	  <td height="40" align="right" class="form_list">Last Name: </td>
      <td class="form_list"><input name="last_name" type="text" class="form" style="width: 300px" value="<?php echo $user ['last_name'];?>"></td></tr>
	  <tr>
	  <td height="40" align="right" class="form_list">Date of Birth: </td>
      <td class="form_list"><input name="age" type="text" class="form" style="width: 300px" value="<?php echo $user ['date_of_birth'];?>"></td></tr>
	 <tr>
	  <td height="40" align="right" class="form_list">Gender: </td>
		<td class="form_list"><select name = "gender">
				<option value="Male" <?php echo $user ['gender']=="Male"?selected:"";?>>Male</option>
				<option value="Female" <?php echo $user ['gender']=="Female"?selected:"";?>>Female</option>
			</select>
		</td>
	  </tr>
	 <tr>
	  <td height="40" align="right" class="form_list">Phone Number: </td>
      <td class="form_list"><input name="phone" type="text" class="form" style="width: 300px" value="<?php echo $user ['phone'];?>"></td></tr>
	 <tr> 
	  <td height="40" align="right" class="form_list">Address: </td>
      <td class="form_list"><input name="address" type="text" class="form" style="width: 300px" value="<?php echo $user ['address'];?>"></td></tr>
	 <tr> 
	  <td height="40" align="right" class="form_list">Postal Code: </td>
      <td class="form_list"><input name="postal_code" type="text" class="form" style="width: 300px" value="<?php echo $user ['postal_code'];?>"></td></tr>
	 <tr> 
	  <td height="40" align="right" class="form_list">E-mail: </td>
      <td class="form_list"><input name="email" type="text" class="form" style="width: 300px" value="<?php echo $user ['email'];?>"></td></tr>
	 <tr> 
	  <td height="40" align="right" class="form_list">Rating: </td>
      <td class="form_list"><input name="rating" type="text" class="form" style="width: 300px" value="<?php echo $user ['rating'];?>"></td></tr>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
    <tr>
      <td height="31" align="center"><input name="id" type="hidden" value="<?php echo $id;?>">
        <input type="submit" name="button" id="button" value="Submit">
        <input type="button" value="Return" onClick="window.history.go(-1)">
        &nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
