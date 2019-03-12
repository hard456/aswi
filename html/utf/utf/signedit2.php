<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Sorry, it was impossible to connect to the database, try later!<BR>\n");
		exit;
	}
		if (@Pg_Exec ($spojeni, "UPDATE graf01 SET scteni='$scteni', lcteni='$lcteni' WHERE (oid='$oid')"))
			echo ("Sign item saved OK:<br>\n");
		else			
		{
			echo ("An error occured, item change was not saved !\n");
		}
  @$result = Pg_Exec(
		"select gnazev, bcislo01, scteni, lcteni from graf01 WHERE oid='$oid'");
  if (!$result):
    echo "An error occured!";
    break;
  endif;
  echo "<BR>";
  @$result2 = Pg_Exec(
		"select gnazev, bcislo01, scteni, lcteni from graf01 WHERE oid='$oid'");
  echo "<table border=1>";
  echo "<tr><td><center>ABZ number</center></td><td><center><b>sign name</b></center></td><td><center><b><small>logographic reading</small></b></center></td><td>syllabic reading</td></tr>";
  for ($j=0; $j < Pg_NumRows($result2); $j++):
    $zaznam = Pg_Fetch_Array($result2, $j);
    echo ("<tr><td>".$zaznam["bcislo01"]."</td><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=2>".$zaznam["gnazev"]."</font></td><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=3>".$zaznam["lcteni"]."</FONT></td><td><FONT FACE='Arial Unicode MS' SIZE=3>".$zaznam["scteni"]."</FONT></td></tr>\n");
  endfor;
  echo "</table>";
	Pg_Close ($spojeni);
?>
	<form>
			<INPUT TYPE="Button" VALUE="Bring me back to select other sign item" onClick="history.go(-2)">
  </form>
