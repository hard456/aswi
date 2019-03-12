<?php

$connection = new DB_Sql();

foreach($transliterations as $key=>$POST) {
  $books = utils_get_books();
  $id_book = -1;
  
  foreach($books as $book_key=>$book) {
    if ($book['book_abrev'] == $POST['book']) {
      $id_book = $book['id_book'];
    }
  }
  
  if($id_book < 0) {
    $dotaz = "INSERT INTO book (book_abrev, book_name, book_autor, book_description) VALUES ('".
            $POST['book']."', '".
            $POST['book']."', '', '')";

    $connection->query($dotaz);
    $id = $connection->currval('book_id_book_seq');
    $id_book = $id;
  }
  
  $dotaz = "INSERT INTO transliteration (chapter, id_book, museum_no, id_museum, id_origin, id_book_type) VALUES ('".
            $POST['chapter']."', '$id_book', '', '0', '0', '0')";
            
  $connection->query($dotaz);
  $id = $connection->currval('transliteration_id_transliteration_seq');
  $id_transliteration = $id;
  
  //$POST = $transliteration;
  require('./logic/insert-transliteration-data.php');
  
  //p_g($transliteration);
}
?>
<h1>Done</h1>
<p>Content of your file was saved in form, you have seen in previous step.</p>
