<form action="<?php echo $PHP_SELF?>" method="post" enctype="multipart/form-data" id="replace-form">
<script src="javascript/keyboard.js" type="text/javascript" language="JavaScript"></script>
  This script can replace one group of characters in all texts.
  <table>
    <tr>
      <td><b>Find:</b> </td>
      <td><input type="text" name="find" value="<?php echo $POST['find']?>" onFocus="javascript:top.keyboard.setListener(this);" /></td>
    </tr>
    <tr>
      <td>Replace with: </td>
      <td><input type="text" name="replace" value="<?php echo $POST['replace']?>" onFocus="javascript:top.keyboard.setListener(this);" /></td>
    </tr>
  </table>

  <input type="submit" name="actionButton" value="<?php echo  htmlspecialchars($first_button_label); ?>" />
</form>
<br />
<br />
<?php include 'inc/keyboard-dnd.inc.php' ?>
