<h1>Add to 
<?php echo ($isDivine)? "divine":"personal"; ?> 
name list</h1>

<form action="<?php echo $PHP_SELF?>" method="post" enctype="multipart/form-data">

<label for="id_name">Choose <?php echo ($isDivine)? "divine":"personal"; ?> name to join: </label>
<?php chooser_get_name($isDivine); ?>
<br />
<br />


<?php echo $obsah_formu; ?>


<input type="hidden" name="actione" value="add_to_list" />
<input type="hidden" name="divine" value="<?php echo isDivine ?>" />

<input type="submit" value="Add to list" />

</form>
