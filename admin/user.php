<?php
require_once ("global.php");
$page 		= !empty($page) ? intval($page) : 1;
$page_size 	= 16;
$mpurl 		= $_SERVER['PHP_SELF'];
$sql = "select * from user order by rating desc";
//总记录数
$total_nums = $db->getRowsNum ($sql);

//执行分页查询
$user_list = $db->selectLimit ( $sql, $page_size, ($page - 1) * $page_size);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>user Management</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript" ></script>
<script type="text/javascript">
function doAction(a,id){
	if(a=='deleteAll'){
		if(confirm('Confirm ro Delete Selected?')){
			$.ajax({
				url:'user.action.php',
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
		if(confirm('Confirm to Delete This?')){
			$.ajax({
				url:'user.action.php',
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
          <td height="30">User Management
          &nbsp;&nbsp;&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_form">
        <tr>
          <th width="40"><input type="checkbox" name="checkbox11" value="checkbox" onClick="checkAll(this,'checkbox')"></th>
          <th>First Name</th>
		  <th>Last Name</th>
		  <th>Gender</th>
		  <th>Date of Birth</th>
		  <th>Phone Number</th>
		  <th>Address</th>
		  <th>Postal Code</th>
		  <th>Email</th>
		  <th>Rating</th>
		  <th>Registered User</th>
		  <th>Creating Date</th>
          <th width="80" height="26">Operations</th>
        </tr>
        <?php
	foreach ($user_list as $list){
  ?>
        <tr onMouseOver="this.className='relow'" onMouseOut="this.className='row'" class="row">
          <td align="center" ><input type="checkbox" name="checkbox" value="<?php echo $list['user_id'];?>" onClick="checkDeleteStatus('checkbox')"></td>
          <td align="center" ><?php echo $list['first_name'];?>&nbsp;</td>
          <td align="center" ><?php echo $list['last_name'];?>&nbsp;</td>
		  <td align="center" ><?php echo $list['gender'];?>&nbsp;</td>
		  <td align="center" ><?php echo $list['date_of_birth'];?>&nbsp;</td>
		  <td align="center" ><?php echo $list['phone'];?>&nbsp;</td>
		  <td><?php echo $list['address'];?>&nbsp;</td>
		  <td align="center" ><?php echo $list['postal_code'];?>&nbsp;</td>
		  <td><?php echo $list['email'];?>&nbsp;</td>
		  <td align="center" ><?php echo $list['rating'];?>&nbsp;</td>
		  <td align="center" ><?php echo $list['registered']==0?"<font color='#ff00000'>Not Registered</font>":"Registered";?>&nbsp;</td>
		  <td align="center" ><?php echo $list['created_date'];?>&nbsp;</td>
          <td height="26" align="center"><a href="user.edit.php?id=<?php echo $list['user_id'];?>"><img src="images/edit.gif" alt="Modify" border="0"></a><img src="images/del.gif" alt="Delete" onClick="doAction('delete',<?php echo $list['user_id'];?>)" style="cursor:pointer"></td>
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

