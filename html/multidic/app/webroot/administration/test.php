<?php
require_once("./functions/dictionary.php");
//require_once("./administration/test_category.php");

function authorize_test($ID) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE test SET autorized = true
                        WHERE \"IDtest\" = '$ID'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

//NOVE2504
function get_header_of_table() {
  return "\n  <tr class=\"nadpis_sekce\">
    <td>&nbsp;</td>
    <td>lekce</td>
    <td>nadpis</td>
    <td>instrukce</td>
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

  $navrat .= "  <tr>\n";
  $navrat .= '    <td>
                <a href="?nav_id=list_test&action=delete_test&test_id='.$Record[0].'&'.$nav_str.'">smaž</a>
                  <!--input type="checkbox" name="smaz['.$Record[0].']" /-->';

  $navrat .= "\n".' <br /> ';

  $navrat .= '<a href="?nav_id=edit_test&test_id='.$Record[0].'&'.$nav_str;
  $navrat .= '">uprav</a>';

  $navrat .= "\n".' <br /> ';

  $navrat .= '<a href="?nav_id=authorize_test&test_id='.$Record[0].'&'.$nav_str;
  $navrat .= '">autorizuj</a>';
  
   $navrat .= "\n".' <br /> ';

  $navrat .= '<a href="?nav_id=detail_test&test_id='.$Record[0].'&'.$nav_str;
  $navrat .= '">detail</a></td>';


 /* $navrat .= "    <td class=\"arabic\" style=\"font-size: 180%\">";
  $navrat .= $Record["title"];
  $navrat .= "&nbsp;</td>\n";*/
  
  $navrat .= "    <td>";
  $navrat .= $Record["lection"];
  $navrat .= "&nbsp;</td>\n";

  $navrat .= "    <td class=\"arabic\" style=\"font-size: 180%\" >";
  $navrat .= "".$Record["title"]."";
  //$navrat .= nl2br($Record["body"]);
  $navrat .= "&nbsp;</td>\n";

  $navrat .= "    <td>";
  $navrat .= $Record["note"];
  $navrat .= "&nbsp;</td>\n";

  

/*
  if (Empty($Record["test_voice"])) {
    $navrat .= "\n    ".'<td> <a href="?nav_id=add_test_voice&test_id='.
               $Record[0].'&'.$nav_str.'"> přidat </a></td>';
  }
  else {
    $navrat .= "\n    ".'<td> <a href="?nav_id=add_test_voice&test_id='.
               $Record[0].'&'.$nav_str.'"> změnit </a>'."<br />\n".'      <a href="'.CESTA_CLANKU.$Record[0].PRIPONA.'"> přehrát </a></td>';
  }
*/
  $navrat .= "\n  </tr> \n";
  return $navrat;
}

function get_razeni($l_order = "IDtest",
                    $l_od = 0,
                    $l_limit = 30,
                    $contrains_source = "all",
                    $contrains_lection = "all",
                    $nonauthorized = false) {

  global $language;

  global $order;
  global $od;
  global $limit;

  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;


  $nav = ($nonauthorized)? "list_nonauthorized_test" : "list_test";
  $nav_str = "language=$language&contrains_source=$contrains_source&contrains_lection=$contrains_lection";

  $pocet_slov = get_pocet_test($contrains_source, $contrains_lection, $nonauthorized);
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "\n<table>
  <tr class=\"nadpis_sekce\">
    <td>
      <form action=\"\" method=\"post\" name=\"razeni\">
        Filtr: $language - $contrains_source - $contrains_lection";

  $navrat .=  " (Ve výběru celkem $pocet_slov)<br />
         Řadit podle
         <select name=\"order\">
           <option value=\"IDtest\">Identifikátor</option>
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
  //$odkaz = "list_test_print.php?nav_id=$nav&serad=true&order=$order&od=$od&limit=$limit&$nav_str";
    //$navrat .= "<a href=\"$odkaz\" onclick=\"OpenPopUp('$odkaz', 800, 750); return false\"
    //                          target=\"_blank\">verze pro tisk</a>";
  return $navrat;
}

