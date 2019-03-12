<?php

$book_type_array = Array (
  "letter" => 1,
  "document" => 2,
  "epic" => 3,
  "hymn" => 4,
  "incantation" => 5,
  "legal text" => 6,
  "legal texts" => 7,
  "mathematics" => 8,
  "omina" => 9,
  "other" => 10,
  "royal inscription" => 11,
  ''=> NULL,
  NULL => NULL
);

$museum_array = Array(
  "Aleppo?" => 3,
  "Aleppo? Museum" => 3,
  "Bagdad museum" => 12,
  "British museum" => 4,
  "British Museum" => 4,
  "Catholic University of America (Washington D.C.)" => 5,
  "Catholic University of America (Washington D.C.), Yale University, New Haven, Conn., U.S.A" => 5,
  "Iraq Museum" => 6,
  "Pergamon? museum in Berlin" => 7,
  "Pierpont Morgan Library" => 8,
  "privat collection of V. Scheil" => 9,
  "Univerzity of Texas Austin, Texas, U.S.A." => 10,
  "Yale Babylonian Collection" => 11,
  NULL => NULL,
  '' => NULL
);

$origin_array = Array (
  "Babylon" => 1,
  "Kis" => 2,
  "Kisura" => 3,
  "Lagaba" => 4,
  "Larsa" => 5,
  "Tell Harmal" => 6,
  "Ugarit" => 7,
  NULL => NULL,
  '' => NULL
);

$object_type_array = Array (
  'tablet' => 1,
  'envelope' => 2
 
);

$surface_type_array = Array (
  'obverse' => 1,
  'reverse' => 2,
  'left' => 3,
  'top' => 4,
  'bottom' => 5,
  'right' => 6,
  'seal1' => 7,
  'seal2' => 8,
  'seal3' => 9,
  'seal4' => 10,
  'seal5' => 11,
  'seal6' => 12,
  'seal7' => 13,
  'seal8' => 14
);

$chapter2help_array = Array (
  'A_H' => 'C',//A_Hulle
  'B_Siegelabrollung' => 'S1',
  'C_Tafel' => 'T',
  'S8' => 'S8',
  'S7' => 'S7',
  'S6' => 'S6',
  'S5' => 'S5',
  'S4' => 'S4',
  'S3' => 'S3',
  'S2' => 'S2',
  'S1' => 'S1',
  'S' => 'S1',
  'H' => 'C',
  'T' => 'T',
  'Ca' => 'S1',
  'Cb' => 'S2',
  '\.A' => 'T',
  '\.B' => 'C',
  '\.C' => 'S1',
  'A' => 'T',
  'B' => 'C',
  'C' => 'C',
  'Ṭ�' => 'T'
  //'' => '',
  //'' => '',
  //'' => '',
);

/*
function ziskej_id_knihy() {
  global $spojeni_na_knihy;
  global $knihy_jsou_nacteny;
  
  if (!$knihy_jsou_nacteny) {
    $spojeni_na_knihy = new DB_Sql();
    $spojeni_na_knihy->Database = "klinopis";
    $dotaz = "select distinct trim(book) as book from obtextp order by book";
        //$dotaz = "select distinct trim(book) as book from obtextp order by book limit 2";
    $spojeni_na_knihy->query($dotaz);
    $spojeni_na_knihy->next_record();
    $knihy_jsou_nacteny = true;
    return $spojeni_na_knihy->Record;
  }
  else {
    if ($spojeni_na_knihy->next_record()) {
      return $spojeni_na_knihy->Record;
    }
    else {
      return null;
    }
  }
}
*/

function ziskej_id_knihy() {
  global $knihy_jsou_nacteny;
  if (!$knihy_jsou_nacteny) {
    //$kniha['book'] = "ARM_10,";
    $kniha['book'] = "Sumer_14";
    $knihy_jsou_nacteny = true;
    return $kniha;
  }
  else {
    return null;
  }
}

