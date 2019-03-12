<?php

//blob.php


Header("Cache-Control: public");
Header("Content-Type: image/png");
//if ($name) Header("Content-Disposition: inline; filename=$name");


$image = @imagecreatefrompng($name);
if (!$image) {
  $final_img = imagecreate(150,30);
  $bgc = imagecolorallocate($final_img, 255, 255, 255);
  $tc = imagecolorallocate($final_img, 0,0,0);
  imagefilledrectangle($final_img, 0,0,150,20,$bgc);
  imagestring($final_img, 1,5,5,"Error loading image", $tc);
}
else {
  $final_img = ImageRotate($image, -90, 0);
}
  
  
imagepng($final_img);

?>
