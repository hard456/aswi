<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Selected text group in the Old Babylonian Graphemic Analyses</center></FONT></h2>
<h3><FONT color=#8080ff face=Verdana size=4>List of items according to previous selection</FONT></h3>
<?
$status = true;
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
//  $pod1 = "(documenttype='$type' OR ancientplace='$type2')";
  if (@$result = @Pg_Exec (
                "SELECT item1, refer1 FROM dictrefer"))
//WHERE ($pod1)"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>$pocethesel item(s) found.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff face=Verdana size=3><small>item1</small></FONT></td><td><FONT color=#8080ff face=Verdana size=4><small>refer1</small></FONT></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($item1, $refer1) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td><FONT FACE='Arial Unicode MS' SIZE=3>$item1</FONT></td><td><FONT FACE='Arial Unicode MS' SIZE=3>$refer1</FONT></td></tr>";
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