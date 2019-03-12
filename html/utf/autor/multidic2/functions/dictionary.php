<?php

  define('CESTA_SLOV', "voices/word/");
  define('PRIPONA', ".mp3");
  define('CESTA_CLANKU', "voices/article/");
  define('CESTA_KONTEXTU', "voices/context/");
  

function p_g($neco) { 
	echo "<pre>";
	print_r($neco);
	echo "</pre>";
} // END function p_g  

function CzStrToLower($str) {

  /*$str = StrTr($str, 
           "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉĚÍÓÚŮÝŠČŘŽŇŤĎ", 
           "abcdefghijlkmnopqrstuvwxyzáéěíóúůýščřžňťď");
  */
  $str = mb_strtolower($str, "UTF-8");
  //echo "str = $str<br />";
  return $str;
}


function lang($idf) { 
  global $LaId; // nastaveno na základě části URL
  if (!IsSet($LaId)) {
    //session_start();
    session_register("LaId");
    $LaId = "cz";
  }
  static $translations;
  if (!isset($translations)) {
    require_once("./classes/db.php");
    $spojeni = new DB_Sql();
    $dotaz = "SELECT idf, translation FROM translation WHERE language = '$LaId'";
    $spojeni->query($dotaz);
    while ($spojeni->next_record()) {
      $translations[$spojeni->Record["idf"]] = $spojeni->Record["translation"];
    }
  }
  return (isset($translations[$idf]) ? $translations[$idf] : $idf);
}

//pouzivat bud lang() nebo lang_cist_cele_najednou()
//nakonec vybrat podle rychlosti


function lang_cist_cele_najednou($idf) { 
  global $LaId; // nastaveno na základě části URL
  if (!IsSet($LaId)) 
    $LaId = "cz";
  static $translations;
  
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT translation FROM translation WHERE idf = '" . addslashes($idf) . "' AND language = '$LaId'";
  $row = $spojeni->query($dotaz);
  // při neexistujícím překladu je vrácen identifikátor
  if ($spojeni->num_rows() != 0) {
    $spojeni->next_record();
    return $spojeni->Record[0];
  }
  else {
    return $idf;
  }
}


function clean_old_examinations($ses_IDuser) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT e.*, 
                   (now() - 3 * INTERVAL '1 month') as before_three_month 
            FROM examing e 
            WHERE e.date < (now() - 3 * INTERVAL '1 month')
              AND e.\"user\" = ".$_SESSION['ses_IDuser']."
            ORDER BY e.date;";
  $radky = $spojeni->query($dotaz);
  while ($spojeni->next_record()) {
    $id = $spojeni->Record["IDexaming"];
    $dotaz = "DELETE FROM exam WHERE examing = $id";
    $spojeni->query($dotaz);
    $dotaz = "DELETE FROM examing WHERE \"IDexaming\" = $id";
    $spojeni->query($dotaz);
  }
}

function translation_chooser() { 
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT code FROM translation_lang WHERE NOT visible = 0;"; 
  $radky = $spojeni->query($dotaz);
  while ($spojeni->next_record()) {
    echo '<a href="?set_lang='.$spojeni->Record["code"].'">'.$spojeni->Record["code"].'</a>&nbsp;';
	}
}

function copyright() {
  //global $LaId;
  //echo ('<div class="copyright"><a href="http://www.e-beda.cz" class="active">created by e-beda.cz</a></div>');
  //echo ("\$LaId = $LaId");
}

function insert_picture( $class = "obrazek" ) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM pictures ORDER BY Random() LIMIT 1";
  $radky = $spojeni->query($dotaz);
  if ($spojeni->num_rows() == 0) {
    echo "Chyba pri vyberu obrazku...";
    return false;
  }
  else {
    $spojeni->next_record();
    $nazev_souboru = $spojeni->Record["name_of_picture"];
    $cesky = $spojeni->Record["czech"];
    $anglicky = $spojeni->Record["english"];
    $arabsky = $spojeni->Record["orig"];
    
  $navrat .= "
<div id=\"$class\">
  <table>
    <tr>
      <td dir=\"rtl\">
        <img src = \"./pictures/$nazev_souboru\" 
             title = \"$cesky - $anglicky - $arabsky\" />
        <br />
        <h2 class = \"arabic\">
          $arabsky
        </h2>
      </td>
    </tr>
  </table>

</div>";
  
  
    echo $navrat;
  }
}


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


