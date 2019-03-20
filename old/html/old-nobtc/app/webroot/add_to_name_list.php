<?php

require_once('./inc/all.inc.php');

//pr($_REQUEST);

//aplikacni logika
if (!empty($_REQUEST['actione']) && $_REQUEST['actione'] == 'search') {
  $exactMatch = (!empty($_REQUEST['exact-match']) && $_REQUEST['exact-match'] == 'on');
  $SearchText = new SearchText($exactMatch);
  $SearchText->setOffset($_REQUEST['r_offset']);
  $SearchText->setLimit(1000);
  $SearchText->setWord($_REQUEST["word1"]);
  $SearchText->setWord2($_REQUEST['word2'], $_REQUEST['word2-op']);
  $SearchText->setWord3($_REQUEST['word3'], $_REQUEST['word3-op']); 
  
  $SearchText->addConstrain("book", "book_name", $_REQUEST['book-op'], $_REQUEST['book']);
  $SearchText->addConstrain("transliteration", "museum_no", $_REQUEST['museum-no-op'], $_REQUEST['museum-no']);
  $SearchText->addConstrain("transliteration", "id_book_type", $_REQUEST['book-type-op'], $_REQUEST['id_book_type']);
  $SearchText->addConstrain("transliteration", "id_origin", $_REQUEST['origin-op'], $_REQUEST['id_origin']);
  $SearchText->addConstrain("transliteration", "reg_no", $_REQUEST['reg_no-op'], $_REQUEST['reg_no']);
  $SearchText->addConstrain("transliteration", "date", $_REQUEST['date-op'], $_REQUEST['date']);
  
  $SearchText->search();
  $SearchText->setLinesAround($_REQUEST['line-count']);

  $Sorter = new Sorter($SearchText->getOffset(), $SearchText->getLimit(), $SearchText->getCount() );
}
elseif (!empty($_REQUEST['actione']) && $_REQUEST['actione'] == 'add_to_list') {
  if (empty($_REQUEST['id_name'])) {
    $connection = new DB_Sql();
    $dotaz = "INSERT INTO name (name) VALUES ('".
            pg_escape_string($_REQUEST['word1'])."')";

    $connection->query($dotaz);
  	$_REQUEST['id_name'] = $connection->currval('name_id_name_seq');
  }
  foreach ($_REQUEST['line'] as $key=>$value) {
  	  $dotaz = "INSERT INTO name_line (id_name, id_line) VALUES ('".
            pg_escape_string($_REQUEST['id_name'])."', '".
            pg_escape_string($key)."')";
      $connection->query($dotaz);
  }
  
	pr($_REQUEST);
}
//konec aplikacni logiky

$tpl = & new Template(INDEX_TMPL);
$envelope = & new Template('./tmpl/add-to-name-list-envelope.tmpl.php');
$body = & new Template('./tmpl/add-to-name-list.tmpl.php');

$envelope->set('isDivine', ($_REQUEST['list-of-names-radio'] === 'divine'));


  while($SearchText->next_record()) {
    $res = $SearchText->getResult();
    $body->set('id_transliteration', $res['id_transliteration']);
    $body->set('book_abrev', $res['book_abrev']);
    $body->set('chapter', $res['chapter']);
    $body->set('line_no', $res['line_number']);
    $body->set('line_transliteration', $res['transliteration']);
    $body->set('id_line', $res['id_line']);
    
    $body->set('found1', $_REQUEST["word1"]);
    $body->set('found2', $_REQUEST["word2"]);
    $body->set('found3', $_REQUEST["word3"]);

    $temp .= $body->fetch();
    //p_g($res);
  }
  $envelope->set("obsah_formu", $temp);
  
  $tpl->set('obsah', $envelope->fetch());
  

echo $tpl->fetch();


pr($_REQUEST);
