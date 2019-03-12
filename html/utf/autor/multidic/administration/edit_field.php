<?
  require_once("./administration/field.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_field") {

  if (Empty($name)) {
    print_hlasku("Název musíte vyplnit");
  }
  else {
    update_field($name, $field_id);
    //print_table_of_field();
    $vypis_edit = false;
  }
}
if($vypis_edit){

  $Record      = get_field($field_id);
  $name        = $Record[1];

?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_field_form(form) {
    edit_field_form = form;
    if (edit_field_form.name.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_field_form.name);
      return false;
    }
    
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav obor</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_field_form" onSubmit="return validate_edit_field_form(this)">
      <table border="0">
      <tr class="akt">
        <td>název*</td>
        <td><input type="text" name="name"  size="50" maxlength="50" value="<?php echo $name?>" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_field">
          <input type="hidden" name="field_id" value="<?php echo $field_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
<?php
  }//end of else
?>
