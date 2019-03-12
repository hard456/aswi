<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
  <title>Edit an item from the OBTC rules</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body>
<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Sorry, it was impossible to connect to the database, try later!<BR>\n");
		exit;
	}
		if (@Pg_Exec ($spojeni, "UPDATE characters SET charview='$charview', char2b='$char2b', charentity='$charentity', description='$description' WHERE (oid='$OID')"))
			echo ("character was updated successfully:<br>\n");
		else			
		{
			echo ("An error occured, item change was not saved !\n");
		}
  @$result = Pg_Exec(
		"select oid, charview, char2b, charentity, description from characters WHERE oid='$OID'");
  if (!$result):
    echo "An error occured!";
    break;
  endif;
  echo "<BR>";
  @$result2 = Pg_Exec(
		"select oid, charview, char2b, charentity, description from characters WHERE oid='$OID'");
  echo "<table border=1>";
  echo "<tr><td><center>character in Unicode font</center></td><td><center><b> 2b Unicode </b></center></td><td><center><b><small>entity Unicode</small></b></center></td><td>description</td></tr>";
  for ($j=0; $j < Pg_NumRows($result2); $j++):
    $zaznam = Pg_Fetch_Array($result2, $j);
    echo ("<tr><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=2>".$zaznam["charview"]."</font></td><td><FONT FACE='VERDANA' SIZE=3>".$zaznam["char2b"]."</FONT></td><td><FONT FACE='VERDANA' SIZE=3>".$zaznam["charentity"]."</FONT></td><td class=td3>".$zaznam["description"]."</td></tr>\n");
  endfor;
  echo "</table>";
	Pg_Close ($spojeni);
?>
	<form>
			<INPUT TYPE="Button" VALUE="Bring me back to characters overview" onClick="history.go(-2)">
  </form>
</body>
</html>