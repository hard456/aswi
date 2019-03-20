<?php



function print_context_chooser($source_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM context WHERE source LIKE '$source_id'";
  $radky = $spojeni->query($dotaz);
  if ($spojeni->num_rows() == 0) {
    echo "Bohužel u tohoto zdroje zatím nejsou žádné kontexty, 
               můžete je přidat ze slovníku, zvolením položky kontext->přidej";
    return false;
  }
  else {
    $navrat = "<select name=\"context\" size=\"6\">";
    while ($spojeni->next_record()) {
      $navrat .= "  <option value=\"".$spojeni->Record["IDcontext"]."\">  ".
                  $spojeni->Record[cz_context]." - ".
                  $spojeni->Record[en_context]." - ".
                  $spojeni->Record[orig_context].
                  "  </option>\n";
    }
    $navrat .= '</select>';
  }
  echo $navrat;  
  return true;
}

function get_field_chooser() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM field";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"field\" size=\"1\">";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record[0]."\">  ".$spojeni->Record[1]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
}

function get_author_chooser() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM author";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"author_id\" size=\"1\">\n";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record[0]."\">  ".
                         $spojeni->Record[1]." ".$spojeni->Record[2]."  </option>\n";
  }
  $navrat .= "</select>\n";
  return $navrat;
}


function insert_language_chooser() {
  echo get_language_chooser();
}

function get_language_chooser($size = 1) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM \"language\"";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"language\" size=\"$size\">";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record[0]."\">  ".$spojeni->Record[1]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
}

function get_source_chooser($language) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM source";
  if (!Empty($language))
   $dotaz .= " WHERE \"language\" = '$language'";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"source\" size=\"1\">";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record[0]."\">  ".$spojeni->Record[1]." - ".$spojeni->Record[2]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
}

function get_lection_chooser($source, $size = 1) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT lection FROM dict WHERE source = '$source' GROUP BY lection ";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"lection\" size=\"$size\">";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record["lection"]."\"> lekce ".$spojeni->Record["lection"]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
}

function get_count_chooser($source, $lection, $size = 1) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT czech FROM dict WHERE source = '$source' AND lection = '$lection' ";
  $radky = $spojeni->query($dotaz);
  $max = $spojeni->num_rows();
  $navrat = "V této lekci je ".$max." slovíček <br />\n";
  $navrat .= "<select name=\"count\" size=\"$size\">";
  for ($count = 10; $count < $max; $count += 10) {
    $navrat .= "  <option value=\"".$count."\">  ".$count."  </option>";
  }
  $navrat .= "  <option value=\"".$spojeni->num_rows()."\">  ".$max."  </option>";
  $navrat .= '</select>';
  return $navrat;
}


function print_hlasku($text) {
  echo "<h4 class=\"nadpis3\">".$text."</h3> \n";
}

function is_in_dictionary_past($past, $source) {
  if (Empty($past) || (Trim($past) == "")) return false;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT past FROM dict WHERE past LIKE '$past' AND source = $source";  
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return false;
  }
  //echo $spojeni->num_rows();
  if ($spojeni->num_rows() > 0)
    return true;
    
  return false;
}

/**
 *  Funkce prida do databaze slovicko.
 *  
 *
 *  TODO: UPRAVIT OSTATNI DATA VKLADANA DO DB (DATA, USER, ATD...)
 *        DODELAT UPLOAD ZVUKOVEHO SOUBORU
 *  @return true   kdyz se to povede
 *  @return false  naopak
 */
function insert_word($czech,$english,$word_category,$verbal_class,$present,$past,$valence,$root,
                     $field,$language,$user,$source,$lection) {
  
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  //pokud uz je ve slovniku nebude se znovu vkladat
  if (is_in_dictionary_past($past, $source)) {
    print_hlasku ("Slovíčko '$past - $czech - $english' nebylo přidáno, již je ve slovníku...");
    return false;
  }
  
  //$NOW = Date("YmdHis");
   $dotaz = "INSERT INTO dict (czech, 
                            english, 
                            word_category, 
                            verbal_class, 
                            present, 
                            past, 
                            valence, 
                            root, 
                            field, 
                            source, 
                            lection, 
                            language, 
                            usr, 
                            date_created, 
                            context,
                            autorized) 
                    VALUES ('$czech', 
                            '$english', 
                            '$word_category', 
                            '$verbal_class', 
                            '$present', 
                            '$past', 
                            '$valence', 
                            '$root', 
                            '$field', 
                            '$source', 
                            '$lection', 
                            '$language', 
                            '$user', 
                            'NOW', 
                            '0',
                            '0')";  
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku($spojeni->$Error);
    return false;
  }
  return true;
}

/**
 *  Pomocna funkce, vraci do tabulky zformatovane slovo
 *
 *  @param $Record polozka slovniku nactena z db
 *  @return do tabulky zformatovany zaznam
*/ 
function get_row($Record, $od = 0, $do = 9) {
  $navrat .= "<tr>\n     ";
  for($j=$od;$j<$do;$j++) {
    $navrat .= "<td class=\"akt\">";
    $navrat .= "$Record[$j]";
    $navrat .= "&nbsp;</td>\n";
  }
  $navrat .= "</tr> \n  ";
  return $navrat;
}



/**
 *  Funkce vytiskne preklad slova z parametru
 *
 *  @param $word slovo urcene k prekladu
 *  @param $language jazyk
 *  
 */
