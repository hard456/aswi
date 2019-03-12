<?php 
  require_once("./administration/source.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_source") {
  
  if (Empty($title)) {
    print_hlasku("Název musíte vyplnit");
  }
  else if (Empty($from_page)) {
    print_hlasku("Od stránky musíte vyplnit");
  }
  else if (Empty($to_page)) {
    print_hlasku("Do stránky musíte vyplnit");
  }
  else {
    update_source($title, $subtitle, $place, $publication, $publication_no, 
                  $from_page, $to_page, $language, $year, $source_id);
    //print_table_of_source();
    $vypis_edit = false;
  }
}
if($vypis_edit){
  
  $Record          = get_source($source_id);
  $title           = $Record[1];
  $subtitle        = $Record[2];
  $place           = $Record[3];
  $publication     = $Record[4];
  $publication_no  = $Record[5];
  $from_page       = $Record[6];
  $to_page         = $Record[7];
  $language        = $Record[8];
  $year            = $Record[9];


?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_source_form(form) {
    new_source_form = form;
    if (new_source_form.title.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_source_form.title);
      return false;
    }
    if (new_source_form.from_page.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_source_form.from_page);
      return false;
    }
    if (new_source_form.to_page.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(new_source_form.to_page);
      return false;
    }
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav zdroj</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_source_form" onSubmit="return validate_edit_source_form(this)">
      <table border="0">
      <tr class="akt">
        <td>titul*</td>
        <td><input type="text" name="title"  size="50" maxlength="100" value="<?php echo($title)?>"/></td>
      </tr>
      <tr class="akt">
        <td>podtitul</td>
        <td><input type="text" name="subtitle"  size="50" maxlength="100" value="<?php echo($subtitle)?>"/></td>
      </tr>
      <tr class="akt">
        <td>místo</td>
        <td><input type="text" name="place"  size="50" maxlength="100" value="<?php echo($place)?>"/></td>
      </tr>
      <tr class="akt">
        <td>publikace</td>
        <td><input type="text" name="publication"  size="50" maxlength="100" value="<?php echo($publication)?>"/></td>
      </tr>
      <tr class="akt">
        <td>publikační číslo</td>
        <td><input type="text" name="publication_no"  size="50" maxlength="30" value="<?php echo($publication_no)?>"/></td>
      </tr>
      <tr class="akt">
        <td>od strany*</td>
        <td><input type="text" name="from_page"  size="50" maxlength="100" value="<?php echo($from_page)?>"/></td>
      </tr>
      <tr class="akt">
        <td>do strany*</td>
        <td><input type="text" name="to_page"  size="50" maxlength="100" value="<?php echo($to_page)?>"/></td>
      </tr>
      <tr class="akt">
        <td>jazyk</td>
        <td><?php insert_language_chooser();?></td>
      </tr>
      <tr class="akt">
        <td>rok</td>
        <td><input type="text" name="year"  size="50" maxlength="4" value="<?php echo($year)?>"/></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_source">
          <input type="hidden" name="source_id" value="<?php echo $source_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  
  <script language="javascript">
				<!--
					var focus = document.edit_source_form.title;
  				focus.focus();
				-->
  </script>
<?php
  }//end of else
?>
