<?php

foreach($object_type_array as $object_type_object) {
  $object_type = StrTr($object_type_object['object_type'], " ", "_");
  
  //p_g("$object_type \n");
  
  foreach($surface_type_array as $surface_type_object) {
    $surface_type = StrTr($surface_type_object['surface_type'], " ", "_");
    
    //p_g("$surface_type \n");
    
    $count = $POST["$object_type-$surface_type-count"];
    
    //p_g("count: $count  \n");
    
    
    if (!Empty($count) && $count > 0) {
      
      $id_object_type = $object_type_object['id_object_type'];
      $id_surface_type = $surface_type_object['id_surface_type'];
    
      $dotaz = "INSERT INTO surface (column_number, id_transliteration, id_object_type, id_surface_type) VALUES (0, ".
                $id_transliteration . ", " . $id_object_type . ", " . $id_surface_type . ")";
      $connection->query($dotaz);
      $id = $connection->currval('surface_id_surface_seq');
      $id_surface = $id;
      
        //a pro kazdou radku v tomu object-surface
        //vlozit radek do line
      //p_g($POST["$object_type-$surface_type-line"]);
      $keys = array_keys($POST["$object_type-$surface_type-line"]);
      foreach ($keys as $k=>$i) {
      	
        $line_broken = (Empty($POST["$object_type-$surface_type-line-broken"][$i]))? 'false' : 'true' ;
      	$dotaz = "INSERT INTO line (transliteration, line_number, id_surface, broken) VALUES ('".
                  pg_escape_string(Trim( $POST["$object_type-$surface_type-line"][$i] ))."', '".
                  pg_escape_string(Trim( $POST["$object_type-$surface_type-line-no"][$i] ))."', ".
                  $id_surface.", ".
                  $line_broken.")";
       //p_g($dotaz);
      	$connection->query($dotaz);
      	
      }
    }
  }
}
?>
