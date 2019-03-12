<?php 
  require_once("./administration/author.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_author") {

  if (Empty($surname)) {
    print_hlasku("Příjmení musíte vyplnit");
  }
  else {
    update_author($name, $surname, $author_id);
    //print_table_of_author();
    $vypis_edit = false;
  }
}
if($vypis_edit){

  $Record      = get_author($author_id);
  $name        = $Record[1];
  $surname     = $Record[2];

?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_author_form(form) {
    edit_author_form = form;
    if (edit_author_form.surname.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_author_form.surname);
      return false;
    }
    
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav autora</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_author_form" onSubmit="return validate_edit_author_form(this)">
      <table border="0">
      <tr class="akt">
        <td>jméno</td>
        <td><input type="text" name="name"  size="50" maxlength="50" value="<?php echo $name?>" /></td>
      </tr>
      <tr class="akt">
        <td>příjmení*</td>
        <td><input type="text" name="surname"  size="50" maxlength="50" value="<?php echo $surname?>" /></td>
      </tr>
      <tr>
        <td>
          <input type="hidden" name="action" value="edit_author">
          <input type="hidden" name="author_id" value="<?php echo $author_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  
  <script language="javascript">
				<!--
					var focus = document.edit_author_form.name;
  				focus.focus();
				-->
  </script>
<?php
  }//end of else
?>
