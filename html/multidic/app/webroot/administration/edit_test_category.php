<?php 
  require_once("./administration/test_category.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_test_category") {

  if (Empty($name)) {
    print_hlasku("Název musíte vyplnit");
  }
  else {
    update_test_category($name, $parent_id, $test_category_id);
    //print_table_of_field();
    $vypis_edit = false;
  }
}
if($vypis_edit){

  $Record      = get_test_category($test_category_id);
  $name        = $Record['name'];
  $parent_id   = $Record['parent_id'];
  
  //print_r($parent_id);

?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_test_category_form(form) {
    edit_test_category_form = form;
    if (edit_test_category_form.name.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_test_category_form.name);
      return false;
    }
    
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav kategorii testu</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_test_category_form" onSubmit="return validate_edit_test_category_form(this)">
      <table border="0">
      <tr class="akt">
        <td>název*</td>
        <td><input type="text" name="name"  size="50" maxlength="50" value="<?php echo $name?>" /></td>
      </tr>
      <tr class="akt">
        <td>rodič</td>
        <td>
         <?php echo (get_test_category_chooser("parent_id", $parent_id)) ?>
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_test_category">
          <input type="hidden" name="test_category_id" value="<?php echo $test_category_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.edit_test_category_form.name;
  				focus.focus();
				-->
  </script>
  
<?php
  }//end of else
?>
