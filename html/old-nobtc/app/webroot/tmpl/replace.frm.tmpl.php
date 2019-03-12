<form action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" id="replace-form">
<script src="javascript/keyboard.js" type="text/javascript" language="JavaScript"></script>
  This script can replace one group of characters in all texts.
  <table>
    <tr>
      <td><b>Find:</b> </td>
      <td><input type="text" name="find" value="<?=$POST['find']?>" onFocus="javascript:top.keyboard.setListener(this);" /></td>
    </tr>
    <tr>
      <td>Replace with: </td>
      <td><input type="text" name="replace" value="<?=$POST['replace']?>" onFocus="javascript:top.keyboard.setListener(this);" /></td>
    </tr>
  </table>

  <input type="submit" name="actionButton" value="<?= htmlspecialchars($first_button_label); ?>" />
</form>
<br />
<br />
<? include 'inc/keyboard-dnd.inc.php' ?>
