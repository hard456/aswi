<?php
  include "autorizace.inc.php";
  ksa_authorize();
  if ($auth_level == 0) ksa_unauthorized();

require('inc/all.inc.php');


$autori = new Autori();

//zobrazovaci logika
  //-- zaklad
    $all = & new Template(INDEX_TMPL);
   //-- konec-zakladu
$body = & new Template('./tmpl/autori.tmpl.php');


if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'new-autor-save') {
  $body->set('hlaska', $autori->addAutor($_REQUEST));
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-author') {
  $body->set('cosedeje', "edit-autor");
  $body->set('fokus_id', $_REQUEST['idauthor']);
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-autor-save') { 
  $body->set('hlaska', $autori->updateAutor($_REQUEST));
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'delete-author') {
  $body->set('knihy_autora', $autori->getAutorsBooks($_REQUEST['idauthor']) );
  $body->set('REQUEST', $_REQUEST);
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'really-delete-author') {
  $body->set('hlaska', $autori->deleteAutor($_REQUEST['idauthor']));
}
  
$body->set('autori', $autori->getAutory() );

  //-- zaklad
    //$all->set('staticke_stranky', $shop->getSeznamInfoStranek());
    //$all->set('obsah_kosiku', $user->obsahKoseString());
    //$all->set('nastaveni', $shop->getNastaveni());
    $all->set('obsah', $body);
    echo $all->fetch();
  //-- konec-zakladu
//p_g($_REQUEST);
//p_g($_SESSION);
