<?php

require_once("./administration/translation_lang.php");

if (!Empty($action) && $action == "delete_translation_lang") {


  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      if (delete_translation_lang(Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true jazyků smazáno.");
  else
    print_hlasku("Bohužel,$coun_false jazyků se nepodařilo smazat ($coun_true se podařilo smazat)");
}

if (!Empty($serad)) {
    print_table_of_translation_lang($order, $od, $limit);
}
else {
  print_table_of_translation_lang();
}


?>
