<?php 
require_once("./administration/context.php");


if (!Empty($action) && $action == "link_context") {
  link_context($context, $word_id);
  
}
else {
?>
<table>
    <thead align="center"> <h3 class="nadpis2">Připoj existující kontext</h3> </thead>
    <tbody>
    <form action="" method="POST" name="link_context_form">
      <table border="0">
      <tr class="akt">
        <td>Vyberte kontext*</td>
        <td>
          <?php  $povol = print_context_chooser($source_id); ?>
        </td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="link_context" />
          <input type="hidden" name="word_id" value="<?php echo $word_id?>" />
          <input type="hidden" name="source" value="<?php echo $source_id?>" />
          <input type="hidden" name="language" value="<?php echo $language?>" />
          <?php 
          if ($povol) echo'<input type="submit" value="Připoj" />';
          ?>
        </td>
        <td>&nbsp;</td>
      </tr>
    </form>
    </tbody>
  </table>
<?php 
echo_zpet_do_slovniku();
} //END OF ELSE
?>
