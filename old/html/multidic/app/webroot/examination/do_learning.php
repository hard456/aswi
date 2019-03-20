 
<div class="content_home_thin">

<?php
require_once("./examination/learning.php");


if ($cnt_done < $count) {
  
  $slovicko = get_word_to_learn($source, $lection);
  $cnt_done++;
  //print_r($slovicko);
  switch ($type) {
    case("to_cz"):
    case("to_en"):
      $original = $slovicko["past"];
    break;
    case("from_cz"):
      $original = $slovicko["czech"];
    break;
    case("from_en"):
      $original = $slovicko["english"];
    break;
    default:
      print_hlasku("Chyba typu zkouseni");
  }
  //print_r($original);
}
else {
  print_hlasku("Hotovo");
  echo "</div>";
  return;
}
?>
  <script language="javascript">
				<!--
				var visible = false;
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
        -->
  </script>
  <table>
    <thead align="center"> <h3 class="nadpis2"><?php echo lang("Přeložte:") ?></h3> </thead>
    <tbody>
    <table border="0">
    <form action="" method="POST" name="do_exam_form">
      <tr class="akt">
        <td><?php echo lang("Originál:") ?></td>
        <td<?php
        if ( $type == "to_cz" || $type == "to_en" )
           echo " class=\"arabic\"";        
        ?>><?php
          echo $original;
        ?></td>
      </tr>
      <tr class="akt">
        <td><?php echo lang("Překlad:") ?></td>
        <td>
          
          <input type="button"
                 id="my_button"
                 value="<?php echo lang("Zobrazit") ?>"
                 onclick="javascript:return switch_okynko_visibility()" />
          
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="source" value="<?php echo urlencode($source); ?>" />
          <input type="hidden" name="lection" value="<?php echo urlencode($lection); ?>" />
          <input type="hidden" name="count" value="<?php echo urlencode($count); ?>" />
          <input type="hidden" name="cnt_done" value="<?php echo urlencode($cnt_done); ?>" />
          <input type="hidden" name="type" value="<?php echo urlencode($type); ?>" />
          <input type="submit" value="<?php echo lang("Dál"); ?>" />
        </td>
        <td>&nbsp;</td>
      </tr>
    </form>
    </table>
    </tbody>
  </table>
  

  
<div id="okynko">

<?php echo __get_word_in_card_format($slovicko); ?>

</div>



</div>


<?php insert_picture(); ?>
