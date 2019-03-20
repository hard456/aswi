<?php

require_once('./inc/all.inc.php');

//aplikacni logika
if (!Empty($_POST['actione']) && $_POST['actione']=='savePicture') {
  $cesta = './picture/'.$_REQUEST['id_transliteration']."/";
  $nazev = 'obrazek';
  $max_x = 1000;
  $max_y = 1000;
  $obr = new Picture($cesta, $_FILES[$nazev]['name'], $_FILES[$nazev], $max_x, $max_y);
  if (!empty($obr->error_message))
    $hlaska = 'File upload error';
  else
    $hlaska = 'File uploaded.';
  $connection = new DB_Sql();
  $dotaz = "INSERT INTO picture (id_transliteration, type, picture, caption) VALUES ('".pg_escape_string($_REQUEST['id_transliteration'])."', '".
           pg_escape_string($_REQUEST['type'])."', '".pg_escape_string($cesta.$obr->filename)."', '".pg_escape_string($_REQUEST['caption'])."')";

  //spustit a vyhodnotit
  $connection->query($dotaz);
}
//konec aplikacni logiky

//zobrazeni
$tpl = & new Template(INDEX_TMPL);

$body = & new Template('./tmpl/add-picture.tmpl.php');
$body->set('POST', $_REQUEST);

if (!Empty($_POST['actione']) && $_POST['actione']=='savePicture') {
  $body->set('hlaska', $hlaska);
}

$tpl->set('obsah', $body);
echo $tpl->fetch(INDEX_TMPL);

//p_g($_REQUEST);

