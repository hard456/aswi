<?php 
require_once("./administration/test.php");
$vypis_edit = true;
if (!Empty($action) && $action == "edit_test") {
  
	if (Empty($lection)) {
      print_hlasku("Lekci musíte vyplnit");
    }
	else {
	    update_test($test_id, $title, $body, $note, $lection, $test_category);
	    //echo_zpet_do_slovniku();
	    $vypis_edit = false;
  	}
}
if($vypis_edit){
  $Record = get_test($test_id);
  $title         = $Record['title'];
  $body          = $Record['body'];
  $lection       = $Record["lection"];  
  $note        = $Record["note"];
  $test_category = $Record["test_category_id"];
  
?>

<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_test_form(form) {
    edit_test_form = form;

    if (edit_test_form.lection.value == "") {
      alert("Lekci musite vyplnit.");
      setFocus(edit_test_form.lection);
      return false;
    }
    return true;
  }
</script>




<script type="text/javascript" src="js/test.js" >
</script>





<table>
    <thead align="center"> <h3 class="nadpis2">Uprav test</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_test_form" onSubmit="return validate_edit_test_form(this)">
      <table>
      <tr class="akt">
        <td>název</td>
        <td<?php echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  echo "class=\"arabic\"\n" ?>
               name="title"  
               size="29"
               value="<?php echo $title ?>"
               onfocus="aktivujKlavesnici('new_test_form.title')" /></td>
      </tr>
      <tr class="akt">
        <td>Instrukce</td>
        <td><input type="text" name="note"  size="50" value="<?php echo $note ?>" />
        
        <input type="button" name="jsaddselect" onclick="javascript:addSelect('body')" value="Vlož možnosti" />
 
        </td>
      </tr>
      <tr class="akt">
        <td>text</td>
        <td<?php echo " dir=\"rtl\"" ?>>
        <textarea <?php  echo "class=\"arabic\"\n style=\"font:60%\"" ?>
            name="body" 
            id="body"
            rows="7" 
            wrap="PHYSICAL" 
            cols="30"
            onfocus="aktivujKlavesnici('new_test_form.body')"
            onchange="javascript:render('body', 'platno')"
            onkeyup="javascript:render('body', 'platno')"
        ><?php echo $body ?></textarea>       
               
               
               </td>
      </tr>
      <tr class="akt">
        <td>Náhled</td>
        <td<?php  echo " dir=\"rtl\"" ?>>
          <div id="platno" class="arabic" style="background-color: #EEE; border:solid 1px black; border-right: solid 3px black; border-bottom: solid 3px black; padding: 1em"> <p class="praznyodstavecbudesmazan"></p> </div>
        
          <script type="text/javascript">
            render('body', 'platno');
         </script>
        </td>
      </tr>

 
 
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50" value="<?php echo $lection ?>" /></td>
      </tr>
      <tr class="akt">
        <td>gramatická kategorie</td>
        <td><?php echo(get_test_category_chooser('test_category', $test_category))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="language" value="<?php echo $language?>">
          <input type="hidden" name="source" value="<?php echo $source?>">
          <input type="hidden" name="action" value="edit_test">
        </td>
        <td><input type="submit" value="Uložit"></td>
      </tr>
    </form>
    </tbody>
  </table>
  <script language="javascript">
				<!--
					var focus = document.edit_test_form.title;
  				focus.focus();
				-->
  </script>
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("edit_test_form.title",false);
  ?>
</div>



<?php
  }//end of else
?>

