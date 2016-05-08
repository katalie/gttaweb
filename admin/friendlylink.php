<?php
require_once ("global.php");
$friendlylink_list = $db->findAll("select * from friendly_link");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Friendly Link</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript" ></script>
<script type="text/javascript">
function doAction(a,id){
	if(a=='deleteAll'){
		if(confirm('Confirm Delete Selected?')){
			$.ajax({
				url:'friendlylink.action.php',
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
				url:'friendlylink.action.php',
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
          <td height="30">Friendly Link
          &nbsp;&nbsp;&nbsp;</td>
          <td width="80"><input name="button" type="button" class="submit" onClick="location.href='friendlylink.add.php?act=add'" value="Add Link"></td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_form">
        <tr>
          <th width="40"><input type="checkbox" name="checkbox11" value="checkbox" onClick="checkAll(this,'checkbox')"></th>
          <th width="200" height="26">Link Name</th>
          <th width="200">Link Address</th>
          <th height="26">Description</th>
          <th width="80" height="26">Operations</th>
        </tr>
        <?php
	foreach ($friendlylink_list as $list){
  ?>
        <tr onMouseOver="this.className='relow'" onMouseOut="this.className='row'" class="row">
          <td align="center" ><input type="checkbox" name="checkbox" value="<?php echo $list['id'];?>" onClick="checkDeleteStatus('checkbox')"></td>
          <td height="26" align="center" ><a href="friendlylink.add.php?act=edit&id=<?php echo $list['id'];?>"><?php echo $list['name'];?></a>&nbsp;</td>
          <td align="center"><a href="<?php echo $list['url'];?>" target="_blank" title="Open Link"><?php echo $list['url'];?></a>&nbsp;</td>
          <td height="26" align="center"><?php echo $list['description'];?>&nbsp;</td>
          <td height="26" align="center"><a href="friendlylink.add.php?act=edit&id=<?php echo $list['id'];?>"><img src="images/edit.gif" alt="Modify" border="0"></a> <img src="images/del.gif" alt="Delete" onClick="doAction('delete',<?php echo $list['id'];?>)" style="cursor:pointer"></td>
        </tr>
        <?php
	}
  ?>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_footer">
        <tr>
          <td height="29" style="text-align:left; padding-left:10px"><div style=" float:left">
              <input type="button" id="DeleteCheckboxButton" value="Delete Selected" disabled="disabled" onClick="doAction('deleteAll')">
          </div></td>
        </tr>
        <tr>
          <td height="3" colspan="2" background="images/20070907_03.gif"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
