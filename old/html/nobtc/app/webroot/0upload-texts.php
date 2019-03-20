<?php

require_once('./inc/all.inc.php');

//zobrazeni
$tpl = & new Template(INDEX_TMPL);

//prvni krok
if ( Empty($_POST['actionButton']) || $_POST['actionButton'] == $sec_button_label_back ) {
  $body = & new Template('./tmpl/upload.frm.tmpl.php');
  $body->set('first_button_label', $first_button_label);
}
//druhy krok
else if (!Empty($_POST['actionButton']) && $_POST['actionButton'] == $first_button_label) {
  //logika
  require('./logic/upload-preview.logic.php');
  
  $body = & new Template('./tmpl/upload-preview.tmpl.php');
  //nazvy buttonu 
  $body->set('sec_button_label', $sec_button_label);
  $body->set('sec_button_label_back', $sec_button_label_back);
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
  //
  $body->set('transliteration_count', $transliteration_count);
  $body->set('transliterations', $transliterations);
  //$body->set('POST', $_POST);
}
//treti krok
else if (!Empty($_POST['actionButton']) && $_POST['actionButton'] == $sec_button_label) {
  //aplikacni logika
  $body = & new Template('./logic/upload.logic.php');
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types()); 
  $body->set('transliterations', $_REQUEST['translits']);
}
else {	
  //empty 
}

$tpl->set('obsah', $body);

echo $tpl->fetch(INDEX_TMPL);
//p_g($_REQUEST);
?>
