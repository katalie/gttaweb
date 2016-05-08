<?php
include ("global.php");

$cid	= trim($_GET ['cid'])?trim($_GET ['cid']):0;
$id	= trim($_GET ['id'])?trim($_GET ['id']):0;
$act	= trim($_GET ['act'])?trim($_GET ['act']):'add';

$actName = $act == 'add'?'Add':'Modify';
$event = $db->find ( "select * from event where id=" . $id );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Event Add</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/xheditor-1.1.14/xheditor-1.1.14-en.min.js" type="text/javascript" ></script>
<script type="text/javascript">
function doAction(a,id){
	ids = 0;
	if(a=='delpic'){
		$.ajax({
			url:'event.action.php',
			type: 'POST',
			data:'act=delpic&id='+id,
			success: function(data){
				document.getElementById('picdiv').innerHTML="";
			}
		});
	}
}

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
    <form action="event.action.php" method="post" enctype="multipart/form-data" name="form1">
        <input type="hidden" name="act" value="<?php echo $act;?>">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
          <tr>
            <td height="31"><strong><?php echo $actName;?> Event</strong></td>
          </tr>
        </table>
  <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td height="40" class="form_list">Title: </td>
    <td class="form_list"><input name="title" type="text" class="form" style="width: 90%" value="<?php echo $event ['title'];?>"></td>
  </tr>
  <tr>
    <td height="40" class="form_list">Thumb: </td>
    <td colspan="3" class="form_list"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="200"><input type="file" name="pic" id="pic"></td>
        <td><div id="picdiv">
          <?php 
                if(!empty($event ['pic'])){
                ?>
          <img src="../<?php echo $event ['pic'];?>" width="100" height="40" onMouseOver="document.getElementById('bigPic').style.display=''" onMouseOut="document.getElementById('bigPic').style.display='none'">
          <div id="bigPic" style="display:none; position:absolute;"><img src="../<?php echo $event ['pic'];?>"></div>
              <font style="cursor:pointer; font-size:12px" onclick="doAction('delpic',<?php echo $id;?>)">Delete Picture</font>
          <?php
                }
                ?>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40" class="form_list">Category: </td>
    <td class="form_list"><input name="cid" type="hidden" value="<?php echo $id;?>">
        <select name="cid">
          <option value="0">--No Category--</option>
          <?php getCategorySelect_event ($cid)?>
        </select></td>
  </tr>
  <tr>
  <td class="form_list">Event Held Location: </td>
    <td class="form_list"><input name="event_location" type="text" class="form" style="width: 90%" value="<?php echo $event ['event_location'];?>"></td>
  </tr>
  <tr>
  <td class="form_list">Event Held Time: </td>
	<td class="form_list"><input name="event_time" type="text" class="form" style="width: 90%" value="<?php echo $event ['event_time'];?>" placeholder="Please enter the Date & Time as format: December 05, 2013, 9:30am"></td>
  </tr>
  <tr>
  <td class="form_list">Registration Due Date: </td>
	<td class="form_list"><input name="event_registration_due_date" type="text" class="form" style="width: 90%" value="<?php echo $event ['registration_due_date'];?>" placeholder="Please enter the Date as format: 2013-01-15"></td>
  </tr>
  <tr>
	<td class="form_list">Content: </td>
    <td height="50" colspan="4" class="form_list">
		<textarea id="elm1" name="content" rows="16" cols="80" style="width: 80%"><?php echo trim ( $event ['content'] );?>
		</textarea> 
	</td>
  </tr>
</table>
        
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
          <tr>
            <td height="31" align="center"><strong><span class="form_footer">
              <input name="id" type="hidden" value="<?php echo $id;?>">
              <input type="submit" name="button" id="button" value=" Submit ">
              <input type="button" value=" Return " onClick="window.history.go(-1)">
            </span></strong></td>
          </tr>
        </table>
</form>
</body>
</html>
