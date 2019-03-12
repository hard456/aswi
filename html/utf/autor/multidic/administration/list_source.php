<?php

require_once("./administration/source.php");

if (!Empty($action) && $action == "delete_source") {
  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      if (delete_source(Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true zdrojů smazáno.");
  else
    print_hlasku("Bohužel,$coun_false zdrojů se nepodařilo smazat ($coun_true se podařilo smazat)");
}


if (!Empty($serad)) {
  print_table_of_source($order, $od, $limit);
}
else {
  print_table_of_source();
}



?>
