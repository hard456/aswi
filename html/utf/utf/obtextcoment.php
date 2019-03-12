<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Description of the selected items from the Old Babylonian Corpus</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Anotation to selected text</center></FONT></h2>
<h3><FONT color=#8080ff face=Verdana size=4>We are eagerly working. Please have patience with us.</FONT></h3>
<?
$status = true;
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  $pod1 = ("bookandchapterp like '$bookandchapter%'");
  $dotaz = "SELECT * FROM obtextp WHERE $pod1";
  if (@$result = @Pg_Exec($dotaz))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>$pocethesel item(s) found.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff size=3><small>book</small></td><td><FONT color=#8080ff size=4><small>description </small></FONT></td><td><FONT color=#8080ff size=4><small>chapter </small></FONT></td><td><FONT color=#8080ff size=4><small>book and chapter </small></FONT></td><td><FONT color=#8080ff size=4><small>autor </small></FONT></td><td><FONT color=#8080ff size=4><small>datum </small></FONT></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($book, $chapter, $descriptionp, $bookandchapterp, $autor, $datum) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td>$book</td><td>$chapter</td><td>$descriptionp</td><td>$bookandchapterp</td><td>$autor</td><td>$datum</td></tr>";
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