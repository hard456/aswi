<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
<script language="JavaScript">
<!--
function openWindow(url, name)
{
popupWin = window.open(url, name, "scrollbars,resizable,width=740,height=490");
}
//-->
</script>

</head>
<body>
<style type="text/css">
<!--
   A:link {text-decoration: none}
   A:visited {text-decoration: none}
   A:active {text-decoration: none}
-->
</style>

<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Chapter or text in full - in the Old Babylonian Text Corpus</center></FONT></h2>
<?
  echo ("<FONT FACE='Arial Unicode MS, Code2000, Titus Cyberbit Basic' SIZE=3>");
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  $pod = ("bookandchapter='$bookandchapter'");
  if (@$result = @Pg_Exec (
                "SELECT * FROM obtexts WHERE $pod ORDER BY OID"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff face=Verdana size=3>text quotation: $bookandchapter</FONT>&nbsp;";
  echo "<td><a href=\"../autor/enter.html\"><small>login to edit - members only</small></a></td>";
  echo "<FONT color=#8080ff face=Verdana size=3>text in transliteration</FONT></td></tr>";
	for ($i = 0; $i < $pocethesel; $i++)
	{
	List ($bookandchapter, $paragraph, $transliteration) = Pg_Fetch_Row ($result, $i);
	echo "<TR><td><a href=\"javascript:openWindow('./obtextcoment.php?paragraph2=$paragraph&bookandchapter=$bookandchapter', 'popwinP')\">$paragraph</A>&nbsp;&nbsp;&nbsp;";
           echo "<FONT FACE=\"Arial Unicode MS, , Code2000, Titus Cyberbit Basic\">$transliteration<br></FONT></td>";
           echo "<td><a href=\"javascript:openWindow('../autor/obtexts/obtexts1.php?paragraph=$paragraph&bookandchapter=$bookandchapter', 'popwinE')\">edit</a></td>";
echo "</TR>";
	echo "</table>";
	}
}
}
  $polozky2 = ("bookandchapterc='$bookandchapter'");
  $result2 = Pg_Exec ($connection, "SELECT comment1, autor, bookandchapterc, paragraphc FROM obtextc WHERE $polozky2");
//  $pocet2 = Pg_NumRows ($result2);
  if (($pocet2 = @Pg_NumRows ($result2)) > 0)
	{
	for ($j = 0; $j < $pocet2; $j++)
	{
	List ($comment1, $autor) = Pg_Fetch_Row ($result2, $j);
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff face='Arial Unicode MS' size=3>text quotation: $comment1</FONT>&nbsp;";
	echo "<td>$autor</td><BR>\n<br>";
	}
}
           echo "<td><a href=\"javascript:openWindow('../autor/obtexts/obtextc1.php?paragraph=$paragraph&bookandchapter=$bookandchapter', 'popwinE')\">$comment1</a></td>";

echo "<a href=\"javascript:openWindow('./obtextdesc.php?bookandchapter=$bookandchapter', 'popwin')\"><img src=\"../png/ab01x01.png\" width=14 height=10 alt=\"\" border=\"0\">$bookandchapter</a>";

echo "</TR>";
	echo "</table>";
	echo "</table>";

  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>