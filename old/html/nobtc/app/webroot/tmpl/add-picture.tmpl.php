<h2>Add picture for transliteration id = <?php echo $POST['id_transliteration']; ?></h2>
 
<h3><?php echo $hlaska ?></h3>

<form action="<?php echo $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
  <table>
   <tr>
      <td class="title"><label for="type"> Photo or handcopy </label></td>
      <td><input type="radio" name="type" value="photo" checked="checked" />Photo    
          <input type="radio" name="type" value="handcopy" />Handcopy  </td>
    </tr>
    <tr>
      <td class="title"><label for="obrazek"> Picture </label></td>
      <td><input type="file" id="obrazek" name="obrazek" size="50" /></td>
    </tr>
    <tr>
      <td class="title"><label for="caption"> Caption </label></td>
      <td><input type="text" id="caption" name="caption" size="50" /></td>
    </tr>
  </table>
  <br />
  <br />
  <input type="hidden" name="actione" value="savePicture" />
  <input type="hidden" name="id_transliteration" value="<?php echo $POST['id_transliteration']; ?>" />
  <input type="submit" name="button" value="Save" />
</form>
