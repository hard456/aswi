<?php
  include "autorizace.inc.php";
  ksa_authorize();
  if ($auth_level == 0) ksa_unauthorized();

require('inc/all.inc.php');

$knihy = new Knihy();

//zobrazovaci logika
  //-- zaklad
    $all = & new Template(INDEX_TMPL);
   //-- konec-zakladu
$body = & new Template('./tmpl/ins_book.tmpl.php');
$body->set('add-edit', 'add');

if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'add-book') {
  $body->set('hlaska', $knihy->ins_book($_REQUEST));
}
if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-book' && !Empty($_REQUEST['idbook'])) {
  $body->set('REQUEST', $knihy->get_book($_REQUEST['idbook']));
}
if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-book-save' && !Empty($_REQUEST['idbook'])) {
  $body->set('hlaska', $knihy->update_book($_REQUEST));
  $body->set('REQUEST', $knihy->get_book($_REQUEST['idbook']));
}

  //-- zaklad
    $all->set('obsah', $body);
    echo $all->fetch();
  //-- konec-zakladu
//p_g($_REQUEST);
//p_g($_SESSION);
