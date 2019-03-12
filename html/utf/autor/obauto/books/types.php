<?php
  include "autorizace.inc.php";
  ksa_authorize();
  if ($auth_level == 0) ksa_unauthorized();

require('inc/all.inc.php');


$types = new Types();

//zobrazovaci logika
  //-- zaklad
    $all = & new Template(INDEX_TMPL);
   //-- konec-zakladu
$body = & new Template('./tmpl/types.tmpl.php');


if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'new-type-save') {
  $body->set('hlaska', $types->addType($_REQUEST));
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-type') {
  $body->set('cosedeje', "edit-type");
  $body->set('fokus_id', $_REQUEST['idtype']);
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-type-save') { 
  $body->set('hlaska', $types->updateType($_REQUEST));
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'delete-type') {
  $body->set('hlaska', $types->deleteType($_REQUEST['idtype']));
}
  
$body->set('types', $types->getTypes() );

  //-- zaklad
    //$all->set('staticke_stranky', $shop->getSeznamInfoStranek());
    //$all->set('obsah_kosiku', $user->obsahKoseString());
    //$all->set('nastaveni', $shop->getNastaveni());
    $all->set('obsah', $body);
    echo $all->fetch();
  //-- konec-zakladu
//p_g($_REQUEST);
//p_g($_SESSION);
