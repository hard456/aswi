<?php

function get_word_to_learn($source, $lection) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict 
            WHERE \"source\" = '$source'
            AND   \"lection\" = '$lection'
            ORDER BY Random() LIMIT 1;";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record;
}

?>
