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
  $navrat .= '<td><input type="checkbox" name="smaz['.$Record[0].']" /></td>'.
             '<td><a href="?nav_id=edit_user&user_id='.$Record[0].'">uprav</a></td>';  
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td>";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "</tr> \n  ";
  return $navrat;
}

function get_pocet_uzivatel() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDuser\" FROM \"user\" ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($l_order = "IDuser", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_uzivatel = get_pocet_uzivatel();
  $nav = "list_user";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit uživatel od $od.  (Ve slovniku celkem $pocet_uzivatel)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"IDuser\">Identifikátor</option>
         <option value=\"name\">jméno</option>
         <option value=\"surname\">příjmení</option>
         <option value=\"city\">město</option>
         <option value=\"email\">email</option>
         <option value=\"nationality\">národnosti</option>
         <option value=\"number_of_usage\">počtu přihlášení</option>
         <option value=\"date_created\">datum vytvoření</option>
         <option value=\"date_last_visit\">datum poslední návštěvy</option>
         <option value=\"privileges\">práva</option>
         <option value=\"nick\">nick</option>
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
  if ($od+$limit < $pocet_uzivatel)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_uzivatel-$limit)."&limit=$limit\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}

function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td>vybrané</td>
  <td>&nbsp</td>
  <td>jméno</td>
  <td>příjmení</td>
  <td>město</td>
  <td>email</td>
  <td>národnost</td>
  <td>počet přihlášení</td>
  <td>vytvořen</td>
  <td>naposledy přihlášen</td>
  <td>práva</td>
  <td>nick</td>
</tr>";
}

function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td><input type="submit" name="delete" value="Smaž"></td><td></td>
          <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
}

function print_table_of_user($order = "IDuser", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM \"user\" ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat .= "<h3 class=\"nadpis2\">Výpis uživatelů</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 1, 11);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_user">';
  $navrat .= "</form></table>";
  echo $navrat;

  
}

function nick_exists($nick) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM \"user\" WHERE nick LIKE '$nick'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return true;
  }
  //echo $nick." / ".$spojeni->num_rows();
  if ($spojeni->num_rows() == 0)
    return false;
    
  return true;
}

function insert_user($name, $surname, $city, $email, $nationality, $privileges, $nick, $password, $vypisovat = true){
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
    if ($vypisovat) print_hlasku("Bohužel, uživatele '$name $surname' se nepodařilo přidat.");
    return false;
  }
  if ($vypisovat) print_hlasku ("Uživatel '$name $surname' přidán..");
  return true;
}

function possible_to_delete_user($user_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict WHERE usr LIKE '$user_id'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return false;
  }
  //echo $spojeni->num_rows();
  if ($spojeni->num_rows() == 0)
    return true;
    
  return false;
}

function delete_user($ID) {
  if (!possible_to_delete_user($ID)) {
    print_hlasku("Kontrola integrity hlásí: Nelze smazat");
    return false;
  }
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM \"user\" WHERE \"IDuser\" = '$ID'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

function update_user($name, $surname, $city, $email, $nationality, $privileges, $nick, $user_id, $password) {
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

function get_user($user_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM \"user\" WHERE \"IDuser\" LIKE '$user_id'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}

function get_privileges_chooser($privileges = 1) {  
  $navrat = "<select name=\"privileges\" size=\"1\">\n";
  
  $navrat .= "  <option value=\"1\"";
  if ($privileges == 1) $navrat .= " selected=\"true\"";
  $navrat .= ">  Uživatel  </option>\n";
  
  $navrat .= "  <option value=\"2\"";
  if ($privileges == 2) $navrat .= " selected=\"true\"";
  $navrat .= ">  Uživatel (smí i zapisovat)  </option>\n";
  
  $navrat .= "  <option value=\"3\"";
  if ($privileges == 3) $navrat .= " selected=\"true\"";
  $navrat .= ">  Administrátor  </option>\n";
  
  $navrat .= '</select>';
  return $navrat;
}
?>
