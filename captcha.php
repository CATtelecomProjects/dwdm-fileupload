<?php
#Genrate Securitycode
session_start();
header("Content-type: image/png");
$ranNUm = rand(1000,9999);
$_SESSION['security_code'] = $ranNUm;
$img = imagecreate(60,17);
$color = imagecolorallocate( $img , 0 , 0 ,0);
$text_color =imagecolorallocate($img , 255,255,255);
imagestring($img,5,10,1,$ranNUm ,$text_color);
imagepng($img);
imagedestroy($img);
?>