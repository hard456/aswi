<form action="<?php echo $PHP_SELF?>" method="post" enctype="multipart/form-data" id="preview-form">

<div style="display: none;">
  <?= get_array_of_hiddens_html($POST); ?>
  <?php// require_once './tmpl/insert-new-text.tmpl.php'?>
</div>

<h1>Preview of transliteration : Step 2</h1>
<h3>Please check out data, you have entered in the first step.</h3>

<?php
require_once('./tmpl/preview-book.tmpl.php');
?>


<?php
require_once('./tmpl/preview-transliteration-data.tmpl.php');
?>

<?php 
  $preview = true;
  require('./tmpl/transliteration.tmpl.php');
?>

<input type="submit" name="actionButton" value="<?php echo htmlspecialchars($sec_button_label_back); ?>" />

<input type="submit" name="actionButton" value="<?php echo htmlspecialchars($sec_button_label); ?>" />

</form>
