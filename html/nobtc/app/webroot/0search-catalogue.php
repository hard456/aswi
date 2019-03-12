<?php

require_once('./inc/all.inc.php');

//aplikacni logika
if (!empty($_REQUEST['actione']) && $_REQUEST['actione'] == 'search') {
  require_once('./logic/search-catalogue.logic.php');
}  
//konec aplikacni logiky

$tpl = & new Template(INDEX_TMPL);

if (Empty($_REQUEST['actione']) || $_REQUEST['actione'] == '') {
  $body = & new Template('./tmpl/search-catalogue.tmpl.php');
  $body->set('book_type_array', utils_get_book_types());
  $body->set('book_array', utils_get_books());
  $body->set('museum_array', utils_get_museums());
  $body->set('origin_array', utils_get_origins());
}
else if (!empty($_REQUEST['actione']) && $_REQUEST['actione'] == 'search') {
  $body = & new Template('./tmpl/search-catalogue-result.tmpl.php');
  $body->set('Found_catc', $Found_catc);
  $body->set('Transliterations', $Transliterations);
  $body->set('object_type_array', utils_get_object_types());
  $body->set('surface_type_array', utils_get_surface_types());
  $body->set('Sorter_line', $Sorter->getLine());
}

$tpl->set('obsah', $body);

echo $tpl->fetch();

//p_g($_REQUEST);
?>
