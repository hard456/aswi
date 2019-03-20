<?php
require_once("./functions/dictionary.php");

function get_pocet_slov($examing) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //vybereme exam
  $dotaz = "SELECT count FROM examing
              WHERE \"IDexaming\" = '$examing'";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record["count"];
}

function get_pocet_spatnych_slov($examing) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //vybereme exam
  $dotaz = "SELECT status FROM exam 
              WHERE examing = '$examing'
              AND status = 0";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function insert_new_examing($user, $source, $lection, $count, $type) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  $dotaz = "INSERT INTO examing (\"user\", date, rating, source, count, type) 
            VALUES ('$user', 'NOW', -1, '$source', '$count', '$type')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při vytváření zkoušení.");
    return NULL;
  }
  $dotaz = "SELECT currval('examing_id_seq')";
  $spojeni->query($dotaz);
  
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při vytváření zkoušení.");
    return NULL;
  }
  $spojeni->next_record();
  return $spojeni->Record["currval"];
}

function words_to_repeat($source, $user) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT *
            FROM exam e, examing ex
            WHERE e.examing = ex.\"IDexaming\"
              AND ex.source = $source
              AND ex.\"user\" = $user
              AND e.status = 0";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při vytváření zkoušení.");
    return NULL;
  }
  return $spojeni;
}

function create_examing($user, $source, $lection, $count, $type) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //vytvori novou polozku v tabulce examing
  $new_examing = insert_new_examing($user, $source, $lection, $count, $type);
    
  //zjisti moznosti opetovneho zkouseni
  $spojeni_k_opakovani = words_to_repeat($source, $user);
  $pocet_k_opakovani = $spojeni_k_opakovani->num_rows();
  
  if ($pocet_k_opakovani == $count) {
    while ($spojeni_k_opakovani->next_record()) {
      $dotaz = "UPDATE exam 
                SET examing = $new_examing, 
                    status = NULL
                WHERE \"IDexam\" = ".$spojeni_k_opakovani->Record["IDexam"];
      $spojeni->query($dotaz);
    }
  }
  else if($pocet_k_opakovani > $count) {
    for ($i = 0 ; $i < $count ;$i++) {
      $spojeni_k_opakovani->next_record();
      $dotaz = "UPDATE exam 
                SET examing = $new_examing, 
                    status = NULL
                WHERE \"IDexam\" = ".$spojeni_k_opakovani->Record["IDexam"];
      $spojeni->query($dotaz);
    }
    while ($spojeni_k_opakovani->next_record()) {
      $dotaz = "DELETE FROM exam 
                WHERE \"IDexam\" = ".$spojeni_k_opakovani->Record["IDexam"];
      $spojeni->query($dotaz);
    }
  }
  else { //if ($pocet_k_opakovani < $count)
    $pomoc = "";
    while ($spojeni_k_opakovani->next_record()) {
      $dotaz = "UPDATE exam 
                SET examing = $new_examing, 
                    status = NULL
                WHERE \"IDexam\" = ".$spojeni_k_opakovani->Record["IDexam"];
      $spojeni->query($dotaz);
      //tohle se pouzije az dale
      $pomoc .= " AND NOT \"IDdict\" = ".$spojeni_k_opakovani->Record["dict"];
    }
    $dotaz = "SELECT *
              FROM dict 
              WHERE source = '$source' AND
                    lection = '$lection'";
    $dotaz .= $pomoc;
    $dotaz .= " ORDER BY random()
                LIMIT ".($count-$pocet_k_opakovani);
    $spojeni->query($dotaz);
    if ($spojeni->Errno != 0) {
      print_hlasku("Chyba při vytváření zkoušení.");
      return NULL;
    }
    $spojeni_na_vkladani = new DB_Sql();
  
    while ($spojeni->next_record()) {
      //echo($spojeni->Record["czech"] . "<br />\n");
      $dotaz = "INSERT INTO exam (examing, status, dict) 
                       VALUES ('$new_examing', NULL, ".$spojeni->Record["IDdict"].")";
      $spojeni_na_vkladani->query($dotaz);
      if ($spojeni_na_vkladani->Errno != 0) {
        print_hlasku("Chyba při vytváření zkoušení.");
        return NULL;
      }
    }
  }
  return $new_examing;
}

