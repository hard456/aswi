<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Slovník katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="css/ksa.css"> 
</head>
<body bgcolor=#B5B5B5 style="scrollbar-face-color:#3D4E5E;scrollbar-shadow-color:#3D4E5E;scrollbar-highlight-color:#FFFF99;scrollbar-3dlight-color:#3D4E5E;scrollbar-darkshadow-color:#FFFF99;scrollbar-track-color:#9A9A9A;scrollbar-arrow-color:#FFFF99">
<center>
  <table>
    <thead align="center">Skript přelož z </thead>
    <tbody>
      <tr>
        <td class="akt">
          <a href="?language=cz">&raquo;češtiny &laquo;</a>&nbsp;&nbsp;
          <a href="?language=en">&raquo;angličtiny &laquo;</a>&nbsp;&nbsp;
          <a href="?language=ar">&raquo;arabštiny &laquo;</a>&nbsp;&nbsp;</td>
      </tr>
    </tbody>
  </table>
</center>
<?php

if (!Empty($action) && $action == "translate") {
  require_once("./functions/dictionary.php");
  print_translation($text1, $language);
}



switch ($language) {
  case("en"):
    $jazyk_slovne = "angličtině";
    $klavesnice = false;
  break;
  case("ar"):
    $jazyk_slovne = "arabštině";
    $klavesnice = true;    
  break;
  case("cz"):
  default:
    $language = "cz";
    $jazyk_slovne = "češtině";
    $klavesnice = false;
}

?>
<form name="translate_form" action="" method="POST">
<center>
<table>
  <tbody>
    <tr>
      <td class="akt">
        Zadej slovo v <?php echo $jazyk_slovne?>:
      </td>
      <td<?php if($klavesnice) echo' dir="rtl"';?>>
        <input type="text" name="text1"  size="50" />
      </td>
      <td>
        <input type="submit" value="Přelož">
        <input type="hidden" name="language" value="<?php echo $language?>">
        <input type="hidden" name="action" value="translate">
      </td>
    </tr>
  </tbody>
</table>
</center>
</form>
<?php 
  if($klavesnice) {
    require("./functions/keyboard.php");
    insert_keyboard("translate_form.text1");
  }
?>

</body>
</html>

