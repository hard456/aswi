<?php
require_once("./examination/article.php");

$article = get_article($article_id);

?>
<h4>Detail článku</h4>
<div class="card" style="width:90%">
   <h2 class="arabic" align="center"> <?php echo $article["title"]?> </h2>


  <p>&nbsp;&nbsp;&nbsp; <b>jazyk:</b> <?php echo $article["language"]?></p>

  <p>&nbsp;&nbsp;&nbsp; <b>zdroj:</b> <?php echo $article["source"]?></p>

  <p>&nbsp;&nbsp;&nbsp; <b>lekce:</b> <?php echo $article["lection"]?></p>
  <p>&nbsp;</p>

  <!--p>&nbsp;&nbsp;&nbsp;<?php echo $article["title"]?></p-->


  <p class="arabic">&nbsp;&nbsp;&nbsp;<?php echo nl2br($article["body"])?></p>

  <p>&nbsp;</p>
  <p>&nbsp;&nbsp;&nbsp; <b>poznámka:</b> <?php echo $article["note"]?></p>

  <p>&nbsp;&nbsp;&nbsp; <b>zvuk:</b> <?php
  if (Empty($article["article_voice"]))
    echo "není";
  else
    echo '<a href="'.CESTA_CLANKU.$article['IDarticle'].PRIPONA.'"> přehrát </a>';

    ?></p>

</div>

<?php echo_zpet_do_clanku(); ?>
