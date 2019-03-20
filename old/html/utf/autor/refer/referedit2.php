<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Sorry, it was impossible to connect to the database, try later!<BR>\n");
		exit;
	}
		if (@Pg_Exec ($spojeni, "UPDATE dictrefer SET item1='$item1', refer1='$refer1', refer2='$refer2' WHERE (oid='$oid')"))
			echo ("<H2>item from refer table saved OK:</H2>");
		else			
		{
			echo ("An error occured, item change was not saved !\n");
		}
  @$result = Pg_Exec(
		"select item1, refer1, refer2 from dictrefer WHERE oid='$oid'");
  if (!$result):
    echo "An error occured!";
    break;
  endif;
  echo "<BR>";
  @$result2 = Pg_Exec(
		"select item1, refer1, refer2 from dictrefer WHERE oid='$oid'");
  echo "<table border=1>";
  echo "<tr><td><center>item1</center></td><td><center><b>refer1</b></center></td><td>refer2 - reserved not used now</td></tr>";
  for ($j=0; $j < Pg_NumRows($result2); $j++):
    $zaznam = Pg_Fetch_Array($result2, $j);
    echo ("<tr><td><FONT FACE='Arial Unicode MS' SIZE=3>".$zaznam["item1"]."</font></td><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=2>".$zaznam["refer1"]."</font></td><td><FONT FACE='Arial Unicode MS' color=#3399ff SIZE=3>".$zaznam["refer2"]."</FONT></td></tr>\n");
  endfor;
  echo "</table>";
	Pg_Close ($spojeni);
?>
	<form>
			<INPUT TYPE="Button" VALUE="Bring me back to select other refer item" onClick="history.go(-2)">
  </form>
