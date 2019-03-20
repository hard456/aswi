  <fieldset id="transliteration-data-fieldset">
    <legend class="input-legend">Transliteration data</legend>



     <?php if (!$preview ) : ?>
    <div id="rightcorner" style="clear:both">
      <a href="edit-transliteration.php?id_transliteration=<?php echo $id_transliteration ?>">edit</a> |
      <a href="add-picture.php?id_transliteration=<?php echo $id_transliteration ?>">add picture</a> |

    </div>
    <?php endif; ?>

    <div style="clear:both">
      <?php if(count($photos)>0 || count($handcopies)>0): ?>
      <div style="float:left;width:50%">
        <h4><?php if($_REQUEST['view-pict'] == 'handcopy'):?>
              Handcopy
              <?php if(count($photos)>0): ?>
                / <a href="<?php
                $pole = $_REQUEST;
                $pole['view-pict'] = 'photo';
                echo $_SERVER['PHP_SELF']."?".get_array_as_get_string($pole).'#pict'; ?>" style="font-size:0.5em" name="pict"> Photo </a>
              <?php endif;?>
            <?php else:?>
              Photo
              <?php if(count($handcopies)>0): ?>
                / <a href="<?php
                $pole = $_REQUEST;
                $pole['view-pict'] = 'handcopy';
                echo $_SERVER['PHP_SELF']."?".get_array_as_get_string($pole).'#pict'; ?>" style="font-size:0.5em" name="pict"> Handcopy </a>
              <?php endif;?>
            <?php endif;?>
            </h4>

        <?php //p_g($photos);p_g($handcopies); ?>

        <?php if($_REQUEST['view-pict'] == 'handcopy'):?>
          <img src="<?php echo $handcopies[0]['picture']?>" alt="<?php echo $picts[0]['caption']?>" title="<?php echo $picts[0]['caption']?>" /><br />
           <?php echo $picts[0]['caption']?>
        <?php else:?>
          <img src="<?php echo $photos[0]['picture']?>" alt="<?php echo $picts[0]['caption']?>" title="<?php echo $picts[0]['caption']?>" /><br />
           <?php echo $picts[0]['caption']?>
        <?php endif;?>
        <br class="clearboth" />

        <?php  $picts = ($_REQUEST['view-pict'] == 'handcopy')? $handcopies : $photos ;

            for($i = 1; $i < count($picts); $i++):?>
        <div class="thumbnail">
          <a href="<?php echo $picts[$i]['picture']?>" target="_blank">
          <img src="<?php echo $picts[$i]['picture']?>" alt="<?php echo $picts[$i]['caption']?>" width="60" height="60"><br />
          <?php echo $picts[$i]['caption']?>
          </a>
        </div>
        <?php if(($i%6) == 0): ?>
        <!--br class="clearboth" /-->
        <?php endif; ?>
        <?php endfor;?>
        <br class="clearboth" />
      </div>
      <?php endif;?>



      <div <?php if(count($photos)>0 || count($handcopies)>0) echo 'style="float:right;width:50%"' ?>>
      <h4>Transliteration</h4>
      <?php foreach($object_type_array as $object_type_object) :?>
      <?php $object_type = $object_type_object['object_type']; ?>
      <b><?php echo $object_type?></b> <br />
      <div class="noname" id="<?php echo $object_type?>-div" >

        <?php foreach($surface_type_array as $surface_type_object) :?>
        <?php $surface_type = $surface_type_object['surface_type']; ?>
        <?php if ($POST["$object_type-$surface_type-count"] > 0): ?>
          <i><?php echo $surface_type?></i> <br />
          <?php for ($i = 0; $i < Count($POST["$object_type-$surface_type-line"]); $i++ ) :?>
            <?php echo $POST["$object_type-$surface_type-line-no"][$i]?>. <?php 
            $found = array($searchtext1, $searchtext2, $searchtext3);
            echo  highlight_found( htmlspecialchars($POST["$object_type-$surface_type-line"][$i]), $found ); ?>
            <!--<?php echo $POST["$object_type-$surface_type-line-broken"][$i]?>--> <br />
          <?php endfor; ?>
        <hr />
        <?php endif; ?>
        <?php endforeach;?>

      </div>
      <?php endforeach;?>
    </div>

    </div>
  </fieldset>
<?php //p_g($POST); ?>
