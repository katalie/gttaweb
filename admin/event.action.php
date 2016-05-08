<?php
require_once ("global.php");

$act = trim($_POST ['act']);

//��������
if ($act=='add') {
	if(empty($_POST['title'])){
		exit("<script>alert('Title Cannot Be Empty!');window.history.go(-1)</script>");
	}
	if(empty($_POST['cid'])){
		exit("<script>alert('Please Select a Category!');window.history.go(-1)</script>");
	}
	$record = array(
		'cid'			=>$_POST ['cid'],
		'title'			=>str_replace('"', '&quot;', $_POST ['title']),
		'event_time'		=>$_POST ['event_time'],
		'event_location'		=>$_POST ['event_location'],
		'content'		=>str_replace("'","\'", $_POST ['content']),
		'created_date'	=>date ( "Y-m-d H:i:s" ),
		'registration_due_date'		=>$_POST ['event_registration_due_date']
	);
	if(!empty($_FILES['pic']['name'])){
		$upload_file = uploadFile('pic');//�ϴ�ͼƬ�����ص�ַ
		$record['pic']=$upload_file;
	}
	$id = $db->save('event',$record);
	header("Location: event.php?id=".$_POST['cid']);
}

//�޸�����
if ($act=='edit'){
	$id = $_POST ['id'];
	if(empty($_POST['title'])){
		exit("<script>alert('Title Cannot Be Empty!');window.history.go(-1)</script>");
	}
	if(empty($_POST['cid'])){
		exit("<script>alert('Please Select a Category!');window.history.go(-1)</script>");
	}	
	
	$record = array(
		'cid'			=>$_POST ['cid'],
		'title'			=>str_replace('"', '&quot;', $_POST ['title']),
		'event_time'		=>$_POST ['event_time'],
		'event_location'		=>$_POST ['event_location'],
		'content'		=>str_replace("'","\'", $_POST ['content']),
		'created_date'	=>date ( "Y-m-d H:i:s" ),
		'registration_due_date'		=>$_POST ['event_registration_due_date']		
	);
	if(!empty($_FILES['pic']['name'])){
		$upload_file = uploadFile('pic');//�ϴ�ͼƬ�����ص�ַ
		$record['pic']=$upload_file;
	}
	$db->update('event',$record,'id='.$id);
	header("Location: event.php?id=".$_POST['cid']);
}

//ɾ������
if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->update('event',array('rubbish'=>1),'id in('.$id.')');
	exit();
}

//ת������
if ($act=='move') {	
	$scid =$_POST['scid'];
	$id = $_POST ['id'];
	$db->update('event',array('cid'=>$scid),'id in('.$id.')');
	exit();
}

//ɾ������ͼ
if ($act=='delpic') {
	$id = $_POST ['id'];
	$pic_path = $db->getOneField("select pic from event where id=".$id);
	$db->update('event',array('pic'=>''),'id in('.$id.')');
	exit();
}

//����ɾ������
if ($act=='cdelete') {	
	$id = $_POST ['id'];
	$db->delete('event','id in('.$id.')');
	exit();
}

//��ԭ����
if ($act=='revert') {	
	$id = $_POST ['id'];
	$db->query("UPDATE event set rubbish = 0 where id in (".$id.")");
}


?>