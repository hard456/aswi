<?php 
  require_once("./administration/translation.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_translation") {

  if (Empty($translation)) {
    print_hlasku("Položku musíte vyplnit");
  }
  else {
    update_translation($translation, $translation_id);
    $vypis_edit = false;
  }
}
if($vypis_edit){

  $Record      = get_translation($translation_id);
  $translation = $Record["translation"];
  $idf         = $Record["idf"];
?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_translation_form(form) {
    edit_translation_form = form;
    if (edit_translation_form.translation.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_field_form.translation);
      return false;
    }
    
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav překlad</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_translation_form" onSubmit="return validate_edit_translation_form(this)">
      <table border="0">
      <tr class="akt">
        <td>česky</td>
        <td><?php echo $idf?></td>
      </tr>
      <tr class="akt">
        <td>překlad</td>
        <td><textarea name="translation" 
                      onfocus="aktivujKlavesnici('edit_word_form.present')" 
                      rows="3" 
                      cols="65"><?php echo $translation?></textarea>
        <!--input type="text" name="translation"  size="50" maxlength="250" value="<?php echo $translation?>" /--></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_translation">
          <input type="hidden" name="translation_id" value="<?php echo $translation_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.edit_translation_form.translation;
  				focus.focus();
				-->
  </script>
  <div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("edit_word_form.present", true);
  ?>
</div>
  
  
<?php
  }//end of else
?>
