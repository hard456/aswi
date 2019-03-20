<?php

require_once("./administration/author.php");

if (!Empty($action) && $action == "delete_author") {
  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      if (delete_author(Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true autorů smazáno.");
  else
    print_hlasku("Bohužel,$coun_false autorů se nepodařilo smazat ($coun_true se podařilo smazat)");
}


if (!Empty($serad)) {
  print_table_of_author($order, $od, $limit);
}
else {
  print_table_of_author();
}


?>
