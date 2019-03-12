<?php
require_once("./functions/dictionary.php");

/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
 */
 
function get_row_of_table($Record, $od = 1, $do = 3) {
  $navrat .= "<tr class=\"akt\">\n     ";
  $navrat .= '<td>'.$Record[0].'</td>'.
             '<td><a href="?nav_id=edit_report&ratio='.$Record[0].'">edit</a></td>';
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td class=\"akt\">";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function get_pocet_reportu() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"czech\" FROM author ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

//NOVE2504
function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td>ratio&nbsp;</td>
  <td>&nbsp;</td>
  <td>česky</td>
  <td>anglicky</td>
</tr>";
}

function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td> </td>
  <td></td><td></td><td></td></tr>';
}

function print_table_of_reports($order = "ratio", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM report ORDER BY \"$order\" OFFSET $od LIMIT $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis zpráv</h3>";
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 1, 3);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '';
  $navrat .= "</form></table>";
  echo $navrat;
}

function update_report($czech, $english, $ratio) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE report SET czech = '".pg_escape_string($czech)."',
                            english = '".pg_escape_string($english)."'
                            WHERE \"ratio\" = $ratio";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Zprávu se nepodařilo upravit.");
    echo_zpet_do_zprav();
    return false;
  }
  print_hlasku("Zpráva změněna.");
  echo_zpet_do_zprav();
  return true;
}

function get_report($ratio) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM report WHERE \"ratio\" LIKE '$ratio'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}