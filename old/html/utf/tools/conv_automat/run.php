<?php
//soubor nelze jen tak spustit
exit();


  require_once("./sql/db.php");
  require_once("./functions.inc.php");
  //require_once './counter.class.php';
  require_once './analyzator.class.php';
  
  set_time_limit(9000000);

 /* 
  function a($q) { 
  	print_g("$q  ".detekuj_seal($q)."\n");
  } 
  a("(04RIME_IasAd03,");
  a("(04RIME_IahLim_S04,");
  a("(04RIME_IahLim_S04");
  exit();
 */
  
  while (($kniha = ziskej_id_knihy()) != null) {
    if (Empty($kniha["book"])) {
      continue;
    }
    echo "<b>Book:</b> ".$kniha["book"]."\n<br />";
    zpracuj_vsechny_kapitoly_knihy($kniha["book"]);
    
  }

/*
    $id_kapitoly = $spojeni_kapitoly->Record["bookandchapter"];
    $museum_no   = $spojeni_kapitoly->Record["museum_no"];
    
    if ($id_kapitoly == null) {
    	echo "Chyba - prazdne id";
    	return;
    }
    $pocitadlo->setMuseumNo($museum_no);

    $data_kapitoly = ziskej_data_kapitoly($id_kapitoly);
    $metadata_kapitoly = ziskej_metadata_kapitoly($id_kapitoly);
    
    pretvor_do_nobtc($id_kapitoly, $data_kapitoly, $metadata_kapitoly, $pocitadlo);

    $pocitadlo->reset();
*/
?>


