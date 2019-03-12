<?php
require_once("./administration/test.php");
  /*zobrazí znovu obsah formuláře*/
  function znova($string) {
    global $zobrazit_znovu;
    if ($zobrazit_znovu)
      echo ' value="'.$string.'"';
  }
  
  function znova_hodnota($string) {
    global $zobrazit_znovu;
    if ($zobrazit_znovu)
      echo $string;
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
    <thead align="center"> <h3 class="nadpis2">Vyberte jazyk pro nový test</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_test_form0">
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

<?php
  break;
  case (1):
?>

  <table>
    <thead align="center"> <h3 class="nadpis2">Vyberte zdroj nového testu</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_test_form1">
      <table>
      <tr class="akt">
        <td><?php echo(get_source_chooser($language))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?php echo $language?>">
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

    if (!Empty($action) && $action == "insert_new_test") {

    $user = $_SESSION['ses_IDuser'];
  
    if (Empty($lection)) {
      print_hlasku("Lekci musíte vyplnit");
    }
    else {
      if (insert_test($language,$source,$lection,$title,$body,$note,$user, $test_category)) {
        print_hlasku ("Test přidán...");
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

  function validate_new_test_form(form) {
    new_test_form = form;

    if (new_test_form.lection.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_test_form.lection);
      return false;
    }
    return true;
  }
</script>

<script type="text/javascript" src="js/test.js" >
</script>

<table>
    <thead align="center"> <h3 class="nadpis2">Vlož nový test</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_test_form" onSubmit="return validate_new_test_form(this)">
      <table>
      <tr class="akt">
        <td>název</td>
        <td<?php if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  echo "class=\"arabic\"\n" ?>
               name="title"  
               size="29"<?php znova($title)?> 
               onfocus="aktivujKlavesnici('new_test_form.title')" /></td>
      </tr>
      <tr class="akt">
        <td>Instrukce</td>
        <td><input type="text" name="note"  size="50"<?php znova($note)?> />
        </td>
      </tr>
      
      <tr>
        <td>Nápověda:</td>
        <td>Možnosti do testu vložíte pomocí tohoto zápisu: 
        <strong>{správná odpověď/špatná/další špatná/další špatná}.</strong> 
        Špatných odpovědí může být libovolné množství.
        <br />
        Můžete použít pomocné tlačítko.
        
        <input type="button" name="jsaddselect" onclick="javascript:addSelect('body')" value="Vlož možnosti" />
        
        </td>
      </tr>
      <tr class="akt">
        <td>text</td>
        <td<?php  echo " dir=\"rtl\"" ?>>
        <textarea <?php echo "class=\"arabic\"\n style=\"font:60%\"" ?>
            name="body" 
            id="body"
            rows="7" 
            wrap="PHYSICAL" 
            cols="30"
            onfocus="aktivujKlavesnici('new_test_form.body')"
            onchange="javascript:render('body', 'platno')"
            onkeyup="javascript:render('body', 'platno')"
        ><?php znova_hodnota($body) ?></textarea>       
               
               
               </td>
      </tr>
      <tr class="akt">
        <td>Náhled</td>
        <td<?php if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <div id="platno" class="arabic" style="background-color: #EEE; border:solid 1px black; border-right: solid 3px black; border-bottom: solid 3px black; padding: 1em"> <p class="praznyodstavecbudesmazan"></p> </div>
        
          <script type="text/javascript">
            render('body', 'platno');
         </script>
        </td>
      </tr>

 
 
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50"<?php znova($lection)?> /></td>
      </tr>
      
      <tr class="akt">
        <td>gramatická kategorie</td>
        <td><?php echo(get_test_category_chooser('test_category', $test_category))?></td>
      </tr>
      
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?php echo $language?>">
          <input type="hidden" name="source" value="<?php echo $source?>">
          <input type="hidden" name="action" value="insert_new_test">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.new_test_form.title;
  				focus.focus();
				-->
  </script>
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("new_test_form.title",false);
  ?>
</div>

<?php   }//end of switch ?>
