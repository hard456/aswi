<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>All used texts in the Old Babylonian Graphemic Analyses</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body>
<FORM ACTION="hledej2.php" METHOD="post">
<H3 align=center>All used texts in the Old Babylonian Graphemic Analyses</H3>
<?
$status = true;
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  if (@$result = @Pg_Exec (
                "SELECT editionabbreviation, editionnumber1, editionnumber2, dateyear, datemonth, dateday, ancientplace, documenttype, transliteration, ancientruler, ancientyear FROM graf02"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=2>$pocethesel items found.\n<BR>";
  echo "<table border=1 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff face=Verdana size=3><small>edition abbrv.</small></FONT></td><td><FONT color=#8080ff face=Verdana size=2>edition number</FONT></td><td><FONT color=#8080ff face=Verdana size=2>edition number</FONT></td><td><FONT color=#8080ff face=Verdana size=2>year</FONT></td><td><FONT color=#8080ff face=Verdana size=2>month</FONT></td><td><FONT color=#8080ff face=Verdana size=2>day</FONT></td><td><FONT color=#8080ff face=Verdana size=2>ancient place</FONT></td><td><FONT color=#8080ff face=Verdana size=2>document type</FONT></td><td><FONT color=#8080ff face=Verdana size=2>transliteration</FONT></td><td><FONT color=#8080ff face=Verdana size=2>ancient ruler</FONT></td><td><FONT color=#8080ff face=Verdana size=2>ancient year</FONT></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($editionabbreviation, $editionnumber1, $editionnumber2, $dateyear, $datemonth, $dateday, $ancientplace, $documenttype, $transliteration, $ancientruler, $ancientyear) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td class=td2>$editionabbreviation</td><td class=td2>$editionnumber1</td><td class=td2>$editionnumber2</td><td class=td2>$dateyear</td><td class=td2>$datemonth</td><td class=td2>$dateday</td><td class=td2>$ancientplace</td><td class=td2>$documenttype</td><td class=td2><small>$transliteration</small></td><td class=td2>$ancientruler</td><td class=td2>$ancientyear</td></tr>";
				}
				echo "</table>";
			}
			else
				echo ("pocet zaznamu je roven 0<br>");
		}
		else
			echo ("pri query nastala chyba<br>");
  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>