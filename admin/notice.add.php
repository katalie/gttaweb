<?php
include ("global.php");

$id		= trim($_GET ['id'])?trim($_GET ['id']):0;
$act	= trim($_GET ['act'])?trim($_GET ['act']):'add';

$actName = $act == 'add'?'Add':'Modify';

$notice = $db->find ( "select * from notice where id=" . $id );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Add Notice</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/xheditor-1.1.14/xheditor-1.1.14-en.min.js" type="text/javascript" ></script>
<script type="text/javascript">
$(pageInit);
function pageInit()
{
	$('#elm1').xheditor({skin:'o2007blue'});
}
$(window).bind('beforeunload', function(){
    if( $('input').val() !== '' ){
        return "It looks like you have input you haven't submitted."
    }
});
</script>
</head>
<body onLoad="document.getElementById('title').focus()">
<form action="notice.action.php" method="post" name="form1">
  <input type="hidden" name="act" value="<?php echo $act;?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
    <tr>
      <td height="31"><strong><?php echo $actName;?> Notice</strong></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td height="40" align="right" class="form_list">Title: </td>
      <td class="form_list"><input name="title" type="text" class="form" style="width: 300px" value="<?php echo $notice ['title'];?>"></td>
    </tr>
    <tr>
      <td height="40" align="right" class="form_list">Content: </td>
	  <td height="50" colspan="4" class="form_list">
		<textarea id="elm1" name="content" rows="25" style="width: 80%"><?php echo trim ( $notice ['content'] );?>
		</textarea> 
	  </td>
    </tr>
	<tr>
      <td height="40" align="right" class="form_list">Member Exclusive: </td>
      <td height="40" class="form_list"><label>
          <input type="radio" name="is_member" id="is_member" value="1" <?php echo $notice['is_member']==1?"checked":"";?>>
          Yes</label>
        <input type="radio" name="is_member" id="is_member" value="0" <?php echo $notice['is_member']==0?"checked":"";?>>
        No</td>
    </tr>
    <tr>
      <td height="40" align="right" class="form_list">State: </td>
      <td height="40" class="form_list"><label>
          <input type="radio" name="state" id="state" value="0" <?php echo empty($notice['state'])?"checked":"";?>>
          Availiable</label>
        <input type="radio" name="state" id="state" value="1" <?php echo $notice['state']==1?"checked":"";?>>
        Not Available</td>
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
