<?php

require_once("./administration/word.php");

if (Empty($language)) :
?>
  <p>Vyberte slovník:</p>
  <p>
    <a href="?nav_id=list_word&language=1">Arabský</a><br />
    <a href="?nav_id=list_word&language=2">Hebrejský</a><br />
    <a href="?nav_id=list_word&language=3">Akkadský</a><br /><br />
    
    <a href="?nav_id=list_word&language=all">Všechny</a>
  </p>
<?php
else :
//obsluha mazani slovicek
if (!Empty($action) && $action == "delete_word") {
  $coun_true = 0;
  $coun_false = 0;
  if (Is_Array($smaz)) {
    for (Reset($smaz); Current($smaz); Next($smaz)) {
      //echo "Index: ".Key($smaz)."\n<br>";
      //echo "Hodnota: ".Current($smaz)."\n<br>";
      if (delete_word(Key($smaz))) $coun_true++;
      else $coun_false++;
    }
  }
  if ($coun_false == 0)
    print_hlasku("$coun_true slovíček smazáno.");
  else
    print_hlasku("Bohužel,$coun_false slovíček se nepodařilo smazat ($coun_true se podařilo smazat)");
}

//obsluha mazani kontextu
if (!Empty($nav_id) && $nav_id == "delete_context") {
  require_once("./administration/context.php");
      
  if (delete_context($context_id, $word_id))
    print_hlasku("Kontext smazán.");
  else
    print_hlasku("Bohužel, kontext se nepodařilo smazat.");
}


//vypis
if (!Empty($serad)) {
    print_all_in_dict($language, false, "all", $order, $od, $limit);
}
else {
  print_all_in_dict($language, false, "all");
}

endif;
?>
