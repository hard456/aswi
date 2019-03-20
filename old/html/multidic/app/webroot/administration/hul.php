<?php 

require_once("../classes/db.php");
$spojeni = new DB_Sql();
$LANG = "cz";
$pattern = "~lang\\('(.*)'\\)~U"; 
printf("neco pred<br />\n");
foreach (glob("*.php") as $filename) { 
   printf("<br />\n<br />\n<b>%s</b>\n", $filename);
   preg_match_all($pattern, file_get_contents($filename), $matches); 
   foreach ($matches[1] as $val) { 
     printf("%s<br />\n", $val);
     $dotaz = "INSERT INTO translation (idf, language, translation) VALUES ($val, '$LANG', $val)";
     $spojeni->query($dotaz);
   } 
} 
?>