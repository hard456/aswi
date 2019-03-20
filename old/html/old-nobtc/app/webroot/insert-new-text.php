<?php

require_once('./inc/all.inc.php');



//zobrazeni
$tpl = & new Template(INDEX_TMPL);

//prvni krok
if ( Empty($_POST['actionButton']) || $_POST['actionButton'] == $sec_button_label_back ) {
  
  $body = & new Template('./tmpl/insert-new-text.tmpl.php');

  //pole pro selecty
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
  //nazvy buttonu 
  $body->set('first_button_label', $first_button_label);
  //znovu zobrazene promenne
  $body->set('POST', $_POST);

}
//druhy krok
else if (!Empty($_POST['actionButton']) && $_POST['actionButton'] == $first_button_label) {
  $body = & new Template('./tmpl/preview.tmpl.php');
    //pole pro selecty
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
  $body->set('book_type_array', utils_get_book_types());
  $body->set('book_array', utils_get_books());
  $body->set('museum_array', utils_get_museums());
  $body->set('origin_array', utils_get_origins());
  //nazvy buttonu 
  $body->set('sec_button_label', $sec_button_label);
  $body->set('sec_button_label_back', $sec_button_label_back);
  //znovu zobrazene promenne
  $body->set('POST', $_POST);
}
//treti krok
else if (!Empty($_POST['actionButton']) && $_POST['actionButton'] == $sec_button_label) {
  //aplikacni logika
  $body = & new Template('./logic/insert-new-text.logic.php');
  //pole pro selecty
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types()); 
  $body->set('POST', $_REQUEST);
}
else {	
  //empty 
}

$tpl->set('obsah', $body);

echo $tpl->fetch(INDEX_TMPL);

//p_g($_POST);
?>
