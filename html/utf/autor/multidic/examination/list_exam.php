<?php

require_once("./examination/exam.php");

if (!Empty($action) && $action == "delete_user") {


  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      if (delete_user(Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true uživatelů smazáno.");
  else
    print_hlasku("Bohužel,$coun_false uživatelů se nepodařilo smazat ($coun_true se podařilo smazat)");
}


print_table_of_examing();

?>
