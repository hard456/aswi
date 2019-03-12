<?php
//pro potreby pokusu zatim takhle
$pocet_id_kapitol = 10;
//$pole_id_kapitol[] = "AbB_6,126";
$pole_id_kapitol[] = "AbB_1,138";
$pole_id_kapitol[] = "AbB_3,35";
$pole_id_kapitol[] = "AbB_13,171";
$pole_id_kapitol[] = "AbB_13,135";
$pole_id_kapitol[] = "ARM_10,35";
$pole_id_kapitol[] = "UF_23,Al_T_322";
$pole_id_kapitol[] = "AbB_13,182";
$pole_id_kapitol[] = "AbB_4,164";
$pole_id_kapitol[] = "Sumer_14,31";
$pole_id_kapitol[] = "ABIM_25";


$spojeni_na_kapitoly;
$jsou_nacteny = false;

function ziskej_nove_id_kapitoly() {
global $pocet_id_kapitol;
global $pole_id_kapitol;

  if ($pocet_id_kapitol > 0) {
    $pocet_id_kapitol--;
  	return $pole_id_kapitol[$pocet_id_kapitol];
  }
  else {
  	return null;
  }
} // end function ziskej_nove_id_kapitoly

function ziskej_id_kapitoly_z_db() {
  global $spojeni_na_kapitoly;
  global $jsou_nacteny;
  
  if (!$jsou_nacteny) {
    $spojeni_na_kapitoly = new DB_Sql();
    $dotaz = "select *
              from museum_no 
              where museum_no is not null 
              and trim(both ' ' from museum_no) not like ''";
    $spojeni_na_kapitoly->query($dotaz);
    $spojeni_na_kapitoly->next_record();
    $jsou_nacteny = true;
    return $spojeni_na_kapitoly;
  }
  else {
    if ($spojeni_na_kapitoly->next_record()) {
    	return $spojeni_na_kapitoly;
    }
    else {
    	return null;
    }
  }
}

function ziskej_data_kapitoly($id_kapitoly) {
  $spojeni = new DB_Sql();
  $dotaz = "select bookandchapter, paragraph, transliteration
              from obtexts 
              where bookandchapter 
                    like '%$id_kapitoly%' 
              order by bookandchapter, paragraph";
  
  $spojeni->query($dotaz);
  
  //print_g($spojeni);
  return $spojeni;
} // end function ziskej_data_kapitoly



function vloz_co_kam($co, $do_ceho, $zastupny_znak = "|") {
	$return = Str_replace($zastupny_znak, $co, $do_ceho);
	return $return;
} // end function vloz_co_kam

function rozdel_do_skupin($data_kapitoly) {
 $analyzator = new Analyzator();	
	while ($data_kapitoly->next_record()) {
  	$transliteration = Trim(Strip_tags($data_kapitoly->Record['transliteration']));
	  $analyzator->analyzuj_pred($data_kapitoly->Record["bookandchapter"]);
	  //prehozeno z duvodu odstraneni &xxx$
	  $object_type = $analyzator->object_type;
	  $surface_type = $analyzator->surface_type;
	  
    $transliteration = $analyzator->analyzuj_za($data_kapitoly->Record["bookandchapter"], $transliteration);
    
    $temp[$object_type][$surface_type][] = $transliteration;
    
	}
	return $temp;	
} // end function rozdel_do_skupin

function sestav_l($radka, $poc) {
  //pozor nikdy do nich nezapisovat///
  global $element_atf;             ///
  global $element_l;               ///
  ////////////////////////////////////
	//atf
  $pomoc_atf = vloz_co_kam(Trim($radka), $element_atf);
  //l
  $pomoc_l = vloz_co_kam($poc->toString(), $element_l, '{atribut_id}');
  $pomoc_l = vloz_co_kam($poc->l,          $pomoc_l,   '{atribut_n}');
  $pomoc_l = vloz_co_kam($pomoc_atf,       $pomoc_l);
  return $pomoc_l;
} // end function sestav_l

