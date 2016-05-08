<?php
require_once 'include/config.inc.php';
session_start();

if ($_POST ['act']=='add'){
	$record = array(
		'nick_name'		=>$_POST ['nickname'],
		'first_name'			=>$_POST ['firstname'],
		'last_name'		=>$_POST ['lastname'],
		'gender'			=>$_POST ['gender'],
		'age'	=>$_POST ['age'],
		'phone'			=>$_POST ['phone'],
		'postal_code'		=>$_POST ['postalcode'],
		'address'			=>$_POST ['address'],
		'email'			=>$_POST ['email'],
		'password'		=>md5($_POST ['password']),
		'rating'		=>$_POST ['rating'],
		'registered'	=> 1,
		'created_date'	=>date ( "Y-m-d H:i:s" )
	);
	$id = $db->save('user',$record);
	redirect('index.php',$time=3,$msg='You have registered successfully! The System will redirect you to Home Page in 3 seconds!');

}else{
	$id = $_SESSION['user_id'];
	$record = array(
		'nick_name'		=>$_POST ['nickname'],
		'first_name'			=>$_POST ['firstname'],
		'last_name'		=>$_POST ['lastname'],
		'age'=>$_POST ['age'],
		'gender'			=>$_POST ['gender'],
		'phone'			=>$_POST ['phone'],
		'postal_code'		=>$_POST ['postalcode'],
		'address'			=>$_POST ['address'],
		'email'			=>$_POST ['email'],
		'rating'		=>$_POST ['rating']
	);
	$db->update('user',$record,'user_id='.$id);
	redirect('index.php',$time=3,$msg='You have changed your profile successfully! The System will redirect you to Home Page in 3 seconds!');
}


?>