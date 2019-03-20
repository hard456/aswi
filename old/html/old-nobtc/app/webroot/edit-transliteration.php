<?php

require_once('./inc/all.inc.php');

//p_g($_REQUEST);

//aplikacni logika - ziskani dat k editaci
if ( !empty($_REQUEST['id_transliteration']) && Empty($_REQUEST['actionButton']) ) {
  require_once('./logic/show-transliteration.logic.php');
}  
//konec aplikacni logiky

//zobrazeni
$tpl = & new Template(INDEX_TMPL);
 
if (Empty($_REQUEST['actionButton'])) {
  $body = & new Template('./tmpl/edit-transliteration.tmpl.php');
    //
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
  
  $body->set('button_label', $sec_button_label);
  
  $body->set('id_transliteration', $_REQUEST['id_transliteration']);
  //znovu zobrazene promenne
  $body->set('POST', $Transliteration->getResult());
}
//
else {
  ///p_g($_REQUEST);
  $body = & new Template('./logic/edit-transliteration.logic.php');
  $body->set('POST', $_REQUEST);
  
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
}

$tpl->set('obsah', $body);

echo $tpl->fetch(INDEX_TMPL);

//p_g($_POST);
//p_g($Transliteration->getResult());
?>
