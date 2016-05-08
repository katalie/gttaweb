<?php
require_once ("global.php");
$act = $_POST ['act'];

if ($act=='add') {	
	$record = array(
		'name'			=>$_POST ['name'],
		'url'			=>$_POST ['url'],
		'description'	=>$_POST ['description']
	);
	$id = $db->save('friendly_link',$record);
	header("Location: friendlylink.php");
}

if ($act=='edit'){
	$id = $_POST ['id'];
	$record = array(
		'name'			=>$_POST ['name'],
		'url'			=>$_POST ['url'],
		'description'	=>$_POST ['description']
		
	);
	 $db->update('friendly_link',$record,'id='.$id);
	 header("Location: friendlylink.php");
}

if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->delete('friendly_link','id in('.$id.')');
	exit();
}

?>