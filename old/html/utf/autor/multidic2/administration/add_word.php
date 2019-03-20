<?php
require_once("./administration/word.php");
  /*zobrazí znovu obsah formuláře*/
  function znova($string) {
    global $zobrazit_znovu;
    if ($zobrazit_znovu)
      echo ' value="'.$string.'"';
  }


if (Empty($language) || $language == "") {
  $krok = 0;
}
else if (Empty($source) || $source == "") {
  $krok = 1;
}
else {
  $krok = 2;
}

switch ($krok) {
  case (0):  
?>


  <table>
    <thead align="center"> <h3 class="nadpis2">Vyberte jazyk pro nové slovo</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_word_form0">
      <table>
      <tr class="akt">
        <td><?php echo(get_language_chooser(1))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_language">
          <input type="submit" value="Dál">
        </td>
      </tr>
    </form>
    </tbody>
  </table>

<?php
  break;
  case (1):
?>

  <table>
    <thead align="center"> <h3 class="nadpis2">Vyberte zdroj nového slova</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_word_form1">
      <table>
      <tr class="akt">
        <td><?php echo(get_source_chooser($language))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?php echo $language?>">
          <?php if ($delete_from_not_found):?>
            <input type="hidden" name="delete_from_not_found" value="true">
            <input type="hidden" name="table_not_found" value="<?php echo $table_not_found?>">
            <input type="hidden" name="id_not_found" value="<?php echo $id_not_found?>">
          <?php else:?>
            <input type="hidden" name="delete_from_not_found" value="false">
          <?php endif;?>
          <input type="hidden" name="action" value="select_source">
          <input type="submit" value="Dál">
        </td>
      </tr>
    </form>
    </tbody>
  </table>


<?php 
  break;

  case (2):
  
  $zobrazit_znovu = true;  

    if (!Empty($action) && $action == "insert_new_word") {

    $user = $ses_IDuser;
  

  
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
      if (insert_word($czech,$english,$word_category,$verbal_class,$present,$past,$valence,$root,
                      $field,$language,$user,$source,$lection, $future, $infinitive, $gender)) {
          print_hlasku ("Slovíčko přidáno...");
      }
        
      if ($delete_from_not_found == "true") {
        //echo ("\$delete_from_not_found = ".$delete_from_not_found."\n<br>");
        require_once("./administration/not_found.php");
        if (delete_not_found($table_not_found, $id_not_found)) { 
          print_hlasku ("a smazáno z nenalezených...");
        }

      }
      $zobrazit_znovu = false;
    }
  }

?>

<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_new_word_form(form) {
    new_word_form = form;
    if (new_word_form.czech.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_word_form.czech);
      return false;
    }
    if (new_word_form.english.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_word_form.english);
      return false;
    }
    if (new_word_form.lection.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_word_form.lection);
      return false;
    }
    
    return true;
  }
</script>

<table>
    <thead align="center"> <h3 class="nadpis2">Vlož nové slovo</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_word_form" onSubmit="return validate_new_word_form(this)">
      <table>
      <tr class="akt">
        <td>česky*</td>
        <td><input type="text" name="czech"  size="50"<?php znova($czech)?> /></td>
      </tr>
      <tr class="akt">
        <td>anglicky*</td>
        <td><input type="text" name="english"  size="50"<?php znova($english)?> /></td>
      </tr>
      <tr class="akt">
        <td>druh slova</td>
        <td><input type="text" name="word_category"  size="50"<?php znova($word_category)?> /></td>
      </tr>
      <tr class="akt">
        <td>seznam zkratek:</td>
        <td>
            <table style="font-size: smaller;">
              <tr>
              <td>
            Podstatné jméno – <b>s</b> <br />
            Přídavné jméno – <b>adj</b> <br />
            
            </td>
            <td>
            Zájmeno – <b>pron</b> <br />
            Číslovka – <b>num</b> <br />
            </td>
            <td>
            Sloveso – <b>v</b> <br />
            Příslovce – <b>adv</b> <br />
            </td>
            <td>
            Předložka – <b>prep</b> <br />
            Spojka – <b>conj</b> <br />
            
            
            </td>
            <td>
            Částice – <b>part</b> <br />
            Citoslovce - <b>interj</b> <br />
            </td>
            </tr>
            </table>
        </td>
      </tr>
      <tr class="akt">
        <td>slovesná třída</td>
        <td><input type="text" name="verbal_class"  size="50"<?php znova($verbal_class)?> /></td>
      </tr>
      <tr class="akt">
        <td>přítomný čas / plurál</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="present"  
               size="29"<?php znova($present)?> 
               onfocus="aktivujKlavesnici('new_word_form.present')" /></td>
      </tr>
      <tr class="akt">
        <td>minulý čas / singulár</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="past"  
                 size="29"<?php znova($past)?> 
                 onfocus="aktivujKlavesnici('new_word_form.past')" /></td>
      </tr>
      <tr class="akt">
        <td>budoucí čas</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="future"  
                 size="29"<?php znova($future)?> 
                 onfocus="aktivujKlavesnici('new_word_form.future')" /></td>
      </tr>
      <tr class="akt">
        <td>infinitiv</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="infinitive"  
                 size="29"<?php znova($infinitive)?> 
                 onfocus="aktivujKlavesnici('new_word_form.infinitive')" /></td>
      </tr>
      <tr class="akt">
        <td>rekce</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="valence"  
               size="29"<?php znova($valence)?> 
               onfocus="aktivujKlavesnici('new_word_form.valence')" /></td>
      </tr>
      <tr class="akt">
        <td>kořen</td>
        <td>
        <input type="text" 
               class="akkad"
               name="root"  
               size="50"<?php znova($root)?> 
               onfocus="aktivujKlavesnici('new_word_form.root')" /></td>
      </tr>
      <tr class="akt">
        <td>rod ('f'/'m' nebo prázdné)</td>
        <td>
        <input type="text" 
               class="akkad"
               name="gender"  
               size="1"<?php znova($gender)?> 
               onfocus="aktivujKlavesnici('new_word_form.gender')" /></td>
      </tr>
      <tr class="akt">
        <td>obor</td>
        <td>
          <?php echo(get_field_chooser())?>
        </td>
      </tr>
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50"<?php znova($lection)?> /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?php echo $language?>">
          <input type="hidden" name="source" value="<?php echo $source?>">
          <input type="hidden" name="delete_from_not_found" value="<?php echo $delete_from_not_found?>">
          <input type="hidden" name="table_not_found" value="<?php echo $table_not_found?>">
          <input type="hidden" name="id_not_found" value="<?php echo $id_not_found?>">
          <input type="hidden" name="action" value="insert_new_word">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.new_word_form.czech;
  				focus.focus();
				-->
  </script>
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("new_word_form.present",true);
  ?>
</div>

<?php    }//end of switch ?>
