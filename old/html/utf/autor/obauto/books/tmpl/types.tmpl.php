
 <h2>
  Types
 </h2>
 
 <h3>
&nbsp;<?php echo $hlaska; ?>
</h3>
 
 <?php if($cosedeje == 'delete-type'): ?>
  <?php echo $dotaz; ?>
<?php else: ?>
<form action="<?php echo $PHP_SELF; ?>" method="post">
 <table>
<tr class="nadpis">
    <td>Abbrev</td>
    <td>Type</td>
    <td>&nbsp;</td>
  </tr>
<?php foreach ($types as $id=>$value): ?>
<?php //p_g($value);?>
  <tr class="akt">
      <td>
        <?php 
              echo $value['abb'];
        ?>
      </td>
      
      <td>
        <?php if($cosedeje=="edit-type" && $fokus_id == $id)
              echo '<input type="text" name="name" value="'.$value['name'].'"  size="40" />';
            else 
              echo $value['name'];
        ?>
      </td>
      
      <td> 
      <?php if( $cosedeje=="edit-type" && $fokus_id == $id ) : ?>
        <input type="hidden" name="akce" value="edit-type-save" />
        <input type="hidden" name="idtype" value="<?php echo $id?>" />
        <input type="submit" name="sButton" value="Save" />
        <input type="submit" name="sButton" value="Cancel" />
      <?php else: ?>
        <a href="types.php?akce=edit-type&amp;idtype=<?php echo $id; ?>">edit</a>
        <a href="types.php?akce=delete-type&amp;idtype=<?php echo $id; ?>">delete</a>
      <?php endif; ?>
      </td>
      

  </tr>
<?php endforeach; ?>

  <?php if( $cosedeje!="edit-type"): ?>
  <tr class="nadpis">
    <td>Add Type</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="nadpis">
    <td>Abbrev.</td>
    <td>Name</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td><input type="text" name="abb" value="" size="20" /></td>
      <td><input type="text" name="name" value=""  size="40" /></td>
      <td> 
        <input type="hidden" name="akce" value="new-type-save" />
        <input type="submit" name="sButton" value="Add" />
      </td>

  </tr>
  <?php endif;// edit-type ?>
</table>
    </form>
<?php endif; ?>
