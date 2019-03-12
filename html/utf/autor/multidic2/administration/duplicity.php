<?php
require_once("./functions/dictionary.php");

//NOVE2504
function get_header_of_table() {
  return "\n  <tr class=\"nadpis_sekce\">
    <td>zdroj</td>
    <td>lekce</td>
    <td>minulý čas&nbsp;/&nbsp;plural</td>
    <td>česky</td>
    <td>anglicky</td>
    <td>kontext</td>
    <td>zvuk</td>
  </tr>
";
}

function get_row_of_table($Record, $nonauthorized = false, $contrains_user_id = "all") {
  global $language;
  global $order;
  global $od;
  global $limit;
  
  $nav_str = "";

  
  $navrat .= "  <tr class=\"akt\">\n";
  $navrat .= '    <td>'.$Record["source"].'</td>'; 
  $navrat .= "\n".'   <td>'.$Record["lection"].'
    </td>';  
  $navrat .= "\n".'    <td class="arabic">'.$Record["past"].'</td>';  
  
  $navrat .= "    <td>";
  $navrat .= $Record["czech"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "    <td>";
  $navrat .= $Record["english"];
  $navrat .= "&nbsp;</td>\n";
  
      if (Empty($Record["context"])) {
      $navrat .= '    <td>není</td>';
    }
    else {
      $navrat .= "    ".'<td>je</td>';
    }
    if (Empty($Record["word_voice"])) {
      $navrat .= "\n    ".'<td>není</td>';
    }
    else {
      $navrat .= "\n    ".'<td>je</td>';
    }
    
  $navrat .= "\n  </tr> \n";
  return $navrat;
}

function get_razeni($l_order = "sorting_no", 
                    $l_od = 0, 
                    $l_limit = 14, 
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

  $nav_str = "";
  
  $pocet_duplicit = get_pocet_duplicit();
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "\n<table>
  <tr class=\"nadpis_sekce\">
    <td>
      <form action=\"\" method=\"post\" name=\"razeni\">" ;

  $navrat .=  " (duplicitních položek celkem $pocet_duplicit)<br />
         Řadit podle 
         <select name=\"order\">

           <option value=\"IDdict\">Identifikátor</option>
           <option value=\"czech\">česky</option>
           <option value=\"english\">anglicky</option>
           <option value=\"past\">minulý čas</option>

         </select>
         od: <input type=\"text\" name=\"od\" value=\"$od\" size=\"5\" />
         počet: <input type=\"text\" name=\"limit\" value=\"$limit\" size=\"5\" />  
         <input type=\"submit\" name=\"serad\" value=\"Zobraz\" /> 
         </form>
    </td>
  </tr>
  <tr class=\"nadpis_sekce\"><td align=\"center\">
    <a href=\"?nav_id=list_duplicity&serad=true&order=$order&od=0&limit=$limit&$nav_str\">
            Na začátek </a> |       ";
  if ($od-$limit >= 0)           
    $navrat .="\n    <a href=\"?nav_id=list_duplicity&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit&$nav_str\"> 
              Předchozích $limit </a> |       ";
  if ($od+$limit < $pocet_duplicit)
    $navrat .="\n    <a href=\"?nav_id=list_duplicity&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit&$nav_str\">
              Dalších $limit </a> |   ";
  $navrat .="\n    <a href=\"?nav_id=list_duplicity&serad=true&order=$order&od=".
             ($pocet_duplicit-$limit)."&limit=$limit&$nav_str\"> 
             Na konec </a>
  ";
  $navrat .= "</td></tr></table>\n";
  return $navrat;
}

function get_pocet_duplicit() {
  global $language;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT 2
  FROM dict d 
  WHERE EXISTS (
     SELECT 1 
       FROM dict e 
       WHERE NOT e.\"IDdict\" = d.\"IDdict\"  
             AND e.past LIKE d.past
  )
  ORDER BY d.past";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();

}


//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce">
            <td><!--input type="submit" name="delete_submit" value="Smaž"--></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>';
}






function print_table_of_duplicity($order = "IDdict", $od = 0, $limit = 14) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "
  SELECT           d.past       as past, 
                   d.source     as source,
                   d.lection    as lection,
                   d.czech      as czech,
                   d.english    as english,
                   d.context    as context,
                   d.word_voice as word_voice
  FROM dict d
  WHERE EXISTS (
     SELECT 1 
       FROM dict e 
       WHERE NOT e.\"IDdict\" = d.\"IDdict\"  
             AND e.past LIKE d.past
  )
  ORDER BY d.past DESC, d.\"$order\"
  LIMIT $limit
  OFFSET $od";
  $radky = $spojeni->query($dotaz);
  $navrat .= "<h3 class=\"nadpis2\">Výpis slov, které se vyskytují duplicitně</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table>";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record);
  }
  $navrat .= get_foot_of_table();
  $navrat .= "</table>";
  echo $navrat;

  
}
?>
