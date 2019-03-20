<?php

$connection = new DB_Sql();

$dotaz = "UPDATE book SET  book_abrev = '".pg_escape_string($POST['book_abrev'])."', 
                           book_autor = '".pg_escape_string($POST['book_autor'])."', 
                           book_description = '".pg_escape_string($POST['book_description'])."', 
                           book_name = '".pg_escape_string($POST['book_name'])."',
                           place_of_pub = '".pg_escape_string($POST['place_of_pub'])."',
                           date_of_pub = '".pg_escape_string($POST['date_of_pub'])."',
                           pages = '".pg_escape_string($POST['pages'])."',
                           book_subtitle = '".pg_escape_string($POST['book_subtitle'])."',
                           volume = '".pg_escape_string($POST['volume'])."',
                           volume_no = '".pg_escape_string($POST['volume_no'])."'
            WHERE id_book = ".$POST['id_book'];
            
//spustit a vyhodnotit

$connection->query($dotaz);
?>
<h3>Done.</h3>