function zpracuj_vsechny_kapitoly_knihy($kniha) {
  $prvne = true;
  $new_id_knihy = NULL;
  $spojeni = new DB_Sql();
  $spojeni->Database = "klinopis";
  $dotaz = "select * from obtextp where trim(book) like '$kniha'";
  $spojeni->query($dotaz);
  
  while ($spojeni->next_record()) {
    if ($prvne) {
      $new_id_knihy = vloz_do_tabulky_book($spojeni->Record);
      $prvne = false;
    }
    $chapter = odrizni_chapter($spojeni->Record['chapter']);
    $tabulky[$chapter['name']][$chapter['type']][$chapter['broken']] = Trim( $spojeni->Record['bookandchapterp'] );
    $museum_nos[$chapter['name']] = $spojeni->Record['museum_id'];
  }
  
  foreach ($tabulky as $chapter=>$bookandchapters) {
    $museum_id = $museum_nos[$chapter];
    print_g("\nChapter: ".$chapter);
//    print_g($bookandchapters);
    $id_trans = vloz_transliteration($new_id_knihy, $chapter, $museum_id, $bookandchapters);
    zpracuj_data_kapitoly($id_trans, $bookandchapters);
  }
  
}
 
function vloz_do_tabulky_book($kniha) {
  
  $spojeni = new DB_Sql();
  
  $dotaz = "insert into book (book_abrev, book_autor, book_name, book_description) values ('".
              pg_escape_string(trim($kniha["book"]))."', 'complete by description', 'complete by description', '".
              pg_escape_string(trim($kniha["descriptionp"]))."')";
  $spojeni->query($dotaz);
  //print_g($dotaz);
  
  $dotaz = "select currval('book_id_book_seq')";
  $spojeni->query($dotaz);
  @$spojeni->next_record();
  $dalsi_cislo = $spojeni->Record["currval"];
  @$spojeni->close();
  return $dalsi_cislo;
}

function odrizni_chapter($chapter)
{ // BEGIN function odrizni_chapter
  $chapter = Trim($chapter);
  if (strpos($book, "04RIME") === FALSE) {
    $uvod_delka = strspn($chapter, "0123456789");
    if ($uvod_delka == 0 || ereg("_I", $chapter)) {
      /*
      Kdyz neni 04RIME ale nezacina na cislici, nebo obsahuje rozdeleni dle rimskych cislic -> 
      pokud obsahuje ' (nebo podobnou variantu znaku) v poctu n, 
      nastavime $ret['broken'] na n, vymazeme tyto znaky .
      */
      $ret['broken'] = spocti_broken($chapter);
      if ($ret['broken'] > 0) {
      	$chapter = vymaz_broken($chapter);
      }
      $ret['name'] = $chapter;
      $ret['type'] = 'T';
      return $ret;
    }
    /*
    Pokud neni 04RIME, a zacina na cislici -> vetsina zaznamu
    */
    $ret['broken'] = spocti_broken($chapter);
    $ret['name'] = substr($chapter, 0, $uvod_delka);
    $ret['type'] = detekuj_typ($chapter);
    return $ret;
  }
  else { // 04RIME
  /*
  Kdyz obsahuje ' (nebo podobnou variantu znaku) v poctu n, 
  nastavime $ret['broken'] na n, vymazeme tyto znaky .
  
  Pokud za poslednim vyskytem znaku S jsou uz jen cislice,
  nic nemazat, ale nastavit $ret['type'] na S1.
  */
    $ret['broken'] = spocti_broken($chapter);
    if ($ret['broken'] > 0) {
    	$chapter = vymaz_broken($chapter);
    }
    $ret['name'] = $chapter;
    $ret['type'] = detekuj_seal($chapter);
    return $ret;
  }
} // END function odrizni_chapter

function spocti_broken($chapter)
{ // BEGIN function spocti_broken ʾ
	$pocet = substr_count($chapter, "´");
	$pocet+= substr_count($chapter, "ʾ");
	$pocet+= substr_count($chapter, "'");
	$pocet+= substr_count($chapter, "?");
	return $pocet;
} // END function spocti_broken

