<?php
require_once("./functions/dictionary.php");


define(CESTA_SLOV, "./voices/word/");
define(CESTA_KONTEXTU, "./voices/context/");
define(CESTA_CLANKU, "./voices/article/");

define(PRIPONA, ".mp3");

function save_article_voice($file,$id) {
  if (!File_exists(CESTA_CLANKU) || FileType(CESTA_CLANKU) != "dir") {
    vytvor_adresar(CESTA_CLANKU);
  }
  //echo "Zdroj: ".$file;
  //echo "<br />\nCil: ".CESTA_CLANKU.$id.PRIPONA;
  
  if ( move_uploaded_file($file, CESTA_CLANKU.$id.PRIPONA)) 
    print_hlasku ("Soubor uploadován");
  else {
    print_hlasku ("Chyba pri uploadu souboru");
    return false;
  }
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE article SET article_voice = 1 WHERE \"IDarticle\" = $id ";
  $spojeni->query($dotaz);
  
  if ($spojeni->Errno != 0) return false;
  return true;
}

function save_context_voice($file,$id) {
  if (!File_exists(CESTA_KONTEXTU) || FileType(CESTA_KONTEXTU) != "dir") {
    vytvor_adresar(CESTA_KONTEXTU);
  }
  //echo "Zdroj: ".$file;
  //echo "<br />\nCil: ".CESTA_KONTEXTU.$word_id.PRIPONA;
  
  if ( move_uploaded_file($file, CESTA_KONTEXTU.$id.PRIPONA)) 
    print_hlasku ("Soubor uploadován");
  else {
    print_hlasku ("Chyba pri uploadu souboru");
    return false;
  }
  return true;
}

function save_word_voice($file,$word_id) {
  if (!File_exists(CESTA_SLOV) || FileType(CESTA_SLOV) != "dir") {
    vytvor_adresar(CESTA_SLOV);
  }
  //echo "Zdroj: ".$_FILES[$file]['name'];
  //echo "<br />\nCil: ".CESTA_SLOV.$word_id.PRIPONA;
  
  if ( move_uploaded_file($_FILES[$file]['tmp_name'], CESTA_SLOV.$word_id.PRIPONA)) {
    chmod(CESTA_SLOV.$word_id.PRIPONA, 0755);
    print_hlasku ("Soubor uploadován");
  }
  else {
    print_hlasku ("Chyba pri uploadu souboru");
    return false;
  }
  
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE dict SET word_voice = 1 WHERE \"IDdict\" = $word_id ";
  $spojeni->query($dotaz);
  
  if ($spojeni->Errno != 0) return false;
  return true;
}

?>
