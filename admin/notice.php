<?php
require_once ("global.php");
$page 		= !empty($page) ? intval($page) : 1;
$page_size 	= 16;
$mpurl 		= $_SERVER['PHP_SELF'];
$sql = "select * from notice";
//总记录数
$total_nums = $db->getRowsNum ($sql);

//执行分页查询
$notice_list = $db->selectLimit ( $sql, $page_size, ($page - 1) * $page_size);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Notice Management</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript" ></script>
<script type="text/javascript">
function doAction(a,id){
	if(a=='deleteAll'){
		if(confirm('Confirm Delete Selected?')){
			$.ajax({
				url:'notice.action.php',
				type: 'POST',
				data:'act=delete&id='+getCheckedIds('checkbox'),
				success: function(data){
					if(data) alert(data);
					window.location.href = window.location.href;
				}
			});
		}
	}
	if(a=='delete'){
		if(confirm('Confirm Delete This?')){
			$.ajax({
				url:'notice.action.php',
				type: 'POST',
				data:'act=delete&id='+id,
				success: function(data){
					if(data) alert(data);
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
			return;
		}
	}
	document.getElementById('DeleteCheckboxButton').disabled=true;
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
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td valign="top" style="padding:10px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_head">
        <tr>
          <td height="30">Notice Management
          &nbsp;&nbsp;&nbsp;</td>
          <td width="80"><input name="button" type="button" class="submit" onClick="location.href='notice.add.php?act=add'" value="Add Notice"></td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_form">
        <tr>
          <th width="40"><input type="checkbox" name="checkbox11" value="checkbox" onClick="checkAll(this,'checkbox')"></th>
          <th width="250" height="26">Title</th>
		  <th width="100">Member Exclusive</th>
          <th width="100">State</th>
          <th width="80" height="26">Operations</th>
        </tr>
        <?php
	foreach ($notice_list as $list){
  ?>
        <tr onMouseOver="this.className='relow'" onMouseOut="this.className='row'" class="row">
          <td align="center" ><input type="checkbox" name="checkbox" value="<?php echo $list['id'];?>" onClick="checkDeleteStatus('checkbox')"></td>
          <td height="26" align="center" ><a href="notice.add.php?act=edit&id=<?php echo $list['id'];?>"><?php echo $list['title'];?></a>&nbsp;</td>
		  <td align="center"><?php echo $list['is_member']==1?"<font color='#ff00000'>Yes</font>":"No";?>&nbsp;</td>
          <td align="center"><?php echo $list['state']==1?"<font color='#ff00000'>Not Available</font>":"Available";?>&nbsp;</td>
          <td height="26" align="center"><a href="notice.add.php?act=edit&id=<?php echo $list['id'];?>"><img src="images/edit.gif" alt="Modify" border="0"></a> <img src="images/del.gif" alt="Delete" onClick="doAction('delete',<?php echo $list['id'];?>)" style="cursor:pointer"></td>
        </tr>
        <?php
	}
  ?>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_footer">
        <tr>
          <td height="29" style="text-align:left; padding-left:10px"><div style=" float:left">
              <input type="button" id="DeleteCheckboxButton" value="Delete Selected" disabled="disabled" onClick="doAction('deleteAll')">
          </div>
		  <div style="float: right; padding-right: 50px"> 
			<?php echo multi ( $total_nums, $page_size, $page, $mpurl, 0, 5 );?></div>
		  </td>
        </tr>
        <tr>
          <td height="3" colspan="2" background="admin/images/20070907_03.gif"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
