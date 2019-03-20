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
  $navrat .= '<td><input type="checkbox" name="smaz['.$Record[0].']" /></td>'.
             '<td><a href="?nav_id=edit_author&author_id='.$Record[0].'">edit</a></td>';
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td class=\"akt\">";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "</tr> \n  ";
  return $navrat;
}


function get_pocet_autoru() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT \"IDauthor\" FROM author ";
  $spojeni->query($dotaz);
  return $spojeni->num_rows();
}

function get_razeni($l_order = "IDauthor", $l_od = 0, $l_limit = 30) {
  global $order;
  global $od;
  global $limit;
  
  $order = $l_order;
  $od    = $l_od;
  $limit = $l_limit;
  $pocet_autoru = get_pocet_autoru();
  $nav = "list_author";
  
  $navrat = "<p class=\"akt\"></p>";
  $navrat .= "<table>
      <tr class=\"nadpis_sekce\"><td><form action\"\" method=\"post\" name=\"razeni\"> 
      Zobrazeno $limit autorů od $od.  (Ve slovniku celkem $pocet_autoru)<br />
       Řadit podle 
       <select name=\"order\">	
         <option value=\"IDauthor\">Identifikátor</option>
         <option value=\"name\">jméno</option>
         <option value=\"surname\">příjmení</option>
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
  if ($od+$limit < $pocet_autoru)
    $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
              ($od+$limit)."&limit=$limit\">
              Dalších $limit </a> |   ";
  $navrat .="<a href=\"?nav_id=$nav&serad=true&order=$order&od=".
             ($pocet_autoru-$limit)."&limit=$limit\"> 
             Na konec </a></td>
  ";
  $navrat .= "</td></tr></table>";
  return $navrat;
}

//NOVE2504
function get_header_of_table() {
return "<tr class=\"nadpis_sekce\">
  <td>Vybrané&nbsp;</td>
  <td>&nbsp;</td>
  <td>jméno</td>
  <td>příjmení</td>
</tr>";
}
//NOVE2504
function get_foot_of_table() {
  return '<tr class="nadpis_sekce"><td><input type="submit" name="delete" value="Smaž"></td>
              <td></td><td></td><td>&nbsp; </td></tr>';
}

function print_table_of_author($order = "IDauthor", $od = 0, $limit = 30) {
  require_once("./classes/db.php");
  
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM author ORDER BY \"$order\" OFFSET $od LIMIT  $limit";
  $radky = $spojeni->query($dotaz);
  $navrat = "<h3 class=\"nadpis2\">Výpis autorů</h3>";
  $navrat .= get_razeni($order, $od, $limit);
  $navrat .= "<table><form action=\"\" method=\"post\">";
  $navrat .= get_header_of_table();
  while ($spojeni->next_record()) {
    $navrat .= get_row_of_table($spojeni->Record, 1, 3);
  }
  $navrat .= get_foot_of_table();
  $navrat .= '<input type="hidden" name="action" value="delete_author">';
  $navrat .= "</form></table>";
  echo $navrat;

  
}

function insert_author($name, $surname) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "INSERT INTO author (name, 
                                surname) 
                    VALUES ('$name', 
                            '$surname')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Bohužel, autora '$name $surname' se nepodařilo přidat.");
    return false;
  }
  print_hlasku ("Autor '$name $surname' přidán..");
  return true;
}

function possible_to_delete_author($author_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM author_of_source WHERE \"IDauthor\" = '$author_id'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return false;
  }
  //echo $spojeni->num_rows();
  if ($spojeni->num_rows() == 0)
    return true;
    
  return false;
}

function delete_author($ID) {
  if (!possible_to_delete_author($ID)) {
    print_hlasku("Kontrola integrity hlásí: Nelze smazat");
    return false;
  }
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM author WHERE \"IDauthor\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  $dotaz = "DELETE FROM author_of_source WHERE \"IDauthor\" = $ID";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }
  return true;
}

//NOVE 2504
function update_author($name, $surname, $author_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE author SET name = '$name',
                              surname = '$surname'
                            WHERE \"IDauthor\" = $author_id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Autora se nepodařilo upravit.");
  }
  print_hlasku("Autor změněn.");
}

//NOVE2504
function get_author($author_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM author WHERE \"IDauthor\" LIKE '$author_id'";
  $radky = $spojeni->query($dotaz);

  $spojeni->next_record();
  
  return $spojeni->Record;
}


?>
