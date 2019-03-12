<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from used texts in the Old Babylonian Graphemic Analyses</title>
<script language="JavaScript">
<!--
function openWindow(url, name)
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
$status = true;
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  if (@$result = @Pg_Exec (
                "SELECT * FROM catalogue"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3><B>$book</B> $pocethesel texts or text parts. \nThe full list could take some time, please, wait a minute.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff size=3><small>text type</small></td><td><FONT color=#8080ff size=4><small>book</small></FONT></td><td><FONT color=#8080ff size=4><small>editio princeps</small></FONT></td><td><FONT color=#8080ff size=4><small>number / chapter</small></FONT></td><td><FONT color=#8080ff size=4><small>book and chapter - click to read the text </small></FONT></td><td><FONT color=#8080ff size=4><small>author of input </small></FONT></td><td><FONT color=#8080ff size=4><small>date </small></FONT></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($bookandchapterc, $autographyabbreviation, $autography1, $autography2, $dateyear, $datemonth, $dateday, $nowlocated, $museumnumber1, $excavationnumber1, $ancientplace, $documenttype, $ancientruler, $ancientyear, $secondarylit, $webnotes, $individualities, $belongsto, $autor, $date, $readycatalogue) = Pg_Fetch_Row ($result, $i);
          echo "<tr><TD><b>$bookandchapterc</b></TD><TR><TD>&nbsp;&nbsp;&nbsp;</TD><td>$autographyabbreviation</td><td>$autography1</td><td>$autography2</td><td>$dateyear</td><td>$datemonth</td><td>$nowlocated</td><td>$museumnumber1</td><td>$excavationnumber1</td><td>$ancientplace</td><td>$documenttype</td><td>$ancientruler</td><td>$ancientyear</td><td>$secondarylit</td><td>$webnotes</td><td>$individualities</td><td>$belongsto</td><td>$autor</td><td>$date</td><td>$readycatalogue</td></tr>";
				}
				echo "</table>";
			}
			else
				echo ("it looks like there is nothing!<br>$bookandchapter");
		}
		else
			echo ("Wow, sorry, too many queries, maybe try it again later<br>");
  Pg_Close($connection);
}
?>
<BR>
</FONT>
</body>
</html>