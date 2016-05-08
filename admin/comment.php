<?php
include ("global.php");
$nid 		= !empty($nid) ? intval($nid) : 0;
$page 		= !empty($page) ? intval($page) : 1;
$page_size 	= 16;
$keywords 	= trim($keywords);
$mpurl 		= $_SERVER['PHP_SELF']."?id=".$nid;

//查询SQL
$sql = "select a.*,b.title
		from comment a, news b 
		where a.nid=b.id";
if($nid != 0){
	$sql .= " and a.cid=".$cid;
}

//总记录数
$total_nums = $db->getRowsNum ($sql);

//执行分页查询
$comment_list = $db->selectLimit ( $sql, $page_size, ($page - 1) * $page_size );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>comment Management</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function doAction(a,id){
	ids = 0;
	if(a=='deleteAll'){
		if(confirm('Delete Confirmation!')){
			$.ajax({
				url:'comment.action.php',
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
				url:'comment.action.php',
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
		
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_form">
			<tr>
				<th width="40"><input type="checkbox" name="checkbox11"
					value="checkbox" onClick="checkAll(this,'checkbox')"></th>
				<th width="20%">News Title</th>
				<th>Publisher's Name</th>
				<th width="30%">Content</th>
				<th>Comment Time</th>
				<th>IP</th>
				<th>Operations</th>
			</tr>
        <?php
			foreach ( $comment_list as $al ) {
		?>
        <tr onMouseOver="this.className='relow'"
				onMouseOut="this.className='row'" class="row">
				<td align="center"><input type="checkbox" name="checkbox"
					value="<?php echo $al ['id'];?>"
					onClick="checkDeleteStatus('checkbox')"></td>
				<td height="26"><a
					href="news.add.php?act=edit&id=<?php echo $al ['nid'];?>"> <?php echo $al ['title'];?> </a>&nbsp;</td>
				<td align="center"><?php echo $al ['name'];?> &nbsp;</td>
				<td><?php echo $al ['content'];?> &nbsp;</td>
				<td align="center"><?php echo $al ['comment_time'];?> &nbsp;</td>
				<td align="center"><?php echo $al ['ip'];?> &nbsp;</td>
				<td align="center"> 
				<img src="images/del.gif" alt="Delete" onClick="doAction('delete',<?php echo $al ['id'];?>)" style="cursor: pointer"></td>
			</tr>
          <?php
		}
		?>
      </table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0"
			class="table_footer">
			<tr>
				<td height="29" style="text-align:left; padding-left:10px"><div style=" float:left">
              <input type="button" id="DeleteCheckboxButton" value="Delete Selected" disabled="disabled" onClick="doAction('deleteAll')">
          </div>
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
