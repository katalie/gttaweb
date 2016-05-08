<?php
/**
 * 前台公用函数库
 * @author:	phpaa.cn@gmail.com
 */

/**
 * 获取某个栏目信息
 * @param $id 栏目ID
 */
function getCategoryById($id){
	global $db;
	$id = !empty($id) ? intval($id) : 0;
	return $db->find("select * from category where id=".$id);
}

/**
 * 获取某个父栏目的所有子栏目
 * @param $pid 父栏目ID
 */
function getCategoryListByPid($pid=0){
	global $db;
	$id = !empty($pid) ? intval($pid) : 0;
	return $db->findAll("select * from category where pid=".$pid);
}

/**
 * 获取指定栏目列表
 * @param $ids 栏目ID集合 例如：1,2,3
 */
function getCategoryList($ids=0){
	global $db;
	return $db->findAll("select * from category where id in(".$ids.")");
}

/**
 * 获取所有子节点集合
 * @param $pid 栏目ID
 * @return 子节点ID集合 如 1,2,3
 */
function getCategoryChildIds($pid=0){
	global $db;
	$str = "";		//节点集合
	$strChild = ""; //子节点集合
	$list = $db->findAll("select id from category where pid=".$pid);
	foreach($list as $ls){
		$strChild = getCategoryChildIds($ls['id']);		
		$str .= $str==""?$ls['id']:",".$ls['id'];		
		if ($strChild) {
			$str .= $str==""?$strChild:",".$strChild;
		}
	}
	return $str;
}

/**
 * 获取页面列表
 */
function getPageList(){
	global $db;
	return $db->findAll("select * from page");
}

/**
 * 获取页面内容
 * @param $id 页面ID
 */
function getPageInfoByID($id=0){
	global $db;
	return $db->find("select * from page where id=".$id);	
}

/**
 * 获取页面内容
 * @param $code 页面别称
 */
function getPageInfoByCode($code){
	global $db;
	return $db->find("select * from page where code='".$code."'");
}

/**
 * 获取公告栏列表
 */
function getNoticeList(){
	global $db;
	return $db->findAll("select * from notice where state=0 order by id desc");
}

/**
 * 获取公告内容 
 * @param $id 公告ID
 */
function getNoticeInfo($id=0){
	global $db;	
	$id = !empty($id) ? intval($id) : 0;
	return $db->find("select * from notice where id=".$id);
}

/**
 * 获取友情链接列表
 */
function getFriendlinkList(){
	global $db;
	return $db->findAll("select * from friendlink order by seq");
}

/**
 * 获取留言列表
 */
function getMessageList($row = 10){
	global $db;
	global $pageList;
	$page = !empty($page) ? intval($page) : 0;
	$curpage = empty($page)?0:($page-1);
	
	$sql = "select * from message where validate=1 order by id desc";
	
	$pageList['pagination_total_number']	= $db->getRowsNum($sql);
	$pageList['pagination_perpage'] 		= empty($row)?$pageList['pagination_total_number']:$row;
	return $db->selectLimit($sql,$pageList['pagination_perpage'],$curpage*$row);
}

/**
 * 获取文章列表
 * @param $str 	获取条件
 * row 			每页显示行数
 * titlelen 	标题显示字数
 * keywords		关键字
 * type			文章类型（image图片类型....）
 * cid			栏目ID
 * order		排序字段
 * orderway		排序方式（ asc desc）
 * 
 */
