<?php 
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
  else if (strtolower($gender) != 'm' && strtolower($gender) != 'f' && !Empty($gender)) {
    print_hlasku("Rod musí obsahovat 'm' nebo 'f' nebo zůstat prázdný");
  }
  else {
    update_word($czech, $english, $word_category, $verbal_class, $present, $past, $valence,
                $root, $field, $word_id, $lection, $future, $infinitive, $gender);
    
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
  $lection       = $Record["lection"];  
  $future        = $Record["future"];
  $infinitive    = $Record["infinitive"];
  $gender    = $Record["gender"];
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
        <td>přítomný čas / plurál</td>
        <td<?php if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
               <input type="text" name="present"  size="29" 
                      <?php if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                      onfocus="aktivujKlavesnici('edit_word_form.present')" 
                      value="<?php echo $present?>" /></td>
      </tr>
      <tr class="akt">
        <td>minulý čas / singulár</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="past"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.past')"
                       value="<?php echo $past?>" /></td>
      </tr>
      <tr class="akt">
        <td>budoucí čas</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="future"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.future')"
                       value="<?php echo $future?>" /></td>
      </tr>
      <tr class="akt">
        <td>infinitive</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="infinitive"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.infinitive')"
                       value="<?php echo $infinitive?>" /></td>
      </tr>
      <tr class="akt">
        <td>rekce</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="valence"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.valence')"
                       value="<?php echo $valence?>" /></td>
      </tr>
      <tr class="akt">
        <td>kořen</td>
        <td>
                <input type="text" name="root"  size="50" class="akkad" 
                       onfocus="aktivujKlavesnici('edit_word_form.root')"
                       value="<?php echo $root?>" /></td>
      </tr>
      <tr class="akt">
        <td>rod ('f'/'m' nebo prázdné)</td>
        <td>
                <input type="text" name="gender"  size="1" class="akkad" 
                       onfocus="aktivujKlavesnici('edit_word_form.gender')"
                       value="<?php echo trim($gender)?>" /></td>
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
          <input type="hidden" name="nonauthorized" value="<?php echo (($nonauthorized) ? "true" : "");?>">
          <input type="hidden" name="contrains_source" value="<?php echo $contrains_source?>">
          <input type="hidden" name="contrains_lection" value="<?php echo $contrains_lection?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.edit_word_form.czech;
  				focus.focus();
				-->
  </script>
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("edit_word_form.present", true);
  ?>
</div>
<?php
  }//end of else
?>

