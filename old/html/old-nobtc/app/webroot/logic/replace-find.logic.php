<?php
$connection = new DB_Sql();
$co = pg_escape_string($_POST['find']);
$dotaz = "SELECT l.*, t.chapter , t.id_transliteration, b.book_abrev
  FROM line l, surface s, transliteration t, book b
  WHERE l.id_surface=s.id_surface 
    AND s.id_transliteration=t.id_transliteration
    AND b.id_book=t.id_book
    AND transliteration ~ add_bracket('$co') LIMIT ".$MAX_LINES;
//echo $dotaz;
//spustit a vyhodnotit
$connection->query($dotaz);

while($connection->next_record()) {
  $lines[$connection->Record['id_line']] = $connection->Record['transliteration'];
  $bachs[$connection->Record['id_line']] = $connection->Record['book_abrev']. ", " .$connection->Record['chapter'];
  $ids[$connection->Record['id_line']] = $connection->Record['id_transliteration'];
}
?>

