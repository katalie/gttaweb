<?php 
/**
 * 后台公用函数库
 */

/**
 * 分页函数
 *
 * @param int $num	
 * @param int $perpage
 * @param int $curpage
 * @param string $mpurl
 * @param int $maxpages
 * @param int $page
 * @param bool $autogoto
 * @param bool $simple
 * @return string
 */
include('simple_image.php');
 
function multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = TRUE, $simple = FALSE) {
	global $maxpage;
		$shownum = $showkbd = true;
		$lang['prev'] = 'Previous';
		$lang['next'] = 'Next';

	$multipage = '';
	$mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';
	$realpages = 1;									
	if($num > $perpage) {
		$offset = 2;

		$realpages = @ceil($num / $perpage);
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if($from < 1) {
				$to = $curpage + 1 - $from;
				$from = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif($to > $pages) {
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}

		$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.$mpurl.'page=1" class="first">First</a> ' : '').
			($curpage > 1 && !$simple ? '<a href="'.$mpurl.'page='.($curpage - 1).'" class="prev">'.$lang['prev'].'</a> ' : '');	
		
		for($i = $from; $i <= $to; $i++) {
			$multipage .= $i == $curpage ? '<strong><font style="color:#ff0000">'.$i.'</font></strong> &nbsp;&nbsp;' :
				'<a href="'.$mpurl.'page='.$i.($i == $pages && $autogoto ? '#' : '').'">'.$i.'</a> &nbsp;&nbsp;';
		}

		$multipage .= ($to < $pages ? '. . .&nbsp;&nbsp;<a href="'.$mpurl.'page='.$pages.'" class="last">'.$realpages.'</a> ': '').
			($curpage < $pages && !$simple ? '&nbsp;&nbsp;<a href="'.$mpurl.'page='.($curpage + 1).'" class="next">'.$lang['next'].'</a> ' : '').
			($showkbd && !$simple && $pages > $page ? '<kbd><input type="text" name="custompage" size="3" style="height:20px;font-size:12px" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'page=\'+this.value; return false;}" /><input type="button"  style="height:22px;font-size:12px" value="Go to" onclick="window.location=\''.$mpurl.'page=\'+document.all(\'custompage\').value; return false;"></kbd>' : '');

		$multipage = $multipage ? '<div class="pages">'.($shownum && !$simple ? 'Total:&nbsp;<font style="color:#ff0000">'.$num.'</font>&nbsp;Pages ' : '').$multipage.'</div>' : '';
	}
	$maxpage = $realpages;
	return $multipage;
}

/**
 * 栏目分类下拉框 <option></option>
 *
 * @param int $pid
 * @param int $id
 * @param int $level
 */
function getCategorySelect($select_id=0,$id = 0,$level = 0){
	global $db;
	$category_arr = $db->findAll ( "select * from category where pid = " . $id);
	for($lev = 0; $lev < $level * 2 - 1; $lev ++) {
		$level_nbsp .= "　";
	}
	if ($level++) $level_nbsp .= "┝";
	foreach ( $category_arr as $category ) {
		$id = $category ['id'];
		$name = $category ['name'];
		$selected = $select_id==$id?'selected':'';
		echo "<option value=\"".$id."\" ".$selected.">".$level_nbsp . " " . $name."</option>\n";
		getCategorySelect ($select_id, $id, $level );
	}
}

function getCategorySelect_event($select_id=0,$id = 0,$level = 0){
	global $db;
	$category_arr = $db->findAll ( "select * from category_event where pid = " . $id);
	for($lev = 0; $lev < $level * 2 - 1; $lev ++) {
		$level_nbsp .= "　";
	}
	if ($level++) $level_nbsp .= "┝";
	foreach ( $category_arr as $category ) {
		$id = $category ['id'];
		$name = $category ['name'];
		$selected = $select_id==$id?'selected':'';
		echo "<option value=\"".$id."\" ".$selected.">".$level_nbsp . " " . $name."</option>\n";
		getCategorySelect_event ($select_id, $id, $level );
	}
}

function getEventSelect($eid=0){
	global $db;
	$events = $db->findAll ( "select * from event;");
	
	foreach ($events as $event){
		$id = $event['id'];
		$name = $event['title'];
		$selected = $eid==$id?'selected':'';
		echo "<option value=\"".$id."\" ".$selected.">".$name."</option>\n";
	}
}

/*=======================================================================================*/
//获取栏目列表信息
function getCategoryList($id = 0, $level = 0) {
	global $db;
	$category_arr = $db->findAll ( "SELECT * FROM category WHERE pid = " . $id . ";" );
	for($lev = 0; $lev < $level * 2 - 1; $lev ++) {
		$level_nbsp .= "　";
	}
	$level++;
	$level_nbsp .= "<font style=\"font-size:12px;font-family:wingdings\">".$level."</font>";
	foreach ( $category_arr as $category ) {
		$id = $category ['id'];
		$name = $category ['name'];
		echo "
<tr >
	<td height=\"26\" ><a href=\"news.php?cid=" . $id . "\"> " . $level_nbsp . " &nbsp; " . $name . "</a>&nbsp;&nbsp;(cid: $id)</td>
	<td height=\"26\" align=\"center\" style=\"color:#FF0000\">" . getNumOfCategory ( $id ) . "&nbsp;</td>
	<td height=\"26\" align=\"center\">
		<a href='category.add.php?act=add&pid=" . $id . "'>Add Sub-Category</a> |&nbsp;
		<a href='news.add.php?act=add&cid=" . $id . "'>Add News</a> |&nbsp;
		<a href='category.add.php?act=edit&id=" . $id . "'>Modify Category</a> |&nbsp;
		<a href=\"javascript:doAction('delete'," . $id . ")\">Delete Category</a></td>
</tr> ";
		getCategoryList ( $id, $level );
	}
}

