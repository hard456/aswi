
 <h2>
  Authors
 </h2>
 
 
<?php if(!empty($knihy_autora)) $hlaska = "This author has following books:";
      else if($REQUEST['akce'] == "delete-author") $hlaska = "Really delete this author?" ; ?>

<h3>
&nbsp;<?php echo $hlaska; ?>
</h3>

<?php if(!empty($knihy_autora)): ?>
  <?php p_g($knihy_autora);?>
<?php elseif($REQUEST['akce'] == "delete-author"):?>
  <form action="<?php echo $PHP_SELF; ?>" method="post" >
  <input type="submit" name="confirmButton" value="Delete" />
  <input type="hidden" name="idauthor" value="<?php echo $REQUEST['idauthor']?>" />
  <input type="hidden" name="akce" value="really-delete-author" />
</form>
<?php endif; ?>


 <?php if($cosedeje == 'delete-autora'): ?>
  <?php echo $dotaz; ?>
<?php else: ?>
<form action="<?php echo $PHP_SELF; ?>" method="post">
 <table>
<tr class="nadpis">
    <td>Title before</td>
    <td>Name</td>
    <td>Surname</td>
    <td>Title after</td>
    <td>&nbsp;</td>
  </tr>
<?php foreach ($autori as $id=>$value): ?>
<?php //p_g($value);?>
  <tr class="akt">
    
      
      <td>
        <?php 
            if($cosedeje=="edit-autor" && $fokus_id == $id)
              echo '<input type="text" name="titlebefore" value="'.$value['titlebefore'].'"  size="20" />';
            else 
              echo $value['titlebefore'];
        ?>
      </td>
      
      <td>
        <?php if($cosedeje=="edit-autor" && $fokus_id == $id)
              echo '<input type="text" name="name" value="'.$value['name'].'"  size="40" />';
            else 
              echo $value['name'];
        ?>
      </td>
      <td>
        <?php if($cosedeje=="edit-autor" && $fokus_id == $id)
              echo '<input type="text" name="surname" value="'.$value['surname'].'"  size="40" />';
            else 
              echo $value['surname'];
        ?>
      </td>
      <td>
        <?php if($cosedeje=="edit-autor" && $fokus_id == $id)
              echo '<input type="text" name="titleafter" value="'.$value['titleafter'].'"  size="20" />';
            else 
              echo $value['titleafter'];
        ?>
      </td>
      
      <td> 
      <?php if( $cosedeje=="edit-autor" && $fokus_id == $id ) : ?>
        <input type="hidden" name="akce" value="edit-autor-save" />
        <input type="hidden" name="idauthor" value="<?php echo $id?>" />
        <input type="submit" name="sButton" value="Save" />
        <input type="submit" name="sButton" value="Cancel" />
      <?php else: ?>
        <a href="autori.php?akce=edit-author&amp;idauthor=<?php echo $id; ?>">edit</a>
        <a href="autori.php?akce=delete-author&amp;idauthor=<?php echo $id; ?>">delete</a>
      <?php endif; ?>
      </td>
      

  </tr>
<?php endforeach; ?>

  <?php if( $cosedeje!="edit-autor"): ?>
  <tr class="nadpis">
    <td>Add Author</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="nadpis">
    <td>Title before</td>
    <td>Name</td>
    <td>Surname</td>
    <td>Title after</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td><input type="text" name="titlebefore" value="" size="20" /></td>
      <td><input type="text" name="name" value=""  size="40" /></td>
      <td><input type="text" name="surname" value=""  size="40" /></td>
      <td><input type="text" name="titleafter" value=""  size="20" /></td>
      <td> 
        <input type="hidden" name="akce" value="new-autor-save" />
        <input type="submit" name="sButton" value="Add" />
      </td>

  </tr>
  <?php endif;// edit-autor ?>
</table>
    </form>
<?php endif; ?>
