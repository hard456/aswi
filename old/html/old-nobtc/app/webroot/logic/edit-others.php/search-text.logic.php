<?php


$SearchText = new SearchText();
$SearchText->setOffset($_REQUEST['r_offset']);
$SearchText->setLimit($_REQUEST['r_limit']);
$SearchText->setWord($_REQUEST["word1"]);

$SearchText->addConstrain("book", "book_name", $_REQUEST['book-op'], $_REQUEST['book']);
$SearchText->addConstrain("transliteration", "museum_no", $_REQUEST['museum-no-op'], $_REQUEST['museum-no']);
$SearchText->addConstrain("transliteration", "id_book_type", $_REQUEST['book-type-op'], $_REQUEST['id_book_type']);
$SearchText->addConstrain("transliteration", "id_origin", $_REQUEST['origin-op'], $_REQUEST['id_origin']);
$SearchText->setWord2($_REQUEST['word2'], $_REQUEST['word2-op']);
$SearchText->setWord3($_REQUEST['word3'], $_REQUEST['word3-op']);

$SearchText->search();


$SearchText->setLinesAround($_REQUEST['line-count']);

$Sorter = new Sorter($SearchText->getOffset(), $SearchText->getLimit(), $SearchText->getCount() );


?>