function getArticleList($str=''){
	global $db;
	$page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 0;
	$curpage = empty($page)?0:($page-1);
	//定义默认数据
	$init_array =array(
		'row'		=>0,
		'titlelen'	=>0,
		'keywords'	=>0,
		'type'		=>'',
		'cid'		=>'',
		'order'		=>'id',
		'orderway'	=>'desc'
	);
	//用获取的数据覆盖默认数据
	$str_array = explode('|',$str);
	foreach($str_array as $_str_item){
		if(!empty($_str_item)){
			$_str_item_array = explode('=',$_str_item);
			if(!empty($_str_item_array[0])&&!empty($_str_item_array[1])){
				$init_array[$_str_item_array[0]]=$_str_item_array[1];
			}
		}
	}
	
	//定义要用到的变量
	$row		 = $init_array['row'];
	$titlelen	 = $init_array['titlelen'];
	$keywords	 = htmlspecialchars($init_array['keywords']);
	$type		 = $init_array['type'];
	$cid		 = $init_array['cid'];
	$order		 = $init_array['order'];
	$orderway	 = $init_array['orderway'];
	
	//文章标题长度控制
	if(!empty($titlelen)){
		$title="substring(a.title,1,".$titlelen.") as title";
	}else{
		$title="a.title";
	}
	//根据条件数据生成条件语句
	$where = "";
	if(!empty($cid)){
		$where .= " and a.cid in (".$cid.")";
	}else{
		$id = !empty($id) ? intval($id) : 0;
		if(!empty($id)){
			$where .= " and a.cid in (".$id.")";
		}
	}
	if($type=='image'){
		$where .= " and a.pic is not null";
	}
	
	if(!empty($keywords)){
		$where .= " and a.title like '%".$keywords."%' or a.content like '%".$keywords."%'";
	}

	$sql = "select 
	a.id,b.id as cid,".$title.",a.att,a.pic,a.source,
	a.author,a.resume,a.pubdate,a.content,a.hits,a.created_by,a.created_date,
	b.name
	from article a 
	left outer join category b on a.cid=b.id
	where a.delete_session_id is null ".$where." order by a.".$order." ".$orderway;
	
	global $pageList;
	$pageList['pagination_total_number']	= $db->getRowsNum($sql);
	$pageList['pagination_perpage'] 		= empty($row)?$pageList['pagination_total_number']:$row;
	return $db->selectLimit($sql,$pageList['pagination_perpage'],$curpage*$row);
}

/**
 * 获取文章详情
 * @param  $id
 */
function getArticleInfo($id=0){
	global $db;
	$db->query("update article set hits=hits+1 where id=".$id);
	return $db->find("select * from article where id=".$id);
}


/**
 * 分页函数
 * @param $page_url 分页URL
 * @param $page 	页码显示数
 */
function getPagination($page_url,$page = 8) {
	global $pageList;
	//当前第几页
	$curpage = empty($_GET['page'])?1:$_GET['page'];
	$realpages = 1;									
	if($pageList['pagination_total_number'] > $pageList['pagination_perpage']) {//需要分页
		$offset = 2;
		//实际总分页数
		$realpages = @ceil($pageList['pagination_total_number'] / $pageList['pagination_perpage']);
		$pages = $realpages;
		if($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if($from < 1) {
				$to = $curpage + 1 - $from;
				$from = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif($to > $pages) {
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}
		
		$page = '';
		$page_url .= strpos($page_url, '?') ? '&amp;' : '?';
		$page = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.$page_url.'page=1" class="first">首页</a> ' : '').
			($curpage > 1? '<a href="'.$page_url.'page='.($curpage - 1).'" class="prev">上一页</a> ' : '');
		for($i = $from; $i <= $to; $i++) {
			$page .= $i == $curpage ? '<strong style="color:#ffa000">'.$i.'</strong> ' :
				'<a href="'.$page_url.'page='.$i.($i == $pages ? '#' : '').'">'.$i.'</a> ';
		}
		$page .= ($to < $pages ? '<a href="'.$page_url.'page='.$pages.'" class="last">...'.$pages.'</a> ': '');
		$page .= ($curpage < $pages ? '<a href="'.$page_url.'page='.($curpage + 1).'" class="next">下一页</a> ' : '');
		$page .= ($to < $pages ? '<a href="'.$page_url.'page='.$pages.'" class="last">尾页</a> ': '');
		$page = $page ? '<div class="pages">共&nbsp;'.$pageList['pagination_total_number'].'&nbsp;条 '.$page.'</div>' : '';
	}
	return $page;
}
?>