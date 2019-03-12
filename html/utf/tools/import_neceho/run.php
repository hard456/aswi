<?php
//exit();

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
function dump_utx_file($file) {

  if (!file_exists($file)) {
    echo ("Chyba!!! Zadany soubor: $file neexistuje!!!");
    return false;
  }
  
  $radky = file($file);
  $pocitadlo = 0;
  
  for($i=2;$i<Count($radky);$i++) {
      if (!strpos($radky[$i], "|"))
          continue;
      $radek = explode('|', $radky[$i]);
      if (count($radek) < 3)
          continue;
      $bookandchapter   = trim($radek[0]);
      $par              = trim($radek[1]);
      $transliteration  = trim($radek[2]);
      
      if (update_record($bookandchapter, $par, $transliteration)) {
          $pocitadlo++;
      }
  }

  echo("Update probehl - zmeneno $pocitadlo zaznamu \n");
  return true;
}

function update_record($bookandchapter, $par, $transliteration) {
  require_once("./db.php");
  $spojeni = new DB_Sql();
  
  $dotaz = "UPDATE obtexts SET transliteration = '$transliteration' 
            WHERE trim(bookandchapter) LIKE '$bookandchapter'
              AND paragraph = '$par'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    echo $spojeni->$Error;
    return false;
  }
  return true;
}

    //main

	dump_utx_file("upr_indexy-mhet_II-2.utx");

//    dump_utx_file("0203mhet.utx");
//    dump_utx_file("0204mhet.utx");
//    dump_utx_file("0206mhet1.utx");

?>
