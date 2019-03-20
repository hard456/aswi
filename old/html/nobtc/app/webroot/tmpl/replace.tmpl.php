<form action="<?php echo $PHP_SELF?>" method="post" enctype="multipart/form-data" id="replace-form">
<script src="javascript/keyboard.js" type="text/javascript" language="JavaScript"></script>
  To change any line tick the chechbox next to the line... You can also correct mistakes.<br />
  When you are ready press "Save to dbase" button. It is on the page bottom.
  <hr />

    <?php if(count($lines) <= 0):?>
      No lines with <b>'<?php echo htmlspecialchars($POST['find'])?>'</b> found...
    <?php else: ?>
    <table style="border: thin solid Black">
    <tr>
      <td><b>Old:</b> </td>
      <td><b>New:</b></td>
      <td><b>Book and chap.:</b></td>
      <td><b>Change:</b> </td>
    </tr>
      <?php foreach($lines as $id => $line): ?>
      <tr style="border: thin dotted Gray">
        <td style="border-bottom: thin dotted Gray"><?php echo highlight_found(htmlspecialchars($line), array($find) ) ?> </td>
        <td style="border-bottom: thin dotted Gray"><input type="text" name="lines[<?php echo $id?>][new]" size="70" value="<?php echo replace_found($line, $POST['find'], $POST['replace'])?>" onFocus="javascript:top.keyboard.setListener(this);" /></td>
        <td style="border-bottom: thin dotted Gray"><a href="<?php echo $html->url('/transliteration/'.$ids[$id].'/'.$POST['find'])?>"><?php echo htmlspecialchars($bachs[$id]) ?></a> </td>
        <td style="border-bottom: thin dotted Gray"><input type="checkbox" name="lines[<?php echo $id?>][proceed]" checked="checked"/></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <hr />

    <input type="submit" name="actionButton" value="<?php echo  htmlspecialchars($sec_button_label_back); ?>" />

    <input type="submit" name="actionButton" value="<?php echo  htmlspecialchars($sec_button_label); ?>" />

    <input type="hidden" name="find" value="<?php echo  htmlspecialchars($POST['find']); ?>" />
    <input type="hidden" name="replace" value="<?php echo  htmlspecialchars($POST['replace']); ?>" />
    <?php endif;?>



<hr />
</form>
<br />
<br />
<br />
<br />
<?php include 'inc/keyboard-dnd.inc.php' ?>
