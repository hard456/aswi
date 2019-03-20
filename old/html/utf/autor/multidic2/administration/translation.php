<?php
 require_once("./functions/dictionary.php");


function get_row_of_table($Record, $translation_lang_id) {
  $navrat .= "<tr class=\"akt\">\n     ";
  //$navrat .= '<td>&nbsp;</td>';
  $navrat .= '<td><a href="?nav_id=edit_translation&translation_lang_id='.$translation_lang_id.'&translation_id='.
               $Record["IDtranslation"].'">uprav</a></td>';
  $navrat .= "<td>";
  $navrat .= $Record["idf"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "<td>";
  $navrat .= $Record["translation"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function get_pocet_translation($translation_lang_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT 1 FROM translation WHERE language = '$translation_lang_id'";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($translation_lang_id, $l_order = "IDtranslation", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_translation = get_pocet_translation($translation_lang_id);
  $nav = "list_translation";
  $nav_tr_lang_id = "translation_lang_id=$translation_lang_id";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit položek od $od.  (Celkem $pocet_translation)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"IDtranslation\"";
                  if( $order == "IDtranslation" )  {
                     $navrat .= " selected=\"true\"";
                  }
           $navrat .= ">Identifikátor</option>
  
         <option value=\"idf\"";
                  if( $order == "idf" )  {
                     $navrat .= " selected=\"true\"";
                  }
           $navrat .= ">česky</option>
           
         <option value=\"translation\"";
                  if( $order == "translation" )  {
                     $navrat .= " selected=\"true\"";
                  }
           $navrat .= ">překlad</option>
       </select>
       od: <input type=\"text\" name=\"od\" value=\"$od\" size=\"5\" />
       počet: <input type=\"text\" name=\"limit\" value=\"$limit\" size=\"5\" />   
       <input type=\"hidden\" name=\"translation_lang_id\" value=\"$translation_lang_id\" />
       <input type=\"submit\" name=\"serad\" value=\"Zobraz\" /> </form>
       </td></tr>
       <tr class=\"nadpis_sekce\"><td align=\"center\">
        <a href=\"?nav_id=$nav&serad=true&order=$order&od=0&limit=$limit&$nav_tr_lang_id\">
            Na začátek </a> |       ";
  if ($od-$limit >= 0)           
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit&$nav_tr_lang_id\"> 
              Předchozích $limit </a> |       ";
  if ($od+$limit < $pocet_translation)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit&$nav_tr_lang_id\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_translation-$limit)."&limit=$limit&$nav_tr_lang_id\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}
//NOVE2504
function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td></td>
  <td>česky</td>
  <td>překlad</td>
</tr>";
}


//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td></td>
             <td></td><td></td></tr>';
}

function print_table_of_translation($translation_lang_id, $order = "IDtranslation", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM translation 
              WHERE language = '$translation_lang_id' 
              ORDER BY \"$order\" 
              OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis překladu prostředí jazyk - $translation_lang_id</h3>";
  $navrat .= get_razeni($translation_lang_id, $order, $od, $limit);
  $navrat .= "<table>";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, $translation_lang_id);
  }
  $navrat .= get_foot_of_table();
  $navrat .= "</table>";
  echo $navrat;
}


function update_translation($translation, $translation_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE translation SET translation = '$translation'
                            WHERE \"IDtranslation\" = $translation_id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Položku se nepodařilo upravit.");
    echo_zpet_do_translation();
    return false;
  }
  print_hlasku("Položka změněna.");
  echo_zpet_do_translation();
  return true;
}


function get_translation($translation_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM translation WHERE \"IDtranslation\" LIKE '$translation_id'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}
?>
