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
  @$result = Pg_Exec(
		"insert into obdict (item, text1, zmena, autor, datum) VALUES (' $item','$text1','$zmena','$autor','$datum')");
		echo "<FONT FACE='Arial Unicode MS' SIZE=3>The item <b>$item</b> and description <b>$text1</b> <br>by the author <b>$autor</b> were correctly inserted into the dictionary.<BR>Please close this window!</FONT>";
  if (!$result):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
    break;
  endif;

  Pg_Close ($connection);
} while (false);
?>
</body>
</html>