<?php 

//
$conn_string = "host=localhost port=5432 dbname=pokusna user=jara password=jara";
$dbconn = pg_connect($conn_string) or die('fuck') ;


define(LaId, "cz");



function projdi_soubor($filename) {
  $pattern = '~lang\\(("([^\\\\]*\\\\.)*[^\\\\"]*"|\'([^\\\\]*\\\\.)*[^\\\\\']*\')\\)~U';
  //$pattern = "~lang\\('(.*)'\\)~U";
  global $dbconn;
  printf("<br />\n<br />\n<b>Soubor %s:</b><br />\n", $filename);
  preg_match_all($pattern, file_get_contents($filename), $matches); 
  foreach ($matches[1] as $val) { 
    $val = substr($val, 1, strlen($val)-2);
    printf("vkladam: %s<br />\n", $val);
    $dotaz = "INSERT INTO translation (idf, language, translation) VALUES ('".addSlashes($val)."', '".LaId."', '".addSlashes($val)."')";
    pg_exec($dbconn, $dotaz );
  } 
}


//MAIN//

printf("<h1>Flush ./</h2>\n");
foreach (glob("*.php") as $filename) { 
  projdi_soubor($filename);
} 
printf("<h1>Flush ./examination/</h2>\n");
foreach (glob("./examination/*.php") as $filename) { 
   projdi_soubor($filename);
} 
projdi_soubor("./functions/dictionary.php");
?>