function vymaz_broken($chapter)
{ // BEGIN function vymaz_broken
  $trans = array("´" => "", "ʾ" => "", "'" => "", "?" => "");
	return strtr($chapter, $trans);
} // END function vymaz_broken

function detekuj_seal($chapter)
{ // BEGIN function detekuj_seal
  $posl_S = strrpos($chapter, 'S');
  if ($pos === false) {
  	return 'T';
  }
  $zbytek = substr($chapter, $posl_S+1);
  $delka = strspn($zbytek, "0123456789,");
  if ($delka != strlen($zbytek)) {
  	return 'T';
  }
	return 'S1';
} // END function detekuj_seal

function detekuj_typ($chapter)
{ // BEGIN function detekuj_typ
  global $chapter2help_array;
  
  foreach ($chapter2help_array as $key=>$value) {
  	if (ereg($key, $chapter)) {
 	    return $value;
    }
  }
  return 'T';
} // END function detekuj_typ




function vloz_transliteration($new_id_knihy, $chapter, $museum_id, $bachs) {
  //TODO: spravne nastavit museum_no
  $spojeni = new DB_Sql();
  
  //ziskani id_museum
  global $museum_array;
  $id_museum = $museum_array[trim($kapitola['museum'])];
  if (empty($id_museum)) $id_museum = 0;
  // konec ziskani id_museum
  
  //ziskani id_origin
  global $origin_array;
  $id_origin = $origin_array[trim($kapitola['origin'])];
  if (empty($id_origin)) $id_origin = 0;
  // konec ziskani id_origin
  
  // ziskani id_BOOK_TYPE
  global $book_type_array;
  $id_book_type = $book_type_array[trim($kapitola["type"])];
  if (empty($id_book_type)) $id_book_type = 0;
  //konec ziskani id_BOOK_TYPE
  
  foreach ($bachs as $key=>$value) {
  	foreach ($value as $key1=>$value1) {
   	  $str_bachs.= $value1." ";
    }
  }  
  $dotaz = "insert into transliteration (chapter, 
                                         museum_no, 
                                         id_book, 
                                         id_museum, 
                                         id_origin,
                                         old_bookandchapter,
                                         id_book_type) 
                        values ('".pg_escape_string(trim($chapter))."', 
                                '".pg_escape_string($museum_id)."',
                                 $new_id_knihy,
                                 $id_museum,
                                 $id_origin,
                                 '".pg_escape_string( $str_bachs )."' ,
                                 $id_book_type )";
  $spojeni->query($dotaz);
//  print_g( $dotaz );
  
  $dotaz = "select currval('transliteration_id_transliteration_seq')";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  $id_transliteration = $spojeni->Record["currval"];
  
  @$spojeni->close();
  return $id_transliteration;
}

function zpracuj_data_kapitoly($id_transliteration, $bookandchapters) {
  $spojeni = new DB_Sql();
  
  $data_tabulky = rozdel_do_skupin($bookandchapters);
  
  $last_object_type = "";
  $last_surface_type = "";
  $aktiv_surface_id = NULL;
  
  if (!is_array($data_tabulky)) {
  	echo "Neni pole\n";
  }
  foreach ($data_tabulky as $object_type => $pole_povrchu) {
    //vlozit
    foreach ($pole_povrchu as $surface_type => $pole_radek_a_bach) {
      if ($last_surface_type != $surface_type || $last_object_type != $object_type) {
        $aktiv_surface_id = pridej_column($id_transliteration, $object_type, $surface_type);
      }
      //zpracovani
      //print_g($pole_radek);
      $pole_radek = $pole_radek_a_bach['line'];
      $pole_bach  = $pole_radek_a_bach['bookandchapter'];
      $pole_par   = $pole_radek_a_bach['paragraph'];
      for ($i = 0; $i < count($pole_radek); $i++) {
        $dotaz = "insert into line (transliteration, 
                                    line_number, 
                                    id_surface, 
                                    broken, 
                                    old_bookandchapter) 
                            values ('".pg_escape_string(trim($pole_radek[$i]))."', 
                                    '".pg_escape_string(trim($pole_par[$i]))."', 
                                    '$aktiv_surface_id', 
                                    FALSE, 
                                    '".pg_escape_string(trim($pole_bach[$i]))."')";
        $spojeni->query($dotaz);
      }
      $last_surface_type = $surface_type;
    }
    $last_object_type = $object_type;
  }
}

