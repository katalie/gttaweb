<?php
require_once ("global.php");
$act = $_POST ['act'];

if ($act=='edit'){
	$id = $_POST ['id'];
	$record = array(
		'fisrt_name'			=>$_POST ['fisrt_name'],
		'last_name'		=>$_POST ['last_name'],
		'gender'			=>$_POST ['gender'],
		'date_of_birth'	=>$_POST ['age'],
		'phone'			=>$_POST ['phone'],
		'postal_code'		=>$_POST ['postal_code'],
		'address'			=>$_POST ['address'],
		'email'			=>$_POST ['email'],
		'rating'		=>$_POST ['rating']
	);
	 $db->update('user',$record,'user_id='.$id);
	 header("Location: user.php");
}

if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->delete('user','user_id in('.$id.')');
	exit();
}

?>