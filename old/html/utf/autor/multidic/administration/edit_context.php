<?
require_once("./administration/context.php");
$vypis_edit = true;
if (!Empty($action) && $action == "edit_context") {
  
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
    update_context($cz_context, $en_context, $org_context, $context_id);
    $vypis_edit = false;
  } 
  
  
}
if($vypis_edit){
  
  $Record = get_context($context_id);
  $cz_context  = $Record["cz_context"];
  $en_context  = $Record["en_context"];
  $org_context = $Record["orig_context"];

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
    <thead align="center"> <h3 class="nadpis2">Uprav kontext</h3> 
    <?php echo_zpet_do_slovniku();?>
    </thead>
    <tbody>
    <form action="" method="POST" name="edit_context_form" onSubmit="return validate_new_context_form(this)">
      <table border="0">
      <tr class="akt">
        <td>český kontext*</td>
        <td><input type="text" 
                   name="cz_context"  
                   size="50" 
                   maxlength="100" 
                   value="<?php echo $cz_context?>" /></td>
      </tr>
      <tr class="akt">
        <td>anglický kontext*</td>
        <td><input type="text" 
                   name="en_context"  
                   size="50" 
                   maxlength="100" 
                   value="<?php echo $en_context?>" /></td>
      </tr>
      <tr class="akt">
        <td>oroginální kontext*</td>
        <td dir="rtl"><input type="text" 
                             name="org_context"  
                             size="50" 
                             maxlength="100" 
                             value="<?php echo $org_context?>" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_context">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody> 
  </table>

<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("edit_context_form.org_context");
  ?>
</div>
<?php
  }//end of else
?>

