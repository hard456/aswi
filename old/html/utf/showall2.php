<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
</head>
<body>
<FORM ACTION="hledej2.php" METHOD="post">
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Attested signs - their logographic and syllabic values in the Old Babylonian Graphemic Analyses</center></FONT></h2>
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
//  $pod1 = "(documenttype='$type' OR ancientplace='$type2')";
  if (@$result = @Pg_Exec (
                "SELECT gnazev, bcislo01, lcteni, scteni FROM graf01"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "$pocethesel item(s) found.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><em><td><FONT color=#8080ff face=Verdana size=3>sign name</FONT></td><td><FONT color=#8080ff face=Verdana size=4><small>Borger's number</small></FONT></td><td><FONT color=#8080ff face=Verdana size=4><small>logographic values</small></FONT></td><td><FONT color=#8080ff face=Verdana size=4><small>syllabic values</small></FONT></td></em></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($gnazev, $bcislo, $lcteni, $scteni) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td>$gnazev</td><td>$bcislo</td><td>$lcteni</td><td>$scteni</td></tr>";
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