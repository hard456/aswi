<?php
require_once("./administration/field.php");

if (!Empty($action) && $action == "delete_field") {
  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      //echo "Index: ".Key($smaz)."/n<br>";
      //echo "Hodnota: ".Current($smaz)."/n<br>";
      if (delete_field(Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true oborů smazáno.");
  else
    print_hlasku("Bohužel,$coun_false oborů se nepodařilo smazat ($coun_true se podařilo smazat)");
}

if (!Empty($serad)) {
  print_table_of_field($order, $od, $limit);
}
else {
  print_table_of_field();
}

?>
