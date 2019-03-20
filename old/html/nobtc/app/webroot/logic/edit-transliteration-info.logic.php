<?php

$connection = new DB_Sql();

$dotaz = "UPDATE transliteration SET chapter = '".pg_escape_string($POST['chapter'])
                                  ."', id_museum = '".pg_escape_string($POST['id_museum'])
                                  ."', museum_no = '".pg_escape_string($POST['museum_no'])
                                  ."', id_origin = '".pg_escape_string($POST['id_origin'])
                                  ."', id_book_type = '".pg_escape_string($POST['id_book_type'])
                                  ."', reg_no = '".pg_escape_string($POST['reg_no'])
                                  ."', date = '".pg_escape_string($POST['date'])
                                  ."', note = '".pg_escape_string($POST['note'])
          ."' WHERE id_transliteration = ".pg_escape_string($POST['id_transliteration']);
          
          
//spustit a vyhodnotit
$connection->query($dotaz);
          
          

//vlozeni revision history
$dotaz = "INSERT INTO rev_history (id_transliteration, date, name, description) VALUES ('".
            pg_escape_string($POST['id_transliteration'])."',
            '".date("Y-m-d")."', '".
            pg_escape_string($_SERVER['PHP_AUTH_USER'])."', '".
            pg_escape_string("Edited catalogue information. ")."')";
            
$connection->query($dotaz);


if (!empty($POST['series']) && is_array($POST['series'])) {
  $dotaz = "DELETE FROM lit_reference WHERE id_transliteration = '".$POST['id_transliteration']."'";
  $connection->query($dotaz);
  foreach(array_keys($POST['series']) as $id) {
    $dotaz = "INSERT INTO lit_reference(series, number, plate, id_transliteration) VALUES ('".
              pg_escape_string($POST['series'][$id])."', '".
              pg_escape_string($POST['number'][$id])."', '".
              pg_escape_string($POST['page'][$id])."', '".
              pg_escape_string($POST['id_transliteration'])."');";
    $connection->query($dotaz);
  }
}



?>
<h3>Done</h3>
