<?php
require_once ("global.php");
$act = $_POST ['act'];
if ($act=='add') {	
	$record = array(
		'title'			=>str_replace('"', '&quot;', $_POST ['title']),
		'content'		=>$_POST ['content'],
		'is_member'		=>$_POST ['is_member'],
		'state'			=>$_POST ['state']
	);
	$id = $db->save('notice',$record);
	header("Location: notice.php");
}

if ($act=='edit'){
	$id = $_POST ['id'];
	$record = array(
		'title'			=>str_replace('"', '&quot;', $_POST ['title']),
		'content'		=>str_replace("'","\'", $_POST ['content']),
		'is_member'		=>$_POST ['is_member'],
		'state'			=>$_POST ['state']
	);
	 $db->update('notice',$record,'id='.$id);
	 header("Location: notice.php");
}

if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->delete('notice','id in('.$id.')');
	exit();
}

?>