<?php
include_once 'global.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu</title>
<link href="images/css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td valign="top" class="main_left">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_title">
        <tr>
          <td>News Management</td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_menu01">
        <tr>
          <td><a href="news.add.php?act=add" target="mainFrame">Add News</a></td>
        </tr>
        <tr>
          <td><a href="news.php" target="mainFrame">News List</a></td>
        </tr>
        <tr>
          <td><a href="category.php" target="mainFrame">News Category Management</a></td>
        </tr>
		<tr>
          <td><a href="comment.php" target="mainFrame">News Comment Management</a></td>
        </tr>
        <tr>
          <td><a href="news.rubbish.php" target="mainFrame">News Recycle Bin Management</a></td>
        </tr>
      </table>
      
       <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_title">
        <tr>
          <td>Events Management</td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_menu01">
        <tr>
          <td><a href="event.add.php?act=add" target="mainFrame">Add Event</a></td>
        </tr>
        <tr>
          <td><a href="event.php" target="mainFrame">Event List</a></td>
        </tr>
        <tr>
          <td><a href="eventcategory.php" target="mainFrame">Event Category Management</a></td>
        </tr>
        <tr>
          <td><a href="participant.php" target="mainFrame">Participant Management</a></td>
        </tr>
		<tr>
          <td><a href="event.rubbish.php" target="mainFrame">Event Recycle Bin Management</a></td>
        </tr>
      </table>
      
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_title">
        <tr>
          <td>Website Management</td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_menu01">
        <tr>
          <td><a href="notice.php" target="mainFrame">Notice Management</a></td>
        </tr>
        <tr>
          <td><a href="friendlylink.php" target="mainFrame">Friendly Link</a></td>
        </tr>
        <tr>
          <td><a href="message.php" target="mainFrame">Message Mangement</a></td>
        </tr>
        <tr>
          <td><a href="file.php" target="mainFrame">Pircture Management</a></td>
        </tr>
        <tr>
          <td><a href="user.php" target="mainFrame">User Management</a></td>
        </tr>
      </table>
      
      <br />
      <div style="font-size:12px; text-align:center; width:142px"> GTTA V0.1 <br />
        <a href="http://www.lijuangeng.com" target="_blank">www.lijuangeng.com </a>
	  </div>
	</td>
  </tr>
</table>
</body>
</html>
