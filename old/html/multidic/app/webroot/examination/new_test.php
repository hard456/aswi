<?php
require_once("./examination/test.php");

if (Empty($source) || $source == "") {
  $krok = 0;
}
else if (Empty($test) || $test == "") {
  $krok = 1;
}
else {
  $krok = 3;
  
}
//echo $krok;

switch ($krok) {
  case (0):  
?>
  <table>
    <thead align="center"> 
    <h3> Nový test </h3>
    <!--h3 class="nadpis2"><?php printf(lang("Vyberte zdroj ze kterého chcete test (krok %d ze 2)"), $krok+1) ?></h3--> </thead>
    <tbody>
    
    
    <h5> 1. Podle knížky </h5>
    
    <form action="" method="POST" name="choose_source_form">
    <table border="0">
      <tr class="akt">
        <td><?php echo(get_source_chooser(NULL))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_source">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        </td>
      </tr>
      </table>
    </form>
    
    <h5> 2. Podle čísla testu </h5>
    
    <form action="examination.php" method="GET" name="choose_source_form">
    <table border="0">
      <tr class="akt">
        <td><input type="text" name="test" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="nav_id" value="do_test">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        </td>
      </tr>
      </table>
    </form>
    
    <h5> 3. Podle gramatické kategorie </h5>
    
    <form action="examination.php" method="GET" name="choose_source_form">
    <table border="0">
      <tr class="akt">
        <td><?php echo get_test_category_chooser("test_category"); ?> </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="nav_id" value="test_by_category">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        </td>
      </tr>
      </table>
    </form>
    
    </tbody>
    
  </table>
  <script language="javascript">
				<!--
					var chooser = document.choose_source_form.source;
  				chooser.focus();
				-->
  </script>

<?php
  break;
  case (1):
?>
 <h3 class="nadpis2"><?php printf(lang("Vyberte ze seznamu test (krok %d ze 2)"), $krok+1) ?></h3> 
       <?php echo $language;
        echo(get_test_chooser($source))?>


<?php
}
?>
