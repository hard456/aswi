<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META content="text/html; charset=utf-8" http-equiv=Content-Type></HEAD>
<BODY>
<?
  echo $text1;
	require "./fcestrip.php";
  $text1 =" <DIS:>culibrk";
	$webtext1 = FCESTRIP ($text1);
  echo $webtext1;
?>
</BODY></HTML>