<?php

$SearchCatalog = new SearchCatalog();
$SearchCatalog->setOperation($_REQUEST['-lop']);
$SearchCatalog->setOffset($_REQUEST['r_offset']);
$SearchCatalog->addConstrain("book", "id_book", $_REQUEST["id_book-op"], $_REQUEST["id_book"]);
$SearchCatalog->addConstrain("book", "book_name", $_REQUEST["book_name-op"], $_REQUEST["book_name"]);
$SearchCatalog->addConstrain("book", "book_autor", $_REQUEST["book_autor-op"], $_REQUEST["book_autor"]);
$SearchCatalog->addConstrain("transliteration", "chapter", $_REQUEST["chapter-op"], $_REQUEST["chapter"]);
$SearchCatalog->addConstrain("transliteration", "id_museum", $_REQUEST["id_museum-op"], $_REQUEST["id_museum"]);
$SearchCatalog->addConstrain("transliteration", "museum_no", $_REQUEST["museum_no-op"], $_REQUEST["museum_no"]);
$SearchCatalog->addConstrain("transliteration", "id_origin", $_REQUEST["id_origin-op"], $_REQUEST["id_origin"]);
$SearchCatalog->addConstrain("transliteration", "id_book_type", $_REQUEST["id_book_type-op"], $_REQUEST["id_book_type"]);

if ( !empty($_REQUEST['view-all']) ) {
	$SearchCatalog->setLimit(1000);
}
  
$SearchCatalog->search();

while ($SearchCatalog->next_record()) {
  $Found_catc[] = $SearchCatalog->getResult();
  $Transliterations[] = new Transliteration($SearchCatalog->result['id_transliteration']);
}
$Sorter = new Sorter($SearchCatalog->getOffset(), $SearchCatalog->getLimit(), $SearchCatalog->getCount() );



?>
