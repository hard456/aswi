<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Update descr.2</title>
</head><body>
<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
//	$zmena ='1';
	$datum = Date ("Y-m-d");
	if (! $spojeni)
	{
    echo ("Sorry, it was impossible to connect to the database, try later!<BR>\n");
		exit;
	}
		if (@Pg_Exec ($spojeni, "UPDATE obtextp SET type='$type', origin='$origin', ruler='$ruler', year='$year', month='$month', notedate='$notedate', autor='$autor', datum='$datum',  WHERE (oid='$co')"))
			echo ("new descr. saved<br>\n");
		else			
		{
			echo ("An error occured, item change was not saved !\n");
		}
  @$result = Pg_Exec(
		"select oid, type, origin, ruler, year, month, notedate, autor, datum from obtextp WHERE oid='$co'");
  if (!$result):
    echo "An error occured!";
    break;
  endif;
  echo "<BR>";
  @$result2 = Pg_Exec(
		"select oid, book, chapter, type, origin, ruler, year, month, notedate, autor, datum from obdict WHERE oid='$co'");
  echo "<table border=1>";
  echo "<tr><td>book</td><td>chapter</td>type</td><td>origin</td><td>ruler</td><td>year</td><td>month</td><td>notedate</td><td>author</td><td>date</td></tr>";
  for ($j=0; $j < Pg_NumRows($result2); $j++):
    $zaznam = Pg_Fetch_Array($result2, $j);
    echo ("<tr><td>".$zaznam["book"]."</td><td>".$zaznam["chapter"]."</td><td>".$zaznam["type"]."</td><td>".$zaznam["origin"]."</td><td>".$zaznam["ruler"]."</td><td>".$zaznam["year"]."</td><td>".$zaznam["month"]."</td><td>".$zaznam["notedate"]."</td><td>".$zaznam["autor"]."</td><td>".$zaznam["datum"]."</td></tr>");
    echo ("<TR>&nbsp;</TR>\n");
  endfor;
  echo "</table>";
	Pg_Close ($spojeni);
?>
	<form>
			<INPUT TYPE="Button" VALUE="Bring me back to select another item" onClick="history.go(-3)">
  </form>
</body>
</html>