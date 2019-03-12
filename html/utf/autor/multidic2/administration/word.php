<?php
require_once("./functions/dictionary.php");

//NOVE2504
function get_header_of_table($print_version) {
  $navrat .= "\n  <tr class=\"nadpis_sekce\">";
  if(!$print_version) $navrat .= "<td>&nbsp;</td>";
  if(!$print_version) $navrat .= "<td>&nbsp;&nbsp;řadítko&nbsp;&nbsp;</td>";
  if(!$print_version) $navrat .= "<td>&nbsp;</td>";
  $navrat .= "<td>česky</td>";
  $navrat .= "<td>anglicky</td>";
  $navrat .= "<td>druh slova</td>";
  $navrat .= "<td>slovesná třída</td>";
  //$navrat .= "<td>přítomný&nbsp;čas / singular</td>";
  $navrat .= "<td>přítomný čas / plurál</td>";
  $navrat .= "<td>minulý čas / singulár</td>";
  $navrat .= "<td>budoucí&nbsp;čas</td>";
  $navrat .= "<td>infinitiv</td>";
  $navrat .= "<td>rekce</td>";
  $navrat .= "<td>kořen</td>";
  $navrat .= "<td>rod</td>";
    if(!$print_version) $navrat .= "<td>kontext</td>";
  if(!$print_version) $navrat .= "<td>zvuk</td>";
  $navrat .= "</tr>\n";
  return $navrat;
}

function get_row_of_table($print_version, $Record, $nonauthorized = false, $contrains_user_id = "all") {
  global $language;
  global $order;
  global $od;
  global $limit;
  global $contrains_source;
  global $contrains_lection;
  
  $nav_str = "language=$language&contrains_user_id=$contrains_user_id&contrains_source=$contrains_source&contrains_lection=$contrains_lection";
  if ($nonauthorized) $nav_str .= '&nonauthorized=true';
  
  $navrat .= "  <tr class=\"akt\">\n";
  if (!$print_version) {
    $navrat .= '    <td>
                  <a href="?nav_id=list_';
    if ($nonauthorized) $navrat .= 'nonauthorized_';
    $navrat .= 'word&action=delete_word&word_id='.$Record['IDdict'].'&'.$nav_str.'">smaž</a>
                    <!--input type="checkbox" name="smaz['.$Record['IDdict'].']" /--></td>'; 
    $navrat .= "\n".'<td><form action="" name="sort_form" method="post">     
          <a href="?nav_id=list_';
    if ($nonauthorized) $navrat .= 'nonauthorized_';
    $navrat .= 'word&action=sort_word&dir=up&word_id='.$Record['IDdict'].'&'.$nav_str.'">-</a>&nbsp;<input type="text"  class="small_button" size="2" name="sorting_no" value="'.$Record["sorting_no"].'" />&nbsp;<a href="?nav_id=list_';
    if ($nonauthorized) $navrat .= 'nonauthorized_';
    $navrat .= 'word&action=sort_word&dir=down&word_id='.$Record['IDdict'].'&'.$nav_str.'">+</a>
        <input type="hidden" name="word_id" value="'.$Record['IDdict'].'" />
        <input type="hidden" name="action" value="sort_direct" />
        <input type="hidden" name="contrains_source" value="'.$contrains_source.'" /> 
        <input type="hidden" name="contrains_lection" value="'.$contrains_lection.'" /> 
        <input type="hidden" name="language" value="'.$language.'" />
        <!--input type="submit" class="small_button" value="set" /-->
         </form>
      </td>';  
    
    $navrat .= "\n".'    <td>';
    //if ($contrains_user_id == "all") {
      $navrat .= '<a href="?nav_id=edit_word&word_id='.$Record['IDdict'].'&'.$nav_str;
      $navrat .= '">uprav</a>';
    //}
    if ($nonauthorized && $contrains_user_id == "all")
      $navrat .= '<br /><a href="?nav_id=authorize_word&word_id='.$Record['IDdict'].'&'.
                 $nav_str.'&serad=true&order='.$order.'&od='.$od.'&limit='.$limit.'">autorizuj</a>';
    $navrat .= '</td>';  
  }
  
    $navrat .= "    <td>";
    $navrat .= $Record['czech'];
    $navrat .= "&nbsp;</td>\n";
    $navrat .= "    <td>";
    $navrat .= $Record['english'];
    $navrat .= "&nbsp;</td>\n";
    $navrat .= "    <td>";
    $navrat .= $Record['word_category'];
    $navrat .= "&nbsp;</td>\n";
    $navrat .= "    <td>";
    $navrat .= $Record['verbal_class'];
    $navrat .= "&nbsp;</td>\n";

    $navrat .= "    <td class=\"arabic\">";
    $navrat .= $Record['present'];
    $navrat .= "&nbsp;</td>\n";
    $navrat .= "    <td class=\"arabic\">";
    $navrat .= $Record['past'];
    $navrat .= "&nbsp;</td>\n";

  $navrat .= "    <td class=\"arabic\">".$Record['future']."&nbsp;</td>\n";
  $navrat .= "    <td class=\"arabic\">".$Record['infinitive']."&nbsp;</td>\n";
  $navrat .= "    <td class=\"arabic\">".$Record['valence']."&nbsp;</td>\n";
  $navrat .= "    <td class=\"akkad\">".$Record["root"]."&nbsp;</td>\n";
  $navrat .= "    <td class=\"akkad\">".$Record["gender"]."&nbsp;</td>\n";
  
  if (! $print_version) {
    //echo $Record["context"];
    if ($contrains_user_id == "all") {
      if (Empty($Record["context"])) {
        $navrat .= '    <td><a href="?nav_id=add_context&word_id='.
                 $Record['IDdict'].'&'.$nav_str.'&source_id='.$Record["source"].'">přidej</a><br />'.
                 "\n    ".'<a href="?nav_id=link_context&word_id='.
                 $Record['IDdict'].'&'.$nav_str.'&source_id='.$Record["source"].'">připoj</a>'.
                 '</td>';
      }
      else {
        $navrat .= "    ".'<td><a href="?nav_id=delete_context&word_id='.
                 $Record['IDdict'].'&context_id='.$Record["context"].
                 '&'.$nav_str.'">odeber</a><br />'.
                 "\n      ".'<a href="?nav_id=edit_context&'.$nav_str.'&context_id='.$Record["context"].'">uprav</a>'.
                 '</td>';
      }
      if (Empty($Record["word_voice"])) {
        $navrat .= "\n    ".'<td> <a href="?nav_id=add_word_voice&word_id='.
                 $Record['IDdict'].'&'.$nav_str.'"> přidat </a></td>';
      }
      else {
        $navrat .= "\n    ".'<td> <a href="?nav_id=add_word_voice&word_id='.
                 $Record['IDdict'].'&'.$nav_str.'"> změnit </a>'."\n".'      <a href="'.CESTA_SLOV.$Record['IDdict'].PRIPONA.'"> přehrát </a></td>';
      }
    }
    else {
      $navrat .= '    <td></td><td></td>';
    }
  }
    
  $navrat .= "\n  </tr> \n";
  return $navrat;
}

