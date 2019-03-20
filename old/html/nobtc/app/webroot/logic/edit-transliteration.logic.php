<?php

$connection = new DB_Sql();

// vymazat vse z tabulky line a surface, kde id_transliteration = this
$mazaci_line = "DELETE FROM line WHERE id_surface IN ( SELECT id_surface FROM surface WHERE id_transliteration = ".$POST['id_transliteration']." )";
$mazaci_surface = "DELETE FROM surface WHERE id_transliteration = ".$POST['id_transliteration'];
//spustit a vyhodnotit
$connection->query($mazaci_line);
$connection->query($mazaci_surface);

//$pomocny = "SELECT Count(*) FROM surface WHERE id_transliteration = ".$POST['id_transliteration'];
//$connection->query($pomocny);
//$connection->next_record();
//p_g($connection);

//a znovu vlozit jako je to v inssert transliteration

$id_transliteration = $POST['id_transliteration'];


//vlozeni revision history
$dotaz = "INSERT INTO rev_history (id_transliteration, date, name, description) VALUES ('".
            pg_escape_string($POST['id_transliteration'])."',
            '".date("Y-m-d")."', '".
            pg_escape_string($_SERVER['PHP_AUTH_USER'])."', '".
            pg_escape_string("Edited transliteration. ")."')";
            
$connection->query($dotaz);

require('./logic/insert-transliteration-data.php');

?>
<h3>Done</h3>
