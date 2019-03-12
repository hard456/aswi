<?php
  
  $language = 1;
  $source   = 5;
  $lection  = 7;
  $cesta_ke_zvukum = "./voices/novy_adresar_pro_zvuky/Slov_7_lekce/";
  
  function seznam_souboru($cesta) {
  	$p_dir = opendir($cesta);
    	if (Empty($p_dir)) {
          
          return NULL;  	
     }  	
     while (($p = readdir($p_dir)) != NULL) {
       if ($p == "." || $p == "..") {
       	 continue;
       }
     	 $pole[] = $p;
     }
     
     sort($pole);
     return $pole;   
  } // end function seznam_souboru
  
  //print_r ( seznam_souboru($cesta_ke_zvukum) );
  
  
  require_once("./classes/db.php");
    $spojeni = new DB_Sql();
    $dotaz = "SELECT * FROM dict 
                WHERE language LIKE '$language' 
                  AND source LIKE '$source' 
                  AND lection LIKE '$lection' 
              ORDER BY \"IDdict\"";
    $spojeni->query($dotaz);
    
    
    $seznam_souboru = seznam_souboru($cesta_ke_zvukum);
    if ($seznam_souboru == NULL) {
      echo "Chyba $cesta neexistuje.\n";
    	exit();
    }
/*    if (Count($seznam_souboru) != $spojeni->num_rows()) {
      echo "Chyba. Pocet souboru neodpovida poctu zaznamu v db. ".Count($seznam_souboru)." ".$spojeni->num_rows()."\n";
    	exit();
    }
*/
    $i = 0;
    $pocitadlo = 1;
    while ($spojeni->next_record()) {
      if ($pocitadlo != 0 + substr($seznam_souboru[$i], 4, 3) ) {
          echo "Soubor $pocitadlo chybi - bude preskocen";
          $pocitadlo++;
          continue;
      }
      $translations[$spojeni->Record["idf"]] = $spojeni->Record["translation"];
      $zdroj = $cesta_ke_zvukum.$seznam_souboru[$i];
      $cil = "./voices/word/".$spojeni->Record["IDdict"].".mp3";
      if (File_Exists($cil)) {
      	echo "Chyba $cil jiz neexistuje.\n";
      	continue;
      }
      rename($zdroj, $cil);
      echo "Kopiruji $zdroj na $cil.\n";
      
      $spojeni_up = new DB_Sql();
      $dotaz_up = "UPDATE dict SET word_voice = 1 
                WHERE \"IDdict\" = ".$spojeni->Record["IDdict"];
      $spojeni_up->query($dotaz_up);
      $i++;
      $pocitadlo++;
    }
    
?>