function getCategoryList_event($id = 0, $level = 0) {
	global $db;
	$category_arr = $db->findAll ( "SELECT * FROM category_event WHERE pid = " . $id . ";" );
	for($lev = 0; $lev < $level * 2 - 1; $lev ++) {
		$level_nbsp .= "　";
	}
	$level++;
	$level_nbsp .= "<font style=\"font-size:12px;font-family:wingdings\">".$level."</font>";
	foreach ( $category_arr as $category ) {
		$id = $category ['id'];
		$name = $category ['name'];
		echo "
<tr onMouseOver=\"this.className='relow'\" onMouseOut=\"this.className='row'\" class=\"row\">
	<td height=\"26\" ><a href=\"event.php?cid=" . $id . "\"> " . $level_nbsp . " &nbsp; " . $name . "</a>&nbsp;&nbsp;(cid: $id)</td>
	<td height=\"26\" align=\"center\" style=\"color:#FF0000\">" . getNumOfCategory_event ( $id ) . "&nbsp;</td>
	<td height=\"26\" align=\"center\">
		<a href='eventcategory.add.php?act=add&pid=" . $id . "'>Add Sub-Category</a> |&nbsp;
		<a href='event.add.php?act=add&cid=" . $id . "'>Add Event</a> |&nbsp;
		<a href='eventcategory.add.php?act=edit&id=" . $id . "'>Modify Category</a> |&nbsp;
		<a href=\"javascript:doAction('delete'," . $id . ")\">Delete Category</a></td>
</tr> ";
		getCategoryList_event ( $id, $level );
	}
}

function getCategoryList_front($id = 0, $level = 0) {
	global $db;
	$category_arr = $db->findAll ( "SELECT id,name FROM category WHERE pid = " . $id . ";" );
	$level++;
	foreach ( $category_arr as $category ) {
		echo "<ul>";
		$id = $category ['id'];
		$name = $category ['name'];
		echo "<li><a href=\"newslist.php?cid=" . $id . "\"> " . $name . "</a><li>";
		getCategoryList_front ( $id, $level );
		echo "</ul>";
	}
}

function getCategoryList_front_event($id = 0, $level = 0) {
	global $db;
	$category_arr = $db->findAll ( "SELECT id,name FROM category_event WHERE pid = " . $id . ";" );
	$level++;
	foreach ( $category_arr as $category ) {
		echo "<ul>";
		$id = $category ['id'];
		$name = $category ['name'];
		echo "<li><a href=\"eventlist.php?cid=" . $id . "\"> " . $name . "</a><li>";
		getCategoryList_front_event ( $id, $level );
		echo "</ul>";
	}
}

//栏目下文章数
function getNumOfCategory($id) {
	global $db;
	$sql = "SELECT id FROM news WHERE cid=" . $id . " AND rubbish = 0";
	return $db->getRowsNum ( $sql );
}

function getNumOfCategory_event($id) {
	global $db;
	$sql = "SELECT id FROM event WHERE cid=" . $id . " AND rubbish = 0";
	return $db->getRowsNum ( $sql );
}

/***********************************
			图片上传函数
***********************************/
function uploadFile($filename){
	global $db;
	global $config;
	$attachment_dir = $config['attachment_dir'].'/admin/attachment/'.date('Ym')."/";
    
	if(!is_dir(ROOT_PATH.$attachment_dir)){
        mkdir(ROOT_PATH.$attachment_dir);
    }
	$AllowedExtensions = array('gif','jpeg','jpg','png');
	$Extensions = end(explode(".",$_FILES[$filename]['name']));
	
	if(!in_array(strtolower($Extensions),$AllowedExtensions)){
		exit("<script>alert('Thumb format error！Only file types gif,jpeg,jpg,png are supported!');window.history.go(-1)</script>");
	}

	$file_rand = date('YmdHis').'_'.rand(10,99);
	$file_name = $file_rand.'.'.$Extensions;
	$file_name_240 = $file_rand.'_240.'.$Extensions;
	$file_name_125 = $file_rand.'_125.'.$Extensions;
    $file_name_origin = $file_rand.'_origin.'.$Extensions;
	
	$upload_file = $attachment_dir.$file_name;
	$upload_absolute_file = ROOT_PATH.$upload_file;
	
	$image = new SimpleImage();
    
	$image->load($_FILES[$filename]['tmp_name']);
	$image->resize(450,300);
	$image->save($upload_absolute_file);
	
	$image->load($_FILES[$filename]['tmp_name']);
	$image->resize(240,130);
	$image->save(ROOT_PATH.$attachment_dir.$file_name_240);
	
	$image->load($_FILES[$filename]['tmp_name']);
	$image->resize(125,125);
	$image->save(ROOT_PATH.$attachment_dir.$file_name_125);
    
    $image->load($_FILES[$filename]['tmp_name']);
    $image->save(ROOT_PATH.$attachment_dir.$file_name_origin);
	
	$record = array(
		'filename'			=>$file_name,
		'ffilename'			=>$_FILES [$filename]['name'],
		'path'				=>$upload_file,
		'path_125'			=>$attachment_dir.$file_name_125,
    	'path_240'			=>$attachment_dir.$file_name_240,
        'path_origin'    	=>$attachment_dir.$file_name_origin,
		'ext'				=>$Extensions,
		'size'				=>$_FILES [$filename]['size'],
		'upload_date'		=>date("Y-m-d H:i:s")			
	);
	$id = $db->save('file',$record);
	return $upload_file;
	
}
?>