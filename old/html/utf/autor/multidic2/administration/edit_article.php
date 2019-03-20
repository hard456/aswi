<?php 
require_once("./administration/article.php");
$vypis_edit = true;
if (!Empty($action) && $action == "edit_article") {
  

  if (Empty($lection)) {
    print_hlasku("Lekci musíte vyplnit");
  }
  else {
    update_article($article_id, $title, $body, $note, $lection);
    
    echo_zpet_do_clanku();
    $vypis_edit = false;
  }
  
  
}
if($vypis_edit){
  
  $Record = get_article($article_id);
  $title         = $Record["title"];
  $body          = $Record["body"];
  $note          = $Record["note"];
  $lection       = $Record["lection"]; 

?>

<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_article_form(form) {
    edit_article_form = form;

    if (edit_article_form.lection.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_article_form.lection);
      return false;
    }
    
    return true;
  }
</script>

<table>
    <thead align="center"> <h3 class="nadpis2">Uprav článek</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_article_form" onSubmit="return validate_edit_article_form(this)">
      <table>
      <tr class="akt">
        <td>název</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <input type="text" <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
               class= "arabic"
               name="title"  
               size="29"
               value="<?php echo $title?>" 
               onfocus="aktivujKlavesnici('edit_article_form.title')" /></td>
      </tr>
      <tr class="akt">
        <td>text</td>
        <td<?php  if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
        <textarea <?php  if ($language == 1 || $language == 2) echo "class=\"arabic\"\n" ?>
        class= "arabic"
            name="body" 
            rows="7" 
            wrap="PHYSICAL" 
            cols="25"
            onfocus="aktivujKlavesnici('edit_article_form.body')"
        ><?php  echo $body ?></textarea>       
               
               
               </td>
      </tr>
      <tr class="akt">
        <td>poznámka</td>
        <td><input type="text" name="note"  size="50" value="<?php  echo $note ?>" /></td>
      </tr>
      <tr class="akt">
        <td>lekce*</td>
        <td><input type="text" name="lection"  size="50" value="<?php  echo $lection ?>" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="article_id" value="<?php echo $article_id?>">
          <input type="hidden" name="language" value="<?php echo $language?>">
          <input type="hidden" name="source" value="<?php echo $source?>">
          <input type="hidden" name="action" value="edit_article">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>


  <script language="javascript">
				<!--
					var focus = document.edit_article_form.title;
  				focus.focus();
				-->
  </script>
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("edit_article_form.title",false);
  ?>
</div>
<?php
  }//end of else
?>

