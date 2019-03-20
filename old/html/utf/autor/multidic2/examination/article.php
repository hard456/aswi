<?php
require_once("./functions/dictionary.php");

//NOVE2504
function get_header_of_table() {
  return "\n  <tr class=\"nadpis_sekce\">
    <td>jazyk&nbsp;</td>
    <td>zdroj&nbsp;</td>
    <td>lekce</td>
    <td>nadpis</td>
    <td>&nbsp;</td>
  </tr>
";
}

function get_row_of_table($Record) {
  global $language;
  global $order;
  global $od;
  global $limit;
  global $contrains_source;
  global $contrains_lection;
  
  $nav_str = "language=$language&contrains_source=$contrains_source&contrains_lection=$contrains_lection";
  
  $navrat .= "  <tr class=\"akt\">";
  $navrat .= "\n    <td>  ".$Record['language']." </td>"; 
  $navrat .= "\n    <td>  ".$Record['source']."</td>";
  $navrat .= "\n    <td>  ".$Record['lection']."</td>";
     
  $navrat .= "\n    <td class=\"arabic\">";
  $navrat .= $Record["title"];
  $navrat .= "&nbsp;</td>\n";
  $navrat .= "\n    <td><a href=\"?nav_id=detail_article&article_id=".$Record['IDarticle']."&".$nav_str."\">detail</a></td>";
  $navrat .= "\n  </tr> \n";
  return $navrat;
}


//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>';
}

function get_razeni($l_order = "IDarticle", 
                    $l_od = 0, 
                    $l_limit = 30, 
                    $contrains_source = "all", 
                    $contrains_lection = "all") {
 
  global $language;
  
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;

  

  $nav_str = "language=$language&contrains_source=$contrains_source&contrains_lection=$contrains_lection";
  
  $pocet_slov = get_pocet_clanku($contrains_source, $contrains_lection);
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "\n<table>
  <tr class=\"nadpis_sekce\">
    <td>
      <form action=\"\" method=\"post\" name=\"razeni\"> 
        Filtr: $language - $contrains_source - $contrains_lection";

  $navrat .=  " (Ve výběru celkem $pocet_slov)<br />
         Řadit podle 
         <select name=\"order\">
           <option value=\"IDarticle\">Identofikátor</option>
           <option value=\"title\">nadpis</option>
           <option value=\"body\">obsah</option>
           <option value=\"note\">poznámka</option>
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
    <a href=\"?nav_id=list_article&serad=true&order=$order&od=0&limit=$limit&$nav_str\">
            Na začátek </a> |       ";
  if ($od-$limit >= 0)           
    $navrat .="\n    <a href=\"?nav_id=list_article&serad=true&order=$order&od=".
              ($od-$limit)."&limit=$limit&$nav_str\"> 
              Předchozích $limit </a> |       ";
  if ($od+$limit < $pocet_slov)
    $navrat .="\n    <a href=\"?nav_id=list_article&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit&$nav_str\">
              Dalších $limit </a> |   ";
  $navrat .="\n    <a href=\"?nav_id=list_article&serad=true&order=$order&od=".
             ($pocet_slov-$limit)."&limit=$limit&$nav_str\"> 
             Na konec </a>
  ";
  $navrat .= "</td></tr></table>\n";
  return $navrat;
}

function get_pocet_clanku($contrains_source, $contrains_lection) {
  global $language;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDarticle\" FROM article";
  if ($language != "all")
    $dotaz .= " WHERE language LIKE '$language'";
  if ($contrains_source != "all")
    $dotaz .= " AND source = $contrains_source";
  if ($contrains_lection != "all")
    $dotaz .= " AND lection = $contrains_lection";

  $spojeni->query($dotaz);
  return $spojeni->num_rows();

}

function build_query_article($language, $contrains_source, $contrains_lection,$order, $od, $limit) {
	  $dotaz = "SELECT DISTINCT ON (ar.\"IDarticle\")
                         ar.\"IDarticle\"  as \"IDarticle\",
                         ar.title          as title,
                         lan.language      as language,
                         so.title          as source,
                         ar.lection        as lection
               
               
            FROM article ar, language lan, source so";
  
  if ($language != "all")
    $dotaz .= " WHERE ar.language LIKE '$language' ";
  else
    $dotaz .= " WHERE TRUE ";
    
  if ($contrains_source != "all")
    $dotaz .= "AND ar.source = $contrains_source";
  if ($contrains_lection != "all")
    $dotaz .= "AND ar.lection = $contrains_lection";
  
  $dotaz .= " AND ar.language = lan.\"IDlanguage\" 
              AND ar.source   = so.\"IDsource\" ";

  $dotaz .= " ORDER BY ar.\"IDarticle\", \"$order\" OFFSET $od LIMIT $limit";
  
  return $dotaz;
} // END function build_query_article


function get_short_table_of_article($language = "all", $contrains_source = "all", $contrains_lection = "all",
                          $order = "IDarticle", $od = 0, $limit = 30) {
	require_once("./classes/db.php");
  $spojeni = new DB_Sql();
	$dotaz = build_query_article($language, $contrains_source, $contrains_lection,$order, $od, $limit);
  $radky = $spojeni->query($dotaz);
  while ($spojeni->next_record()) {
    //print_r($spojeni->Record);
    $navrat .= "<a href=\"?language=".$_REQUEST['language']."&view_article=".$spojeni->Record['IDarticle']."\">".$spojeni->Record['title']."</a><br />";
  }
	return $navrat;
} // END function get_short_table_of_article


/**
 *  Funkce vypise z db vsechny slovnikove polozky
 *
 *
 */
function print_table_of_article($language = "all", $contrains_source = "all", $contrains_lection = "all",
                          $order = "IDarticle", $od = 0, $limit = 30) {
                          
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $navrat = "<h3 class=\"nadpis2\">Výpis článků";
  
  if ($language == "all")
    $navrat .= " - vše</h3>";
  else if($language == 1)
    $navrat .= " - arabské</h3>";
  else if($language == 2)
    $navrat .= " - hebrejské</h3>";
  else if($language == 3)
    $navrat .= " - akkadské</h3>";
    
  $navrat .= get_razeni($order, $od, $limit, $contrains_source, $contrains_lection);
  $navrat .= "<table>";
  $navrat .= get_header_of_table();

  $dotaz = build_query_article($language, $contrains_source, $contrains_lection,$order, $od, $limit);
    //echo "dotaz: ".$dotaz;
  $radky = $spojeni->query($dotaz);

  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record);
  }
  $navrat .= get_foot_of_table();
  $navrat .= "</table>";
  echo $navrat;
}

function get_article($id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT DISTINCT ON (ar.\"IDarticle\")
                         ar.\"IDarticle\"  as \"IDarticle\",
                         ar.title          as title,
                         ar.body           as body,
                         ar.note           as note,
                         ar.article_voice  as article_voice,
                         lan.language      as language,
                         so.title          as source,
                         ar.lection        as lection,
                         ar.source         as \"IDsource\"
             FROM article ar, language lan, source so
             WHERE \"IDarticle\" = '$id'
              AND ar.language = lan.\"IDlanguage\" 
              AND ar.source   = so.\"IDsource\" ";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();

  if ($spojeni->Errno != 0) {
    print_hlasku("Slovo se nepodařilo načíst.");
  }

  return $spojeni->Record;
}



?>
