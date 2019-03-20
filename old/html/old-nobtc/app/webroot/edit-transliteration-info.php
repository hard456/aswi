<?php

require_once('./inc/all.inc.php');

//aplikacni logika - predelat
if ( !empty($_REQUEST['id_transliteration']) ) {
  require_once('./logic/show-transliteration-info.logic.php');
}  
//konec aplikacni logiky

//zobrazeni
$tpl = & new Template(INDEX_TMPL);

 if (Empty($_POST['actionButton'])) {
  $body = & new Template('./tmpl/transliteration-info-edit.tmpl.php');

  $body->set('id_transliteration', $_REQUEST['id_transliteration']);
  $body->set('button_label', $sec_button_label);
  $body->set('POST', $result );
}
//treti krok
else {
  $body = & new Template('./logic/edit-transliteration-info.logic.php');
  $body->set('POST', $_REQUEST );
}

$tpl->set('obsah', $body);

echo $tpl->fetch(INDEX_TMPL);

//p_g($result);
//p_g($_POST);

?>
