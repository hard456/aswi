<?php
if ($soubor) {
  $radky = file($soubor);
}
echo nl2br($file);

$transliteration_count = 0; //pocet tabulek
$analyz = new Analyzator();
$nova = true;
$book = '';
$chapter = '';

for($i = 0; $i < count($radky); $i++) {
  if ($nova) {
    //echo "nova ".$radky[$i]." <br />";
    $transliteration_count++;
    
    $posit = strpos($radky[$i], "|");
    $book = Trim( Substr($radky[$i], $posit+1) );
    $nova = false;
    $obj_sur = $analyz->object_type."-".$analyz->surface_type;
    //$transliterations[$book]["$obj_sur-count"] = 0;
  }
  else if (Empty($radky[$i])) {
    //echo "prazdna ".$radky[$i]." <br />";
    $analyz->reset();
    $nova = true;
  }
  else if(substr($radky[$i], 0, 1) == '|') {
    //echo "treti ".$radky[$i]." book: $book <br />";
    $chapter = trim( substr($radky[$i], 1) );
    $analyz->reset();
    $bach = $book."  ".$chapter;
    $analyz->analyzuj_pred2($chapter);
    $obj_sur = $analyz->object_type."-".$analyz->surface_type;
    $transliterations['translits'][$bach]["$obj_sur-count"] = 0;
  }
  else {
    //echo "else ".$radky[$i]." <br />";
    $obj_sur = $analyz->object_type."-".$analyz->surface_type;
    $transliterations['translits'][$bach]['book'] = $book;
    $transliterations['translits'][$bach]['chapter'] = $chapter;
    $pos = strpos($radky[$i], " ");
    $transliterations['translits'][$bach]["$obj_sur-line-no"][] = Substr($radky[$i], 0, $pos);
    $transliterations['translits'][$bach]["$obj_sur-line"][] = $analyz->analyzuj_za( $chapter, Trim( Substr($radky[$i], $pos+1) ) );//Trim( Substr($radky[$i], $pos+1) );
    $transliterations['translits'][$bach]["$obj_sur-count"] ++;
    
  }
}

//p_g($transliterations);
?>
