<?php
include ("global.php");
$id		 = trim($_GET ['id'])?trim($_GET ['id']):0;
$act			 = trim($_GET ['act'])?trim($_GET ['act']):'add';

$actName = $act == 'add'?'Add':'Modify';

$friendlylink = $db->find ( "select * from friendly_link where id=" . $id );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Add Friendly Link</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="document.getElementById('name').focus()">
<table width="100%" border="0" align="center" cellpadding="0"
	cellspacing="0">
	<tr>
		<td width="*" height="1299" valign="top" style="padding: 10px;">
		<form action="friendlylink.action.php" method="post" name="form1">
		<input type="hidden" name="act" value="<?php echo $act;?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td height="829" valign="top" style="padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
                  <tr>
                    <td height="31"><?php echo $actName;?> Link</td>
                </tr>
                </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                  <tr>
                    <td height="40" align="right" class="form_list">Website Name: </td>
					<td class="form_list"><input name="name" type="text" class="form" style="width: 300px" value="<?php echo $friendlylink ['name'];?>"></td>
				  </tr>
					<tr>
						<td height="40" align="right" class="form_list">Website Address: </td>
						<td class="form_list"><input name="url" type="text" class="form" style="width: 300px" value="<?php echo $friendlylink ['url'];?>"></td>
					</tr>
					<tr>
						<td height="40" align="right" class="form_list">Description</td>
					<td class="form_list"><textarea name="description" class="form" style="width:300px; height: 50px; overflow: auto"><?php echo trim ( $friendlylink ['description'] );?></textarea>						</tr>
					
                </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
                  <tr>
                    <td height="31" align="center"><input name="id" type="hidden" value="<?php echo $id;?>"> 
                            <input type="submit" name="button" id="button" value="Submit"> 
                      <input type="button" value="Return" onClick="window.history.go(-1)">&nbsp;</td>
                  </tr>
              </table></td>
          </tr>
        </table>
		<p>&nbsp;</p>
		</form>
		</td>
	</tr>
</table>
</body>
</html>
