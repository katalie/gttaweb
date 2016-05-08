<?php
require_once ("global.php");

$id 			= trim ( $_GET ['id'] ) ? trim ( $_GET ['id'] ) : 0;
$keywords 		= trim($_GET['keywords']);
$page 			= $_GET ['page'] ? $_GET ['page'] : 1;
$page_size 		= 16;


$where="a.delete_session_id is not null";

$sql_string = "select a.*,b.name
			   from event a, category_event b
			   where a.cid=b.id and rubbish = 1";
$total_nums = $db->getRowsNum ( $sql_string );
$mpurl 	= "event.rubbish.php";
$event_list = $db->selectLimit ( $sql_string, $page_size, ($page - 1) * $page_size );
//========================


$name = $db->getOneField ( "select name from category_event where id =" . $id );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Event Management</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function doAction(a,id){
	ids = 0;
	if(a=='cdelete'){
		if(confirm('Confirm Delete Completely!')){
			$.ajax({
				url:'event.action.php',
				type: 'POST',
				data:'act=cdelete&id='+getCheckedIds('checkbox'),
				success: function(data){
					window.location.href = window.location.href;
				}
			});
		}
	}
	if(a=='revert'){
		if(confirm('Confirm Restoration!')){
			$.ajax({
				url:'event.action.php',
				type: 'POST',
				data:'act=revert&id='+getCheckedIds('checkbox'),
				success: function(data){
					if(data) alert(data);
					window.location.href = window.location.href;
				}
			});
		}
	}
}
//ȫѡ/ȡ��
function checkAll(o,checkBoxName){
	var oc = document.getElementsByName(checkBoxName);
	for(var i=0; i<oc.length; i++) {
		if(o.checked){
			oc[i].checked=true;	
		}else{
			oc[i].checked=false;	
		}
	}
	checkDeleteStatus(checkBoxName)
}
//�����ѡ���������ɾ����ť�ɲ���
function checkDeleteStatus(checkBoxName){
	var oc = document.getElementsByName(checkBoxName);
	for(var i=0; i<oc.length; i++) {
		if(oc[i].checked){
			document.getElementById('DeleteCheckboxButton').disabled=false;
			document.getElementById('updateCategoryButton').disabled=false;
			
			return;
		}
	}
	document.getElementById('DeleteCheckboxButton').disabled=true;
	document.getElementById('updateCategoryButton').disabled=true;
}

//��ȡ���б�ѡ�����ID����ַ���
function getCheckedIds(checkBoxName){
	var oc = document.getElementsByName(checkBoxName);
	var CheckedIds = "";
	for(var i=0; i<oc.length; i++) {
		if(oc[i].checked){
			if(CheckedIds==''){
				CheckedIds = oc[i].value;	
			}else{
				CheckedIds +=","+oc[i].value;	
			}
			
		}
	}
	return CheckedIds;
}
</script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td valign="top" style="padding:10px;"><table width="100%" border="0" align="center" cellpadding="0"
	cellspacing="0" class="table_head">
        <tr>
          <td height="30">Recycle Bin Management
          &nbsp;&nbsp;&nbsp; </td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_form">
			<tr>
				<th width="40"><input type="checkbox" name="checkbox11"
					value="checkbox" onClick="checkAll(this,'checkbox')"></th>
				<th>Event Title</th>
				<th>Event Held Time</th>
				<th>Event Held Location</th>
				<th>Category</th>
			</tr>
        <?php
			foreach ( $event_list as $al ) {
		?>
        <tr onMouseOver="this.className='relow'"
				onMouseOut="this.className='row'" class="row">
				<td align="center"><input type="checkbox" name="checkbox"
					value="<?php echo $al ['id'];?>"
					onClick="checkDeleteStatus('checkbox')"></td>
				<td height="26" align="center"><?php echo $al ['title'];?>&nbsp;</td>
				<td height="26" align="center"><?php echo $al ['event_time'];?> &nbsp;</td>
				<td height="26" align="center"><?php echo $al ['event_location'];?> &nbsp;</td>
				<td align="center"><?php echo $al ['name'];?> &nbsp;</td>
		</tr>
          <?php
		}
		?>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0"
	class="table_footer">
        <tr>
          <td height="29" style="text-align: left; padding-left: 10px"><div style="float: left;">
              <input type="button" id="DeleteCheckboxButton" value="Delete Selected Completely" disabled="disabled" onClick="doAction('cdelete')">
              &nbsp;
              <input id="updateCategoryButton" type="button" value="Restore Selected Items" disabled="disabled" onClick="doAction('revert')">
            </div>
            <div style="float: right; padding-right: 50px"> <?php echo multi ( $total_nums, $page_size, $page, $mpurl, 0, 5 );?> </div></td>
        </tr>
        <tr>
          <td height="3" colspan="2" background="admin/images/20070907_03.gif"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
