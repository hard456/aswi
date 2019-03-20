

 <?php 
    $found = array($found1, $found2, $found3);
    echo ( highlight_found(htmlspecialchars($line_transliteration), $found));
    ?>
    <br />
    
<input name="line[<?php echo $id_line ?>]" id="line_<?php echo $id_line ?>" type="checkbox" checked="checked" />
<label for="line_<?php echo $id_line ?>">Add  
<strong><?php echo "$book_abrev, $chapter, $line_no"; ?></strong></label>
<hr />


