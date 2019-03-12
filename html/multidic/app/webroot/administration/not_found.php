<?php
require_once("./functions/dictionary.php");

/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
 */
 
//NOVE2504 
function get_row_of_table_not_found($table, $Record, $od = 1, $do = 2) {
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td><input type="checkbox" name="smaz['.$Record["ID$table"].']" /></td>'.
             '<td><a href="?nav_id=add_word&language=1&delete_from_not_found=true&';
  switch($table) {
    case "not_found_en":
      $navrat .= "english";
    break;
    case "not_found_cz":
      $navrat .= "czech";
    break;
    case "not_found_ar":
      $navrat .= "past";
    break;
  }
  $navrat .= '='.$Record["not_found"].'&table_not_found='.$table.
             '&id_not_found='.$Record["ID$table"].'">doplň do slovníku</a></td>';

  $navrat .= "<td ";
  if ($table == "not_found_ar") $navrat .= "class =\"arabic\"";
  $navrat .= ">";
  $navrat .= $Record["not_found"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "<td>";
  $navrat .= $Record["count"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "<td>";
  $navrat .= $Record["date"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function get_pocet_not_found($table) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"ID$table\" FROM $table ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni_not_found($table, $l_order = "ID", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_not_found = get_pocet_not_found($table);
  $nav = "list_not_found";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit výrazů od $od.  (Celkem $pocet_not_found)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"ID\">Identifikátor</option>
         <option value=\"not_found\">výraz</option>
         <option value=\"count\">počet</option>
         <option value=\"date\">datum</option>
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
  if ($od+$limit < $pocet_not_found)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_not_found-$limit)."&limit=$limit\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}

//NOVE2504
function get_header_of_table_not_found() {
return "<tr class=\"nadpis_sekce\">
  <td>Vybrané&nbsp;</td>
  <td>&nbsp;</td>
  <td>výraz</td>
  <td>kolikrát</td>
  <td>datum</td>
</tr>";
}
//NOVE2504
function get_foot_of_table_not_found() {
  return '<tr class="nadpis_sekce"><td><input type="submit" name="delete" value="Smaž"></td>
              <td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td></tr>';
}

function print_table_of_not_found($table, $order = "ID", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  
  $spojeni = new DB_Sql();
  if ($order == "ID") $order = "ID$table";
  $dotaz = "SELECT * FROM $table 
            ORDER BY \"$order\" OFFSET $od LIMIT  $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis hledaných a nenalezených výrazů</h3>";
  $navrat .= get_razeni_not_found($table, $order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table_not_found();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table_not_found($table, $spojeni->Record, 1, 3);
  }
  $navrat .= get_foot_of_table_not_found();
  $navrat .= '<input type="hidden" name="action" value="delete_not_found">';
  $navrat .= "</form></table>";
  echo $navrat;

  
}


function delete_not_found($table, $ID) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM $table WHERE \"ID$table\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}



//NOVE2504
function get_not_found($not_found_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * 
              FROM not_found nf, language lan 
              WHERE nf.\"IDnot_found\" LIKE '$not_found_id' 
                AND nf.language = lan.\"IDlanguage\"";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}


?>
