<?
$file= "turci.tif";
$src_img = ImageCreateFromJPEG($file);
//$src_img = ImageRotate($src_img,90,0);
ImageJPEG($src_img);
?>
