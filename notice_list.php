<div class="column2" id="tabs">
<ul>
<li><a href="#tabs-1">Public Notices</a></li>
<li><a href="#tabs-2">Monthly Ratings</a></li>
</ul>
<div id="tabs-1">
<marquee scrollamount="4" scrolldelay="10" direction="up" onmouseover="this.stop()" onmouseout="this.start()">
	<?php $notice_list = $db->findAll("select * from notice where state=0 and is_member=0 order by id LIMIT 3,30 ");
	foreach($notice_list as $list){?>
	<div><a href="notice.php?id=<?php echo $list ['id'];?>" target="_blank"><?php echo $list['title']?>..</a></div>
	</br>
	<?php }?>
</marquee>
</div>
<div id="tabs-2">
<h2>Top 10 Ratings</h2>
  <table summary="Summary Here" cellpadding="0" cellspacing="0">
	<thead>
	  <tr>
		<th>Nick Name</th>
		<th>Real Name</th>
		<th>Rating</th>
	  </tr>
	</thead>
	<tbody>
	<?php $user_list = $db->findAll("select first_name, nick_name, rating from user where registered = 1 and rating is not null order by rating desc LIMIT 0,10"); $i=0;
	foreach($user_list as $user){?>
	  <tr class="<?php echo $i%2 == 1?"light":"dark";?>">
		<td><?php echo $user ['nick_name'];?></td>
		<td><?php echo $user ['first_name'];?></td>
		<td><?php echo $user ['rating']; $i++?></td>
	  </tr>
	<?php }?>
	</tbody>
  </table>
</div>
</div>