<?php
  include "autorizace.inc.php";
  ksa_authorize();
  if ($auth_level == 0) ksa_unauthorized();

require('inc/all.inc.php');


$subjects = new Subjects();

//zobrazovaci logika
  //-- zaklad
    $all = & new Template(INDEX_TMPL);
   //-- konec-zakladu
$body = & new Template('./tmpl/subjects.tmpl.php');


if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'new-subject-save') {
  $body->set('hlaska', $subjects->addSubject($_REQUEST));
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-subject') {
  $body->set('cosedeje', "edit-subject");
  $body->set('fokus_id', $_REQUEST['idsubject']);
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'edit-subject-save') { 
  $body->set('hlaska', $subjects->updateSubject($_REQUEST));
}
else if (!empty($_REQUEST['akce']) && $_REQUEST['akce'] == 'delete-subject') {
  $body->set('hlaska', $subjects->deleteSubject($_REQUEST['idsubject']));
}
  
$body->set('subjects', $subjects->getSubjects() );

  //-- zaklad

    $all->set('obsah', $body);
    echo $all->fetch();
  //-- konec-zakladu
//p_g($_REQUEST);
//p_g($_SESSION);
