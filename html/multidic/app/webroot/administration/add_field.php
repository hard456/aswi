<?php
if (!Empty($action) && $action == "insert_new_field") {
  require_once("./administration/field.php");
  
  $zobrazit_znovu = true;
  
  if (Empty($name)) {
    print_hlasku("Český název musíte vyplnit");
  }
  if (Empty($en_field)) {
    print_hlasku("Anglický název musíte vyplnit");
  }
  else {
    insert_field($name,$en_field);
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

  function validate_new_field_form(form) {
    new_field_form = form;
    if (new_field_form.name.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_field_form.name);
      return false;
    }
    return true;
  }
</script> 
<table>
    <thead align="center"> <h3 class="nadpis2">Vlož nový obor</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_field_form" onSubmit="return validate_new_field_form(this)">
      <table border="0">
      <tr class="akt">
        <td>český název*</td>
        <td><input type="text" name="name"  size="50" /></td>
      </tr>
      <tr class="akt">
        <td>anglický název*</td>
        <td><input type="text" name="en_field"  size="50" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="insert_new_field">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.new_field_form.name;
  				focus.focus();
				-->
  </script>

