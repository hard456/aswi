<?php 
  require_once("./administration/report.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_report") {

  
    update_report($czech, $english, $ratio);
    $vypis_edit = false;
  
}
if($vypis_edit){

  $Record      = get_report($ratio);
  $czech       = $Record[1];
  $english     = $Record[2];

?>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav zprávu</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_report_form">
      <table border="0">
      <tr class="akt">
        <td>česky*</td>
        <td><input type="text" name="czech"  size="80"  value="<?php echo $czech?>" /></td>
      </tr>
      <tr class="akt">
        <td>anglicky*</td>
        <td><input type="text" name="english"  size="80" value="<?php echo $english?>" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="edit_report">
          <input type="hidden" name="ratio" value="<?php echo $ratio?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
  
<?php
  }//end of else
?>
