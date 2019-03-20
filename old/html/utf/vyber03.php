<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Select a text group in the Old Babylonian Graphemic Analyses</center></h2>
<h1><FONT color=#8080ff face=Verdana size=4>List of items according to previous selection</FONT></h1>
<h3><FONT color=#000099 face=Verdana size=2></FONT><h3>
<FONT color=#8080ff FACE='Arial Unicode MS' SIZE=3><BR>
<p>
<?
$status = true;
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Nepodařilo se připojit k databázi!";
    break;
  endif;

  $pod1 = "(documenttype='$type' AND ancientplace='$type2')";
  @$result = Pg_Exec (
                "SELECT * FROM graf02 WHERE ($pod1)");
  $pocethesel = @Pg_NumRows ($result);
  echo "$pocethesel item(s) found.";
  if ($pocethesel == 0):
  echo "<br>Nothing found, try again.";
  break;
  endif;

  if (!$result):
    echo "there was probably an error, please, try again!";
    break;
  endif;

  echo "<BR>";
  echo "<table border=1 cellspacing=1 cellpadding=5>";
    echo "<tr><td><FONT color=#8080ff face=Verdana size=4>edition abbrv.</FONT></td><td><FONT color=#8080ff face=Verdana size=4>edition number</FONT></td><td><FONT color=#8080ff face=Verdana size=4>edition number</FONT></td><td><FONT color=#8080ff face=Verdana size=4>year</FONT></td><td><FONT color=#8080ff face=Verdana size=4>month</FONT></td><td><FONT color=#8080ff face=Verdana size=4>day</FONT></td><td><FONT color=#8080ff face=Verdana size=4>ancient place</FONT></td><td><FONT color=#8080ff face=Verdana size=4>document type</FONT></td><td><FONT color=#8080ff face=Verdana size=4>transliteration</FONT></td><td><FONT color=#8080ff face=Verdana size=4>ancient ruler</FONT></td><td><FONT color=#8080ff face=Verdana size=4>ancient year</FONT></td></tr><FONT face=Verdana size=4>\n";

  while ($row = Pg_Fetch_Array($result))
    echo "<tr><td>".$row["editionabbreviation"]."</td><td>".$row["editionnumber1"]."</td><td>".$row["editionnumber2"]."</td><td>".$row["dateyear"]."</td><td>".$row["datemonth"]."</td><td>".$row["dateday"]."</td><td>".$row["ancientplace"]."</td><td>".$row["documenttype"]."</td><td>".$row["transliteration"]."</td><td>".$row["ancientruler"]."</td><td>".$row["ancientyear"]."</td></tr>\n";
// <td>&nbsp; <a href=\"./deleteg1.php?koho=$ncislo\">delete</a> &nbsp;</td>"."<td><a href=\"./editg1.php?co=$ncislo\">edit</a> &nbsp;"."</td>
  echo "</table>";
} while (false);

  Pg_Close($connection);
?>
</p>
<BR>
</FONT>
</body>
</html>