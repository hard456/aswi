<?php
if (!Empty($action) && $action == "insert_new_translation_lang") {
  require_once("./administration/translation_lang.php");
  
  $zobrazit_znovu = true;
  
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
    insert_translation_lang($code,$name,$visible);
    $zobrazit_znovu = false;
  }
}
?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_new_translation_lang_form(form) {
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
    <thead align="center"> <h3 class="nadpis2">Vlož nový jazyk překladu prostředí</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_field_form" onSubmit="return validate_new_translation_lang_form(this)">
      <table border="0">
      <tr class="akt">
        <td>kód*</td>
        <td><input type="text" name="code" size="50" /></td>
      </tr>
      <tr class="akt">
        <td>název*</td>
        <td><input type="text" name="name" size="50" /></td>
      </tr>
      <tr class="akt">
        <td>viditelnost*</td>
        <td><input type="text" name="visible" size="50" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="insert_new_translation_lang">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.new_field_form.code;
  				focus.focus();
				-->
  </script>

