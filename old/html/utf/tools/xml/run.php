<?php
  require_once("./sql/db.php");
  require_once("./functions.inc.php");
  require_once("./xtf.template.php");
  require_once './counter.class.php';
  require_once './analyzator.class.php';
  
  $pocitadlo = new Counter("");
  //while (($id_kapitoly = ziskej_nove_id_kapitoly()) != null) {
  while (($spojeni_kapitoly = ziskej_id_kapitoly_z_db()) != null) {
  
    $id_kapitoly = $spojeni_kapitoly->Record["bookandchapter"];
    $museum_no   = $spojeni_kapitoly->Record["museum_no"];
    
    if ($id_kapitoly == null) {
    	echo "Chyba - prazdne id";
    	return;
    }
    //print_g($spojeni_kapitoly);
    $pocitadlo->setMuseumNo($museum_no);
    //$pocitadlo->setPrefix($id_kapitoly);
    
    $data_kapitoly = ziskej_data_kapitoly($id_kapitoly);
    
    $vystup .= pretvor_do_xtf($id_kapitoly, $data_kapitoly, $pocitadlo);
    //print_g( pretvor_do_xtf($id_kapitoly, $data_kapitoly, $pocitadlo) );
    //echo $id_kapitoly."\n";
    $pocitadlo->reset();
  }
  $nove_xtf = vloz_co_kam($vystup, $korenovy_xtf);
  
  save_to_file("sample_out", $nove_xtf);

  //print($xtf);

?>