function get_razeni($l_order = "sorting_no", 
                    $l_od = 0, 
                    $l_limit = 30, 
                    $nonauthorized = false, 
                    $contrains_user_id = "all",
                    $contrains_source = "all", 
                    $contrains_lection = "all") {
 
  global $language;
  
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;

  
  $nav = ($nonauthorized)? "list_nonauthorized_word" : "list_word";
  $nav_str = "language=$language&contrains_user_id=$contrains_user_id&contrains_source=$contrains_source&contrains_lection=$contrains_lection";
  
  $pocet_slov = get_pocet_slov($nonauthorized, $contrains_user_id, $contrains_source, $contrains_lection);
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "\n<table>
  <tr class=\"nadpis_sekce\">
    <td>
      <form action=\"\" method=\"post\" name=\"razeni\"> 
        Filtr: $language - $contrains_source - $contrains_lection";


/*$navrat .= get_language_chooser();
  $navrat .= "&nbsp;";
  $navrat .= get_source_chooser($language);
  $navrat .= "&nbsp;";
  $navrat .= get_lection_chooser($source);
  $navrat .= "&nbsp;";*/
  $navrat .=  " (Ve výběru celkem $pocet_slov)<br />
         Řadit podle 
         <select name=\"order\">
           <option value=\"sorting_no\">řadítko</option>
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
         <input type=\"hidden\" name=\"contrains_source\" value=\"$contrains_source\" /> 
         <input type=\"hidden\" name=\"contrains_lection\" value=\"$contrains_lection\" /> 
         <input type=\"submit\" name=\"serad\" value=\"Zobraz\" /> 
         </form>
    </td>
  </tr>
  <tr class=\"nadpis_sekce\"><td align=\"center\">
    <a href=\"?nav_id=$nav&serad=true&order=$order&od=0&limit=$limit&$nav_str\">
            Na začátek </a> |       ";
  if ($od-$limit >= 0)           
    $navrat .="\n    <a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit&$nav_str\"> 
              Předchozích $limit </a> |       ";
  if ($od+$limit < $pocet_slov)
    $navrat .="\n    <a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit&$nav_str\">
              Dalších $limit </a> |   ";
  $navrat .="\n    <a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_slov-$limit)."&limit=$limit&$nav_str\"> 
             Na konec </a>
  ";
  $navrat .= "</td></tr></table>\n";
  $odkaz = "list_word_print.php?nav_id=$nav&serad=true&order=$order&od=$od&limit=$limit&$nav_str";
    $navrat .= "<a href=\"$odkaz\" onclick=\"OpenPopUp('$odkaz', 800, 750); return false\"
                              target=\"_blank\">verze pro tisk</a>";
  return $navrat;
}

