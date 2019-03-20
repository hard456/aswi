<?php
  require_once("./administration/test_category.php");

if (!Empty($action) && $action == "insert_new_test_category") {

  
  $zobrazit_znovu = true;
  
  if (Empty($name)) {
    print_hlasku("Český název musíte vyplnit");
  }
  else {
    insert_test_category($name,$parent_id);
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

  function validate_new_test_category_form(form) {
    new_test_category_form = form;
    if (new_test_category_form.name.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_test_category_form.name);
      return false;
    }
    return true;
  }
</script> 
<table>
    <thead align="center"> <h3 class="nadpis2">Vlož novou kategorii testu</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_test_category_form" onSubmit="return validate_new_test_category_form(this)">
      <table border="0">
      <tr class="akt">
        <td>název*</td>
        <td><input type="text" name="name"  size="50" /></td>
      </tr>
      <tr class="akt">
        <td>rodič</td>
        <td>
        <?php echo (get_test_category_chooser("parent_id")) ?>
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="insert_new_test_category">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.new_test_category_form.name;
  				focus.focus();
				-->
  </script>

