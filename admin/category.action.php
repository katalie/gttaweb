<?php
require_once ("global.php");
$act = $_POST['act'];

if($act=='add'){
	$pid = $_POST['pid'];
	$record = array(
		'pid'		=>$_POST ['pid'],
		'name'		=>$_POST ['name']
	);
	$id = $db->save('category',$record);
	header("Location: category.php");
}
if ($act=='edit'){
	$pid = $_POST['pid'];
	$id  = $_POST['cid'];
	$record = array(
		'pid'		=>$_POST ['pid'],
		'name'		=>$_POST ['name']
	);
	$db->update('category',$record,'id='.$id);
	header("Location: category.php");
}

if ($act=='delete'){
	$id = $_POST['id'];
	$ids = getAllCatetoryIds($id);
	$db->delete('category','id in('.$ids.')');
	$db->update('news',array('rabbish'=>1),'cid in('.$ids.')');
	exit(1);
}


function getAllChildCategoryIds($id,&$ids=''){
	global $db;
	$list = $db->findAll("select id from category where pid=".$id);
	foreach($list as $ls){
		$ids = empty($ids)?$ls['id']:$ids .','.$ls['id'];
		getAllChildCategoryIds($ls['id'],$ids);
	}
	return $ids;
}
function getAllCatetoryIds($id){
	$ids = getAllChildCategoryIds($id);
	return empty($ids)?$id:$id.','.$ids;
}
?>