<?php

require_once('./inc/all.inc.php');

$tpl = & new Template(INDEX_TMPL);
$MAX_LINES = 200;

//prvni krok
if ( Empty($_REQUEST['find']) || Empty($_POST['actionButton']) || $_POST['actionButton'] == $sec_button_label_back ) {
  $body = & new Template('./tmpl/replace.frm.tmpl.php');
  //nazvy buttonu 
  $body->set('first_button_label', $first_button_label);
  $body->set('POST', $_REQUEST);
}
//druhy krok
else if (!Empty($_POST['actionButton']) && $_POST['actionButton'] == $first_button_label) {
  require_once('./logic/replace-find.logic.php');
  $body = & new Template('./tmpl/replace.tmpl.php');
  $body->set('lines', $lines);
  $body->set('bachs', $bachs);
  $body->set('ids', $ids);
  $body->set('find', $_POST['find']);
  //nazvy buttonu 
  $body->set('sec_button_label', $sec_button_label);
  $body->set('sec_button_label_back', $sec_button_label_back);
   //post
  $body->set('POST', $_POST);
}
//treti krok
else if (!Empty($_POST['actionButton']) && $_POST['actionButton'] == $sec_button_label) {

  $body = & new Template('./logic/replace.logic.php');
  $body->set('POST', $_REQUEST);
}
else {	
  //empty 
}

$tpl->set('obsah', $body);

echo $tpl->fetch();

//p_g($_REQUEST);
?>
