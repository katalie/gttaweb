<?php
require_once ("global.php");

$act = $_POST ['act'];

if ($act=='add') {	
	$upload_file = uploadFile('file');
    header("Location: file.php");
}

if ($act=='delete') {	
	$id = $_POST ['id'];
	$list = $db->findAll('select * from file where id in('.$id.')');
	foreach($list as $ls){
		@unlink(dirname(dirname(__FILE__)).'/'.$ls['path']);
		@unlink(dirname(dirname(__FILE__)).'/'.$ls['path_125']);
		@unlink(dirname(dirname(__FILE__)).'/'.$ls['path_240']);
	}
	$db->delete('file','id in('.$id.')');
	exit();
}

?>