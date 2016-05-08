<?php
include ("global.php");
$cid 		= !empty($cid) ? intval($cid) : 0;
$page 		= !empty($page) ? intval($page) : 1;
$page_size 	= 16;
$keywords 	= trim($keywords);
$mpurl 		= $_SERVER['PHP_SELF']."?cid=".$cid."&keywords=".$keywords;

//查询SQL
$sql = "select a.*,b.name
		from event a, category_event b 
		where a.rubbish = 0 and a.cid=b.id";
if($cid != 0){
	$sql .= " and a.cid=".$cid;
}
if(!empty($keywords)){
	$sql.=" and (a.title like '%".$keywords."%' or a.content like '%".$keywords."%')";
}

//总记录数
$total_nums = $db->getRowsNum ($sql);

//执行分页查询
$event_list = $db->selectLimit ( $sql, $page_size, ($page - 1) * $page_size );
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
	if(a=='deleteAll'){
		if(confirm('Delete Confirmation!')){
			$.ajax({
				url:'event.action.php',
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
				url:'event.action.php',
				type: 'POST',
				data:'act=delete&id='+id,
				success: function(data){
					window.location.href = window.location.href;
				}
			});
		}
	}
	if(a=='moveAll'){
		scid = document.getElementById("selectCid").value;
		if(confirm('Move Confirmation!')){
			$.ajax({
				url:'event.action.php',
				type: 'POST',
				data:'act=move&scid='+scid+'&id='+getCheckedIds('checkbox'),
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
			document.getElementById('selectCid').disabled=false;
			
			return;
		}
	}
	document.getElementById('DeleteCheckboxButton').disabled=true;
	document.getElementById('updateCategoryButton').disabled=true;
	document.getElementById('selectCid').disabled=true;
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
		<form method="get" action="event.php" style="margin: 0"><input
			type="hidden" name="cid" value="<?php echo $cid;?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="serach">
			<tr>
				<td width="70" height="40" align="right">Keyword: </td>
				<td width="135" style="padding-left: 2px"><input title="Please Input Event's Title or Content"
					name="keywords" type="text" value="<?php echo $keywords;?>"></td>
				<td><input type="image" name="Submit5" src="images/search.gif"
					style="border: none; height: 19px; width: 66px" /></td>
			</tr>
		</table>
		</form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_head">
			<tr>
				<td width="200" height="31">Event Management</td>
				<td align="right"><select name="select"
					onChange="window.location.href='event.php?cid='+this.value">
					<option value="0">--All Categories--</option>
              <?php getCategorySelect_event ($cid)?>
                    </select> <input type="button" value="Add Event"
					onClick="location.href='event.add.php?act=add&cid=<?php echo $cid;?>'"
					class="submit"></td>
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
				<th>Operations</th>
			</tr>
        <?php
			foreach ( $event_list as $al ) {
		?>
        <tr onMouseOver="this.className='relow'"
				onMouseOut="this.className='row'" class="row">
				<td align="center"><input type="checkbox" name="checkbox"
					value="<?php echo $al ['id'];?>"
					onClick="checkDeleteStatus('checkbox')"></td>
				<td height="26" align="center"><a
					href="event.add.php?act=edit&id=<?php echo $al ['id'];?>&cid=<?php echo $al ['cid'];?>"> <?php echo $al ['title'];?> </a>&nbsp;</td>
				<td height="26" align="center"><?php echo $al ['event_time'];?> &nbsp;</td>
				<td height="26" align="center"><?php echo $al ['event_location'];?> &nbsp;</td>
				<td align="center"><?php echo $al ['name'];?> &nbsp;</td>
				<td height="26" align="center"><a
					href="event.add.php?act=edit&cid=<?php echo $al['cid'];?>&id=<?php echo $al ['id'];?>"><img
					src="images/edit.gif" alt="Modify" border="0"></a> <img
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
					onClick="doAction('deleteAll')"> Move to <select id="selectCid"
					name="selectCid" disabled>
                <?php getCategorySelect_event ();?>
              </select> <input id="updateCategoryButton" type="button"
					value="Move Selected Items" disabled="disabled" onClick="doAction('moveAll')"></div>
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
