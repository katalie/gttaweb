<?php
include ("global.php");
$eid 		= !empty($eid) ? intval($eid) : 0;
$page 		= !empty($page) ? intval($page) : 1;
$page_size 	= 16;
$keywords 	= trim($keywords);
$mpurl 		= $_SERVER['PHP_SELF']."?eid=".$eid."&keywords=".$keywords;

//查询SQL
$sql = "select a.first_name, a.last_name,b.title, c.*
		from user a, event b, participant c
		where c.eid=b.id and c.uid=a.user_id";
if($eid != 0){
	$sql .= " and c.eid=".$eid;
}
if(!empty($keywords)){
	$sql.=" and (a.first_name like '%".$keywords."%' or a.last_name like '%".$keywords."%')";
}

$sql .= " order by created_date desc";

//总记录数
$total_nums = $db->getRowsNum ($sql);

//执行分页查询
$participant_list = $db->selectLimit ( $sql, $page_size, ($page - 1) * $page_size );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Participant Management</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function doAction(a,id){
	ids = 0;
	if(a=='deleteAll'){
		if(confirm('Delete Selected Confirmation!')){
			$.ajax({
				url:'participant.action.php',
				type: 'POST',
				data:'act=delete&id='+getCheckedIds('checkbox'),
				success: function(data){
					window.location.href = window.location.href;
				}
			});
		}
	}
	if(a=='delete'){
		if(confirm('Delete Confirmation!')){
			$.ajax({
				url:'participant.action.php',
				type: 'POST',
				data:'act=delete&id='+id,
				success: function(data){
					window.location.href = window.location.href;
				}
			});
		}
	}
	
}
//全选/取消
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
//检查有选择的项，如果有删除按钮可操作
function checkDeleteStatus(checkBoxName){
	var oc = document.getElementsByName(checkBoxName);
	for(var i=0; i<oc.length; i++) {
		if(oc[i].checked){
			document.getElementById('DeleteCheckboxButton').disabled=false;
			document.getElementById('updateCategoryButton').disabled=false;
			document.getElementById('selecteid').disabled=false;
			
			return;
		}
	}
	document.getElementById('DeleteCheckboxButton').disabled=true;
	document.getElementById('updateCategoryButton').disabled=true;
	document.getElementById('selecteid').disabled=true;
}

//获取所有被选中项的ID组成字符串
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top" style="padding: 10px;">
		<form method="get" action="participant.php" style="margin: 0"><input
			type="hidden" name="eid" value="<?php echo $eid;?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="serach">
			<tr>
				<td width="70" height="40" align="right">Keyword: </td>
				<td width="135" style="padding-left: 2px"><input title="Please Input Participant's First Name or Last Name"
					name="keywords" type="text" value="<?php echo $keywords;?>"></td>
				<td><input type="image" name="Submit5" src="images/search.gif"
					style="border: none; height: 19px; width: 66px" /></td>
			</tr>
		</table>
		</form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_head">
			<tr>
				<td width="200" height="31">Participant Management</td>
				<td align="right"><select name="select"
					onChange="window.location.href='participant.php?eid='+this.value">
					<option value="0">--All Events--</option>
              <?php getEventSelect ($eid)?>
                    </select></td>
			</tr>
		</table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_form">
			<tr>
				<th width="40"><input type="checkbox" name="checkbox11"
					value="checkbox" onClick="checkAll(this,'checkbox')"></th>
				<th>Participant's Name</th>
				<th>Event's Name</th>
				<th>Register Time</th>
				<th>Operations</th>
			</tr>
        <?php
			foreach ( $participant_list as $al ) {
		?>
        <tr onMouseOver="this.className='relow'"
				onMouseOut="this.className='row'" class="row">
				<td align="center"><input type="checkbox" name="checkbox"
					value="<?php echo $al ['id'];?>"
					onClick="checkDeleteStatus('checkbox')"></td>
				<td height="26" align="center"><a
					href="user.edit.php?id=<?php echo $al ['uid'];?>"> <?php echo $al ['first_name']." ".$al ['last_name'];?> </a>&nbsp;</td>
				<td height="26" align="center"><a
					href="event.add.php?act=edit&id=<?php echo $al ['eid'];?>"><?php echo $al ['title'];?> &nbsp;</td>
				<td height="26" align="center"><?php echo $al ['created_date'];?> &nbsp;</td>
				<td height="26" align="center"><img
					src="images/del.gif" alt="Delete"
					onClick="doAction('delete',<?php echo $al ['id'];?>)"
					style="cursor: pointer"></td>
		</tr>
          <?php
		}
		?>
      </table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_footer">
			<tr>
				<td height="29" style="text-align: left; padding-left: 10px">
				<div style="float: left;"><input type="button"
					id="DeleteCheckboxButton" value="Delete Selected Items" disabled="disabled"
					onClick="doAction('deleteAll')"> </div>
				<div style="float: right; padding-right: 50px"> 
			<?php echo multi ( $total_nums, $page_size, $page, $mpurl, 0, 5 );?></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
