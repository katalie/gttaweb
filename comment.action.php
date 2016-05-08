<?php
require_once 'include/config.inc.php';

if($_POST ['comment']=='' || $db->getRowsNum('select * from comment where ip=\''.get_client_ip().'\'') > 0)
	header("Location: news.php?id=".$_POST ['nid']);
else{
$record = array(
	'nid'		=>$_POST ['nid'],
	'name'			=>$_POST ['name'],
	'content'		=>$_POST ['comment'],
	'ip'=> get_client_ip(),
	'comment_time'	=>date ( "Y-m-d H:i:s" )
);
$id = $db->save('comment',$record);
redirect('news.php?id='.$_POST ['nid'],$time=3,$msg='You have commented successfully! The System will redirect you to news page in 3 seconds!');
}
?>