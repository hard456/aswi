<?
if (!Empty($action) && $action == "insert_new_field") {
  require_once("./administration/field.php");
  
  $zobrazit_znovu = true;
  
  if (Empty($name)) {
    print_hlasku("Název musíte vyplnit");
  }
  else {
    insert_field($name,$surname);
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
        <td>název*</td>
        <td><input type="text" name="name"  size="50" /></td>
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

