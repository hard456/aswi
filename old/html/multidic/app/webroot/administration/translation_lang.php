<?php
require_once("./functions/dictionary.php");

/**
 *  Pomocna funkce, vraci do tabulky zformatovany zaznam
 *
 *  @param $Record polozka tabulky nactena z db
 *  @return do tabulky zformatovany zaznam
 */
function get_row_of_table($Record, $od = 1, $do = 2) {
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td>';
  if ($Record["code"] != "cz" && $Record["code"] != "en") {
    $navrat .= '<input type="checkbox" name="smaz['.$Record[0].']" /></td>'.
               '<td><a href="?nav_id=edit_translation_lang&translation_lang_id='.$Record[0].'">uprav</a>';
  }
  else {
    $navrat .= '</td><td>';
  }
  $navrat .= '</td>';  
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td>";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "</tr> \n  ";
  return $navrat;
}

function get_pocet_jazyku() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDtranslation_lang\" FROM \"translation_lang\" ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($l_order = "IDtranslation_lang", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_jazyku = get_pocet_jazyku();
  $nav = "list_trans_lang";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit jazyků od $od.  (Celkem $pocet_jazyku)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"IDtranslation_lang\">Identifikátor</option>
         <option value=\"code\">kód</option>
         <option value=\"name\">název</option>
         <option value=\"visible\">viditelnosti</option>
       </select>
       od: <input type=\"text\" name=\"od\" value=\"$od\" size=\"5\" />
       počet: <input type=\"text\" name=\"limit\" value=\"$limit\" size=\"5\" />   
       <input type=\"submit\" name=\"serad\" value=\"Zobraz\" /> </form>
       </td></tr>
       <tr class=\"nadpis_sekce\"><td align=\"center\">
        <a href=\"?nav_id=$nav&serad=true&order=$order&od=0&limit=$limit\">
            Na začátek </a> |       ";
  if ($od-$limit >= 0)           
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit\"> 
              Předchozích $limit </a> |       ";
  if ($od+$limit < $pocet_jazyku)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_jazyku-$limit)."&limit=$limit\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}

function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td>vybrané</td>
  <td>&nbsp</td>
  <td>kód</td>
  <td>název</td>
  <td>viditelný</td>
</tr>";
}

function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td><input type="submit" name="delete" value="Smaž"></td><td></td>
          <td></td><td></td><td></td></tr>';
}

function print_table_of_translation_lang($order = "IDtranslation_lang", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM \"translation_lang\" ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat .= "<h3 class=\"nadpis2\">Výpis jazyků</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 1, 4);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_translation_lang">';
  $navrat .= "</form></table>";
  echo $navrat;

  
}


function insert_translation_lang($name, $surname, $city, $email, $nationality, $privileges, $nick, $password, $vypisovat = true){
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //$NOW = Date("YmdHis");
  
  $dotaz = "INSERT INTO \"user\" (\"name\", 
                              \"surname\",
                              \"city\",
                              \"email\",
                              \"nationality\",
                              \"number_of_usage\",
                              \"date_created\",
                              \"privileges\",
                              \"nick\",
                              \"pass\")
                    VALUES ('$name', 
                            '$surname',
                            '$city',
                            '$email',
                            '$nationality',
                            '0',
                            'NOW',
                            '$privileges',
                            '$nick',
                            '$password')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    if (vypisovat) print_hlasku("Bohužel, uživatele '$name $surname' se nepodařilo přidat.");
    return false;
  }
  if (vypisovat) print_hlasku ("Uživatel '$name $surname' přidán..");
  return true;
}


function delete_user($ID) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM \"translation_lang\" WHERE \"IDtranslation_lang\" = '$ID'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

function update_translation_lang($name, $surname, $city, $email, $nationality, $privileges, $nick, $user_id, $password) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE \"user\" SET \"name\" = '$name', 
                            \"surname\" = '$surname',
                            \"city\" = '$city',
                            \"email\" = '$email',
                            \"nationality\" = '$nationality',
                            \"privileges\" = '$privileges',
                            \"nick\" = '$nick'";
  if (!Empty($password)) {
    $dotaz .= ", \"pass\" = '$password'";
  }
  $dotaz .= " WHERE \"IDuser\" = '$user_id'";
  
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Uživatel se nepodařilo upravit.");
  }
  print_hlasku("Uživatel změněn.");
  echo_zpet_do_uzivatel();
}

function get_translation_lang($id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM \"translation_lang\" WHERE \"IDuser\" LIKE '$id'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}


?>

