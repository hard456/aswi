<?php

$form_name = "insert_form";

?>
<script language="JavaScript" type="text/javascript">
<!--
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  -->
</script>
<h1 class="nadpis2">Insert new row of table <?php echo $table ?></h1>
<form action="admin.php" method="POST" name="<?php echo $form_name; ?>" onSubmit="return validate_insert_form(this)">
<table>
    <tbody>
      <table border="0">
 <?php
  echo $table_of_new_edit;
 ?>


      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>" />
          <input type="hidden" name="actione" value="insert" />
          <input type="hidden" name="nav_id" value="insert" />
        </td>
        <td><input type="submit" value="Insert" /></td>
       <td>&nbsp;</td>
      </tr>

    </tbody>
  </table>
</form>
