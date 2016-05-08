<?php
require_once ("global.php");
$act = $_POST ['act'];

if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->delete('comment','id in('.$id.')');
	exit();
}

?>