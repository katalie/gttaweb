<?php
require_once ("global.php");

$act = trim($_POST ['act']);


//и╬ЁЩндуб
if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->delete('participant','id in('.$id.')');
	exit();
}
?>