function get_pocet_slov($nonauthorized, $contrains_user_id, $contrains_source, $contrains_lection) {
  global $language;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDdict\" FROM dict ";
  if ($nonauthorized)
    $dotaz .= " WHERE NOT autorized = 1 ";
  else
    $dotaz .= " WHERE autorized = 1 ";
  if ($language != "all")
    $dotaz .= " AND language LIKE '$language'";
  if ($contrains_source != "all")
    $dotaz .= " AND source = '$contrains_source' ";
  if ($contrains_lection != "all")
    $dotaz .= " AND lection = '$contrains_lection' ";
  if ($contrains_user_id != "all")
    $dotaz .= " AND usr = '$contrains_user_id' ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();

}


//NOVE2504
function get_foot_of_table($print_version) {
  $navrat .= "<tr class=\"nadpis_sekce\">";
  if (!$print_version) $navrat .= "<td><!--input type=\"submit\" name=\"delete_submit\" value=\"Smaž\"--></td>";
  if (!$print_version) $navrat .= "<td></td>";
  if (!$print_version) $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  $navrat .= "<td></td>";
  if (!$print_version) $navrat .= "<td></td>";
  if (!$print_version) $navrat .= "<td></td>";
  $navrat .= "</tr>";
  return $navrat;
}

/**
 *  Funkce vypise z db vsechny slovnikove polozky
 *
 *  TODO: DODELAT VYPIS OSTATNICH DAT Z DB (DATA, USER, ATD...)
 *
 *
 */
function print_all_in_dict($print_version = false, $language = "all", $contrains_source = "all", $contrains_lection = "all",
                           $nonauthorized = false, $contrains_user_id = "all", $order = "sorting_no", 
                           $od = 0, $limit = 30 ) {
                          
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  if (!$print_version) {
    $navrat = "<h3 class=\"nadpis2\">Výpis ze studijního slovníku";
    if ($nonauthorized) 
      $navrat .= " - neautorizováno";
    if ($language == "all")
      $navrat .= " - vše</h3>";
    else if($language == 1)
      $navrat .= " - arabský</h3>";
    else if($language == 2)
       $navrat .= " - hebrejský</h3>";  
    else if($language == 3)
      $navrat .= " - akkadský</h3>";
  
    $navrat .= get_razeni($order, $od, $limit, $nonauthorized, $contrains_user_id, $contrains_source, $contrains_lection);
  }
  $navrat .= "<table><!--form name=\"delete_word\" action=\"\" method=\"post\"-->";
  $navrat .= get_header_of_table($print_version);

  $dotaz = "SELECT * FROM dict";
  
  if ($nonauthorized) $pomocna = " NOT autorized = 1 ";
  else $pomocna = " autorized = 1";
  
  if ($language != "all")
    $dotaz .= " WHERE language LIKE '$language' AND $pomocna ";
  else
    $dotaz .= " WHERE $pomocna ";
  
  if ($contrains_source != "all")
    $dotaz .= " AND source = '$contrains_source' ";
  if ($contrains_lection != "all")
    $dotaz .= " AND lection = '$contrains_lection' ";

  
  if ($contrains_user_id != "all")
    $dotaz .= " AND usr = $contrains_user_id ";  

  $dotaz .= " ORDER BY \"$order\" OFFSET $od LIMIT $limit ";
  $spojeni->query($dotaz);
  //print_r($dotaz);

  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($print_version, $spojeni->Record, $nonauthorized, $contrains_user_id);
  }
  $navrat .= get_foot_of_table($print_version);
  $navrat .= '<!--input type="hidden" name="action" value="delete_word">';
  $navrat .= '<input type="hidden" name="language" value="'.$language.'">';
  $navrat .= "</form--></table>";
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
                     $present,$past,$valence,$root,$field,$word_id,$lection, $future, $infinitive, $gender) {
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
                            gender = '".AddSlashes($gender)."',
                            lection = '".AddSlashes($lection)."',
                            field = '".AddSlashes($field)."',
                            future = '".AddSlashes($future)."',
                            infinitive = '".AddSlashes($infinitive)."'
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

function sort_word($word_id, $direction) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  $word = get_word($word_id);
  $hodnota = $word["sorting_no"];
  if ($direction == "up")  $hodnota--;
  else   $hodnota++;
  $dotaz = "UPDATE dict SET sorting_no = $hodnota WHERE \"IDdict\" LIKE '$word_id'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

function set_sorting_value($word_id, $sorting_no) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE dict SET sorting_no = $sorting_no WHERE \"IDdict\" LIKE '$word_id'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

?>
