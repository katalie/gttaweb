<?php
require_once ("global.php");

$page 			= $_GET ['page'] ? $_GET ['page'] : 1;
$page_size 		= 10;
$sql_string = "select * from message";
$total_nums = $db->getRowsNum ( $sql_string );
$mpurl 	= "message.php";
$message_list = $db->selectLimit ( $sql_string, $page_size, ($page - 1) * $page_size );

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Message Management</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript" ></script>
<script type="text/javascript">
function doAction(a,id,v){
	if(a=='validate'){
		$.ajax({
			url:'message.action.php',
			type: 'POST',
			data:'act=validate&id='+id+'&validate='+v,
			success: function(data){
				if(data) alert(data);
				window.location.href = window.location.href;
			}
		});
	}
	if(a=='delete'){
		if(confirm('Confirm to delete!')){
			$.ajax({
				url:'message.action.php',
				type: 'POST',
				data:'act=delete&id='+id,
				success: function(data){
					if(data) alert(data);
					window.location.href = window.location.href;
				}
			});
		}
	}
	
	if(a=='deleteAll'){
		if(confirm('Confirm to delete selected items!')){
			$.ajax({
				url:'message.action.php',
				type: 'POST',
				data:'act=delete&id='+getCheckedIds('checkbox'),
				success: function(data){
					if(data) alert(data);
					window.location.href = window.location.href;
				}
			});
		}
	}
}

function reply(id,reply){
	var str 	= "<hr>Reply Message<br>";
	str			+= "<textarea id=\"reply_"+id+"\" style=\"width:300px;height:100px\">"+reply+"</textarea>";
	str			+= "&nbsp;<input type=\"button\" value=\"Save\" onclick=\"savereply("+id+")\">";
	document.getElementById('replyDiv'+id).innerHTML=str;
}

function savereply(id){
	var val = document.getElementById('reply_'+id).value;
	$.ajax({
		url:'message.action.php',
		type: 'POST',
		data:'act=reply&id='+id+"&reply="+val,
		success: function(data){
			if(data) alert(data);
			window.location.href = window.location.href;
		}
	});
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
<style type="text/css">
<!--
.STYLE1 {
	color: #FF0000
}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td valign="top" style="padding:10px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_head">
        <tr>
          <td height="30">Message Management
            &nbsp;&nbsp;&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_form">
        <?php
	foreach ($message_list as $list){
  ?>
        <tr>
          <td height="26" align="left" style="background-color:#EEEEEE">&nbsp; 
          <input type="checkbox" name="checkbox" value="<?php echo $list['id'];?>" onClick="checkDeleteStatus('checkbox')">
          <font style="color:#009900"><?php echo $list['created_date'];?></font> &nbsp;&nbsp;<font style="color:#0009CC"><?php echo $list['name'];?></font> &nbsp;&nbsp;Email：<?php echo $list['email'];?> &nbsp;&nbsp;IP：<?php echo $list['ip'];?></td>
          <th width="250" align="center" style="background-color:#EEEEEE"> <?php
if($list['validate']==0){
?>
            <label style="cursor:pointer; color:#FF0000" onClick="doAction('validate',<?php echo $list['id'];?>,1)">Not Validated</label>
            <?php
}else{
?>
            <label style="cursor:pointer;" onClick="doAction('validate',<?php echo $list['id'];?>,0)">Validated</label>
            <?php
}
?>
            <label style="cursor:pointer" onClick="reply(<?php echo $list['id'];?>,'<?php echo $list['reply'];?>')">Reply</label>
            <label style="cursor:pointer" onClick="doAction('delete',<?php echo $list['id'];?>)">Delete</label></th>
        </tr>
        <tr class="row">
          <td height="26" colspan="2" style="line-height:20px" ><?php echo $list['content'];?>
            <div id="replyDiv<?php echo $list['id'];?>">
              <?php
if(!empty($list['reply'])){
?>
              <hr>
              <strong>Administrator's Reply：</strong><font style="color:#009900"> <?php echo $list['reply_date']?> </font><br>
              <span class="STYLE1"><?php echo $list['reply'];?> </span><br>
              <?php
}
?>
            </div></td>
        </tr>
        <?php
	}
  ?>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_footer">
        <tr>
          <td height="3" background="admin/images/20070907_03.gif">
          <input type="checkbox" name="checkbox11" value="checkbox" onClick="checkAll(this,'checkbox')">Select All
          <input type="button" id="DeleteCheckboxButton" value="Delete Selected" disabled="disabled" onClick="doAction('deleteAll')">
          </td>
          <td height="3" background="admin/images/20070907_03.gif">
          <?php echo multi ( $total_nums, $page_size, $page, $mpurl, 0, 5 );?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
