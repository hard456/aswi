<form action="<?php echo $PHP_SELF ?>"  method="post" enctype="multipart/form-data">
<h3>Analisys of file <?php echo $soubor_name ?></h3>
<h3>Please check out all data!!!</h3>
<h3>If any mistakes, please do not save to database.</h3>

Total: <?php echo count($transliterations['translits']) ?> transliteration(s).<br />

<?
$preview = true;
foreach($transliterations['translits'] as $key=>$POST ) {
  //p_g($POST);
  echo "Book and chapter: $key <br /> \n";
  include ('./tmpl/transliteration.tmpl.php');
  echo "<br /><br />";
}

//p_g($transliterations);

echo get_array_of_hiddens_html($transliterations);

//pole hidnu
?>

<input type="submit" name="actionButton" value="<?= htmlspecialchars($sec_button_label_back); ?>" />

<input type="submit" name="actionButton" value="<?= htmlspecialchars($sec_button_label); ?>" />

</form>
