<?php
require_once("./functions/dictionary.php");

if (!Empty($action) && $action == "insert_new_source") {
  require_once("./administration/source.php");
  
  $zobrazit_znovu = true;
  
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
    insert_source($title, $subtitle, $place, $publication, $publication_no, $from_page, $to_page, $language, $year);
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

  function validate_new_source_form(form) {
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
    <thead align="center"> <h3 class="nadpis2">Vlož nový zdroj</h3> </thead>
    <tbody>
    <form action="" method="POST" name="new_source_form" onSubmit="return validate_new_source_form(this)">
      <table border="0">
      <tr class="akt">
        <td>titul*</td>
        <td><input type="text" name="title"  size="50" maxlength="100"<?php znova($title)?>/></td>
      </tr>
      <tr class="akt">
        <td>podtitul</td>
        <td><input type="text" name="subtitle"  size="50" maxlength="100"<?php znova($subtitle)?>/></td>
      </tr>
      <tr class="akt">
        <td>místo</td>
        <td><input type="text" name="place"  size="50" maxlength="100"<?php znova($place)?>/></td>
      </tr>
      <tr class="akt">
        <td>publikace</td>
        <td><input type="text" name="publication"  size="50" maxlength="100"<?php znova($publication)?>/></td>
      </tr>
      <tr class="akt">
        <td>publikační číslo</td>
        <td><input type="text" name="publication_no"  size="50" maxlength="30"<?php znova($publication_no)?>/></td>
      </tr>
      <tr class="akt">
        <td>od strany*</td>
        <td><input type="text" name="from_page"  size="50" maxlength="100"<?php znova($from_page)?>/></td>
      </tr>
      <tr class="akt">
        <td>do strany*</td>
        <td><input type="text" name="to_page"  size="50" maxlength="100"<?php znova($to_page)?>/></td>
      </tr>
      <tr class="akt">
        <td>jazyk</td>
        <td><?php insert_language_chooser();?></td>
      </tr>
      <tr class="akt">
        <td>rok</td>
        <td><input type="text" name="year"  size="50" maxlength="4"<?php znova($year)?>/></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="insert_new_source">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  
  <script language="javascript">
				<!--
					var focus = document.new_source_form.title;
  				focus.focus();
				-->
  </script>

