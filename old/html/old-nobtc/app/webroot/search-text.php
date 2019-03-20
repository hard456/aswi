<?php

require_once('./inc/all.inc.php');

if (!empty($_REQUEST['work-with-lists']) && $_REQUEST['work-with-lists'] == 'on')
 Header("Location: add_to_name_list.php?".get_array_as_get_string_direct($_REQUEST)) ;



//aplikacni logika
if (!empty($_REQUEST['actione']) && $_REQUEST['actione'] == 'search') {
  $exactMatch = (!empty($_REQUEST['exact-match']) && $_REQUEST['exact-match'] == 'on');
  $SearchText = new SearchText($exactMatch);
  $SearchText->setOffset($_REQUEST['r_offset']);
  $SearchText->setLimit($_REQUEST['r_limit']);
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
//konec aplikacni logiky

$tpl = & new Template(INDEX_TMPL);

if (empty($_REQUEST['actione']) || $_REQUEST['actione'] == '') {
	$body = & new Template('./tmpl/search-text.tmpl.php');
	$body->set('book_type_array', utils_get_book_types());
  $body->set('origin_array', utils_get_origins());
  $tpl->set('obsah', $body);
}
else {
  $body = & new Template('./tmpl/search-text-result.tmlp.php');
  $temp .= "<h1>Search in texts - Results</h1>\n";
  $temp .= $Sorter->getLine();
  while($SearchText->next_record()) {
    $res = $SearchText->getResult();
    $body->set('id_transliteration', $res['id_transliteration']);
    $body->set('book_abrev', $res['book_abrev']);
    $body->set('chapter', $res['chapter']);
    $body->set('line_no', $res['line_number']);
    $body->set('line_transliteration', $res['transliteration']);
    $body->set('found1', $_REQUEST["word1"]);
    $body->set('found2', $_REQUEST["word2"]);
    $body->set('found3', $_REQUEST["word3"]);
    //$around = $SearchText->getLinesAround();
    
    $body->set('dots_before', $SearchText->getDotsBefore());
    $body->set('array_lines_before', $SearchText->getLinesBefore());
    $body->set('array_lines_after', $SearchText->getLinesAfter());
    $body->set('dots_after', $SearchText->getDotsAfter());
    $temp .= $body->fetch();
    //p_g($res);
  }
  $tpl->set('obsah', $temp);
  //p_g($SearchText->getResult());
}

echo $tpl->fetch();

//p_g($_REQUEST);
