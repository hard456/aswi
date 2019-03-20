<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from Old Babylonian Text Corpus</title>
</head>
<body>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<FONT FACE='Verdana' Color="#9bbad6"><h2><center>Attested chains - in the Old Babylonian Text Corpus</center></FONT></h2>
<?
$status = true;
	echo ("<FONT FACE='Arial Unicode MS, Code2000, Titus Cyberbit Basic' SIZE=3>");
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  $popis2 = URLDecode ($chain);
  echo "$popis2<BR>";
  echo ("For the searched item <b>$popis2</b> there was ");
//  $pod = ("stransliteration like '%$popis2%'");
//  $pod = $popis2;
  if (@$result = @Pg_Exec (
//                "SELECT * FROM cad WHERE $popis2"))
                "SELECT * FROM cad"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "$pocethesel item(s) found.<BR><BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><em><td>volume</td><td><FONT color=#8080ff face=Verdana size=4><small>page in the printed original</small></FONT></td></em><td><FONT color=#8080ff face=Verdana size=3>text</FONT></td></tr>";
		for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($volume, $page, $dicttext) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td>$volume</td><td>$page</td><td><FONT FACE=\"Arial Unicode MS, Code2000, Titus Cyberbit Basic\">$dicttext</FONT></td></tr>";
				}
				echo "</table>";
}
		else
		echo "nothing found!";
		echo "<form>";
					echo "<BR>&nbsp;&nbsp;&nbsp;";
					echo "<INPUT TYPE=\"Button\" VALUE=\"Bring me back to search other text chain.\" onClick=\"history.go(-1)\">";
		echo "</form>";
}
  Pg_Close($connection);
}
?>
</FONT>
</body>
</html>