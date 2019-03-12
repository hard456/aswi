<h1>Edit transliteration : <?=get_bookandchapter_from_id_transliteration($id_transliteration)?></h1>
<script src="javascript/inserttext.js" type="text/javascript" language="JavaScript"></script>
<script src="javascript/keyboard.js" type="text/javascript" language="JavaScript"></script>

<form action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" id="edit-form">

  <?php require('tmpl/transliteration-data-edit-panel.tmpl.php');?>

<input type="submit" name="actionButton" value="<?= htmlspecialchars($button_label); ?>" />

</form>

<? include 'inc/keyboard-dnd.inc.php' ?>

