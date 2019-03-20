<h1>Edit book : <?php echo $POST['book_abrev']?> - <?php echo $POST['book_name']?></h1>

<form action="<?php echo $PHP_SELF?>" method="post" enctype="multipart/form-data" id="book-edit-form">

<fieldset id="book-edit-fieldset">
    <legend class="input-legend">Book edit</legend>
  <?php require('tmpl/book-edit-panel.tmpl.php');?>
  
</fieldset>

<input type="hidden" name="actione" value="save" />
<input type="submit" name="actionButton" value="<?php echo htmlspecialchars($button_label); ?>" />

</form>


