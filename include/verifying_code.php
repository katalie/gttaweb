<?php
/*
 * 生成验证码
 */
session_start();
header("Content-type: image/png");

include_once 'functions.php';

$_SESSION['code'] = rand_string(4,1);

$string = $_SESSION['code'];

$im     = imagecreatefromgif("../admin/images/validate.gif");
$orange = imagecolorallocate($im, 200, 200, 200);
$px     = (imagesx($im) - 1.5 * strlen($string)) /3;
imagestring($im, 5, $px, 2, $string, $orange);
imagepng($im);
imagedestroy($im);
?>