function get_exam_word($examing, $step) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //vybereme exam
  $dotaz = "SELECT * FROM exam 
              WHERE examing = '$examing'
              AND status is NULL
              ORDER BY random()
              LIMIT 1";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při zkoušení.");
    return NULL;
  }
  if ($spojeni->num_rows() == 0) {
    return NULL;
  }
  //pak slovicko ze slovniku
  $spojeni->next_record();
  $dict = $spojeni->Record["dict"];
  $exam = $spojeni->Record["IDexam"];
  $dotaz = "SELECT e.\"IDexam\", d.* FROM dict d, exam e
              WHERE d.\"IDdict\" = '$dict'
              AND d.\"IDdict\" = e.dict";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při zkoušení.");
    return NULL;
  }

  $spojeni->next_record();
  return $spojeni->Record;
}

function exam_word($IDdict, $IDexam, $type, $to) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict WHERE \"IDdict\" = '$IDdict'";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  $vysledek = "neco";
  
  switch ($type) {
    case ("to_cz"):
      $vysledek = ($spojeni->Record["czech"] == $to) ? NULL : $spojeni->Record["czech"]; 
    break;
    case("to_en"):
      $vysledek = ($spojeni->Record["english"] == $to) ? NULL : $spojeni->Record["english"]; 
    break;
    case("from_cz"):
      $vysledek = ($spojeni->Record["past"] == $to) ? NULL : $spojeni->Record["past"];
    break;
    case("from_en"):
      $vysledek = ($spojeni->Record["past"] == $to) ? NULL : $spojeni->Record["past"];
    break;
    default:
      echo "Sem by se to nemelo dostat.";
  }
  if ($vysledek == "neco")
    echo "Chyba";
  elseif ($vysledek == NULL)
    set_exam_status($IDexam, 1);
  else
    set_exam_status($IDexam, 0);
  
  return $vysledek;
}

function set_exam_status($IDexam, $status) {

  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE exam SET status = $status WHERE \"IDexam\" = '$IDexam'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při zkoušení.");
  }
}

function uklid($examing, $rating) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM exam WHERE examing = '$examing'
                             AND status = 1";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při zkoušení.");
  }  
  $dotaz = "UPDATE examing SET rating = $rating WHERE \"IDexaming\" = '$examing'";
  $spojeni->query($dotaz);
}

function delete_exam($IDexam) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM exam WHERE \"IDexam\" = '$IDexam'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Chyba při zkoušení.");
  }
}

function get_typ($identifikator) {
  switch ($identifikator) {
    case("from_cz"):
      return "Z Čestiny";
    break;
    case("to_cz"):
      return "Do Češtiny";
    break;
    case("from_en"):
      return "Z Angličtiny";
    break;
    case("to_en"):
      return "Do Angličtiny";
    break;
    default:
      return "Špatný formát";
  }
}

/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
 */
function get_row_of_table_examing($Record) {
  /*
  Reset($Record);
  echo "\n<br />Dalsi:\n<br />";
  while(Current($Record)) {
    echo "Record[".Key($Record)."] ";
    echo " = ".Current($Record)."<br />\n";
    Next($Record);
  }*/
  
  
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td>'.$Record["date"].'</td>';
  if ($Record["rating"] == -1)
    $navrat .= '<td>Nebylo dokončeno</td><td><a href="?nav_id=do_exam&examing='.$Record["IDexaming"].
               '&type='.$Record["type"].'">dokončit</a></td>';
  else
    $navrat .= '<td>'.$Record["rating"].'</td><td></td>';
  $navrat .= '<td>'.$Record["title"].'</td>';
  $navrat .= '<td>'.$Record["count"].'</td>';
  $navrat .= '<td>'.get_typ($Record["type"]).'</td>';
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function print_razeni($table = "user") {
  echo ("<form action\"\" method=\"post\"> ");
  
  
  echo "</form>";
}


function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td>Datum</td>
  <td>Úspěšnost [%]</td>
  <td>&nbsp;</td>
  <td>Zdroj</td>
  <td>Počet slovíček</td>
  <td>Směr</td>
</tr>";
}

function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
}


function print_table_of_examing($order = "IDexaming", $od = 0, $limit = 30) {
  global $ses_IDuser;
  require_once("./classes/db.php");
  print_razeni();
  $spojeni = new DB_Sql();
  $dotaz = "SELECT s.title, e.* FROM examing e";
  $dotaz .= " LEFT OUTER JOIN source s ON (e.source = s.\"IDsource\")";
  $dotaz .= " WHERE e.\"user\" = $ses_IDuser";
  $dotaz .= " ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis zkoušení</h3>";
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table_examing($spojeni->Record);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '';
  $navrat .= "</form></table>";
  echo $navrat;

  
}
 /*
 
 SELECT distinct ex.date,*
            FROM exam e, examing ex
            WHERE e.examing = ex."IDexaming"
              AND ex.source = 5
              AND ex.user = 2
              AND e.status = 0
 
 */
?>
