<form action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" id="replace-form">
<script src="javascript/keyboard.js" type="text/javascript" language="JavaScript"></script>
  To change any line tick the chechbox next to the line... You can also correct mistakes.<br />
  When you are ready press "Save to dbase" button. It is on the page bottom.
  <hr />
    
    <? if(count($lines) <= 0):?>
      No lines with <b>'<?=htmlspecialchars($POST['find'])?>'</b> found...
    <? else: ?>
    <table style="border: thin solid Black"> 
    <tr>
      <td><b>Old:</b> </td>
      <td><b>New:</b></td> 
      <td><b>Book and chap.:</b></td>
      <td><b>Change:</b> </td>
    </tr>
      <? foreach($lines as $id => $line): ?>
      <tr style="border: thin dotted Gray">
        <td style="border-bottom: thin dotted Gray"><?=highlight_found(htmlspecialchars($line), array($find) ) ?> </td>
        <td style="border-bottom: thin dotted Gray"><input type="text" name="lines[<?=$id?>][new]" size="70" value="<?php echo replace_found($line, $POST['find'], $POST['replace'])?>" onFocus="javascript:top.keyboard.setListener(this);" /></td>
        <td style="border-bottom: thin dotted Gray"><a href="show-transliteration.php?id_transliteration=<?php echo $ids[$id]; ?>&searchtext1=<?php echo $POST['find']?>"><?=htmlspecialchars($bachs[$id]) ?></a> </td>
        <td style="border-bottom: thin dotted Gray"><input type="checkbox" name="lines[<?=$id?>][proceed]" checked="checked"/></td>
      </tr>
      <? endforeach; ?>
    </table>
    <hr />
  
    <input type="submit" name="actionButton" value="<?= htmlspecialchars($sec_button_label_back); ?>" />

    <input type="submit" name="actionButton" value="<?= htmlspecialchars($sec_button_label); ?>" />

    <input type="hidden" name="find" value="<?= htmlspecialchars($POST['find']); ?>" />
    <input type="hidden" name="replace" value="<?= htmlspecialchars($POST['replace']); ?>" />
    <? endif;?> 
  


<hr />
</form>
<br />
<br />
<br />
<br />
<? include 'inc/keyboard-dnd.inc.php' ?>
