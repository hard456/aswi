<h1>Edit transliteration : <?php echo get_bookandchapter_from_id_transliteration($id_transliteration)?></h1>
<script src="javascript/inserttext.js" type="text/javascript" language="JavaScript"></script>
<script src="<?php echo $html->url('/javascript/keyboard.js')?>" type="text/javascript" language="JavaScript"></script>

<form action="<?php echo $PHP_SELF?>" method="post" enctype="multipart/form-data" id="edit-form">

  <?php require('tmpl/transliteration-data-edit-panel.tmpl.php');?>

<input type="submit" name="actionButton" value="<?php echo  htmlspecialchars($button_label); ?>" />

</form>

<?php include 'inc/keyboard-dnd.inc.php' ?>

