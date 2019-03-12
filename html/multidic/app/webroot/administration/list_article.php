<?php

if ($cesta == "./examination/")
  require_once("./examination/article.php");
else
  require_once("./administration/article.php");

if (Empty($language)) :


?>
  <p>Vyberte jazyk:</p>
  <p>
    <a href="?nav_id=<?php echo $nav_id?>&language=1<?php echo $pomocna?>">arabský</a><br />
    <a href="?nav_id=<?php echo $nav_id?>&language=2<?php echo $pomocna?>">hebrejský</a><br />
    <a href="?nav_id=<?php echo $nav_id?>&language=3<?php echo $pomocna?>">akkadský</a><br /><br />

    <a href="?nav_id=<?php echo $nav_id?>&language=all&contrains_source=all&contrains_lection=all">všechny</a>
  </p>
<?php

elseif ($language != "all" && Empty($contrains_source)):
?>
  <p>Vyberte zdroj:</p>
  <p><form method="post">

     <?php
echo get_source_chooser($language, "contrains_source");
?>
     <input type="submit" value="Dál" />
     </form>
   <br /> <a href="?nav_id=<?php echo $nav_id?>&language=<?php echo $language?>&contrains_source=all&contrains_lection=all">všechny</a>
  </p>
<?php
elseif ($language != "all" && $contrains_source != "all" && Empty($contrains_lection)):
?>
  <p>Vyberte lekci:</p>
  <p><form method="post">

     <?php
echo get_lection_chooser_article($contrains_source, 1, "contrains_lection");
?>
     <input type="submit" value="Dál" />
     <input type="hidden" name="contrains_source" value="<?php echo $contrains_source?>" title="Dál" />
     </form>
   <br /> <a href="?nav_id=<?php echo $nav_id?>&language=<?php echo $language?>&contrains_source=<?php echo $contrains_source?>&contrains_lection=all">všechny</a>
  </p>
<?php
else :
//obsluha mazani slovicek
if (!Empty($action) && $action == "delete_article") {
  if (delete_article($article_id))
    print_hlasku("Článek smazán.");
  else
    print_hlasku("Článek se nepodařilo smazat");

  /*$coun_true = 0;
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
    print_hlasku("$coun_true článků smazáno.");
  else
    print_hlasku("Bohužel,$coun_false článků se nepodařilo smazat ($coun_true se podařilo smazat)");*/
}

//obsluha autorizace slovicka
if (!Empty($nav_id) && $nav_id == "autorize_article") {

  if (authorize_article($article_id))
    print_hlasku("Článek autorizován.");
  else
    print_hlasku("Bohužel, článek se nepodařilo autorizovat.");
}

if ($nav_id == "list_artile") $pomocna = false;
else if ($nav_id == "list_nonauthorized_article") $pomocna = true;
else  $pomocna = ($nonauthorized == true);
//pr($nav_id);
//vypis
if (!Empty($serad)) {
    print_table_of_article($language, $contrains_source, $contrains_lection,$pomocna, $order, $od, $limit);
}
else {
  print_table_of_article($language, $contrains_source, $contrains_lection, $pomocna);
}

endif;
?>