function print_translation($word, $language) {
  $text = "<center>\n  <table>\n    <tbody>\n      ";
  
  if (empty($word)) {
    $text .= "Musíte zadat nějaké slovo.";
  }
  else {
    $navrat = "";
    switch ($language) {
      case("en"):
        $navrat = translate_from_en($word);
      break;
      case("ar"):
        $navrat = translate_from_ar($word);
      break;
      case("cz"):
        $navrat = translate_from_cz($word);
    }
    if (empty($navrat)) $text .= "Slovo nebylo nalezeno";
    else                $text .= $navrat;
  }  
  $text .= "\n    </tbody>\n  </table>\n</center>";
  echo $text;
}

/**
 *  Funkce pro preklad z cestiny, vyhleda ve slovniku 
 *  vsechna slova odpovidajici parametru
 *
 *  @param $word slovo urcene k prekladu
 *  @return do tabulky zformatovany preklad
 */
function translate_from_cz($word) {
  $navrat = "";
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict WHERE czech LIKE '$word'";
  $radky = $spojeni->query($dotaz);
  while ($spojeni->next_record()) {
    $navrat .= get_row($spojeni->Record);
  }
  return $navrat;
}

/**
 *  Funkce pro preklad z anglictiny, vyhleda ve slovniku 
 *  vsechna slova odpovidajici parametru
 *
 *  @param $word slovo urcene k prekladu
 *  @return do tabulky zformatovany preklad
 */
function translate_from_en($word) {
  $navrat = "";
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict WHERE english LIKE '$word'";
  $radky = $spojeni->query($dotaz);
  while ($spojeni->next_record()) {
    $navrat .= get_row($spojeni->Record);
  }
  return $navrat;
}

/**
 *  Funkce pro preklad z "tretiho" jazyka, vyhleda ve slovniku 
 *  vsechna slova odpovidajici parametru
 *
 *  @param $word slovo urcene k prekladu
 *  @return do tabulky zformatovany preklad
 */
function translate_from_ar($word) {
  $navrat = "";
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM dict 
            WHERE (present LIKE '$word') OR
                  (past LIKE '$word') OR
                  (valence LIKE '$word') OR
                  (root LIKE '$word')";
  $radky = $spojeni->query($dotaz);
  while ($spojeni->next_record()) {
    $navrat .= get_row($spojeni->Record);
  }
  return $navrat;
}

/**
 *  Funkce nacte do databaze soubor zadamy jako parametr.
 *  Pred tim databazi namaze!!!!!!!!!!!!!!
 *  Nekontroluje format csv souboru.
 *
 *  TODO: UPRAVIT OSTATNI DATA VKLADANA DO DB (DATA, USER, ATD...)
 *
 *
 *  @param $file - cesta k csv souboru 
 *  @return true   kdyz se to povede
 *  @return false  naopak
 */
function dump_csv_file($file) {

  if (!file_exists($file)) {
    echo ("Chyba!!! Zadany soubor: $file neexistuje!!!");
    return false;
  }
  require_once("./classes/db.php");

  $spojeni = new DB_Sql();

  $radky = file($file);
  echo "<table border=\"1\">\n";
  
  $pocitadlo = 0;
  
  $NOW = Date("YmdHis");
  for($i=0;$i<Count($radky);$i++) {
    if (!strpos($radky[$i], ";"))  continue;
    $radek = explode(';', $radky[$i]);
    insert_word(AddSlashes($radek[0]),//czech 
                AddSlashes($radek[1]),//english
                AddSlashes($radek[2]),//word category
                AddSlashes($radek[3]),//verbal class
                AddSlashes($radek[4]),//present
                AddSlashes($radek[5]),//past
                AddSlashes($radek[6]),//valence
                AddSlashes($radek[7]),//root
                1,//field
                1,//language
                0,//user
                0,//source
                2);//lection
    $spojeni->query($dotaz);
    if ($spojeni->Errno != 0) {
      echo $spojeni->$Error;
    }
    else $pocitadlo++;
  }

  echo("<thead>Dump probehl - pridano $pocitadlo zaznamu</thead></table> \n");
  return true;
}

/**
 * fce "aktivuje" promenou predavanou pomoci Post nebo get
 *
 * pouziti: $akce = povolPromennou("akce");
 */
function povolPromennou($nazev) {
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;
  
  if(!Empty($HTTP_GET_VARS[$nazev]))  return $HTTP_GET_VARS[$nazev];
  if(!Empty($HTTP_POST_VARS[$nazev]))  return $HTTP_POST_VARS[$nazev];
  
  return false;
}

function echo_zpet_do_slovniku() {
  global $language;
  global $nonauthorized;
  
  //echo $nonauthorized;
  
  if ($nonauthorized) $pomocna = "list_nonauthorized_word";
  else $pomocna = "list_word";
  
  echo "<br /><a href=\"?nav_id=$pomocna&language=$language\">Zpět do studijniho slovníku</a>";
}

function echo_zpet_do_uzivatel() {
  global $language;
  echo "<br /><a href=\"?nav_id=list_user\">Zpět na seznam uživatel</a>";
}

function echo_zpet_do_oboru() {
  global $language;
  echo "<br /><a href=\"?nav_id=list_field\">Zpět na seznam oborů</a>";
}

function echo_zpet_do_zdroju() {
  global $language;
  echo "<br /><a href=\"?nav_id=list_source\">Zpět na seznam zdrojů</a>";
}

?>

