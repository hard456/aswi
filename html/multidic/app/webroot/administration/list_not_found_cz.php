<?php

require_once("./administration/not_found.php");

if (!Empty($action) && $action == "delete_not_found") {
  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      if (delete_not_found("not_found_cz", Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true výrazů smazáno.");
  else
    print_hlasku("Bohužel,$coun_false výrazů se nepodařilo smazat ($coun_true se podařilo smazat)");
}


if (!Empty($serad)) {
  print_table_of_not_found("not_found_cz", $order, $od, $limit);
}
else {
  print_table_of_not_found("not_found_cz");
}


?>
