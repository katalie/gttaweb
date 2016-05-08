<?php
require_once ("global.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function doAction(a,id){
	if(a=='delete'){
		if(confirm('All the news will be remove under this category. Are you sure to do so?')){
			$.ajax({
				url:'category.action.php',
				type: 'POST',
				data: '&act=delete&id='+id,//对页面所有input元素进行序列化
				success: function(data){if(data) alert(data);
					window.location.href = window.location.href;
				}
			});			
		}
	}
	
}
</script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td valign="top" style="padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_head">
          <tr>
            <td width="39%" height="31">Category</td>
            <td width="61%" align="right"></td>
            <td width="61%" align="right"><input type="button" value="Add a Top Category"
			onClick="location.href='category.add.php?act=add'" class="submit1"></td>
          </tr>
        </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_form">
          <tr>
            <th width="50%">Category Name</th>
            <th width="10%">Num. of News</th>
            <th width="40%">Operations</th>
          </tr>
          <?php
getCategoryList ();
?>
        </table>
      </td>
  </tr>
</table>
</body>
</html>