<?php 

$connection = new DB_Sql();

if ( $POST['add-or-select-radio'] == 'add' ) {
//vlozeni do knihy, pokud je nova

  $dotaz = "INSERT INTO book (book_abrev, book_name, book_autor, book_description, place_of_pub, date_of_pub, book_subtitle, volume, volume_no, pages) VALUES ('".
            pg_escape_string($POST['book_abrev'])."', '".
            pg_escape_string($POST['book_name'])."', '".
            pg_escape_string($POST['book_autor'])."', '".
            pg_escape_string($POST['book_description'])."', '".
            pg_escape_string($POST['place_of_pub'])."', '".
            pg_escape_string($POST['date_of_pub'])."', '".
            pg_escape_string($POST['book_subtitle'])."', '".
            pg_escape_string($POST['volume'])."', '".
            pg_escape_string($POST['volume_no'])."', '".
            pg_escape_string($POST['pages'])."')";

  $connection->query($dotaz);
  $id = $connection->currval('book_id_book_seq');
  $POST['id_book'] = $id;

}

//vlozeni do transliteration

$dotaz = "INSERT INTO transliteration (chapter, id_book, museum_no, id_museum, id_origin, id_book_type, reg_no, note, date) VALUES ('".
            pg_escape_string($POST['chapter'])."', '".
            pg_escape_string($POST['id_book'])."', '".
            pg_escape_string($POST['museum_no'])."', '".
            pg_escape_string($POST['id_museum'])."', '".
            pg_escape_string($POST['id_origin'])."', '".
            pg_escape_string($POST['id_book_type'])."', '".
            pg_escape_string($POST['reg_no'])."', '".
            pg_escape_string($POST['note'])."', '".
            pg_escape_string($POST['date'])."')";
            
  $connection->query($dotaz);
  $id = $connection->currval('transliteration_id_transliteration_seq');
  $id_transliteration = $id;

//vlozeni do lit_reference, pokud je zadana

if (!empty($POST['series']) && is_array($POST['series'])) {
  foreach(array_keys($POST['series']) as $id) {
    $dotaz = "INSERT INTO lit_reference(series, number, plate, id_transliteration) VALUES ('".
              pg_escape_string($POST['series'][$id])."', '".
              pg_escape_string($POST['number'][$id])."', '".
              pg_escape_string($POST['page'][$id])."', '".
              pg_escape_string($id_transliteration)."');";
    $connection->query($dotaz);
  }
}

//vlozeni revision history


$dotaz = "INSERT INTO rev_history (id_transliteration, date, name, description) VALUES ('".
            pg_escape_string($id_transliteration)."',
            '".date("Y-m-d")."', '".
            pg_escape_string($_SERVER['PHP_AUTH_USER'])."', '".
            pg_escape_string("Inserted using web interface. ")."')";
            
  $connection->query($dotaz);

//vlozeni vsech radek ze vsech surfaceu

require('./logic/insert-transliteration-data.php');

?>
<h3>Done.</h3>
