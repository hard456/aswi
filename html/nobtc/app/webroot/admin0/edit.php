
<script language="JavaScript" type="text/javascript">
  <!--
	function setFocus(object)	{
	   	object.focus();
	   	object.select();
	}

  -->
</script>
<h1 class="nadpis2">Edit row in table <?php echo $table; ?> </h1>
<form action="admin.php" method="POST" name="<?php echo $form_name; ?>" onSubmit="return validate_edit_field_form(this)">
<table>
    <tbody>
      <?php
      echo $table_of_edit;
      ?>

      <tr class="nadpis_sekce">
        <td>
          <?php
          if (isset($unique)) {
            echo "<input type=\"hidden\" name=\"unique\" value=\"".urlencode($unique)."\" />\n          ";
          }
          if (isset($unique_id)) {
            echo "<input type=\"hidden\" name=\"unique_id\" value=\"".urlencode($unique_id)."\" />\n";
          }
          ?>
          <input type="hidden" name="nav_id" value="edit" />
          <input type="hidden" name="actione" value="edit" />
          <input type="hidden" name="table" value="<?php echo urlencode($table); ?>" />
        </td>
        <td><input type="submit" value="Save"></td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
</form>

