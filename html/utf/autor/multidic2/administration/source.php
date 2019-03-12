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
  $navrat .= '<td><a href="?nav_id=edit_source&source_id='.$Record[0].'">uprav</a></td>';  
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td>";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "<td>".get_authors_of_source($Record[0])."</td>\n";
  $navrat .= "<td><a href=\"?nav_id=add_author_of_source&source_id=".$Record[0]."\">Přidej autora</a></td>";
  $navrat .= "</tr> \n  ";
  return $navrat;
}

function get_authors_of_source($IDsource) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT a.name, a.surname, a.\"IDauthor\"
            FROM author_of_source f, author a 
            WHERE f.\"IDsource\" = '$IDsource'
              AND f.\"IDauthor\" = a.\"IDauthor\"";
  $spojeni->query($dotaz);
  $navrat = "";
  while ($spojeni->next_record()) {
    $navrat .= $spojeni->Record[0]."&nbsp;".$spojeni->Record[1]."&nbsp;";
    $navrat .= '<a href="?nav_id=delete_author_of_source&author_id='.
                $spojeni->Record[2].'&source_id='.$IDsource.'">odeber</a><br />';
  }
  return $navrat;
}

function get_pocet_zdroju() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDsource\" FROM source ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($l_order = "IDsource", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_zdroju = get_pocet_zdroju();
  $nav = "list_source";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit zdrojů od $od.  (Ve slovniku celkem $pocet_zdroju)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"IDsource\">Identifikátor</option>
         <option value=\"title\">titul</option>
         <option value=\"subtitle\">podtitul</option>
         <option value=\"place\">místo</option>
         <option value=\"publication\">publikace</option>
         <option value=\"publication_no\">publikační číslo</option>
         <option value=\"language\">jazyk</option>
         <option value=\"year\">rok</option>
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
  if ($od+$limit < $pocet_zdroju)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_zdroju-$limit)."&limit=$limit\"> 
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
  <td>titul</td>
  <td>podtitul</td>
  <td>místo</td>
  <td>publikace</td>
  <td>publikační číslo</td>
  <td>od strany</td>
  <td>do strany</td>
  <td>jazyk</td>
  <td>rok</td>
  <td>autori</td>
  <td></td>
</tr>";
}

function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td> <input type="submit" name="delete" value="Smaž"></td>
  <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
}

function print_table_of_source($order = "IDsource", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM source ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis zdrojů</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 1, 10);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_source">';
  $navrat .= "</form></table>";
  echo $navrat;

  
}


function insert_source($title,$subtitle,$place,$publication,$publication_no,$from_page,$to_page,$language,$year) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  $dotaz = "INSERT INTO source (\"title\", 
                                \"subtitle\", 
                                \"place\",
                                \"publication\",
                                \"publication_no\", 
                                \"from_page\",
                                \"to_page\",
                                \"language\",
                                \"year\") 
                       VALUES ('$title',
                               '$subtitle',
                               '$place',
                               '$publication',
                               '$publication_no',
                               '$from_page',
                               '$to_page',
                               '$language',
                              '$year')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Bohužel, zdroj '$title' se nepodařilo přidat.");
    return false;
  }
  print_hlasku ("Zdroj '$title' přidán..");
  return true;
}

function possible_to_delete_source($source_id) {
  $jedna = false;
  $dva = false;

  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM author_of_source WHERE \"IDsource\" = '$source_id'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return false;
  }
  if ($spojeni->num_rows() == 0)
    $jedna = true;
    
  $dotaz = "SELECT * FROM dict WHERE source = '$source_id'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return false;
  }
  if ($spojeni->num_rows() == 0)
    $dva = true;
    
  return $jedna && $dva;
}

function delete_source($ID) {
  if (!possible_to_delete_source($ID)) {
    print_hlasku("Kontrola integrity hlásí: Nelze smazat");
    return false;
  }
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM source WHERE \"IDsource\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  $dotaz = "DELETE FROM author_of_source WHERE \"IDsource\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

//NOVE 2504
function update_source($title, $subtitle, $place, $publication, $publication_no, 
                  $from_page, $to_page, $language, $year, $source_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE source SET title = '$title', 
                            subtitle = '$subtitle',
                            place = '$place',
                            publication = '$publication',
                            publication_no = '$publication_no',
                            from_page = '$from_page',
                            to_page = '$to_page',
                            language = '$language',
                            year = '$year'
                            WHERE \"IDsource\" = $source_id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Zdroj se nepodařilo upravit.");
    echo_zpet_do_zdroju();
    return false;
  }
  print_hlasku("Zdroj změněn.");
  echo_zpet_do_zdroju();
  return true;
}

//NOVE2504
function get_source($source_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM source WHERE \"IDsource\" LIKE '$source_id'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}



?>
