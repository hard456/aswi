<form action="<?php echo $PHP_SELF?>"  method="post" enctype="multipart/form-data">

<h3 class="nadpis2">Select file for upload</h3> 
  <table border="0">
    <tr>
      <td>File:</td>
      <td><input type="file" name="soubor"  size="50" /></td>
    </tr>
    <tr class="nadpis_sekce">
      <td>
      </td>
      <td><input type="submit" name="actionButton" value="<?php echo $first_button_label?>"></td>
    </tr>
  </table>
 </form>
