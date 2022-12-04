<?php


session_start();
ob_clean();
$random_alpha = md5(rand());

$captcha_code = substr($random_alpha, 0, 6);

$_SESSION['captcha_code'] = $captcha_code;


header('Content-Type: image/png');

$image = imagecreaturecolor(200, 38);

$background_color = imagecolorallocate($image, 231, 100, 18);

$text_color = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image, 0, 0, 200, 38, $background_color);

$font = dirname(_FILE_) . '/arial.ttf';

imagettftext($image, 20, 0, 60, 38, $test_color, $font, $captcha_code);

imagepng($image);

imagedestroy($image);
 ?>









<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
