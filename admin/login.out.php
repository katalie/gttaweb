<?php
session_start();
session_destroy();
echo "<script language='javascript'>parent.window.location.href='index.php';</script>";
?>