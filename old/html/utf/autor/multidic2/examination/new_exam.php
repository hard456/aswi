<?php
require_once("./examination/exam.php");

if (Empty($source) || $source == "") {
  $krok = 0;
}
else if (Empty($lection) || $lection == "") {
  $krok = 1;
}
else if (Empty($count) || $count == "" || Empty($type)) {
  $krok = 2;
}
else {
  $krok = 3;
}
//echo $krok;

switch ($krok) {
  case (0):  
?>
  <table>
    <thead align="center"> <h3 class="nadpis2"><?php printf(lang("Vyberte zdroj ze kterého chcete zkoušet (krok %d ze 3)"), $krok+1) ?></h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="choose_source_form">
      <tr class="akt">
        <td><?php echo(get_source_chooser(NULL))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_source">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        </td>
      </tr>
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
  <table>
    <thead align="center"> <h3 class="nadpis2"><?php printf(lang("Vyberte lekci ze které chcete zkoušet (krok %d ze 3)"), $krok+1) ?></h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="choose_lection_form">
      <tr class="akt">
        <td><?php echo $language;
        echo(get_lection_chooser($source, 10))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_lection">
          <input type="hidden" name="source" value="<?php echo $source ?>">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        </td>
      </tr>
    </form>
    </tbody>
  </table>

<?php
  break;
  case (2):
?>
  <table>
    <thead align="center"> <h3 class="nadpis2"><?php printf(lang("Vyberte z kolika slovíček chcete vyzkoušet (krok %d ze 3)"), $krok+1) ?></h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="choose_count_form">
      <tr class="akt">
        <td><?php echo(get_count_chooser($source, $lection))?></td>
      </tr>
      <tr class="akt">
        <td>
        <!--fieldset>
          <legend>Vyberte typ zkouseni</legend-->
            <input type="radio" name="type" value="from_cz" checked="true" /> <?php echo lang("Z češtiny") ?><br /> 
            <input type="radio" name="type" value="to_cz" /> <?php echo lang("Do češtiny") ?><br />
            <input type="radio" name="type" value="from_en" /> <?php echo lang("Z angličtiny") ?><br />
            <input type="radio" name="type" value="to_en" /> <?php echo lang("Do angličtiny") ?>
        <!--/fieldset-->
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_count">
          <input type="hidden" name="lection" value="<?php echo $lection ?>">
          <input type="hidden" name="source" value="<?php echo $source ?>">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        </td>
      </tr>
    </form>
    </tbody>
  </table>

<?php
  break;
  case (3):
  $IDexaming = create_examing($ses_IDuser, $source, $lection, $count, $type, $learning);
  
  $pomoc = ($learning == 'TRUE')? 'learning' : 'exam';
?>
 <table>
    <thead align="center"> <h3 class="nadpis2"><?php echo lang("Zkoušení vytvořeno") ?></h3> </thead>
    <tbody>
    <table border="0">

      <tr class="nadpis_sekce">
        <td>
          <a href="?nav_id=do_<?php echo $pomoc ?>&examing=<?php echo $IDexaming ?>&type=<?php echo $type ?>" class="active"><?php echo lang("Začít") ?></a>
        </td>
      </tr>
    </tbody>
  </table> 
<?php
}
?>
