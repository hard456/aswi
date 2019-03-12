<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from the Old Babylonian Text Corpus</title>
</head>
<body>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Selected items from the Old Babylonian Text Corpus</center></FONT></h2>
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
//  $radek2.="(";
  $radek2.=$s;
  $s = $radek2;
  $apostroph = "ʾ";
  $selection2 = ($s.=$apostroph);
  $selection3 = ($s.=$apostroph);
  $selection4 = ($s.=$apostroph);
  echo "<FONT FACE=\"Arial Unicode MS\"><B>$radek2)</B></FONT><BR>";
  $pod1 = "bookandchapter='$radek2' OR bookandchapter='$selection2' OR bookandchapter='$selection3' OR bookandchapter='$selection4'";
  if (@$result = @Pg_Exec ("SELECT * FROM obtexts WHERE ($pod1) ORDER BY OID"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>There are $pocethesel lines of this text.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff size=3><small>paragraph</small></td><td><FONT color=#8080ff size=4><small>transliteration</small></FONT></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($bookandchapter,$paragraph,$transliteration) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td>$paragraph</td><td>$transliteration</td></tr>";
				}
echo "<td>$bookandchapter$paragraph)</td></tr>";
				echo "</table>";
			}
			else
				echo ("it looks like there is nothing! You can try another search with a part of an item.<br>$radek2");
		}
		else
			echo ("Wow, sorry, too many queries, maybe try again later<br>");
  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>