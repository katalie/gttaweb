<?php
require_once ("global.php");
$act	= trim($_GET ['act'])?trim($_GET ['act']):'add';
$pid	= trim($_GET ['pid'])?trim($_GET ['pid']):0;
$id		= trim($_GET ['id'])?trim($_GET ['id']):0;

$actName = $act == 'add'?'Add':'Modify';


$name="";

if($act=='edit'){
	$classify_row = $db->find("select * from category where id=".$id);
	$pid 	= $classify_row['pid'];
	$name	= $classify_row['name'];
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<form action="category.action.php" method="post">
<input type="hidden" name="act" value="<?php echo $act;?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
  <tr>
    <td width="39%" height="31"><?php echo $actName;?> Category</td>
    <td width="61%" align="right"></td>
    <td width="61%" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="5"
	cellspacing="0" class="table_list">
	<tr class="row">
	  <td width="60" align="right" class="form_list">Parent-Category：</td>
	  <td height="26" class="form_list">
      <select name="pid" style="font-size:12px">
      <option value="0">--Top Category--</option>
      <?php getCategorySelect($pid)?>
      </select>      </td>
    </tr>
	<tr class="row">
		<td align="right" class="form_list">Category Name：</td>
	  <td height="26" class="form_list"><input name="name" type="text"
			value="<?php echo $name;?>" style="width: 250px"></td>
	</tr>
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
          <tr>
            <td height="31" align="center"><strong><span class="form_footer">
              <input type="hidden" name="cid" value="<?php echo $id;?>">
              <input type="submit" name="button" id="button" value="<?php echo $actName;?> Category">
              <input type="button" value=" Return " onClick="window.history.go(-1)">
            </span></strong></td>
          </tr>
</table>


</form>
</body>
</html>