function sestav_surface($surface_type, $pole_surface, $poc) {
  //pozor nikdy do nich nezapisovat///
  global $element_column;          ///
  global $element_surface;         ///
  global $element_sealing;         ///
  ////////////////////////////////////
  
	foreach ($pole_surface as $key=>$radka) {
 	  //echo "$key=>$radka\n<br />";
 	  $navrat .= sestav_l($radka, $poc);
 	  $poc->incL();
  }
  $pomoc_column = vloz_co_kam($poc->toStringColumn(), $element_column, '{atribut_id}' );
	$pomoc_column = vloz_co_kam(0,                      $pomoc_column,   '{atribut_n}' );  
  $pomoc_column = vloz_co_kam($navrat,                $pomoc_column );
  
  //kdyz je $surface_type sealing pouziva se tag sealing
  if ($surface_type == "sealing") {
  	$muj_element_surface = $element_sealing;
  	$pomoc_surface = vloz_co_kam(1, $muj_element_surface, '{atribut_n}');
  }
  else {
  	$muj_element_surface = $element_surface;
  	$pomoc_surface = vloz_co_kam($surface_type, $muj_element_surface, '{atribut_type}');
  }
  
  $pomoc_surface = vloz_co_kam($poc->toStringSurface(), $pomoc_surface, '{atribut_id}');
  $pomoc_surface = vloz_co_kam($pomoc_column,           $pomoc_surface);
  
  return $pomoc_surface;
} // end function sestav_l

function sestav_object($object_type, $pole_povrchu, $poc) {
  //pozor nikdy do nich nezapisovat!!!
  global $element_object;
  ////////////////////////////////////
  
	foreach ($pole_povrchu as $surface_type=>$pole_surface) {
 	  //echo "$surface_type=>$pole_surface\n<br />";
 	  $navrat .= sestav_surface($surface_type, $pole_surface, $poc)."\n";
 	  $poc->incSurface();
  }
  $pomoc_object = vloz_co_kam($poc->toStringObject(), $element_object, '{atribut_id}');	 
  $pomoc_object = vloz_co_kam($object_type, $pomoc_object, '{atribut_type}');
  $pomoc_object = vloz_co_kam($navrat, $pomoc_object);
  
  return $pomoc_object;
} // end function sestav_object


function sestav_transliteration($pole_objektu, $poc) {
  //pozor nikdy do nich nezapisovat///
  global $element_transliteration; ///
  ////////////////////////////////////
  //print_g($poc);
  //print_g($pole_objektu);
  
  if (Empty($pole_objektu)) {
    return "";
  }
  foreach ($pole_objektu as $object_type => $pole_povrchu) {
  	//echo "$object_type=>$pole_povrchu\n<br />";
  	$navrat .= sestav_object($object_type, $pole_povrchu, $poc);
    $poc->incObject();
  }
  $pomoc_transliteration = vloz_co_kam($poc->getPrefix(), $element_transliteration, '{atribut_id}');	  
  $pomoc_transliteration = vloz_co_kam($poc->museum_no,   $pomoc_transliteration,   '{atribut_n}');
  $pomoc_transliteration = vloz_co_kam($navrat, $pomoc_transliteration);
  //$poc->reset();
	return $pomoc_transliteration;
} // end function sestav_transliteration

function pretvor_do_xtf($id_kapitoly, $data_kapitoly, $poc) {
    
  $pole = rozdel_do_skupin($data_kapitoly);
  //print_g($pole);
  return sestav_transliteration($pole, $poc);

} // end function pretvor_do_xtf



function print_g($text) {
	echo "<pre>";
  print_r($text);
  echo "</pre>";
} // end function print_g

function save_to_file( $file_name, $content ) {
	$cesta_k_xml="./out/$file_name.xml";
	if (File_Exists($cesta_k_xml)) {
	  echo "\nSoubor $cesta_k_xml již existuje, bude přepsán.\n<br />";
	  //return;
	}
	if (($fp = fopen($cesta_k_xml, "w")) == false) {
	  echo "\nSoubor $cesta_k_xml se nepodařilo vytvořit.\n<br />";
	  return;
	}
	if (fwrite($fp, $content) == false) {
    echo "\nDo souboru $cesta_k_xml se nepodařilo zapsat.\n<br />";
  }
  echo "\nZaviram $cesta_k_xml.\n<br />\n<br />";
  fclose($fp);
} // end function save_to_file
?>
