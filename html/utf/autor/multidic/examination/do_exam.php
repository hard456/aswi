<?
require_once("./examination/exam.php");

if (!Empty($action) || $action == "do_exam") {
  //zavolat funkci, ktera otestuje zda je to dobre
  //podle toho nastavi priznakove bity
  
  $navrat = exam_word($IDdict, $IDexam, $type, $to);
  
  if ($navrat != NULL) {
    print_hlasku("Je mi líto, ale vaše odpověď '$to' není správná.");
    print_hlasku("Správná odpověď je: '$navrat'");
  }
  else {
    print_hlasku("Správně");
  }
}
$slovicko = get_exam_word($examing, $step);

if ($slovicko == NULL) {
  //ukoncit zkouseni
  //tj. uklidit spravne zodpovezene polozky nastavit rating.
  //vypsat hlasku...
    
  $pocet_slov = get_pocet_slov($examing);
  $pocet_spatnych_slov = get_pocet_spatnych_slov($examing);
  $pocet_spravnych_slov = $pocet_slov - $pocet_spatnych_slov;
  $rating = ($pocet_spravnych_slov / $pocet_slov) * 100;
  
  print_hlasku("Zkouseni je hotove. 
                Odpověděl jste správně $pocet_spravnych_slov slov z celkového počtu $pocet_slov (tj. $rating %)");
  
  uklid($examing, $rating);
  exit;
}

$language = $slovicko["language"];
?>
<? if ($type == "to_cz" || $type == "to_en") :?>

  <table>
    <thead align="center"> <h3 class="nadpis2">Přeložte:</h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="do_exam_form">
      <tr class="akt">
        <td>Originál:</td>
        <td dir="rtl"><? echo $slovicko["past"] ?></td>
      </tr>
      <tr class="akt">
        <td>Překlad:</td> 
        <td><input type="text" 
                             name="to"  
                             size="50" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="IDdict" value="<? echo $slovicko["IDdict"] ?>">
          <input type="hidden" name="IDexam" value="<? echo $slovicko["IDexam"] ?>">
          <input type="hidden" name="action" value="do_exam">
          <input type="hidden" name="examing" value="<? echo $examing ?>">
          <input type="hidden" name="type" value="<? echo $type ?>">
          <input type="submit" value="Dál">
        </td>
        <td>&nbsp;</td>
      </tr>
    </form>
    </table>
    </tbody>
  </table>


<? else: ?>
  <table>
    <thead align="center"> <h3 class="nadpis2">Přeložte:</h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="do_exam_form">
      <tr class="akt">
        <td>Originál:</td>
        <td><? echo (($type == "from_cz") ? $slovicko["czech"]:$slovicko["english"]) ?></td>
      </tr>
      <tr class="akt">
        <td>Překlad:</td>
        <td dir="rtl"><input type="text" 
                             name="to"  
                             size="50"
                             onfocus="aktivujKlavesnici('do_exam_form.to')" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="IDdict" value="<? echo $slovicko["IDdict"] ?>">
          <input type="hidden" name="IDexam" value="<? echo $slovicko["IDexam"] ?>">
          <input type="hidden" name="action" value="do_exam">
          <input type="hidden" name="examing" value="<? echo $examing ?>">
          <input type="hidden" name="type" value="<? echo $type ?>">
          <input type="submit" value="Dál">
        </td>
        <td>&nbsp;</td>
      </tr>
    </form>
    </table>
    </tbody>
  </table>
  
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("do_exam_form.to");
  ?>
</div>
<? endif; ?>
