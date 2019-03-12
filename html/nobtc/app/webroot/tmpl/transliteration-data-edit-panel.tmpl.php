<div class="noname" id="transliteration-data">

  <fieldset id="transliteration-data-fieldset">
    <legend class="input-legend">Transliteration data</legend>

    <?php//p_g($object_type_array) ?>

    <?php  foreach($object_type_array as $object_type_object) :?>
    <?php  $object_type = $object_type_object['object_type'];?>
    <script type="text/javascript" language="JavaScript">var showBranchOfTree = false;</script>
    <a href="#"
       title="Show or hide <?php echo $object_type?>"
       id="show-hide-<?php echo $object_type?>"
       onclick="return top.transliteration.showTree('<?php echo $object_type?>');">
      <img src="./img/plus.gif" alt="List" title="plus" width="20" class="noborder" id="<?php echo $object_type?>-img" />
    </a> <?php echo $object_type?>
    <br />
    <div class="noname" id="<?php echo $object_type?>-div" style="display:none">

      <?php  foreach($surface_type_array as $surface_type_object) :?>
      <?php  $surface_type = $surface_type_object['surface_type']; ?>

      <input type="hidden"
             name="<?php echo $object_type?>-<?php echo $surface_type?>-count"
             id="<?php echo $object_type?>-<?php echo $surface_type?>-count"
             value = "0" />

      <img src="./img/line.gif"  class="noborder"/>
      <a href="#"
         title="Show or hide surface <?php echo $surface_type?>"
         id="show-hide-<?php echo $object_type?>-<?php echo $surface_type?>"
         onclick="return top.transliteration.showTree('<?php echo $object_type?>-<?php echo $surface_type?>');">

        <img src="./img/minus.gif"
             alt="List"
             title="minus"
             class="noborder"
             width="20"
             id="<?php echo $object_type?>-<?php echo $surface_type?>-img" />
      </a> <?php echo $surface_type?>

      <div class="noname" id="<?php echo $object_type?>-<?php echo $surface_type?>-div" style="display:inline">
      <a href="#"
           title="Add line"
           id="<?php echo $object_type?>-<?php echo $surface_type?>-adding-line"
           onclick="return top.transliteration.addLine( '<?php echo $object_type?>-<?php echo $surface_type?>', '', '', 'Delete line', '');">Add line</a>

        <!-- Space for javascript including of lines -->
      </div>
      <br />
      <?php  if (!Empty($POST["$object_type-$surface_type-line-no"]) || !Empty($POST["$object_type-$surface_type-line"])): ?>
      <script type="text/javascript" language="JavaScript">
      //onLoad - set all lines - correcting
          var elemCount = top.utils.gEI('<?php echo "$object_type-$surface_type-count"?>');
          elemCount.value = 0;
        <?php for ($i = 0; $i < Count($POST["$object_type-$surface_type-line"]); $i++ ) :?>
          top.transliteration.addLine('<?php echo $object_type?>-<?php echo $surface_type?>',
                                      '<?php echo addslashes($POST["$object_type-$surface_type-line-no"][$i])?>',
                                      "<?php echo ($POST["$object_type-$surface_type-line"][$i]) ?>",
                                      'Delete line',
                                      '<?php echo $POST["$object_type-$surface_type-line-broken"][$i]?>');
          showBranchOfTree = true;
        <?php  endfor; ?>
      </script>
      <?php  endif; ?>

      <?php  endforeach;?>

    </div>
    <script type="text/javascript" language="JavaScript">
      //onLoad - display not epmty parts of tree
      if (showBranchOfTree)
        top.transliteration.showTree('<?php echo $object_type?>');
      showBranchOfTree = false;
    </script>
    <?php  endforeach;?>

  </fieldset>
</div>
