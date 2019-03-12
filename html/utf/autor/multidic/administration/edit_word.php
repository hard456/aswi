<?
require_once("./administration/word.php");
$vypis_edit = true;
if (!Empty($action) && $action == "edit_word") {
  
  if (Empty($czech)) {
    print_hlasku("Česky musíte vyplnit");
  }
  else if (Empty($english)) {
    print_hlasku("Anglicky musíte vyplnit");
  }
  else if (Empty($lection)) {
    print_hlasku("Lekci musíte vyplnit");
  }
  else {
    update_word($czech, $english, $word_category, $verbal_class, $present, $past, $valence,
                $root, $field, $word_id, $lection);
    
    echo_zpet_do_slovniku();
    $vypis_edit = false;
  }
  
  
}
if($vypis_edit){
  
  $Record = get_word($word_id);
  $czech         = $Record[1];
  $english       = $Record[2];
  $word_category = $Record[3];
  $verbal_class  = $Record[4];
  $present       = $Record[5];
  $past          = $Record[6];
  $valence       = $Record[9];        
  $root          = $Record[10];
  $word_lang     = $Record["language"];  

?>

<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_word_form(form) {
    edit_word_form = form;
    if (edit_word_form.czech.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_word_form.czech);
      return false;
    }
    if (edit_word_form.english.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_word_form.english);
      return false;
    }
    if (edit_word_form.lection.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_word_form.lection);
      return false;
    }
    
    return true;
  }
</script>

<table>
    <thead align="center"> <h3 class="nadpis2">Uprav slovo</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_word_form" onSubmit="return validate_edit_word_form(this)">
      <table>
      <tr class="akt">
        <td>česky*</td>
        <td><input type="text" name="czech"  size="50" value="<?php echo $czech?>" /></td>
      </tr>
      <tr class="akt">
        <td>anglicky*</td>
        <td><input type="text" name="english"  size="50" value="<?php echo $english?>" /></td>
      </tr>
      <tr class="akt">
        <td>druh slova</td>
        <td><input type="text" name="word_category"  size="50" value="<?php echo $word_category?>" /></td>
      </tr>
      <tr class="akt">
        <td>slovesná třída</td>
        <td><input type="text" name="verbal_class"  size="50" value="<?php echo $verbal_class?>" /></td>
      </tr>
      <tr class="akt">
        <td>přítomný čas</td>
        <td<? if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
               <input type="text" name="present"  size="37" 
                      <? if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                      onfocus="aktivujKlavesnici('edit_word_form.present')" 
                      value="<?php echo $present?>" /></td>
      </tr>
      <tr class="akt">
        <td>minulý čas</td>
        <td<? if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="past"  size="37" 
                       <? if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.past')"
                       value="<?php echo $past?>" /></td>
      </tr>
      <tr class="akt">
        <td>rekce</td>
        <td<? if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="valence"  size="37" 
                       <? if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.valence')"
                       value="<?php echo $valence?>" /></td>
      </tr>
      <tr class="akt">
        <td>kořen</td>
        <td<? if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="root"  size="37" 
                       <? if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.root')"
                       value="<?php echo $root?>" /></td>
      </tr>
      <tr class="akt">
        <td>obor</td>
        <td>
          <?php echo(get_field_chooser())?>
        </td>
      </tr>
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50" value="<?php echo $lection; ?>" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_word">
          <input type="hidden" name="word_id" value="<?php echo $word_id?>">
          <input type="hidden" name="nonauthorized" value="<?echo (($nonauthorized) ? "true" : "");?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>

<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("edit_word_form.present");
  ?>
</div>
<?php
  }//end of else
?>

