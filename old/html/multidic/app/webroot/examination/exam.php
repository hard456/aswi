<?php
require_once("./functions/dictionary.php");

function get_pocet_slov_ve_zkouseni($examing) {
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

function insert_new_examing($user, $source, $lection, $count, $type, $learning) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();

  $dotaz = "INSERT INTO examing (\"user\", date, rating, source, count, type, lection, learning)
            VALUES ('$user', 'NOW', -1, '$source', '$count', '$type', '$lection', '$learning')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku(lang("Chyba při vytváření zkoušení."));
    return NULL;
  }
  $dotaz = "SELECT currval('examing_id_seq')";
  $spojeni->query($dotaz);

  if ($spojeni->Errno != 0) {
    print_hlasku(lang("Chyba při vytváření zkoušení."));
    return NULL;
  }
  $spojeni->next_record();
  return $spojeni->Record["currval"];
}

function words_to_repeat($source, $lection, $user) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT *
            FROM exam e, examing ex
            WHERE e.examing = ex.\"IDexaming\"
              AND ex.source = '$source'
              AND ex.\"user\" = '$user'
              AND ex.lection = '$lection'
              AND e.status = 0";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku(lang("Chyba při vytváření zkoušení."));
    return NULL;
  }
  return $spojeni;
}

function create_examing($user, $source, $lection, $count, $type, $learning) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //vytvori novou polozku v tabulce examing
  $new_examing = insert_new_examing($user, $source, $lection, $count, $type, $learning);

  //zjisti moznosti opetovneho zkouseni
  $spojeni_k_opakovani = words_to_repeat($source, $lection, $user);
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
      print_hlasku(lang("Chyba při vytváření zkoušení."));
      return NULL;
    }
    $spojeni_na_vkladani = new DB_Sql();

    while ($spojeni->next_record()) {
      //echo($spojeni->Record["czech"] . "<br />\n");
      $dotaz = "INSERT INTO exam (examing, status, dict)
                       VALUES ('$new_examing', NULL, ".$spojeni->Record["IDdict"].")";
      $spojeni_na_vkladani->query($dotaz);
      if ($spojeni_na_vkladani->Errno != 0) {
        print_hlasku(lang("Chyba při vytváření zkoušení."));
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
  $dotaz = "SELECT e.\"IDexam\", d.* FROM exam e, dict d
              WHERE e.examing = '$examing'
              	AND e.status is NULL
              	AND e.dict = d.\"IDdict\"
              ORDER BY random()
              LIMIT 1";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku(lang("Chyba při zkoušení."));
    return NULL;
  }
  if ($spojeni->num_rows() == 0) {
    return NULL;
  }

  $spojeni->next_record();
  return $spojeni->Record;
}

function exam_word($IDdict, $IDexam, $type, $to) {
  require_once("./classes/db.php");
  
  
  
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict
            WHERE \"IDdict\" = '$IDdict'";

  if(empty($to)) {
    $dotaz .= " AND 1 = 0 ";
  }
  switch ($type) {
    case ("to_cz"):
    	$word = mb_strtolower($to, "UTF-8");
        $word = get_token_regexp($word); 
      $dotaz .= " AND lower(czech) ~ ('$word')";
    break;
    case("to_en"):
    	$word = mb_strtolower($to, "UTF-8");
        $word = get_token_regexp($word);
      $dotaz .= " AND lower(english) = ('$word')";
    break;
    case("from_cz"):
    case("from_en"):
      $to = hebrew_add_vowel($to);
      $to = get_token_regexp($to);
      /*
      SELECT * FROM dict
            WHERE language = $language AND
                  ((present ~ ('$word')) OR
                   (past    ~ ('$word')) OR
                   (valence ~ ('$word')))
                   */
      $dotaz .= " AND ((present ~ ('$to')) OR
                   (past    ~ ('$to')) OR
                   (valence ~ ('$to')))";
    break;
    default:
      echo lang("Chyba");
  }
  //echo $dotaz;
  $spojeni->query($dotaz);
  if ($spojeni->num_rows() == 0) {
    //echo "nic";
    set_exam_status($IDexam, 0);
    require_once("./administration/word.php");
    return get_word($IDdict);
  }
  else {
    //echo "neco";
  	set_exam_status($IDexam, 1);
  	$spojeni->next_record();
    return NULL;

  }
}

function set_exam_status($IDexam, $status) {

  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE exam SET status = $status WHERE \"IDexam\" = '$IDexam'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku(lang("Chyba při zkoušení."));
  }
}

function uklid($examing, $rating) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM exam WHERE examing = '$examing'
                             AND status = 1";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku(lang("Chyba při zkoušení."));
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
    print_hlasku(lang("Chyba při zkoušení."));
  }
}

