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

foreach($object_type_array as $object_type_object) {
  $object_type = StrTr($object_type_object['object_type'], " ", "_");

  //p_g("$object_type \n");

  foreach($surface_type_array as $surface_type_object) {
    $surface_type = StrTr($surface_type_object['surface_type'], " ", "_");

    //p_g("$surface_type \n");

    $count = $POST["$object_type-$surface_type-count"];

    //p_g("count: $count  \n");


    if (!Empty($count) && $count > 0) {

      $id_object_type = $object_type_object['id_object_type'];
      $id_surface_type = $surface_type_object['id_surface_type'];

      $dotaz = "INSERT INTO surface (column_number, id_transliteration, id_object_type, id_surface_type) VALUES (0, ".
                $id_transliteration . ", " . $id_object_type . ", " . $id_surface_type . ")";
      $connection->query($dotaz);
      $id = $connection->currval('surface_id_surface_seq');
      $id_surface = $id;

        //a pro kazdou radku v tomu object-surface
        //vlozit radek do line
      //p_g($POST["$object_type-$surface_type-line"]);
      $keys = array_keys($POST["$object_type-$surface_type-line"]);
      foreach ($keys as $k=>$i) {

        $line_broken = (Empty($POST["$object_type-$surface_type-line-broken"][$i]))? 'false' : 'true' ;
      	$dotaz = "INSERT INTO line (transliteration, line_number, id_surface, broken) VALUES ('".
                  pg_escape_string(Trim( $POST["$object_type-$surface_type-line"][$i] ))."', '".
                  pg_escape_string(Trim( $POST["$object_type-$surface_type-line-no"][$i] ))."', ".
                  $id_surface.", ".
                  $line_broken.")";
       //p_g($dotaz);
      	$connection->query($dotaz);

      }
    }
  }
}
?>

<h3>Done.</h3>
