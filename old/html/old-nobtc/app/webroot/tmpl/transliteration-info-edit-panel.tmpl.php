
    <table>
      <tr title="Chapter in referenced book">
        <td><label for="chapter">Chapter in referenced book:</label></td>
        <td><input type="text" id="chapter" name="chapter" size="20" maxlength="20" value="<?=$POST['chapter']?>" /></td>
      </tr>
      <tr title="Museum">
        <td><label for="id_museum">Museum:</label></td>
        <td>
          <?php chooser_get_museum($POST['id_museum']); ?>
        </td>
      </tr>
      
      <tr title="Museum number">
        <td><label for="museum_no">Museum no:</label></td>
        <td><input type="text" id="museum_no" name="museum_no" size="40" maxlength="40" value="<?=$POST['museum_no']?>" /></td>
      </tr>
      
      <tr title="Origin of the object">
        <td><label for="id_origin">Origin:</label></td>
        <td>
          <?php chooser_get_origin($POST['id_origin']); ?>
        </td>
      </tr>
      
      <tr title="Select type of the transliteration">
        <td><label for="id_book_type">Type:</label> </td>
          <td>
            <?php chooser_get_book_type($POST['id_book_type']); ?>
          </td>
      </tr>
      
      <tr title="Registration or excavation number">
        <td><label for="reg_no">Registration number:</label></td>
        <td>
          <input type="text" id="reg_no" name="reg_no" size="50" maxlength="255" value="<?php echo $POST['reg_no']?>" />
        </td>
      </tr>
      
      <tr title="Date">
        <td><label for="date">Date:</label></td>
        <td>
          <input type="text" id="date" name="date" size="50" maxlength="255" value="<?php echo $POST['date']?>" />
        </td>
      </tr>
      
      <tr title="Note">
        <td><label for="note">Note:</label></td>
        <td>
          <input type="text" id="note" name="note" size="50" maxlength="255" value="<?php echo $POST['note']?>" />
        </td>
      </tr>
      
      <tr title="References from literature">
        <td>References<br /> (series, number, page)</td>
        <td>
          <div id="references-row" class="row">
            <!-- Space for javascript including of references -->
          </div>
          <div id="references-link">
            <a href="#" 
               title="Add reference" 
               id="adding-reference" 
               onclick="return top.references.addReference('', '', '', 'Delete');">
                  Add reference</a>
          </div>
        </td>
      </tr>
    </table>
    <?php //p_g($POST);?>
    <? if (!Empty($POST['series']) && is_array($POST['series']) ):  ?>
    <script type="text/javascript" language="JavaScript">
      //onLoad
      <? for ($i = 0; $i < Count($POST['series']); $i++ ) : ?>
      top.references.addReference('<?=$POST['series'][$i]?>', '<?=$POST['number'][$i]?>', '<?=$POST['page'][$i]?>', 'Delete');
      <? endfor; ?>
    </script> 
    <? endif; ?> 
