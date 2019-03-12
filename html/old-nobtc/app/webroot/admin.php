<?php

require_once('./inc/all.inc.php');
require_once('./admin/core/admin.class.php');

$tpl = & new Template(INDEX_TMPL);

$body = & new Template('./admin/tmpl/admin.tmpl.php');
$left = & new Template('./admin/left.php');
//$main = & new Template('./admin/');
$admi = & new Administration ();

$left->set('table_chooser', $admi->get_table_chooser( $_REQUEST['table'] ));
$left->set('table', $_REQUEST['table']);

switch($_REQUEST['nav_id']) {
  case("list"):
    
    if (!Empty($_REQUEST['actione']) && $_REQUEST['actione'] == "delete") {
      $main = $admi->delete_more_rows( $_REQUEST['smaz'], $_REQUEST['table'], $_REQUEST['unique'] );
    }

    if (!Empty($_REQUEST['actione']) && $_REQUEST['actione'] == "sort") {
      $main = $admi->get_table( $_REQUEST['table'], $_REQUEST['unique'], $_REQUEST['order'], $_REQUEST['od'], $_REQUEST['limit'] );
    }
    else {
      if ( empty($_REQUEST['unique']))
        $_REQUEST['unique'] = 'id_'.$_REQUEST['table'];
      $main .= $admi->get_table( $_REQUEST['table'], $_REQUEST['unique'], $_REQUEST['unique'] );
    }
    
  break;
  case("insert"):
    $main = & new Template('./admin/insert.php');  
    if (isset($_REQUEST['actione']) && ($_REQUEST['actione'] == "insert")) { 
      $content = $admi->insert($_REQUEST['table'], $_REQUEST['fields']);
      $content = "<tr><td>".$content."</td></tr>";
    }
    $content .= $admi->table_of_new_edit($_REQUEST['table'], $_REQUEST['form_name']);
    $main->set('table_of_new_edit', $content);
    $main->set('table', $_REQUEST['table']);
    
  break;
  case("edit"):
    
    if (isset($_REQUEST['unique']) && isset($_REQUEST['unique_id']) && ($_REQUEST['actione'] == "edit")) {
      $main = $admi->update ($_REQUEST['table'], $_REQUEST['unique'], $_REQUEST['unique_id'], $_REQUEST['fields']);
      $main = "<tr><td>".$main."</td></tr>";
    } // end row update
    else {
      $form_name = "edit_form";
      $main = & new Template('./admin/edit.php');  
      $main->set('unique_id', $_REQUEST['unique_id']);
      $main->set('unique', $_REQUEST['unique']);
      $main->set('table', $_REQUEST['table']);
      $main->set('form_name', $form_name);
      if (!isset($_REQUEST['unique']) || !isset($_REQUEST['unique_id'])) {
        print_hlasku("Internal Error:");
        return;
      }
      $Record = $admi->get_row($_REQUEST['table'], $_REQUEST['unique'], $_REQUEST['unique_id']);
      $main->set('table_of_edit', $admi->table_of_new_edit($_REQUEST['table'], $form_name, $Record) );
    }
    
  break;
  default:
  
  break;
}

$body->set('main', $main);
$body->set('left', $left);

$tpl->set('obsah', $body);

echo $tpl->fetch();

//p_g($_REQUEST);
?>