function get_translation_chooser() {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM translation_lang";
  $spojeni->query($dotaz);
  $navrat = "<select name=\"translation_lang_id\" size=\"4\">";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record["code"]."\">  ".$spojeni->Record["name"]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
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

function get_source_chooser($language, $nazev = "source") {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM source";
  if (!Empty($language))
   $dotaz .= " WHERE \"language\" = '$language'";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"$nazev\" size=\"1\">";
  while ($spojeni->next_record()) {
    $navrat .= "  <option value=\"".$spojeni->Record[0]."\">  ".$spojeni->Record[1]." - ".$spojeni->Record[2]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
}

function get_lection_chooser($source, $size = 1, $nazev = "lection") {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT lection FROM dict WHERE source = '$source' GROUP BY lection ORDER BY lection ";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"$nazev\" size=\"$size\">";
  $i = 0;
  while ($spojeni->next_record()) {
    $cisla[$i] = 0 + ($spojeni->Record["lection"]);
    $hodnoty[$i] = $spojeni->Record["lection"];
    $i++;
  }
  if (count($cisla) <= 0) {
  	return "prazdne";
  }
  asort($cisla);
  foreach ($cisla as $klic => $cislo) {
    $navrat .= "  <option value=\"".$hodnoty[$klic]."\"> ".lang("lekce")." ".$hodnoty[$klic]."  </option>";
  }
  $navrat .= '</select>';
  return $navrat;
}

function get_lection_chooser_article($source, $size = 1, $nazev = "lection") {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT lection FROM article WHERE source = '$source' GROUP BY lection ORDER BY lection ";
  $radky = $spojeni->query($dotaz);
  $navrat = "<select name=\"$nazev\" size=\"$size\">";
  $i = 0;
  while ($spojeni->next_record()) {
    $cisla[$i] = 0 + ($spojeni->Record["lection"]);
    $hodnoty[$i] = $spojeni->Record["lection"];
    $i++;
  }
  if (count($cisla) <= 0) {
  	return "prazdne";
  }
  asort($cisla);
  foreach ($cisla as $klic => $cislo) {
    $navrat .= "  <option value=\"".$hodnoty[$klic]."\"> ".lang("lekce")." ".$hodnoty[$klic]."  </option>";
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
  $navrat = lang("V této lekci je ").$max.lang(" slovíček ")." <br />\n";
  $navrat .= "<select name=\"count\" size=\"$size\">";
  for ($count = 10; $count < $max; $count += 10) {
    $navrat .= "  <option value=\"".$count."\">  ".$count."  </option>";
  }
  $navrat .= "  <option value=\"".$spojeni->num_rows()."\">  ".$max."  </option>";
  $navrat .= '</select>';
  return $navrat;
}


function print_hlasku($text) {
  echo "<h4 class=\"nadpis3\">".$text."</h4> \n";
}

function is_in_dictionary_past($past, $source, $lection) {
  if (Empty($past) || (Trim($past) == "")) return false;
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT past FROM dict WHERE past LIKE '$past' AND source = $source AND lection LIKE '$lection'";  
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
                     $field,$language,$user,$source,$lection, $future, $infinitive, $gender) {
  
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  //pokud uz je ve slovniku nebude se znovu vkladat
  if (is_in_dictionary_past($past, $source, $lection)) {
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
                            future,
                            infinitive,
                            valence, 
                            root,
                            gender, 
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
                            '$future',
                            '$infinitive',
                            '$valence', 
                            '$root', 
                            '$gender',
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


function save_to_not_found($language, $word) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM not_found_$language WHERE not_found LIKE '$word'";
  $radky = $spojeni->query($dotaz);
  if ($spojeni->num_rows() == 0)  {
    $dotaz = "INSERT INTO not_found_$language (not_found, 
                          date, 
                          count) 
                  VALUES ('$word', 'NOW', 1)";
  }
  else {
    $spojeni->next_record();
    $pocet = $spojeni->Record["count"];
    $pocet++;
    $identifikator = $spojeni->Record["IDnot_found_$language"];
    $dotaz = "UPDATE not_found_$language 
              SET count = $pocet 
              WHERE \"IDnot_found_$language\" = $identifikator";   
  }
  $spojeni->query($dotaz);
}



function __get_word_in_card_format($Record) {
  //global CESTA_KONTEXTU, PRIPONA, CESTA_SLOV;
  require_once("./administration/context.php");
  
  $navrat = "<div class=\"card\">\n<br />";
  $navrat .= " \n     ";

  $navrat .= $Record["czech"];
  $navrat .= "&nbsp;  - \n";
  $navrat .= $Record["english"];
  $navrat .= "&nbsp;   \n";

  $navrat .= "<div class=\"arabic\">";
  $navrat .= $Record["past"];
  $navrat .= "&nbsp;</div>\n";
  $navrat .= " \n  ";
  $navrat .= "\n<br />".lang("Kontext:");
  if (!Empty($Record["context"])) {
    $context = get_context($Record["context"]);
    $navrat .= $context["cz_context"]." - ".$context["en_context"]." -
              <div class=\"arabic\">".$context["orig_context"]."</div>";
  }
  if (!Empty($Record["context_voice"])) {
  	$navrat .= '<a href="'.CESTA_KONTEXTU.$Record["IDdict"].PRIPONA.'"> '.lang("přehrát zvuk").' </a>';
  }
  else {
    $navrat .= lang("není");
  }
  $navrat .= "\n<br />".lang("Zvuk:");
  if (!Empty($Record["word_voice"])) 
    $navrat .= '<a href="'.CESTA_SLOV.$Record["IDdict"].PRIPONA.'"> '.lang("přehrát zvuk").' </a>';
  else
    $navrat .= lang("není");
  $navrat .= "\n<br />\n<br />\n</div>";
  
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
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $text = "<center>\n       ";
  
  //$po = mb_strtolower($word, "UTF-8");
  //echo $word."\n<br />".$po;
  
  if (empty($word)) {
    $text .= lang("Musíte zadat nějaké slovo.");
  }
  else {
    $navrat = "";
    switch ($language) {
      case("en"):
        //$word = mb_strtolower($word, "UTF-8");
        $dotaz = "SELECT * FROM dict WHERE lower(english) = lower('$word')";
      break;
      case("ar"):
        $dotaz = "SELECT * FROM dict 
            WHERE language = 1 AND 
                  ((present = '$word') OR
                   (past    = '$word') OR
                   (valence = '$word') OR
                   (root    = '$word'))";
      break;
      case("cz"):
        //$word = mb_strtolower($word, "UTF-8");
        $dotaz = "SELECT * FROM dict WHERE lower(czech) = lower('$word')";
    }
    $dotaz .= " ORDER BY context DESC, word_voice";
    //echo "sql = $dotaz\n<br />";

    $radky = $spojeni->query($dotaz);
    if ($spojeni->num_rows() == 0)  {
      $text .= "Slovo nebylo nalezeno";
      save_to_not_found($language, $word);
    }
    else {
      $spojeni->next_record();
      //dle zadani vybereme jen prvni slovo - tj. s contextem a zvukem 
      $text .= __get_word_in_card_format($spojeni->Record);
      
      $text .= "";
    }
  }  
  $text .= "\n   \n</center>";
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
  $dotaz = "SELECT * FROM dict WHERE lower(czech) LIKE lower('$word') ;";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record;
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
  $dotaz = "SELECT * FROM dict WHERE lower(english) LIKE lower('$word') ;";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record;
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
            WHERE language = 1 AND 
                  ((present LIKE '$word') OR
                   (past LIKE '$word') OR
                   (valence LIKE '$word') OR
                   (root LIKE '$word'))";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record;
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
  global $contrains_source;
  global $contrains_lection;
  global $contrains_user_id;
  
  //echo $nonauthorized;
  
  if ($nonauthorized) $pomocna = "list_nonauthorized_word";
  else $pomocna = "list_word";
  
  echo "<br />
        <a href=\"?nav_id=$pomocna&language=$language&contrains_source=$contrains_source&contrains_lection=$contrains_lection&contrains_user_id=$contrains_user_id\">
           Zpět do studijniho slovníku
        </a>";
}

function echo_zpet_do_clanku() {
  global $language;
  global $contrains_source;
  global $contrains_lection;
  
  echo "<br />
        <a href=\"?nav_id=list_article&language=$language&contrains_source=$contrains_source&contrains_lection=$contrains_lection\">
           Zpět na seznam článků
        </a>";
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

function echo_zpet_do_translation_lang() {
  global $language;
  echo "<br /><a href=\"?nav_id=list_translation_lang\">Zpět na seznam jazyků překladu prostředí</a>";
}

function echo_zpet_do_translation() {
  global $translation_lang_id;
  echo "<br /><a href=\"?nav_id=list_translation&translation_lang_id=$translation_lang_id\">Zpět na překlady prostředí</a>";
}
?>
