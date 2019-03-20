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

<!--h6>
Soubor generován <?php echo Date("d.m.Y");?> ze systému KBS ZČU v Plzni pro uživatele <?php echo $ses_name." ".$ses_surname; ?>.
</h6-->
<?php
  require_once("./examination/article.php");
  $article = get_article($_REQUEST['view_article']);
  //print_r($article); ?>
  
    <div class="articlecard">
       <h2 class="arabic"> <?php echo $article["title"]?> </h2>
       <p class="arabic">&nbsp;&nbsp;&nbsp;<?php echo $article["body"]?></p>
       <p>&nbsp;&nbsp;&nbsp; <b>zdroj:</b> <?php echo $article["source"]?></p>
       <p>&nbsp;&nbsp;&nbsp; <b>lekce:</b> <?php echo $article["lection"]?></p>
    </div>   


</body>
</html>

