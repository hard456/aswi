<h1>Edit transliteration info : <?php $pole = get_book($POST['id_book']);
                                      echo $pole['book_abrev'] ?>, <?php echo $POST['chapter'] ?></h1>
<script src="javascript/inserttext.js" type="text/javascript" language="JavaScript"></script>
<div class="noname" id="transliteration-info">
  <form action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" id="edit-trinfo-form">
  <fieldset id="transliteration-info-fieldset">
    <legend class="input-legend">Transliteration information</legend>
    <table>
      <tr title="Book">
        <td><label for="id_book">Book:</label></td>
        <td>
        <?php chooser_get_book($POST['id_book']); ?>
        </td>
      </tr>
    </table>
      <?php require('tmpl/transliteration-info-edit-panel.tmpl.php');?>
  </fieldset>
  <input type="submit" name="actionButton" value="<?= htmlspecialchars($button_label); ?>" />
  </form>
</div>
