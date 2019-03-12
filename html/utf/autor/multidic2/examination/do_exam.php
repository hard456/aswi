
<div class="content_home_thin">

<?php
require_once("./examination/exam.php");

if (!Empty($action) && $action == "do_exam") {
  //zavolat funkci, ktera otestuje zda je to dobre
  //podle toho nastavi priznakove bity
  
  $navrat = exam_word($IDdict, $IDexam, $type, $to);
  
  if ($navrat != NULL) {
  
    print_hlasku(sprintf(lang("Je mi líto, ale vaše odpověď '%s' není správná."), $to ));
    print_hlasku(lang("Slovo bylo:"));
    
    echo __get_word_in_card_format($navrat);
  }
  else {
    print_hlasku(lang("Správně"));
  }
}
else if (!Empty($action) && $action == "do_learning") {
  if (!Empty( $sub_button ) && $sub_button == lang("Uměl")) {
    set_exam_status($IDexam, 1);
    //echo "1";
  }
  else {
    set_exam_status($IDexam, 0);
    //echo "0";
  }
}
$slovicko = get_exam_word($examing, $step);

if ($slovicko == NULL) {
  //ukoncit zkouseni
  //tj. uklidit spravne zodpovezene polozky nastavit rating.
  //vypsat hlasku...
    
  $pocet_slov = get_pocet_slov_ve_zkouseni($examing);
  $pocet_spatnych_slov = get_pocet_spatnych_slov($examing);
  $pocet_spravnych_slov = $pocet_slov - $pocet_spatnych_slov;
  $rating = ($pocet_spravnych_slov / $pocet_slov) * 100;
  
  print_hlasku(sprintf(lang("Zkouseni je hotove.Odpověděl jste správně  %d slov z celkového počtu %d (tj. %0.2f %%)"),
                       $pocet_spravnych_slov, 
                       $pocet_slov, $rating));
  
  print_hlasku(get_vyslednou_hlasku($rating));
  uklid($examing, $rating);
  exit;
}

$language = $slovicko["language"];
?>

<?php if ($learning == 'TRUE') { ?>
  <script language="javascript">
				<!--
				//doba v sekundach
				var timeout = 5;
				//odpocet
				function odpocet() {
				  if(visible) return;
				
				  if (timeout == 0) {
				    switch_okynko_visibility();
				  }
				  else {
				    document.getElementById('my_button').value = '<?php echo lang("Zobrazit"); ?>'+' '+timeout;
				    timeout--;
            setTimeout("odpocet()",1000);
				  }
				}
				
				//viditelnost
				var visible = false;
				//zmena viditelnosti
				function switch_okynko_visibility() {
          if (visible) {
            visible = false;
            pomoc = 'hidden';
            popisek = '<?php echo lang("Zobrazit"); ?>';
          }
          else {
            visible = true;  
            pomoc = 'visible'; 
            popisek = '<?php echo lang("  Skrýt  ") ?>';
          }
          document.getElementById('okynko').style.visibility = pomoc ;
				  document.getElementById('my_button').value = popisek;
        }
        //spusteni odpocitavani
        setTimeout("odpocet()",1000);
        -->
  </script>
<?php } //end if ?>

<?php if ($type == "to_cz" || $type == "to_en") :?>

  <table>
    <thead align="center"> <h3 class="nadpis2"><?php echo lang("Přeložte:") ?></h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="do_exam_form">
      <tr class="akt">
        <td><?php echo lang("Originál:") ?></td>
        <td class="arabic"><?php echo $slovicko["past"] ?></td>
      </tr>
      <tr class="akt">
        <td><?php echo lang("Překlad:") ?></td> 
        <td>
      <?php if ($learning != 'TRUE') { ?>
        <input type="text" 
               name="to"  
               size="50" />
      <?php } else {?>       
        <input type="button"
               id="my_button"
               value="<?php echo lang("Zobrazit")." 6" ?>"
               onclick="javascript:return switch_okynko_visibility()" />  
      <?php } //end if else ?>
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>&nbsp;
          
        </td>
        <td>
          <input type="hidden" name="IDdict" value="<?php echo $slovicko["IDdict"] ?>">
          <input type="hidden" name="IDexam" value="<?php echo $slovicko["IDexam"] ?>">
          <input type="hidden" name="examing" value="<?php echo $examing ?>">
          <input type="hidden" name="type" value="<?php echo $type ?>">
        <?php if ($learning != 'TRUE') { ?>
          <input type="hidden" name="action" value="do_exam">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        <?php } else {?>
          <input type="hidden" name="action" value="do_learning">
          <input type="submit" name="sub_button" value="<?php echo lang("Uměl") ?>">
          <input type="submit" name="sub_button" value="<?php echo lang("Neuměl") ?>">
        <?php } // end if else ?>
          </td>
      </tr>
    </form>
    </table>
    </tbody>
  </table>
  
  <script language="javascript">
				<!--
					var focus = document.do_exam_form.to;
  				focus.focus();
				-->
  </script>

<?php else: ?>
  <table>
    <thead align="center"> <h3 class="nadpis2"><?php echo lang("Přeložte:") ?></h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="do_exam_form">
      <tr class="akt">
        <td><?php echo lang("Originál:") ?></td>
        <td><?php echo (($type == "from_cz") ? $slovicko["czech"]:$slovicko["english"]) ?></td>
      </tr>
      <tr class="akt">
        <td><?php echo lang("Překlad:") ?></td>
        <td<?php if ($language == 1 || $language == 2) echo " dir=\"rtl\"" ?>>
          <?php if ($learning != 'TRUE') { ?>
                      <input  <?php if ($language == 1 || $language == 2) echo "class=\"arabic\"\n         " ?>type="text" 
                             name="to"  
                             size="20"
                             onfocus="aktivujKlavesnici('do_exam_form.to')" />
          <?php } else {?>
            <input type="button"
                   id="my_button"
                   value="<?php echo lang("Zobrazit")." 6" ?>"
                   onclick="javascript:return switch_okynko_visibility()" />  
          <?php } //end if else ?>
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>&nbsp;
        </td>
        <td>
          <input type="hidden" name="IDdict" value="<?php echo $slovicko["IDdict"] ?>">
          <input type="hidden" name="IDexam" value="<?php echo $slovicko["IDexam"] ?>">
          <input type="hidden" name="examing" value="<?php echo $examing ?>">
          <input type="hidden" name="type" value="<?php echo $type ?>">
          <?php if ($learning != 'TRUE') { ?>
          <input type="hidden" name="action" value="do_exam">
          <input type="submit" value="<?php echo lang("Dál") ?>">
        <?php } else {?>
          <input type="hidden" name="action" value="do_learning">
          <input type="submit" name="sub_button" value="<?php echo lang("Uměl") ?>">
          <input type="submit" name="sub_button" value="<?php echo lang("Neuměl") ?>">
        <?php } // end if else ?>
        </td>
      </tr>
    </form>
    </table>
    </tbody>
  </table>
  
<?php endif; ?>
  
<?php if ($learning != 'TRUE') { ?>
  
<div id="key">
  <?php 
    require_once("./functions/keyboard.php");
    insert_keyboard("do_exam_form.to");
  ?>
</div>
<script language="javascript">
				<!--
					var focus = document.do_exam_form.to;
  				focus.focus();
				-->
  </script>
<?php } else {
   ///pri zkouseni vykreslime okynko s napovedou
?>
  <div id="okynko">

    <?php echo __get_word_in_card_format($slovicko); ?>

  </div>

<?php } //end if ?>

</div>

<?php insert_picture(); ?>