function get_typ($identifikator) {
  switch ($identifikator) {
    case("from_cz"):
      return lang("Z Čestiny");
    break;
    case("to_cz"):
      return lang("Do Češtiny");
    break;
    case("from_en"):
      return lang("Z Angličtiny");
    break;
    case("to_en"):
      return lang("Do Angličtiny");
    break;
    default:
      return lang("Špatný formát");
  }
}

/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
 */
function get_row_of_table_examing($learning, $Record) {
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td>'.$Record["date"].'</td>';
  $pomoc = ($learning == 'TRUE')? 'learning' : 'exam';
  if ($Record["rating"] == -1)
    $navrat .= '<td>'.lang("Nebylo dokončeno").' <br /><a href="?nav_id=do_'.$pomoc.'&examing='.$Record["IDexaming"].
               '&type='.$Record["type"].'">'.lang("dokončit").'</a></td>';
  else
    $navrat .= '<td>'.$Record["rating"].'</td>';
  $navrat .= '<td>'.$Record["title"].'</td><td>'.$Record["lection"].'</td>';
  $navrat .= '<td>'.$Record["count"].'</td>';
  $navrat .= '<td>'.get_typ($Record["type"]).'</td>';
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function get_pocet_zkouseni() {
  global $ses_IDuser;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDexaming\" FROM examing WHERE \"user\" = $ses_IDuser";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni_of_table_examing($l_order = "IDexaming", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;

  global $nav_id;

  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_zdroju = get_pocet_zkouseni();
  $nav = $nav_id;

  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> ".
      sprintf(lang("Zobrazeno %d zkoušení od %d.  (celkem %d)"), $limit, $od,$pocet_zdroju )."<br />
       ".lang("Řadit podle")."
       <select name=\"order\">
         <option value=\"IDexaming\">".lang("Identifikátor")."</option>
         <option value=\"date\">".lang("datum")."</option>
         <option value=\"rating\">".lang("úspěšnost")."</option>
         <option value=\"source\">".lang("zdroj")."</option>
         <option value=\"lection\">".lang("lekce")."</option>
         <option value=\"count\">".lang("počet")."</option>
       </select>
       ".lang("od:")." <input type=\"text\" name=\"od\" value=\"$od\" size=\"5\" />
       ".lang("počet:")." <input type=\"text\" name=\"limit\" value=\"$limit\" size=\"5\" />
       <input type=\"submit\" name=\"serad\" value=\"".lang("Zobraz")."\" /> </form>
       </td></tr>
       <tr class=\"nadpis_sekce\"><td align=\"center\">
        <a href=\"?nav_id=$nav&serad=true&order=$order&od=0&limit=$limit\">
            ".lang("Na začátek")." </a> |       ";
  if ($od-$limit >= 0)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit\">
              ".lang("Předchozích")." $limit </a> |       ";
  if ($od+$limit < $pocet_zdroju)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              ".lang("Dalších")." $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             (($pocet_zdroju-$limit < 0)? 0: $pocet_zdroju-$limit)."&limit=$limit\">
             ".lang("Na konec")." </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}

function get_header_of_table_examing() {
return "<tr class=\"nadpis_sekce\">
  <td>".lang("Datum")."</td>
  <td>".lang("Úspěšnost")." [%]</td>
  <td>".lang("Zdroj")."</td>
  <td>".lang("Lekce")."</td>
  <td>".lang("Počet slovíček")."</td>
  <td>".lang("Směr")."</td>
</tr>";
}

function get_foot_of_table_examing() {
  return '<tr class="nadpis_sekce"><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
}


function print_table_of_examing($learning, $order = "IDexaming", $od = 0, $limit = 30) {
  global $ses_IDuser;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT s.title, e.* FROM examing e";
  $dotaz .= " LEFT OUTER JOIN source s ON (e.source = s.\"IDsource\")";
  $dotaz .= " WHERE e.\"user\" = $ses_IDuser AND e.learning = $learning";
  $dotaz .= " ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">".lang("Výpis zkoušení")."</h3>";
  $navrat .= get_razeni_of_table_examing($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table_examing();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table_examing($learning, $spojeni->Record);
  }
  $navrat .= get_foot_of_table_examing();
  $navrat .= '';
  $navrat .= "</form></table>";
  echo $navrat;
}

function get_vyslednou_hlasku($rating) {
  global $LaId;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $ratio = floor($rating / 10);
  $ratio = ($ratio == 0) ? $ratio+1 : $ratio;
  //echo($ratio);
  $dotaz = "SELECT ";
  $dotaz .= (($LaId == "cz")? "czech" : "english");
  $dotaz .= " FROM report WHERE ratio = $ratio";
  //echo $dotaz;
  $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record[0];
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
