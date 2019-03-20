<?php


//NEPOUZIVA SE//


require_once("./administration/word.php");

if (Empty($language)) :

if (!Empty($contrains_user_id))
  $pomocna = "&contrains_user_id=$contrains_user_id";
else $pomocna = "";

?>
  <p>Vyberte slovník:</p>
  <p>
    <a href="?nav_id=list_nonauthorized_word&language=1<?php echo $pomocna?>">arabský</a><br />
    <a href="?nav_id=list_nonauthorized_word&language=2<?php echo $pomocna?>">hebrejský</a><br />
    <a href="?nav_id=list_nonauthorized_word&language=3<?php echo $pomocna?>">akkadský</a><br /><br />
    
    <a href="?nav_id=list_nonauthorized_word&language=all<?php echo $pomocna?>">všechny</a>
  </p>
<?php

elseif ($language != "all" && Empty($contrains_source)):
?>
  <p>Vyberte zdroj:</p>
  <p><form method="post">

     <?php 
echo get_source_chooser($language, "contrains_source");
?>   
     <input type="submit" title="Dál" />
     </form>
   <br /> <a href="?nav_id=list_word&language=<?php echo $language?>&contrains_source=all">všechny</a>
  </p>
<?php   
elseif ($language != "all" && $contrains_source != "all" && Empty($contrains_lection)):
?>
  <p>Vyberte lekci:</p>
  <p><form method="post">

     <?php 
echo get_lection_chooser($contrains_source, 1, "contrains_lection");
?>   
     <input type="submit" value="Dál" />
     <input type="hidden" name="contrains_source" value="<?php echo $contrains_source?>" title="Dál" />
     </form>
   <br /> <a href="?nav_id=list_word&language=<?php echo $language?>&contrains_source=<?php echo $contrains_source?>&contrains_lection=all">všechny</a>
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

//obsluha autorizace slovicka
if (!Empty($nav_id) && $nav_id == "authorize_word") {
      
  if (authorize_word($word_id))
    print_hlasku("Slovíčko autorizováno.");
  else
    print_hlasku("Bohužel, slovo se nepodařilo autorizovat.");
}
//dulezita pojistka
if (Empty($contrains_user_id)) $contrains_user_id = "all";

//vypis
if (!Empty($serad)) {
    print_all_in_dict($language,  $contrains_source, $contrains_lection, true, $contrains_user_id, $order, $od, $limit);
}
else {
  print_all_in_dict($language,  $contrains_source, $contrains_lection, true, $contrains_user_id);
}

endif;
?>