function pridej_column($id_transliteration, $object_type, $surface_type) {
  //TODO: spravne nastavit object_type, surface_type
  $spojeni = new DB_Sql();
  
  //ziskani id_object_type
  global $object_type_array;
  $id_object_type = $object_type_array[$object_type];
  if (empty($id_object_type)) $id_object_type = 'NULL';
  // konec ziskani id_object_type
  
  //ziskani id_surface_type
  global $surface_type_array;
    ///echo "surface_type=$surface_type\n";
  $id_surface_type = $surface_type_array[$surface_type];
  if (empty($id_surface_type)) $id_surface_type = 'NULL';
    ///echo "id_surface_type=$id_surface_type\n";
  // konec ziskani id_surface_type
  
  $dotaz = "insert into surface (id_transliteration, id_object_type, id_surface_type, column_number) 
                         values ($id_transliteration, $id_object_type, $id_surface_type, 0)";
  $spojeni->query($dotaz);
  
  $dotaz = "select currval('surface_id_surface_seq')";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  $id_surface = $spojeni->Record["currval"];
  return $id_surface; 
}

function ziskej_data_kapitoly($id_kapitoly) {
  $spojeni = new DB_Sql();
  $spojeni->Database = "klinopis";
  /* takhle to funguje na vetsinu textu - docasne upraveno pro prevod spatne upravenych knih */
  /*$dotaz = "select bookandchapter, paragraph, transliteration
              from obtexts 
              where trim(bookandchapter) 
                    like '".pg_escape_string(trim($id_kapitoly))."' 
              order by bookandchapter, paragraph";
  */
  
  $dotaz = "select bookandchapter, paragraph, transliteration
              from obtexts 
              where trim(bookandchapter) 
                    like '%(".pg_escape_string(trim($id_kapitoly)).",%' 
              order by bookandchapter, paragraph";
  
  $spojeni->query($dotaz);
  return $spojeni;
} // end function ziskej_data_kapitoly

function rozdel_do_skupin($bookandchapters) {
  $analyzator = new Analyzator();
  
  //print_g($bookandchapters);
  
  foreach ($bookandchapters as $type=>$array) {
  	foreach ($array as $broken=>$bach) {
  	  $data_kapitoly = ziskej_data_kapitoly($bach); 
  	  
      $analyzator->reset();
    	while($data_kapitoly->next_record()) {
  	     $transliteration = Trim( html_entity_decode( Strip_tags($data_kapitoly->Record['transliteration']) ));
	       //$analyzator->analyzuj_pred($data_kapitoly->Record["bookandchapter"]);
	       $analyzator->analyzuj_pred2($type);
	  
	       $object_type = $analyzator->object_type;
	       $surface_type = $analyzator->surface_type;
  
         $transliteration = $analyzator->analyzuj_za($data_kapitoly->Record["bookandchapter"], $transliteration);
   
         $temp[$object_type][$surface_type]['line'][] = $transliteration;
         $temp[$object_type][$surface_type]['bookandchapter'][] = $data_kapitoly->Record["bookandchapter"];
         $temp[$object_type][$surface_type]['paragraph'][] = $data_kapitoly->Record['paragraph'].priznaky_broken($broken);
      }
	  }
  }
  //print_g($temp);
	return $temp;	
} // end function rozdel_do_skupin

function priznaky_broken($pocet)
{ // BEGIN function priznaky_broken
  $str = "";
	for ($i = 0; $i < $pocet; $i++) {
 	  $str .= "'";
  }
  return $str;
} // END function priznaky_broken

function print_g($text) {
	echo "<pre>";
  print_r($text);
  echo "</pre>\n";
} // end function print_g

?>
