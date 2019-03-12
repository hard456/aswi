<?php

require_once('./inc/all.inc.php');

//aplikacni logika - precist z db
if ( !empty($_REQUEST['id_book']) && empty($_POST['actione']) ) {
  require_once('./logic/search-book.logic.php');
}
//konec aplikacni logiky

//zobrazeni
$tpl = & new Template(INDEX_TMPL);

if (Empty($_POST['actione'])) {
  $body = & new Template('./tmpl/book-edit.tmpl.php');
    //
  $body->set('button_label', $sec_button_label);

  $body->set('id_book', $_REQUEST['id_book']);
  $body->set('POST', $result);
  //znovu zobrazene promenne
  //$body->set('POST', );
}
//treti krok
else {
  $body = & new Template('./logic/edit-book.logic.php');
  $body->set('POST', $_REQUEST);
}

$tpl->set('obsah', $body);

echo $tpl->fetch(INDEX_TMPL);

//p_g($result);



