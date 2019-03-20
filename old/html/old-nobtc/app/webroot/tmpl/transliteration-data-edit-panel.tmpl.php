<div class="noname" id="transliteration-data">
 
  <fieldset id="transliteration-data-fieldset">
    <legend class="input-legend">Transliteration data</legend>
  
    <?//p_g($object_type_array) ?>
    
    <? foreach($object_type_array as $object_type_object) :?>
    <? $object_type = $object_type_object['object_type'];?>
    <script type="text/javascript" language="JavaScript">var showBranchOfTree = false;</script>
    <a href="#" 
       title="Show or hide <?=$object_type?>" 
       id="show-hide-<?=$object_type?>" 
       onclick="return top.transliteration.showTree('<?=$object_type?>');">
      <img src="./img/plus.gif" alt="List" title="plus" width="20" class="noborder" id="<?=$object_type?>-img" />
    </a> <?=$object_type?>
    <br />
    <div class="noname" id="<?=$object_type?>-div" style="display:none">
      
      <? foreach($surface_type_array as $surface_type_object) :?>
      <? $surface_type = $surface_type_object['surface_type']; ?>
      
      <input type="hidden" 
             name="<?=$object_type?>-<?=$surface_type?>-count" 
             id="<?=$object_type?>-<?=$surface_type?>-count" 
             value = "0" />
      
      <img src="./img/line.gif"  class="noborder"/>
      <a href="#" 
         title="Show or hide surface <?=$surface_type?>" 
         id="show-hide-<?=$object_type?>-<?=$surface_type?>" 
         onclick="return top.transliteration.showTree('<?=$object_type?>-<?=$surface_type?>');">
         
        <img src="./img/minus.gif" 
             alt="List" 
             title="minus"  
             class="noborder" 
             width="20" 
             id="<?=$object_type?>-<?=$surface_type?>-img" />
      </a> <?=$surface_type?>
      
      <div class="noname" id="<?=$object_type?>-<?=$surface_type?>-div" style="display:inline">
      <a href="#" 
           title="Add line" 
           id="<?=$object_type?>-<?=$surface_type?>-adding-line" 
           onclick="return top.transliteration.addLine( '<?=$object_type?>-<?=$surface_type?>', '', '', 'Delete line', '');">Add line</a>
      
        <!-- Space for javascript including of lines -->
      </div>
      <br />
      <? if (!Empty($POST["$object_type-$surface_type-line-no"]) || !Empty($POST["$object_type-$surface_type-line"])): ?>
      <script type="text/javascript" language="JavaScript">
      //onLoad - set all lines - correcting
          var elemCount = top.utils.gEI('<?="$object_type-$surface_type-count"?>');
          elemCount.value = 0;
        <?php for ($i = 0; $i < Count($POST["$object_type-$surface_type-line"]); $i++ ) :?>
          top.transliteration.addLine('<?php echo $object_type?>-<?=$surface_type?>', 
                                      '<?php echo addslashes($POST["$object_type-$surface_type-line-no"][$i])?>', 
                                      "<?php echo ($POST["$object_type-$surface_type-line"][$i]) ?>", 
                                      'Delete line',
                                      '<?php echo $POST["$object_type-$surface_type-line-broken"][$i]?>');
          showBranchOfTree = true;
        <? endfor; ?>
      </script> 
      <? endif; ?>
      
      <? endforeach;?>
      
    </div>
    <script type="text/javascript" language="JavaScript">
      //onLoad - display not epmty parts of tree
      if (showBranchOfTree)
        top.transliteration.showTree('<?=$object_type?>');
      showBranchOfTree = false;
    </script>
    <? endforeach;?>
        
  </fieldset>
</div>
