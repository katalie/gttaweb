<?php
require_once 'include/config.inc.php';
session_start();

if($_POST ['act']=='join_event'){
	$id=$_SESSION['user_id'];
	if($_SESSION['user_id'] == null && !isset($_SESSION['user_id'])){
		$record = array(
		'first_name'			=>$_POST ['firstname'],
		'last_name'		=>$_POST ['lastname'],
		'gender'			=>$_POST ['gender'],
		'date_of_birth'	=>$_POST ['age'],
		'phone'			=>$_POST ['phone'],
		'postal_code'		=>$_POST ['postalcode'],
		'address'			=>$_POST ['address'],
		'email'			=>$_POST ['email'],
		'rating'		=>$_POST ['rating'],
		'registered'	=> 0,
		'created_date'	=>date ( "Y-m-d H:i:s" )
		);
		$id = $db->save('user',$record);
	
	}else{
		$record = array(
		'first_name'			=>$_POST ['firstname'],
		'last_name'		=>$_POST ['lastname'],
		'phone'			=>$_POST ['phone'],
		'postal_code'		=>$_POST ['postalcode'],
		'address'			=>$_POST ['address'],
		'rating'		=>$_POST ['rating']
		);
		$db->update('user',$record,'user_id='.$id);
	}
	
	$record = array(
		'eid'			=>$_POST ['eid'],
		'uid'		=>$id,
		'created_date'	=>date ( "Y-m-d H:i:s" )
	);
	$id = $db->save('participant',$record);
	
	redirect('event.php?id='.$_POST ['eid'],$time=3,$msg='You have registered for the event successfully!  The System will redirect you to the Event Page in 3 seconds!');

}else if ($_POST ['act']=='add'){
	$record = array(
		'nick_name'		=>$_POST ['nickname'],
		'first_name'			=>$_POST ['firstname'],
		'last_name'		=>$_POST ['lastname'],
		'gender'			=>$_POST ['gender'],
		'date_of_birth'	=>$_POST ['age'],
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
	
	redirect('index.php',$time=3,$msg='You have registered successfully! The System will redirect you to the Event Page in 3 seconds!');

}else{
	$id = $_SESSION['user_id'];
	$record = array(
		'nick_name'		=>$_POST ['nickname'],
		'first_name'			=>$_POST ['firstname'],
		'last_name'		=>$_POST ['lastname'],
		'date_of_birth'=>$_POST ['age'],
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