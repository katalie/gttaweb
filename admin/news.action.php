<?php
require_once ("global.php");

$act = trim($_POST ['act']);

//添加文章
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
		'summary'		=>$_POST ['summary'],
		'slide_position'		=>$_POST ['slide_position'],
		'content'		=>str_replace("'","\'", $_POST ['content']),
		'created_date'	=>date ( "Y-m-d H:i:s" )
	);
	if(!empty($_FILES['pic']['name'])){
		$upload_file = uploadFile('pic');//上传图片，返回地址
		$record['pic']=$upload_file;
	}
	$id = $db->save('news',$record);
	header("Location: news.php?id=".$_POST['cid']);
}

//修改文章
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
		'summary'		=>$_POST ['summary'],
		'slide_position'		=>$_POST ['slide_position'],
		'content'		=>str_replace("'","\'", $_POST ['content']),	
	);
	if(!empty($_FILES['pic']['name'])){
		$upload_file = uploadFile('pic');//上传图片，返回地址
		$record['pic']=$upload_file;
	}
	$db->update('news',$record,'id='.$id);
	header("Location: news.php?id=".$_POST['cid']);
}

//删除文章
if ($act=='delete') {	
	$id = $_POST ['id'];
	$db->update('news',array('rubbish'=>1),'id in('.$id.')');
	exit();
}

//转移文章
if ($act=='move') {	
	$scid =$_POST['scid'];
	$id = $_POST ['id'];
	$db->update('news',array('cid'=>$scid),'id in('.$id.')');
	exit();
}

//删除缩略图
if ($act=='delpic') {
	$id = $_POST ['id'];
	$pic_path = $db->getOneField("select pic from news where id=".$id);
	$db->update('news',array('pic'=>''),'id in('.$id.')');
	exit();
}

//彻底删除垃圾
if ($act=='cdelete') {	
	$id = $_POST ['id'];
	$db->delete('news','id in('.$id.')');
	$db->delete('comment','nid='.$id);
	exit();
}

//还原垃圾
if ($act=='revert') {	
	$id = $_POST ['id'];
	$db->query("UPDATE news set rubbish = 0 where id in (".$id.")");
}


?>