<?php

  require_once("./administration/voice.php");
  $znovu = true;

if (!Empty($action) && $action == "add_article_voice") {
  
  if (Empty($soubor)) {
    print_hlasku("Musíte vybrat soubor");
  }
  else {
    $znovu = false;
    save_article_voice($soubor,$article_id);
    echo_zpet_do_clanku();
  }
}

if ($znovu) {
?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_add_article_voice_form(form) {
    add_article_voice_form = form;
    if (add_article_voice_form.file.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(add_article_voice_form.file);
      return false;
    }
    return true;
  }
</script>

<table>
    <thead align="center"> <h3 class="nadpis2">Vyber zvukový soubor</h3> </thead>
    <tbody>
    <form action=""  method="post" enctype="multipart/form-data" name="add_article_voice_form" onSubmit="return validate_add_article_voice_form(this)">
      <table border="0">
      <tr class="akt">
        <td>soubor</td>
        <td><input type="file" name="soubor"  size="50" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="add_article_voice">
          <input type="hidden" name="article_id" value="<?php echo $article_id?>">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
  
  <script language="javascript">
				<!--
					var focus = document.add_article_voice_form.file;
  				focus.focus();
				-->
  </script>
  
<?php
} //konec if
?>
