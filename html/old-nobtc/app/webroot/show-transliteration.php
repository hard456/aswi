<?php

require_once('./inc/all.inc.php');

//aplikacni logika
if ( !empty($_REQUEST['id_transliteration']) ) {
  require_once('./logic/show-transliteration.logic.php');
}  
//konec aplikacni logiky

$tpl = & new Template(INDEX_TMPL);
$body = & new Template('./tmpl/show-transliteration.tmpl.php');
if ( !empty($_REQUEST['id_transliteration']) ) {  
  $body->set('found_cat', $SearchCatalog->getResult());
  $body->set('transliteration_count', $SearchCatalog->getCount());
  $body->set('POST', $Transliteration->getResult());
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
  $body->set('id_transliteration', $_REQUEST['id_transliteration']);
  $body->set('searchtext1', $_REQUEST['searchtext1']);
  $body->set('searchtext2', $_REQUEST['searchtext2']);
  $body->set('searchtext3', $_REQUEST['searchtext3']);
  $body->set('references', $Reference->getResult());
  $body->set('rev_history', $Transliteration->getRevHistory());
  $body->set('photos', $Transliteration->getPhotos());
  $body->set('handcopies', $Transliteration->getHandcopies());
}

$tpl->set('obsah', $body);

echo $tpl->fetch();

//p_g($_REQUEST);
?>
