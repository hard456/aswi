<?php
require_once("./administration/article.php");
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
    <thead align="center"> <h3 class="nadpis2">Vyberte jazyk pro nový článek</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_article_form0">
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
    <thead align="center"> <h3 class="nadpis2">Vyberte zdroj nového článku</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_article_form1">
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

    if (!Empty($action) && $action == "insert_new_article") {

    $user = $ses_IDuser;
  
  
    if (Empty($lection)) {
      print_hlasku("Lekci musíte vyplnit");
    }
    else {
      if (insert_article($language,$source,$lection,$title,$body,$note,$user)) {
        print_hlasku ("Článek přidán...");
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

  function validate_new_article_form(form) {
    new_article_form = form;

    if (new_article_form.lection.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_article_form.lection);
      return false;
    }
    
    return true;
  }
</script>

<table>
    <thead align="center"> <h3 class="nadpis2">Vlož nový článek</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_article_form" onSubmit="return validate_new_article_form(this)">
      <table>
      <tr class="akt">
        <td>název</td>
        <td<?php if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               name="title"  
               size="29"<?php znova($title)?> 
               onfocus="aktivujKlavesnici('new_article_form.title')" /></td>
      </tr>
      <tr class="akt">
        <td>text</td>
        <td<?php if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <textarea <?php if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
            name="body" 
            rows="7" 
            wrap="PHYSICAL" 
            cols="25"
            onfocus="aktivujKlavesnici('new_article_form.body')"
        ><?php znova_hodnota($body) ?></textarea>       
               
               
               </td>
      </tr>
      <tr class="akt">
        <td>poznámka</td>
        <td><input type="text" name="note"  size="50"<?php znova($note)?> /></td>
      </tr>
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50"<?php znova($lection)?> /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?php echo $language?>">
          <input type="hidden" name="source" value="<?php echo $source?>">
          <input type="hidden" name="action" value="insert_new_article">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.new_article_form.title;
  				focus.focus();
				-->
  </script>
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("new_article_form.title",false);
  ?>
</div>

<?php   }//end of switch ?>
