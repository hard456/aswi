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
  

  
   // if (Empty($czech)) {
   //   print_hlasku("Česky musíte vyplnit");
   // }
   // else 
   // if (Empty($english)) {
   //   print_hlasku("Anglicky musíte vyplnit");
   // }
   // else 
    if (Empty($lection)) {
      print_hlasku("Lekci musíte vyplnit");
    }
    //else if (strtolower($gender) != 'm' && strtolower($gender) != 'f' && !Empty($gender)) {
    //  print_hlasku("Rod musí obsahovat 'm' nebo 'f' nebo zůstat prázdný");
    //}
    else {
      if (insert_word($czech,$english,$word_category,$verbal_class,$present,$past,$valence,$root,
                      $field,$language,$user,$source,$lection, $future, $infinitive, $gender, $vocalized, $nonvocalized,
                      $word_category_foreign, $status_constructus_single, $status_constructus_plural, $single_adj_female,
                      $plural_adj_female, $conjugation, $imperative, $prefix, $status_constructus_single_female,
		      $status_constructus_plural_female, $czech_female, $single_female, $plural_female, 
                      $status_constructus_single_noun_female, $status_constructus_plural_noun_female,
		      $nonvocalized_female, $nonvocalized_alternative, $vocalized_alternative)) {
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
/*
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
*/
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
        <td>česky</td>
        <td><input type="text" name="czech"  size="50"<?php znova($czech)?> /></td>
      </tr>
      <tr class="akt">
        <td>česky v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td><input type="text" name="czech_female"  size="50"<?php znova($czech_female)?> /></td>
      </tr>
      <tr class="akt">
        <td>anglicky</td>
        <td><input type="text" name="english"  size="50"<?php znova($english)?> /></td>
      </tr>
      <tr class="akt">
        <td>druh slova v češtině</td>
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
            
              <td>
            fráze – <b>phr</b> <br />
            uvoz. částice - <b>IP</b> <br />
            </td>
            
            </tr>
            </table>
        </td>
      </tr>
      <tr class="akt">
        <td>druh slova v cizím j.</td>
        <td>
        <?php if($language == 2): ?>
            <select name="word_category_foreign">
                
                <option <?php echo (empty($word_category_foreign))? 'selected="selected" ' : ""?>value="">  </option>
                <option <?php echo ($word_category_foreign === "שם עצם")? 'selected="selected" ' : ""?>value="שם עצם"> ש"ע </option>
                <option <?php echo ($word_category_foreign === "מילת חיבור")? 'selected="selected" ' : ""?>value="מילת חיבור"> מ"ח </option>
                <option <?php echo ($word_category_foreign === "מילת קריאה")? 'selected="selected" ' : ""?>value="מילת קריאה"> מ"ק </option>
                <option <?php echo ($word_category_foreign === "פועל")? 'selected="selected" ' : ""?>value="פועל"> פ' </option>
                <option <?php echo ($word_category_foreign === "מילת יחס")? 'selected="selected" ' : ""?>value="מילת יחס"> מ"י </option>
                <option <?php echo ($word_category_foreign === "תואר הפועל")? 'selected="selected" ' : ""?>value="תואר הפועל"> תה"פ </option>
                <option <?php echo ($word_category_foreign === "שם מספר")? 'selected="selected" ' : ""?>value="שם מספר"> ש"מ </option>
                <option <?php echo ($word_category_foreign === "מילת שאלה")? 'selected="selected" ' : ""?>value="מילת שאלה"> מ"ש </option>
                <option <?php echo ($word_category_foreign === "מילת גוף")? 'selected="selected" ' : ""?>value="מילת גוף"> מ"ג </option>
                <option <?php echo ($word_category_foreign === "תואר")? 'selected="selected" ' : ""?>value="תואר"> ת' </option>
                <option <?php echo ($word_category_foreign === "ביטוי")? 'selected="selected" ' : ""?>value="ביטוי">  ביטוי  </option>
                

            </select>
        <?php else: ?>
            <input type="text" name="word_category_foreign"  size="50"<?php znova($word_category_foreign)?> />
        <?php endif;?>
        </td>
      </tr>
      <tr class="akt">
        <td>slovesná třída</td>
        <td><input type="text" name="verbal_class"  size="50"<?php znova($verbal_class)?> /></td>
      </tr>
      <tr class="akt">
        <td>přítomný čas / množné číslo <br />všech podstatných jmen a <br />přídavných jmen mužského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="present"  
               size="29"<?php znova($present)?> 
               onfocus="aktivujKlavesnici('new_word_form.present')" /></td>
      </tr>
      <tr class="akt">
        <td>minulý čas / jednotné číslo <br />všech podstatných jmen a <br />přídavných jmen mužského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="past"  
                 size="29"<?php znova($past)?> 
                 onfocus="aktivujKlavesnici('new_word_form.past')" /></td>
      </tr>

      </tr>
      <tr class="akt">
        <td>alternativní vokalizovaný tvar</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="vocalized_alternative"  
                 size="29"<?php znova($vocalized_alternative)?> 
                 onfocus="aktivujKlavesnici('new_word_form.vocalized_alternative')" /></td>
      </tr>


      <tr class="akt">
        <td>jednotné číslo podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="single_female"  
                 size="29"<?php znova($single_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.single_female')" /></td>
      </tr>
      <tr class="akt">
        <td>množné číslo podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="plural_female"  
                 size="29"<?php znova($plural_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.plural_female')" /></td>
      </tr>
      


      <tr class="akt">
        <td>status constructus číslovek,<br /> jednotného čísla podstatných jmen <br />a jednotného čísla přídavných<br /> jmen mužského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="status_constructus_single"  
                 size="29"<?php znova($status_constructus_single)?> 
                 onfocus="aktivujKlavesnici('new_word_form.status_constructus_single')" /></td>
      </tr>
      
      <tr class="akt">
        <td>status constructus množného <br />čísla podstatných jmen <br />a přídavných jmen mužského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="status_constructus_plural"  
                 size="29"<?php znova($status_constructus_plural)?> 
                 onfocus="aktivujKlavesnici('new_word_form.status_constructus_plural')" /></td>
      </tr>
      
      <tr class="akt">
        <td>status constructus jednotného <br />čísla přídavných jmen <br />ženského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="status_constructus_single_female"  
                 size="29"<?php znova($status_constructus_single_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.status_constructus_single_female')" /></td>
      </tr>
      <tr class="akt">
        <td>status constructus množného <br />čísla přídavných jmen <br />ženského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="status_constructus_plural_female"  
                 size="29"<?php znova($status_constructus_plural_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.status_constructus_plural_female')" /></td>
      </tr>


      <tr class="akt">
        <td>status constructus jednotného čísla podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="status_constructus_single_noun_female"  
                 size="29"<?php znova($status_constructus_single_noun_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.status_constructus_single_noun_female')" /></td>
      </tr>
      <tr class="akt">
        <td>status constructus množného čísla podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="status_constructus_plural_noun_female"  
                 size="29"<?php znova($status_constructus_plural_noun_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.status_constructus_plural_noun_female')" /></td>
      </tr>
      
      
      <tr class="akt">
        <td>jednotné číslo přídavných <br /> jmen ženského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="single_adj_female"  
                 size="29"<?php znova($single_adj_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.single_adj_female')" /></td>
      </tr>
      <tr class="akt">
        <td>množné číslo přídavných <br /> jmen ženského rodu</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
                 name="plural_adj_female"  
                 size="29"<?php znova($plural_adj_female)?> 
                 onfocus="aktivujKlavesnici('new_word_form.plural_adj_female')" /></td>
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
        <td>konjugace</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="conjugation"  
               size="29"<?php znova($conjugation)?> 
               onfocus="aktivujKlavesnici('new_word_form.conjugation')" /></td>
      </tr>
      
      <tr class="akt">
        <td>imperativ</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="imperative"  
               size="29"<?php znova($imperative)?> 
               onfocus="aktivujKlavesnici('new_word_form.imperative')" /></td>
      </tr>
      
      <tr class="akt">
        <td>vokalizovaný tvar</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="vocalized"  
               size="29"<?php znova($vocalized)?> 
               onfocus="aktivujKlavesnici('new_word_form.vocalized')" 
               disabled="disabled"
               /></td>
      </tr>
      
      <tr class="akt">
        <td>nevokalizovaný tvar</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="nonvocalized"  
               size="29"<?php znova($nonvocalized)?> 
               onfocus="aktivujKlavesnici('new_word_form.nonvocalized')" /></td>
      </tr>

      <tr class="akt">
        <td>nevokalizovaný tvar v ženském rodě – pouze u přechylovatelných</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="nonvocalized_female"  
               size="29"<?php znova($nonvocalized_female)?> 
               onfocus="aktivujKlavesnici('new_word_form.nonvocalized_female')" /></td>
      </tr>

    <tr class="akt">
        <td>alternativní nevokalizovaný tvar</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="nonvocalized_alternative"  
               size="29"<?php znova($nonvocalized_alternative)?> 
               onfocus="aktivujKlavesnici('new_word_form.nonvocalized_alternative')" /></td>
      </tr>
      
      <tr class="akt">
        <td>předložka se zájmenným sufixem (ve všech možných tvarech)</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="prefix"  
               size="29"<?php znova($prefix)?> 
               onfocus="aktivujKlavesnici('new_word_form.prefix')" /></td>
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
        <?php if($language == 2): ?>
            <select name="gender">
                <option <?php echo (empty($gender))? 'selected="selected" ' : ""?>value="">  </option>
                <option <?php echo (trim($gender) == "'ז")? 'selected="selected" ' : ""?>value="'ז"> 'ז </option>
                <option <?php echo (trim($gender) == "'נ")? 'selected="selected" ' : ""?>value="'נ"> 'נ </option>
		<option <?php echo (trim($gender) == "'ז'+נ")? 'selected="selected" ' : ""?>value="'ז'+נ"> 'ז'+נ </option>
            </select>
        <?php else: ?>
            <input type="text" 
               class="akkad"
               name="gender"  
               size="1"<?php znova($gender)?> 
               onfocus="aktivujKlavesnici('new_word_form.gender')" />
        <?php endif;?>
        
        </td>
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
