<?

$nezobrazuj = false;
if (!Empty($action) && $action == "insert_new_context") {
  require_once("./administration/context.php");
  
  $zobrazit_znovu = true;
  
  if (Empty($cz_context)) {
    print_hlasku("Český kontext musíte vyplnit");
  }
  else if (Empty($en_context)) {
    print_hlasku("Anglický kontext musíte vyplnit");
  }
  else if (Empty($org_context)) {
    print_hlasku("Originální kontext musíte vyplnit");
  }
  else {
    insert_context($cz_context, $en_context, $org_context, $word_id, $source_id);
    $zobrazit_znovu = false;
    $nezobrazuj = true;
  }
}
  
  
  
function znova($string) {
  global $zobrazit_znovu;
  if ($zobrazit_znovu)
    echo ' value="'.$string.'"';
}

if (!$nezobrazuj) {
?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_new_context_form(form) {
    new_source_form = form;
    if (new_context_form.cz_context.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_context_form.cz_context);
      return false;
    }
    if (new_context_form.en_context.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_context_form.en_context);
      return false;
    }
    if (new_context_form.org_context.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_context_form.org_context);
      return false;
    }
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Vlož nový kontext</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_context_form" onSubmit="return validate_new_context_form(this)">
      <table border="0">
      <tr class="akt">
        <td>český kontext*</td>
        <td><input type="text" name="cz_context"  size="50" maxlength="100"<?znova($cz_context)?>/></td>
      </tr>
      <tr class="akt">
        <td>anglický kontext*</td>
        <td><input type="text" name="en_context"  size="50" maxlength="100"<?znova($en_context)?>/></td>
      </tr>
      <tr class="akt">
        <td>originální kontext*</td>
        <td dir="rtl"><input type="text" name="org_context"  size="50" maxlength="100"<?znova($org_context)?>/></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="insert_new_context">
          <input type="hidden" name="word_id" value="<?echo $word_id?>">
          <input type="hidden" name="source_id" value="<?echo $source_id?>">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
<?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("new_context_form.org_context");
 }//END IF ?>
