<?php
$connection = new DB_Sql();
$counter = 0;

foreach($POST['lines'] as $id => $helpa) {
  //p_g($helpa);
  $proceed = $helpa['proceed'];
  $new     = $helpa['new'];
  
  if(!empty($proceed)) {
    $dotaz = "UPDATE line SET transliteration = '".pg_escape_string($new)."' WHERE id_line = $id";
    //p_g($dotaz);
    $connection->query($dotaz);
    $counter++;
  }
}

//spustit a vyhodnotit
?>

<h2><?=$counter?> lines changed.</h2> 

You can find next <?=$MAX_LINES?> lines and correct it. Use this <a href="<?=$PHP_SELF?>?find=<?=htmlentities($POST['find'])?>&replace=<?=htmlentities($POST['replace'])?>&konec=konec">link</a>.

