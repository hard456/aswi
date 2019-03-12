<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
</head>
<body>
<FORM ACTION="hledej2.php" METHOD="post">
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Selected text group in the Old Babylonian Graphemic Analyses</center></FONT></h2>
<h3><FONT color=#8080ff face=Verdana size=4>List of items according to previous selection</FONT></h3>
<?
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  $pod1 = "(documenttype='$type' OR ancientplace='$type2')";
  if (@$result = @Pg_Exec (
                "SELECT editionabbreviation, editionnumber1, editionnumber2, dateyear, datemonth, dateday, ancientplace, documenttype, transliteration, ancientruler, ancientyear FROM graf02 WHERE ($pod1)"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>$pocethesel item(s) found.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td class=td1>edition abbrv.</td><td class=td1>edition number</td><td class=td1>edition number</td><td class=td1>year</td><td class=td1>month</td><td class=td1>day</td><td class=td1>ancient place</td><td class=td1>document type</td><td class=td1>transliteration</td><td class=td1>ancient ruler</td><td class=td1>ancient year</td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($editionabbreviation, $editionnumber1, $editionnumber2, $dateyear, $datemonth, $dateday, $ancientplace, $documenttype, $transliteration, $ancientruler, $ancientyear) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td class=td2>$editionabbreviation</td><td class=td2>$editionnumber1</td><td class=td2>$editionnumber2</td><td class=td2>$dateyear</td><td class=td2>$datemonth</td><td class=td2>$dateday</td><td class=td2>$ancientplace</td><td class=td2>$documenttype</td><td class=td2>$transliteration</td><td class=td2>$ancientruler</td><td class=td2>$ancientyear</td></tr>";
//echo "<tr><td>$editionabbreviation</td></tr>";
				}
				echo "</table>";
			}
			else
				echo ("nothing found<br>");
		}
		else
			echo ("an error by SQL query occured<br>");
  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>
