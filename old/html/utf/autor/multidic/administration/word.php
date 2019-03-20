<?php
require_once("./functions/dictionary.php");

//NOVE2504
function get_header_of_table() {
  return "<tr class=\"nadpis_sekce\">
  <td>vybrané&nbsp;</td>
  <td>&nbsp;</td>
  <td>česky</td>
  <td>anglicky</td>
  <td>druh slova</td>
  <td>slovesná třída</td>
  <td>přítomný čas</td>
  <td>minulý čas</td>
  <td>rekce</td>
  <td>kořen</td>
  <td>kontext</td>
</tr>";
}

function get_row_of_table($Record, $nonauthorized = false, $contrains_user_id = "all") {
  global $language;
  global $order;
  global $od;
  global $limit;

  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td><input type="checkbox" name="smaz['.$Record[0].']" /></td>';  
  $navrat .= '<td>';
  if ($contrains_user_id == "all") {
    $navrat .= '<a href="?nav_id=edit_word&word_id='.$Record[0].'&language='.$language;
    if ($nonauthorized) $navrat .= '&nonauthorized=true';
    $navrat .= '">uprav</a>';
  }
  if ($nonauthorized && $contrains_user_id == "all")
    $navrat .= '<br /><a href="?nav_id=authorize_word&word_id='.$Record[0].'&language='.
               $language.'&serad=true&order='.$order.'&od='.$od.'&limit='.$limit.'">autorizuj</a>';
  $navrat .= '</td>';  
  for($j=1;$j<5;$j++) {
    $navrat .= "<td>";
    $navrat .= $Record[$j];
    $navrat .= "&nbsp;</td>\n";
  }
  for($j=5;$j<7;$j++) {
    $navrat .= "<td class=\"arabic\">";
    $navrat .= $Record[$j];
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "<td class=\"arabic\">".$Record[9]."&nbsp;</td>\n";
  $navrat .= "<td>".$Record[11]."&nbsp;</td>\n";
  
    //echo $Record["context"];
  if ($contrains_user_id == "all") {
    if (Empty($Record["context"]))
      $navrat .= '<td><a href="?nav_id=add_context&word_id='.
                 $Record[0].'&language='.$language.'&source_id='.$Record["source"].'">přidej</a><br />'.
                 '<a href="?nav_id=link_context&word_id='.
                 $Record[0].'&language='.$language.'&source_id='.$Record["source"].'">připoj</a>'.
                 '</td>';
    else
      $navrat .= '<td><a href="?nav_id=delete_context&word_id='.
                 $Record[0].'&context_id='.$Record["context"].
                 '&language='.$language.'">odeber</a><br />'.
                 '<a href="?nav_id=edit_context&language='.$language.'&context_id='.$Record["context"].'">uprav</a>'.
                 '</td>';
  }
  else {
    $navrat .= '<td>';
  }
    
  $navrat .= "</tr> \n  ";
  return $navrat;
}

function get_razeni($l_order = "IDsource", $l_od = 0, $l_limit = 30, $nonauthorized = false, $contrains_user_id = "all") {
  global $language;
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;

  
  $nav = ($nonauthorized)? "list_nonauthorized_word" : "list_word";
  
  $pocet_slov = get_pocet_slov($nonauthorized, $contrains_user_id);
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit slovíček od slovíčka číslo $od.  (Ve slovniku celkem $pocet_slov)<br />
       Řadit podle 
       <select name=\"order\">
         <option value=\"IDdict\">Identifikátor</option>
         <option value=\"czech\">česky</option>
         <option value=\"english\">anglicky</option>
         <option value=\"word_category\">druh slova</option>
         <option value=\"verbal_class\">slovesná třída</option>
         <option value=\"present\">přítomný čas</option>
         <option value=\"past\">minulý čas</option>
         <option value=\"valence\">rekce</option>
         <option value=\"root\">kořen</option>
       </select>
       od: <input type=\"text\" name=\"od\" value=\"$od\" size=\"5\" />
       počet: <input type=\"text\" name=\"limit\" value=\"$limit\" size=\"5\" />   
       <input type=\"submit\" name=\"serad\" value=\"Zobraz\" /> </form>
       </td></tr>
       <tr class=\"nadpis_sekce\"><td align=\"center\">
        <a href=\"?nav_id=$nav&serad=true&order=$order&od=0&limit=$limit&language=$language&contrains_user_id=$contrains_user_id\">
            Na začátek </a> |       ";
  if ($od-$limit >= 0)           
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit&language=$language&contrains_user_id=$contrains_user_id\"> 
              Předchozích $limit </a> |       ";
  if ($od+$limit < $pocet_slov)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit&language=$language&contrains_user_id=$contrains_user_id\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_slov-$limit)."&limit=$limit&language=$language&contrains_user_id=$contrains_user_id\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}

function get_pocet_slov($nonauthorized, $contrains_user_id) {
  global $language;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDdict\" FROM dict";
  if ($nonauthorized)
    $dotaz .= " WHERE NOT autorized = 1";
  else
    $dotaz .= " WHERE autorized = 1";
  if ($language != "all")
    $dotaz .= " AND language LIKE '$language'";
  if ($contrains_user_id != "all")
    $dotaz .= "AND usr = $contrains_user_id";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();

}


//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce">
            <td><input type="submit" name="delete" value="Smaž"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>';
}

