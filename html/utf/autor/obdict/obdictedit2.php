<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from the Old Babylonian Dictionary</title>
</head>
<body>
<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	$zmena ='1';
	$datum = Date ("Y-m-d");
	if (! $spojeni)
	{
    echo ("Sorry, it was impossible to connect to the database, try later!<BR>\n");
		exit;
	}
		if (@Pg_Exec ($spojeni, "UPDATE obdict SET text1='$text1', text2='$text2', zmena='$zmena', autor='$autor', datum='$datum' WHERE (oid='$co')"))
			echo ("Dictionary item saved OK:<br>\n");
		else			
		{
			echo ("An error occured, item change was not saved !\n");
		}
  @$result = Pg_Exec(
		"select oid, item, text1, text2 from obdict WHERE oid='$co'");
  if (!$result):
    echo "An error occured!";
    break;
  endif;
  echo "<BR>";
  @$result2 = Pg_Exec(
		"select oid, item, text1, text2, autor from obdict WHERE oid='$co'");
  echo "<table border=1>";
  echo "<tr><td><center>dictionary item</center></td><td><center><b> description </b></center></td><td><center><b><small>short czech translation</small></b></center></td></tr>";
  for ($j=0; $j < Pg_NumRows($result2); $j++):
    $zaznam = Pg_Fetch_Array($result2, $j);
    echo ("<tr><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=2>".$zaznam["item"]."</font></td><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=3>".$zaznam["text1"]."</FONT></td><td><FONT FACE='Arial Unicode MS' SIZE=3>".$zaznam["text2"]."</FONT></td></tr><TR>&nbsp;</TR>\n");
    echo ("<tr><td>author abbreviation:&nbsp;".$zaznam["autor"]."</td></tr>\n");
  endfor;
  echo "</table>";
	Pg_Close ($spojeni);
?>
	<form>
			<INPUT TYPE="Button" VALUE="Bring me back to select other dictionary item" onClick="history.go(-3)">
  </form>
</body>
</html>