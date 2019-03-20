<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Selected items from the Old Babylonian Text Corpus</title>
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
                "SELECT * FROM graf01 WHERE $pod ORDER BY OID"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><SPAN CLASS=text1>text quotation: $bookandchapter</SPAN>&nbsp;";
  echo "<td><a href=\"../autor/enter.html\"><small>login to edit - members only</small></a></td>";
  echo "<FONT color=#8080ff face=Verdana size=3>text in transliteration</FONT></td></tr>";
	for ($i = 0; $i < $pocethesel; $i++)
	{
	List ($bookandchapter, $paragraph, $transliteration) = Pg_Fetch_Row ($result, $i);
	echo "<TR><td><a href=\"javascript:openWindow('./obtextcoment.php?paragraph2=$paragraph&bookandchapter=$bookandchapter', 'popwinP')\">$paragraph</A>&nbsp;&nbsp;&nbsp;";
           echo "<SPAN CLASS=text1>$transliteration<br></SPAN></td>";
           echo "<td><a href=\"javascript:openWindow('../autor/obtexts/obtexts1.php?paragraph=$paragraph&bookandchapter=$bookandchapter', 'popwinE')\">edit</a></td>";
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
	echo "<td>$comment1</td><td>$autor</td><BR>\n<br>";
	}
}
           echo "<td><a href=\"javascript:openWindow('../autor/obtexts/obtextc1.php?paragraph=$paragraph&bookandchapter=$bookandchapter', 'popwinE')\">$comment1</a></td>";
echo "<TD><a href=\"javascript:openWindow('./obtextdesc.php?bookandchapter=$bookandchapter', 'popwin')\">$bookandchapter$paragraph)</a></TD>";
echo "</TR>";
	echo "</table>";
  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>