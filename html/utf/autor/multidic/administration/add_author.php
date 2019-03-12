<?
if (!Empty($action) && $action == "insert_new_author") {
  require_once("./administration/author.php");
  
  $zobrazit_znovu = true;
  
  if (Empty($surname)) {
    print_hlasku("Příjmení musíte vyplnit");
  }
  else {
    insert_author($name,$surname);
    $zobrazit_znovu = false;
  }
}

function znova($string) {
  global $zobrazit_znovu;
  if ($zobrazit_znovu)
    echo ' value="'.$string.'"';
}


?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_new_author_form(form) {
    new_author_form = form;
    if (new_author_form.surname.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_author_form.surname);
      return false;
    }
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Vlož nového autora</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_author_form" onSubmit="return validate_new_author_form(this)">
      <table border="0">
      <tr class="akt">
        <td>jméno</td>
        <td><input type="text" name="name"  size="50"<?znova($name)?> /></td>
      </tr>
      <tr class="akt">
        <td>příjmení*</td>
        <td><input type="text" name="surname"  size="50" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="insert_new_author">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>

