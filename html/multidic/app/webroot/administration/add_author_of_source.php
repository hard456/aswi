<?php

  require_once("./functions/dictionary.php");
  
function print_table($source_id) {
  $navrat = "<h3 class=\"nadpis2\">Přidej autora ke zdroji</h3>";
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= "<tr class=\"nadpis_sekce\">\n
                 <td>Vyber autora&nbsp;</td></tr><tr class=\"akt\"><td>\n";
  $navrat .= get_author_chooser();
  $navrat .= '</td></tr><tr class="nadpis_sekce"><td> <input type="submit" name="add" value="Přidej"></td></tr>';
  $navrat .= '<input type="hidden" name="source_id" value="'.$source_id.'">';
  $navrat .= '<input type="hidden" name="action" value="add_author_of_souce">';
  $navrat .= '</form></table>';
  echo $navrat;
}

function add_author_of_source($source_id, $author_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "INSERT INTO author_of_source (\"IDsource\", 
                            \"IDauthor\") 
                    VALUES ('$source_id', 
                            '$author_id')";  
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    echo_zpet_do_zdroju();
    return false;
  }
  print_hlasku ("Zaznam pridan...");
  echo_zpet_do_zdroju();
  return true;
  
}


if (!Empty($action) && $action == "add_author_of_souce") {
  
  add_author_of_source($source_id, $author_id);
}

  print_table($source_id);

?>
