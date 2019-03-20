<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Administrace slovníku katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="./css/kbs.css" /> 
</head>
<body onload="javascript:print()">

<h6>
Soubor generován <?php echo Date("d.m.Y");?> ze systému KBS ZČU v Plzni.
</h6>
<?php 
  require_once("./administration/article.php");
  //print_r($_GET) ;
  
  
  //dulezita pojistka
  if (Empty($contrains_user_id)) $contrains_user_id = "all";

 //vypis
if (!Empty($serad)) {
    print_table_of_article($language, $contrains_source, $contrains_lection, $order, $od, $limit);
}
else {
  print_table_of_article($language, $contrains_source, $contrains_lection);
}
  
?>

</body>
</html>

