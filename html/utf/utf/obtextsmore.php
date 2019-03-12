<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
</head>
<body>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Selected items - the Old Babylonian Text Corpus</center></FONT></h2>
<?
$status = true;
	echo ("<FONT FACE='Arial Unicode MS' SIZE=3>");
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  if ($paragraph2 == 2) {
  $parag = $paragraph2 -1;
    }
  else if ($paragraph2 < 3) {
  $parag = $paragraph2;
    }
  else 
    { 
  $parag = $paragraph2 - 2;
  }
  $pod = ("paragraph='$parag' AND bookandchapter='$bookandchapter'");
  if (@$result = @Pg_Exec (
                "SELECT * FROM obtexts WHERE $pod"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
   echo "<tr><td><FONT color=#8080ff face=Verdana size=3>text in transliteration</FONT></td>";
  echo "<td><FONT color=#8080ff face=Verdana size=3>text quotation</FONT></td></tr>";
	for ($i = 0; $i < $pocethesel; $i++)
	{
	List ($bookandchapter, $paragraph, $transliteration) = Pg_Fetch_Row ($result, $i);
           echo "<tr><td><FONT FACE=\"Arial Unicode MS\">$transliteration<br></FONT></td>";           echo "<td><a href=\"./catalogue.php?bookandchapter=$bookandchapter\">$bookandchapter</a></td></TR>";
	echo "<TR><td><a href=\"./obtextcoment.php?paragraph2=$paragraph&bookandchapter=$bookandchapter\">$paragraph</A></td></TR>";
	}
	for ($r = 0; $r < 7; $r++)
	{
	$k = 1;
	$konec2 = ($paragraph + $k);
	$pod2 = ("bookandchapter='$bookandchapter' AND paragraph='$konec2'");
	if (@$result2 = @Pg_Exec (
                "SELECT * FROM obtexts WHERE $pod2"))
	{
	if (($pocethesel2 = @Pg_NumRows ($result2)) > 0)
	{
	for ($j = 0; $j < $pocethesel2; $j++)
	{
	List ($bookandchapter, $paragraph, $transliteration) = Pg_Fetch_Row ($result2, $j);
	echo "<tr><td><FONT FACE=\"Arial Unicode MS\">$transliteration</FONT></td>
	<td><a href=\"./obtextcoment.php?paragraph2=$paragraph&bookandchapter=$bookandchapter\">$paragraph</A></td></TR>";
	}
	}
}
}
}
}
	echo "</table>";
  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>