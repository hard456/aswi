<?php 
  require_once("./administration/translation_lang.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_traslation_lang") {

  if (Empty($code)) {
    print_hlasku("Kód musíte vyplnit");
  }
  elseif (Empty($name)) {
    print_hlasku("Název musíte vyplnit");
  }
  elseif (!IsSet($visible)) {
    print_hlasku("Viditelnost musíte vyplnit");
  }
  else {
    update_translation_lang($code, $name, $visible, $translation_lang_id);
    $vypis_edit = false;
  }
}
if($vypis_edit){

  $Record      = get_translation_lang($translation_lang_id);
  $code        = $Record["code"];
  $name        = $Record["name"];
  $visible     = $Record["visible"];

?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_translation_lang_form(form) {
    edit_translation_lang_form = form;
    if (edit_translation_lang_form.name.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_translation_lang_form.name);
      return false;
    }
    if (edit_translation_lang_form.code.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_translation_lang_form.code);
      return false;
    }
    if (edit_translation_lang_form.visible.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_translation_lang_form.visible);
      return false;
    }
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav jazyk překladu prostředí</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_traslation_lang_form" onSubmit="return validate_edit_traslation_lang_form(this)">
      <table border="0">
      <tr class="akt">
        <td>kód*</td>
        <td><input type="text" name="code"  size="50" maxlength="50" value="<?php echo $code?>" /></td>
      </tr>
      <tr class="akt">
        <td>název*</td>
        <td><input type="text" name="name"  size="50" maxlength="50" value="<?php echo $name?>" /></td>
      </tr>
      <tr class="akt">
        <td>viditelnost*</td>
        <td><input type="text" name="visible"  size="50" maxlength="50" value="<?php echo $visible?>" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_traslation_lang">
          <input type="hidden" name="traslation_lang_id" value="<?php echo $translation_lang_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.edit_field_form.code;
  				focus.focus();
				-->
  </script>
  
<?php
  }//end of else
?>
