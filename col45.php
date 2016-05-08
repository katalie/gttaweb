<!-- ####################################################################################################### -->
<?php
$sql = "select id,name,url from friendly_link";
$friendly_link_list = $db->selectLimit($sql,6,0);
?>
<div class="wrapper col4">
  <div id="footer">
    <div class="footbox">
      <h2>Contact Information</h2>
      <ul>
        <li><a href="about.php" target="blank">Lijuan Geng: </a></li>
		<li>Email: lijuangeng@yahoo.com </li>
        <li>Telephone: 613-282-7918</li>
		<li><a href="about.php" target="blank">Horatio Pintea: </a></li>
		<li>Email: horatiopintea@rogers.com</li>
        <li>Telephone: 613-277-6855</li>
      </ul>
    </div>
	<div class="footbox">
      <h2>We Are Social</h2>
	  <ul>
	  <li><a href="https://www.facebook.com/GengTableTennisAcademy" target="blank"><img src="./images/facebook.jpg" alt="" /> </a></li>
	 
	  <li><a href="https://plus.google.com/photos/111772324553579024097/albums?banner=pwa" target="blank"><img src="./images/picasa.png" alt="" /> </a></li>
      </ul>
      
    </div>
    <div class="footbox last">
      <h2>Friendly Links</h2>
      <ul>
		<?php
		foreach ( $friendly_link_list as $al ) {
		?>
        <li><a href="<?php echo $al ['url'];?>" target="blank"><?php echo $al ['name'];?></a></li>
		<?php
		}
		?>
      </ul>
    </div>
    
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="copyright">
    <p style=" text-align:center">Copyright &copy; 2013 - All Rights Reserved - <a href="http://www.lijuangeng.com" target="blank">GTTA</a></p>
  </div>
</div>