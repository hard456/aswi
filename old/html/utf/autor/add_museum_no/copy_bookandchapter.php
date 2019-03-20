Dont run this. If you know, what this script can do and you want it, edit the source. 
 
<?php
  //exit();

  //
  //  SELECT SUBSTRING(bookandchapter, '([[:alnum:]]*_[[:alnum:]]*,([0-9]{1,3}))'), * from obtexts;
  //
  //
  
  require_once("./sql/db.php");
  $spojeni = new DB_Sql();
  $spojeni_ins = new DB_Sql();
  $dotaz = "SELECT bookandchapter from obtexts LIMIT 1000 OFFSET 0";
  $spojeni->query($dotaz);
  
  while ($spojeni->next_record()) {
    $bac = Trim($spojeni->Record['bookandchapter']);
    
    //echo $bac."\t   ";
    //$bac = eregi_replace("^\(", "", $bac);
    //$bac = eregi_replace(",$", "", $bac);
    //echo $bac."\n<br />";
  	@$spojeni_ins->query("INSERT INTO museum_no (bookandchapter) VALUES ('$bac')");
  }
  echo "hotovo.";
  
?>