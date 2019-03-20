<?php

$SearchBook = new SearchBook();

$SearchBook->addConstrain("book", "id_book", "is", $_REQUEST['id_book']);

$SearchBook->search();
$result = $SearchBook->getResult();
?>
