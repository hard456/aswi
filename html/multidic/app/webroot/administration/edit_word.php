<?php 
require_once("./administration/word.php");
$vypis_edit = true;
if (!Empty($action) && $action == "edit_word") {
  
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
    update_word($czech, $english, $word_category, $verbal_class, $present, $past, $valence,
                $root, $field, $word_id, $lection, $future, $infinitive, $gender, $vocalized, $nonvocalized,
                $word_category_foreign, $status_constructus_single, $status_constructus_plural, $single_adj_female,
                      $plural_adj_female, $conjugation, $imperative, $prefix, $status_constructus_single_female,
		      $status_constructus_plural_female, $czech_female, $single_female, $plural_female, 
                      $status_constructus_single_noun_female, $status_constructus_plural_noun_female,
		      $nonvocalized_female, $nonvocalized_alternative, $vocalized_alternative);
    
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
  $gender        = $Record["gender"];
  $vocalized     = $Record["vocalized"];
  $nonvocalized  = $Record["nonvocalized"];
  $word_category_foreign = $Record['word_category_foreign'];
  $status_constructus_single = $Record['status_constructus_single'];
  $status_constructus_plural = $Record['status_constructus_plural'];
  $single_adj_female = $Record['single_adj_female'];
  $plural_adj_female = $Record['plural_adj_female'];
  $conjugation   = $Record['conjugation'];
  $imperative    = $Record['imperative'];
  $prefix    = $Record['prefix'];
  $status_constructus_single_female    = $Record['status_constructus_single_female'];
  $status_constructus_plural_female    = $Record['status_constructus_plural_female'];
  $czech_female = $Record['czech_female'];
  $single_female = $Record['single_female'];
  $plural_female = $Record['plural_female'];
  $status_constructus_single_noun_female = $Record['status_constructus_single_noun_female'];
  $status_constructus_plural_noun_female = $Record['status_constructus_plural_noun_female'];
  $nonvocalized_female = $Record['nonvocalized_female'];
  $nonvocalized_alternative = $Record['nonvocalized_alternative'];
  $vocalized_alternative = $Record['vocalized_alternative'];
?>

<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_word_form(form) {
    edit_word_form = form;
/*
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
*/
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
        <td>česky</td>
        <td><input type="text" name="czech"  size="50" value="<?php echo $czech?>" /></td>
      </tr>
      <tr class="akt">
        <td>česky v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td><input type="text" name="czech_female"  size="50" value="<?php echo $czech_female?>" /></td>
      </tr>
      <tr class="akt">
        <td>anglicky</td>
        <td><input type="text" name="english"  size="50" value="<?php echo $english?>" /></td>
      </tr>
      <tr class="akt">
        <td>druh slova v češtině</td>
        <td><input type="text" name="word_category"  size="50" value="<?php echo $word_category?>" /></td>
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
        <td><?php if($language == 2): ?>
            <select name="word_category_foreign">
                <option value="" <?php echo (empty($word_category_foreign))? 'selected="selected"' : ""?> >  </option>
                <option value="שם עצם" <?php echo ($word_category_foreign === "שם עצם")? 'selected="selected"' : ""?> > ש"ע </option>
                <option value="מילת חיבור" <?php echo ($word_category_foreign === "מילת חיבור")? 'selected="selected"' : ""?> > מ"ח </option>
                <option value="מילת קריאה" <?php echo ($word_category_foreign === "מילת קריאה")? 'selected="selected"' : ""?> > מ"ק </option>
                <option value="פועל" <?php echo ($word_category_foreign === "פועל")? 'selected="selected"' : ""?> > פ' </option>
                <option value="מילת יחס" <?php echo ($word_category_foreign === "מילת יחס")? 'selected="selected"' : ""?> > מ"י </option>
                <option value="תואר הפועל" <?php echo ($word_category_foreign === "תואר הפועל")? 'selected="selected"' : ""?> > תה"פ </option>
                <option value="שם מספר" <?php echo ($word_category_foreign === "שם מספר")? 'selected="selected" ' : ""?> > ש"מ </option>
                <option value="מילת שאלה" <?php echo ($word_category_foreign === "מילת שאלה")? 'selected="selected" ' : ""?> > מ"ש </option>
                <option value="מילת גוף" <?php echo ($word_category_foreign === "מילת גוף")? 'selected="selected" ' : ""?> > מ"ג </option>
                <option value="תואר" <?php echo ($word_category_foreign === "תואר")? 'selected="selected" ' : ""?> > ת' </option>
                <option value="ביטוי" <?php echo ($word_category_foreign === "ביטוי")? 'selected="selected" ' : ""?> >  ביטוי  </option>
                
            </select>
        <?php else: ?>
            <input type="text" name="word_category_foreign"  size="50"<?php echo $word_category_foreign ?> />
        <?php endif;?></td>
      </tr>
      
      <tr class="akt">
        <td>slovesná třída</td>
        <td><input type="text" name="verbal_class"  size="50" value="<?php echo $verbal_class?>" /></td>
      </tr>
      <tr class="akt">
        <td>přítomný čas / množné číslo <br />všech podstatných jmen a <br />přídavných jmen mužského rodu</td>
        <td<?php if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
               <input type="text" name="present"  size="29" 
                      <?php if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                      onfocus="aktivujKlavesnici('edit_word_form.present')" 
                      value="<?php echo $present?>" /></td>
      </tr>
      <tr class="akt">
        <td>minulý čas / jednotné číslo <br />všech podstatných jmen a <br />přídavných jmen mužského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="past"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.past')"
                       value="<?php echo $past?>" /></td>
      </tr>
      
      <tr class="akt">
        <td>alternativní vokalizovaný tvar</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="vocalized_alternative"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.vocalized_alternative')"
                       value="<?php echo $vocalized_alternative?>" /></td>
      </tr>


      <tr class="akt">
        <td>jednotné číslo podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="single_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.single_female')"
                       value="<?php echo $single_female?>" /></td>
      </tr>
      <tr class="akt">
        <td>množné číslo podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="plural_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.plural_female')"
                       value="<?php echo $plural_female?>" /></td>
      </tr>
      
      
      <tr class="akt">
        <td>status constructus číslovek, jednotného čísla podstatných jmen a jednotného čísla přídavných jmen mužského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="status_constructus_single"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.status_constructus_single')"
                       value="<?php echo $status_constructus_single?>" /></td>
      </tr>
      <tr class="akt">
        <td>status constructus množného čísla podstatných jmen a přídavných jmen mužského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="status_constructus_plural"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.status_constructus_plural')"
                       value="<?php echo $status_constructus_plural?>" /></td>
      </tr>
      
       <tr class="akt">
        <td>status constructus jednotného čísla přídavných jmen ženského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="status_constructus_single_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.status_constructus_single_female')"
                       value="<?php echo $status_constructus_single_female?>" /></td>
      </tr>
      <tr class="akt">
        <td>status constructus množného čísla přídavných jmen ženského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="status_constructus_plural_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.status_constructus_plural_female')"
                       value="<?php echo $status_constructus_plural_female?>" /></td>
      </tr>
      
      <tr class="akt">
        <td>status constructus jednotného čísla podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="status_constructus_single_noun_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.status_constructus_single_noun_female')"
                       value="<?php echo $status_constructus_single_noun_female?>" /></td>
      </tr>
      <tr class="akt">
        <td>status constructus množného čísla podstatných jmen v ženském rodě (pouze u přechylovatelných podstatných jmen)</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="status_constructus_plural_noun_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.status_constructus_plural_noun_female')"
                       value="<?php echo $status_constructus_plural_noun_female?>" /></td>
      </tr>
      




      <tr class="akt">
        <td>jednotné číslo přídavných <br /> jmen ženského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="single_adj_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.single_adj_female')"
                       value="<?php echo $single_adj_female?>" /></td>
      </tr>
      <tr class="akt">
        <td>množné číslo přídavných <br /> jmen ženského rodu</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
                <input type="text" name="plural_adj_female"  size="29" 
                       <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
                       onfocus="aktivujKlavesnici('edit_word_form.plural_adj_female')"
                       value="<?php echo $plural_adj_female?>" /></td>
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
        <td>konjugace</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="conjugation"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.conjugation')" 
               value="<?php echo $conjugation?>" /></td>
      </tr>
      
      <tr class="akt">
        <td>imperativ</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="imperative"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.imperative')" 
               value="<?php echo $imperative?>" /></td>
      </tr>
      
      
            <tr class="akt">
        <td>vokalizovaný tvar</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="vocalized"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.vocalized')" 
               value="<?php echo $vocalized?>" 
               disabled="disabled" /></td>
      </tr>
      
      <tr class="akt">
        <td>nevokalizovaný tvar</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="nonvocalized"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.nonvocalized')" 
               value="<?php echo $nonvocalized?>" /></td>
      </tr>

      <tr class="akt">
        <td>nevokalizovaný tvar v ženském rodě – pouze u přechylovatelných</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="nonvocalized_female"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.nonvocalized_female')" 
               value="<?php echo $nonvocalized_female?>" /></td>
      </tr>

      <tr class="akt">
        <td>alternativní nevokalizovaný tvar</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="nonvocalized_alternative"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.nonvocalized_alternative')" 
               value="<?php echo $nonvocalized_alternative?>" /></td>
      </tr>
      
            <tr class="akt">
        <td>předložka se zájmenným sufixem (ve všech možných tvarech)</td>
        <td<?php  if ($word_lang == 1 || $word_lang == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($word_lang == 1 || $word_lang == 2) echo "class=\"arabic\"\n" ?>
               name="prefix"  
               size="29"
               onfocus="aktivujKlavesnici('edit_word_form.prefix')" 
               value="<?php echo $prefix?>" /></td>
      </tr>
      
        
      
      <tr class="akt">
        <td>kořen</td>
        <td>
                <input type="text" name="root"  size="50" class="akkad" 
                       onfocus="aktivujKlavesnici('edit_word_form.root')"
                       value="<?php echo $root?>" /></td>
      </tr>
      <tr class="akt">
        <td>rod ('f'/'m' nebo prázdné) now: <?php echo $gender ?></td>
        <td>
        <?php if($language == 2): ?>
            <select name="gender">
		
	        <option <?php echo (empty($gender))? 'selected="selected" ' : ""?>value=""> </option>
                <option <?php echo (trim($gender) === "'ז")? 'selected="selected" ' : ""?>value="'ז">      'ז    </option>
                <option <?php echo (trim($gender) === "'נ")? 'selected="selected" ' : ""?>value="'נ">  'נ </option>
		<option <?php echo (trim($gender) === "'ז'+נ")? 'selected="selected" ' : ""?>value="'ז'+נ">  'ז'+נ </option>
            </select>
        <?php else: ?>
            <input type="text" name="gender"  size="1" class="akkad" 
                       onfocus="aktivujKlavesnici('edit_word_form.gender')"
                       value="<?php echo trim($gender)?>" />
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

