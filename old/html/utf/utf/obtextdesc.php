<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Description of the selected items from the Old Babylonian Corpus</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2 align=center>Bibliographic and other sources to selected text</FONT></h2>
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
  $pod1 = ("bookandchapterp like '%'");
  $pod1 = ("bookandchapterp like '%$bookandchapter%'");
  if (@$result = @Pg_Exec (
                "SELECT * FROM obtextp WHERE $pod1"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>$pocethesel item(s) found.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td class=td1>book</td><td class=td1>description</td><td class=td1>chapter</td><td class=td1>book and chapter</td><td class=td1>author</td><td class=td1>date</td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($book, $chapter, $descriptionp, $bookandchapterp, $autor, $datum) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td class=td2>$book</td><td class=td2>$chapter</td><td class=td2>$descriptionp</td><td class=td2>$bookandchapterp</td><td class=td2>$autor</td><td class=td2>$datum</td></tr>";
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