/**
 *  Funkce vypise z db vsechny slovnikove polozky
 *
 *  TODO: DODELAT VYPIS OSTATNICH DAT Z DB (DATA, USER, ATD...)
 *
 *
 */
function print_all_in_dict($language = "all", $nonauthorized = false, 
                          $contrains_user_id = "all", $order = "IDdict", 
                          $od = 0, $limit = 30) {
                          
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $navrat = "<h3 class=\"nadpis2\">Výpis ze studijního slovníku";
  if ($nonauthorized) 
    $navrat .= " - neautorizováno";
  if ($language == "all")
    $navrat .= " - vše</h3>";
  else if($language == 1)
    $navrat .= " - arabský";
  else
    $navrat .= " - hebrejský";
  $navrat .= get_razeni($order, $od, $limit, $nonauthorized, $contrains_user_id);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();

  $dotaz = "SELECT * FROM dict";
  
  if ($nonauthorized) $pomocna = " NOT autorized = 1";
  else $pomocna = " autorized = 1";
  
  if ($language != "all")
    $dotaz .= " WHERE language LIKE '$language' AND $pomocna";
  else
    $dotaz .= " WHERE $pomocna";
    
  if ($contrains_user_id != "all")
    $dotaz .= "AND usr = $contrains_user_id";

  $dotaz .= " ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);

  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, $nonauthorized, $contrains_user_id);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_word">';
  $navrat .= '<input type="hidden" name="language" value="'.$language.'">';
  $navrat .= "</form></table>";
  echo $navrat;
}

function authorize_word($ID) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE dict SET autorized = 1
                        WHERE \"IDdict\" = '$ID'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

function delete_word($ID) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM dict WHERE \"IDdict\" = '$ID'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

function update_word($czech,$english,$word_category,$verbal_class,
                     $present,$past,$valence,$root,$field,$word_id,$lection) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();

  $dotaz = "UPDATE dict SET czech = '".AddSlashes($czech)."', 
                            english = '".AddSlashes($english)."',
                            word_category = '".AddSlashes($word_category)."',
                            verbal_class = '".AddSlashes($verbal_class)."',
                            present = '".AddSlashes($present)."',
                            past = '".AddSlashes($past)."',
                            valence = '".AddSlashes($valence)."',
                            root = '".AddSlashes($root)."',
                            lection = '".AddSlashes($lection)."',
                            field = '".AddSlashes($field)."'
                            WHERE \"IDdict\" = '".AddSlashes($word_id)."'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Slovo se nepodařilo upravit.");
  }
  print_hlasku("Slovo změněno.");
}

function get_word($word_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict WHERE \"IDdict\" LIKE '$word_id'";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();

  if ($spojeni->Errno != 0) {
    print_hlasku("Slovo se nepodařilo načíst.");
  }

  return $spojeni->Record;
}



?>
