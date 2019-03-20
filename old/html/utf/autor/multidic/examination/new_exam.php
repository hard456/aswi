<?
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

switch ($krok) {
  case (0):  
?>
  <table>
    <thead align="center"> <h3 class="nadpis2">Vyberte zdroj ze kterého chcete zkoušet</h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="choose_source_form">
      <tr class="akt">
        <td><?php echo(get_source_chooser(NULL, 10))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_source">
          <input type="submit" value="Dál">
        </td>
      </tr>
    </form>
    </tbody>
  </table>


<?
  break;
  case (1):
?>
  <table>
    <thead align="center"> <h3 class="nadpis2">Vyberte lekci ze které chcete zkoušet</h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="choose_lection_form">
      <tr class="akt">
        <td><?php echo(get_lection_chooser($source, 10))?></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_lection">
          <input type="hidden" name="source" value="<? echo $source ?>">
          <input type="submit" value="Dál">
        </td>
      </tr>
    </form>
    </tbody>
  </table>

<?
  break;
  case (2):
?>
  <table>
    <thead align="center"> <h3 class="nadpis2">Vyberte z kolika slovíček chcete vyzkoušet</h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="choose_count_form">
      <tr class="akt">
        <td><?php echo(get_count_chooser($source, $lection))?></td>
      </tr>
      <tr>
        <td>
        <fieldset>
          <legend>Vyberte typ zkouseni</legend>
            <input type="radio" name="type" value="from_cz" checked="true" /> Z češtiny<br /> 
            <input type="radio" name="type" value="to_cz" /> Do češtiny<br />
            <input type="radio" name="type" value="from_en" /> Z angličtiny<br />
            <input type="radio" name="type" value="to_en" /> Do angličtiny
        </fieldset>
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="select_count">
          <input type="hidden" name="lection" value="<? echo $lection ?>">
          <input type="hidden" name="source" value="<? echo $source ?>">
          <input type="submit" value="Dál">
        </td>
      </tr>
    </form>
    </tbody>
  </table>

<?
  break;
  case (3):
  $IDexaming = create_examing($ses_IDuser, $source, $lection, $count, $type);
  
  
?>
 <table>
    <thead align="center"> <h3 class="nadpis2">Zkoušení vytvořeno</h3> </thead>
    <tbody>
    <table border="0">
      <tr class="akt">
        <td></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <a href="?nav_id=do_exam&examing=<? echo $IDexaming ?>&type=<? echo $type ?>" class="active">Začít</a>
        </td>
      </tr>
    </tbody>
  </table> 
<?
}
?>
