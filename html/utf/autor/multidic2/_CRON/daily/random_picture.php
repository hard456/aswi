<?
//musi se opravit podle skutecneho umisteni souboru

  require_once("../../classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "UPDATE pictures SET active = 0";
  $spojeni->query($dotaz);
  $dotaz = "SELECT \"IDpicture\" FROM pictures ORDER BY Random() LIMIT 1";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  $ID = $spojeni->Record["IDpicture"];
  $dotaz = "UPDATE pictures SET active = 1 WHERE \"IDpicture\" = $ID";
  $spojeni->query($dotaz);
  
  
  
  
  
?>