function get_pocet_test($contrains_source, $contrains_lection, $nonauthorized) {
  global $language;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //$spojeni->debug = true;
  $dotaz = "SELECT \"IDtest\" FROM test";
   if ($nonauthorized == true) {
    $dotaz .= " WHERE autorized = false";
	}
	else {
		$dotaz .= " WHERE autorized = true";
	}
  if ($language != "all")
    $dotaz .= " AND language = '$language'";
  if ($contrains_source != "all")
    $dotaz .= " AND source = $contrains_source";
  if ($contrains_lection != "all")
    $dotaz .= " AND lection = '$contrains_lection'";

	//pr($dotaz);
  $spojeni->query($dotaz);
  return $spojeni->num_rows();

}


//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce">

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
function print_table_of_test($language = "all", $contrains_source = "all", $contrains_lection = "all",
							$nonauthorized = false,
                          $order = "IDtest", $od = 0, $limit = 30) {

  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $navrat = "<h3 class=\"nadpis2\">Výpis testů";

 if ($nonauthorized)
      $navrat .= " - neautorizováno";
  if ($language == "all")
    $navrat .= " - vše</h3>";
  else if($language == 1)
    $navrat .= " - arabské</h3>";
  else if($language == 2)
    $navrat .= " - hebrejské</h3>";
  else if($language == 3)
    $navrat .= " - akkadské</h3>";

  $navrat .= get_razeni($order, $od, $limit, $contrains_source, $contrains_lection, $nonauthorized);
  $navrat .= "<table>";
  $navrat .= get_header_of_table();

  $dotaz = "SELECT * FROM test ";

	if ($nonauthorized) $pomocna = " autorized = false ";
  else $pomocna = " autorized = true";

  if ($language != "all")
    $dotaz .= " WHERE language = '$language' AND $pomocna ";
  else
    $dotaz .= " WHERE $pomocna ";

  if ($contrains_source != "all")
    $dotaz .= "AND source = $contrains_source";
  if ($contrains_lection != "all")
    $dotaz .= "AND lection = '$contrains_lection'";


  $dotaz .= " ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  
  //pr($dotaz);

  $radky = $spojeni->query($dotaz);

  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record);
  }
  $navrat .= get_foot_of_table();
  $navrat .= "</table>";
  echo $navrat;
}

function get_test($id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM test WHERE \"IDtest\" = '$id'";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();

  if ($spojeni->Errno != 0) {
    print_hlasku("Test se nepodařilo načíst.");
  }

  return $spojeni->Record;
}

function delete_test($ID) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM test WHERE \"IDtest\" = '$ID'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

function update_test($id, $title, $body, $note, $lection, $test_category) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();

  $dotaz = "UPDATE test SET title = '".AddSlashes($title)."',
                            body = '".AddSlashes($body)."',
                            note = '".AddSlashes($note)."',
                            lection = '".AddSlashes($lection)."',
                            test_category_id = '".AddSlashes($test_category)."'
                            WHERE \"IDtest\" = '".AddSlashes($id)."'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Test se nepodařilo upravit.");
  }
  print_hlasku("Test změněn.");
}




function insert_test($language,$source,$lection,$title,$body,$note,$user,$test_category){
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  //$NOW = Date("YmdHis");

  $dotaz = "INSERT INTO test (\"language\",
                              \"source\",
                              \"lection\",
                              \"inserted_by\",
                              \"title\",
                              \"body\",
                              \"note\",
                              \"test_category_id\")
                    VALUES ('". AddSlashes($language)."',
                            '". AddSlashes($source)."',
                            '". AddSlashes($lection)."',
                            '". AddSlashes($user)."',
                            '". AddSlashes($title)."',
                            '". AddSlashes($body)."',
                            '". AddSlashes($note)."',
                            '". AddSlashes($test_category)."')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

?>
