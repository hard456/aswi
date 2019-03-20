<?php
  
  require_once("./functions/dictionary.php");
  require_once("./classes/db.php");
  
  $spojeni = new DB_Sql();
  $dotaz = "DELETE FROM author_of_source WHERE \"IDsource\" = $source_id AND \"IDauthor\" = $author_id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Autora se nepodařilo odebrat");
  }
  print_hlasku("Autor odebrán");
  echo_zpet_do_zdroju();
  
?>
