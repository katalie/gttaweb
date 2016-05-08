<?php
include_once ("include/functions.php");
session_start();
session_destroy();
redirect('index.php',$time=3,$msg='You have logged out successfully! The System will redirect you to Home Page in '.$time.' seconds!');
?>