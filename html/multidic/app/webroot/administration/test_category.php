<?php
 require_once("./functions/dictionary.php");



/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
 */ 
 
//NOVE2504
function get_row_of_table($Record, $od = 0, $do = 4) {
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td><input type="checkbox" name="smaz['.$Record[0].']" /></td>';
  $navrat .= '<td><a href="?nav_id=edit_test_category&test_category_id='.$Record[0].'">uprav</a></td>';
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
  $dotaz = "SELECT id FROM test_category ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($l_order = "id", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_oboru = get_pocet_oboru();
  $nav = "list_test_category";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit oborů od $od.  (Ve slovniku celkem $pocet_oboru)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"id\">Identifikátor</option>
         <option value=\"name\">název</option>
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
  <td>číslo</td>
  <td>rodič</td>
  <td>název</td>
</tr>";
}

function insert_test_category($name, $parent_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "INSERT INTO test_category (name, parent_id) 
                    VALUES ('$name', '$parent_id')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Bohužel, kategorii '$name' - '$parent_id' se nepodařilo přidat.");
    return false;
  }
  print_hlasku ("Kategorie '$name' - '$parent_id' přidán...");
  return true;
}
//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td><input type="submit" name="delete" value="Smaž"></td>
              <td></td><td></td><td></td><td></td></tr>';
}

function print_table_of_test_category($order = "id", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM test_category ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis kategoríí testů</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 0, 3);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_test_category">';
  $navrat .= "</form></table>";
  echo $navrat;
}

function possible_to_delete_test_category($test_category_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM test WHERE test_category_id LIKE '$test_category_id'";
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

function delete_test_category($ID) {
  if (!possible_to_delete_test_category($ID)) {
    print_hlasku("Kontrola integrity hlásí: Nelze smazat");
    return false;
  }
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM test_category WHERE \"id\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    //print_hlasku("Bohužel, obor '$field' se nepodařilo smazat.");
    return false;
  }
  //print_hlasku ("Obor '$field' smazán...");
  return true;
}

//NOVE 2504
function update_test_category($name, $parent_id, $id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE test_category SET name = '$name',
                            parent_id = '$parent_id'
                            WHERE id = $id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Kategorii se nepodařilo upravit.");
    echo_zpet_do_kategorii();
    return false;
  }
  print_hlasku("Kategorie změněna.");
  echo_zpet_do_kategorii();
  return true;
}

