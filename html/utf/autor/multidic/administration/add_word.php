<?
require_once("./administration/word.php");

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
        <td><?php echo(get_language_chooser(3))?></td>
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



  
<?
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
          <input type="hidden" name="language" value="<?echo $language?>">
          <input type="hidden" name="action" value="select_source">
          <input type="submit" value="Dál">
        </td>
      </tr>
    </form>
    </tbody>
  </table>


<?
  break;

  case (2):

if (!Empty($action) && $action == "insert_new_word") {
  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  //nutno nastavit id_user aktualniho uzivatele - HOTOVO
  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  $user = $ses_IDuser;
  
  $zobrazit_znovu = true;
  
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
    if (insert_word($czech,$english,$word_category,$verbal_class,$present,$past,$valence,$root,
                    $field,$language,$user,$source,$lection))
      print_hlasku ("Slovíčko přidáno...");
      
    $zobrazit_znovu = false;
  }
}

function znova($string) {
  global $zobrazit_znovu;
  if ($zobrazit_znovu)
    echo ' value="'.$string.'"';
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
        <td><input type="text" name="czech"  size="50"<?znova($czech)?> /></td>
      </tr>
      <tr class="akt">
        <td>anglicky*</td>
        <td><input type="text" name="english"  size="50"<?znova($english)?> /></td>
      </tr>
      <tr class="akt">
        <td>druh slova</td>
        <td><input type="text" name="word_category"  size="50"<?znova($word_category)?> /></td>
      </tr>
      <tr class="akt">
        <td>slovesná třída</td>
        <td><input type="text" name="verbal_class"  size="50"<?znova($verbal_class)?> /></td>
      </tr>
      <tr class="akt">
        <td>přítomný čas</td>
        <td<? if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <? if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="present"  
               size="37"<?znova($present)?> 
               onfocus="aktivujKlavesnici('new_word_form.present')" /></td>
      </tr>
      <tr class="akt">
        <td>minulý čas</td>
        <td<? if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <? if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="past"  
                 size="37"<?znova($past)?> 
                 onfocus="aktivujKlavesnici('new_word_form.past')" /></td>
      </tr>
      <tr class="akt">
        <td>rekce</td>
        <td<? if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <? if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="valence"  
               size="37"<?znova($valence)?> 
               onfocus="aktivujKlavesnici('new_word_form.valence')" /></td>
      </tr>
      <tr class="akt">
        <td>kořen</td>
        <td<? if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <? if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="root"  
               size="37"<?znova($root)?> 
               onfocus="aktivujKlavesnici('new_word_form.root')" /></td>
      </tr>
      <tr class="akt">
        <td>obor</td>
        <td>
          <?php echo(get_field_chooser())?>
        </td>
      </tr>
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50"<?znova($lection)?> /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?echo $language?>">
          <input type="hidden" name="source" value="<?echo $source?>">
          <input type="hidden" name="action" value="insert_new_word">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>

<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("new_word_form.present");
  ?>
</div>

<?   }//end of switch ?>
