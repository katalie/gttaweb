<?php
include ("global.php");

$cid	= trim($_GET ['cid'])?trim($_GET ['cid']):0;
$id	= trim($_GET ['id'])?trim($_GET ['id']):0;
$act	= trim($_GET ['act'])?trim($_GET ['act']):'add';

$actName = $act == 'add'?'Add':'Modify';
$news = $db->find ( "select * from news where id=" . $id );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>News</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/xheditor-1.1.14/xheditor-1.1.14-en.min.js" type="text/javascript" ></script>
<script type="text/javascript">
function doAction(a,id){
	ids = 0;
	if(a=='delpic'){
		$.ajax({
			url:'news.action.php',
			type: 'POST',
			data:'act=delpic&id='+id,
			success: function(data){
				document.getElementById('picdiv').innerHTML="";
			}
		});
	}
}

$(pageInit);
function pageInit()
{
	$('#elm1').xheditor({skin:'o2007blue'});
}

$(window).bind('beforeunload', function(){
    if( $('.form').val() !== '' ){
        return "If you just clicked Submit, your change will be saved when you leave this page. Or it will be discarded."
    }
});

</script>

</head>
<body onLoad="document.getElementById('title').focus()">
    <form id="target_form" action="news.action.php" method="post" enctype="multipart/form-data" name="form1">
        <input type="hidden" name="act" value="<?php echo $act;?>">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
          <tr>
            <td height="31"><strong><?php echo $actName;?> News</strong></td>
          </tr>
        </table>
  <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="10%" height="40" class="form_list">Title ：</td>
    <td width="40%" class="form_list"><input name="title" type="text" class="form" style="width: 90%" value="<?php echo $news ['title'];?>"></td>
  </tr>
  <tr>
    <td height="40" class="form_list">Thumb：</td>
    <td colspan="3" class="form_list"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="200"><input type="file" name="pic" id="pic"></td>
        <td><div id="picdiv">
          <?php 
                if(!empty($news ['pic'])){
                ?>
          <img src="../<?php echo $news ['pic'];?>" width="100" height="40" onMouseOver="document.getElementById('bigPic').style.display=''" onMouseOut="document.getElementById('bigPic').style.display='none'">
          <div id="bigPic" style="display:none; position:absolute;"><img src="../<?php echo $news ['pic'];?>"></div>
              <font style="cursor:pointer; font-size:12px" onclick="doAction('delpic',<?php echo $id;?>)">Delete Picture</font>
          <?php
                }
                ?>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
	<td height="40" class="form_list">Silde Position：</td>
    <td class="form_list">
        <select name="slide_position">
			<option value="0">Not Available</option>
			<option value="1" <?php echo $news ['slide_position']==1?selected:"";?>>1</option>
			<option value="2" <?php echo $news ['slide_position']==2?selected:"";?>>2</option>
			<option value="3" <?php echo $news ['slide_position']==3?selected:"";?>>3</option>
			<option value="4" <?php echo $news ['slide_position']==4?selected:"";?>>4</option>
			<option value="5" <?php echo $news ['slide_position']==5?selected:"";?>>5</option>
        </select>
	</td>
  </tr>
  <tr>
    <td class="form_list">Category：</td>
    <td class="form_list"><input name="cid" type="hidden" value="<?php echo $id;?>">
        <select name="cid">
          <option value="0">--No Category--</option>
          <?php getCategorySelect ($cid)?>
        </select>
	</td>
    <td class="form_list">Abstract：</td>
    <td class="form_list"><textarea name="summary" class="form" style="width: 90%; height: 50px; overflow: auto"><?php echo trim ( $news ['summary'] );?></textarea></td>
  </tr>
  <tr>
	<td class="form_list">Content：</td>
    <td height="50" colspan="4" class="form_list">
		<textarea id="elm1" name="content" rows="20" cols="80" style="width: 80%"><?php echo trim ( $news ['content'] );?>
		</textarea> 
	</td>
  </tr>
</table>
        
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="form_title">
          <tr>
            <td height="31" align="center"><strong><span class="form_footer">
              <input name="id" type="hidden" value="<?php echo $id;?>">
              <input type="submit" name="button" id="button" value=" Submit ">
              <input type="button" value=" Return " onClick="window.history.go(-1)">
            </span></strong></td>
          </tr>
        </table>
</form>
</body>
</html>
