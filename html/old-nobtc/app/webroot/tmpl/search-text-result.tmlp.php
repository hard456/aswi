<a href="show-transliteration.php?id_transliteration=<?php echo urlencode($id_transliteration);
if(!empty($found1)) echo "&searchtext1=".urlencode($found1);
if(!empty($found2)) echo "&searchtext2=".urlencode($found2);
if(!empty($found3)) echo "&searchtext3=".urlencode($found3);
?>">

<?php echo $book_abrev.", ".$chapter; ?></a>
<table>
  <?php if ($dots_before):?>
  <tr>
    <td></td>
    <td>...</td>
  </tr>
  <?php endif;?>
  <?php if (!empty($array_lines_before) && is_array($array_lines_before)): ?>
    <?php foreach($array_lines_before as $key => $value): ?>
    <tr>
      <td><?php echo $key?>.</td>
      <td><?php echo $value?> </td>
    </tr>
    <?php endforeach; ?>
  <?php endif;?>
  
  <!-- main found line -->
  <tr>
    <td class="linefound"><?php echo $line_no?>.</td>
    <td> <?php 
    $found = array($found1, $found2, $found3);
    echo ( highlight_found(htmlspecialchars($line_transliteration), $found));
    ?> </td>
  </tr>
  <!-- end of main found line -->
  
  <?php if (!empty($array_lines_after) && is_array($array_lines_after)): ?>
    <?php foreach($array_lines_after as $key => $value): ?>
    <tr>
      <td><?php echo $key?>.</td>
      <td><?php echo $value?> </td>
    </tr>
    <?php endforeach; ?>
  <?php endif;?>
  
  <?php if($dots_after):?>
  <tr>
    <td></td>
    <td>...</td>
  </tr>
  <?php endif;?>
</table>

<hr />


