<?php
 require_once("./functions/dictionary.php");


/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
 */
 
//NOVE2504
function get_row_of_table($Record, $od = 1, $do = 2) {
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td><input type="checkbox" name="smaz['.$Record[0].']" /></td>';
  $navrat .= '<td><a href="?nav_id=edit_field&field_id='.$Record[0].'">uprav</a></td>';
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td>";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function get_pocet_oboru() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDfield\" FROM field ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($l_order = "IDfield", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_oboru = get_pocet_oboru();
  $nav = "list_field";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit oborů od $od.  (Ve slovniku celkem $pocet_oboru)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"IDfield\">Identifikátor</option>
         <option value=\"field\">český název</option>
         <option value=\"en_field\">anglický název</option>
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
  if ($od+$limit < $pocet_oboru)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_oboru-$limit)."&limit=$limit\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}
//NOVE2504
function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td>Vybrané&nbsp;</td>
  <td></td>
  <td>český název</td>
  <td>anglický název</td>
</tr>";
}

function insert_field($field, $en_field) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "INSERT INTO field (field, en_field) 
                    VALUES ('$field', '$en_field')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Bohužel, obor '$field' - '$en_field' se nepodařilo přidat.");
    return false;
  }
  print_hlasku ("Obor '$field' - '$en_field' přidán...");
  return true;
}
//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td><input type="submit" name="delete" value="Smaž"></td>
              <td></td><td></td><td></td></tr>';
}

function print_table_of_field($order = "IDfield", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM field ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis oborů</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 1, 3);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_field">';
  $navrat .= "</form></table>";
  echo $navrat;
}

function possible_to_delete_field($field_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict WHERE field LIKE '$field_id'";
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

function delete_field($ID) {
  if (!possible_to_delete_field($ID)) {
    print_hlasku("Kontrola integrity hlásí: Nelze smazat");
    return false;
  }
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM field WHERE \"IDfield\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    //print_hlasku("Bohužel, obor '$field' se nepodařilo smazat.");
    return false;
  }
  //print_hlasku ("Obor '$field' smazán...");
  return true;
}

//NOVE 2504
function update_field($name, $en_field, $field_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE field SET field = '$name',
                            en_field = '$en_field'
                            WHERE \"IDfield\" = $field_id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Obor se nepodařilo upravit.");
    echo_zpet_do_oboru();
    return false;
  }
  print_hlasku("Obor změněn.");
  echo_zpet_do_oboru();
  return true;
}

//NOVE2504
function get_field($field_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM field WHERE \"IDfield\" LIKE '$field_id'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}
?>
