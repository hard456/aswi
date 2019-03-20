<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from the Old Babylonian Dictionary</title>
</head>
<body>
<?
$status = true;
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Nepodarilo se pripojit k databázi!";
    break;
  endif;
  $zmena ='1';
  $datum = Date ("Y-m-d");

  @$result_translation = Pg_Exec("insert into TRANSLATION (translation) VALUES ('$translation')");
  if (!$result_translation):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
    break;
  endif;

  $idt = Pg_Exec("select id_translation from TRANSLATION where translation = '$translation'");
  $idt = Pg_Fetch_Row ($idt, 0, PGSQL_NUM);
  $idt = $idt[0];
  @$result = Pg_Exec("insert into CLASSIFICATION (id_word, id_translation, type) VALUES ($idw, $idt, '$type')");
  if (!$result):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$type<br></FONT>";
    break;
  endif;
  @$result = Pg_Exec("insert into CONTEXT (id_word, id_translation, context) VALUES ($idw, $idt, '$context')");
  if (!$result):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$context<br></FONT>";
    break;
  endif;
  $idc = Pg_Exec("select id_context from CONTEXT where context = '$context' and id_word = $idw and id_translation = $idt");
  $idc = Pg_Fetch_Row ($idc, 0, PGSQL_NUM);
  $idc = $idc[0];
  @$result = Pg_Exec("insert into SOURCE (id_context, source) VALUES ($idc, '$source')");
  if (!$result):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$source<br></FONT>";
    break;
  endif;
  
echo "<FONT FACE='Arial Unicode MS' SIZE=3>The item <b>$item</b> and description <b>$text1</b> <br>by the author <b>$autor</b> were correctly inserted into the dictionary.<BR>Please close this window!</FONT>";

  Pg_Close ($connection);
} while (false);
?>

</body>
</html>