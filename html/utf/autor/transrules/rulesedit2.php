<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
  <title>Edit an item from the OBTC rules</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body>
<?
  echo "OIDN:$OIDN";
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Sorry, it was impossible to connect to the database, try later!<BR>\n");
		exit;
	}
        	$datumN = Date ("Y-m-d H:00:00");
		if (@Pg_Exec ($spojeni, "UPDATE transrules SET bad='$bad', good='$good', notes='$notes', datum='$datumN', autor='$autorN' WHERE (oid='$OIDN')"))
			echo ("Rule was updated successfully:<br>\n");
		else			
		{
			echo ("An error occured, item change was not saved !\n");
		}
  @$result = Pg_Exec(
		"select oid, bad, good, notes, autor from transrules WHERE oid='$OIDN'");
  if (!$result):
    echo "An error occured!";
    break;
  endif;
  echo "<BR>";
  @$result2 = Pg_Exec(
		"select bad, good, notes, datum, autor from transrules WHERE oid='$OIDN'");
  echo "<table border=1>";
  echo "<tr><td><center>transcription in editio princeps</center></td><td><center><b> our unified transcription </b></center></td><td><center><b><small>notes</small></b></center></td><td>date</td><td>author's code</td></tr>";
  for ($j=0; $j < Pg_NumRows($result2); $j++):
    $zaznam = Pg_Fetch_Array($result2, $j);
    echo ("<tr><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=2>".$zaznam["bad"]."</font></td><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=3>".$zaznam["good"]."</FONT></td><td><FONT FACE='Arial Unicode MS' SIZE=3>".$zaznam["notes"]."</FONT></td><td>".$zaznam["datum"]."</td><td>".$zaznam["autor"]."</td></tr>\n");
  endfor;
  echo "</table>";
	Pg_Close ($spojeni);
?>
	<form>
			<INPUT TYPE="Button" VALUE="Bring me back to rules overview" onClick="history.go(-2)">
  </form>
</body>
</html>