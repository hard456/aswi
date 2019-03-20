<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Description of the selected items from the Old Babylonian Corpus</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Anotation to selected text</center></FONT></h2>
<h3><FONT color=#8080ff face=Verdana size=4>The full list could take some time, please, wait a minute.</FONT></h3>
<?
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
     if ($origin == '')
	{
	$pod1 = ("book='$book,' OR book='$book' OR type='$type'");
	}
	elseif ($type == '')
	{
             $pod1 = ("book='$book'");
	}
	else
	{
             $pod1 = ("type='$type' AND origin='$origin'");
	}
 if (@$result = @Pg_Exec (
                "SELECT * FROM obtextp WHERE $pod1 ORDER BY book, chapter, OID"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3><B>$book</B> $pocethesel texts or text parts.<BR>";
  echo "<table border=1 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff size=3><small>text type</small></td><td><FONT color=#8080ff size=4><small>book</small></FONT></td><td><FONT color=#8080ff size=4><small>editio princeps and author of the current changed transliteration</small></FONT></td><td><FONT color=#8080ff size=4><small>number / chapter</small></FONT></td><td><FONT color=#8080ff size=4><small>book and chapter - click to read the text </small></FONT></td><td><FONT color=#8080ff size=4><small>origin</small></FONT></td><td><FONT color=#8080ff size=4><small>date </small></FONT></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($book, $chapter, $descriptionp, $bookandchapterp, $autor, $datum, $type, $origin) = Pg_Fetch_Row ($result, $i);
          $bookandchapterp = str_replace(" (", "(", $bookandchapterp);
          $bookandchapterp = rtrim($bookandchapterp);
          $bookandchapterp = str_replace(" ", "_", $bookandchapterp);
          echo "<tr><TD><b>$type</b></TD><td><a href=\"/utf/autor/obtexts/obte1.php?bookandchapter=$bookandchapterp\">$book</A></td><td>$chapter</td><td><small>$descriptionp</small></td><td><a href=\"./catalogue.php?bookandchapter=$bookandchapterp\">$bookandchapterp</A></td><td>$origin</td><td><small>$datum</small></td></tr>";
				}
				echo "</table>";
			}
			else
				echo ("it seems there is nothing for the searched item!<br>$bookandchapter");
		}
		else
			echo ("Wow, sorry, too many queries, maybe try it again later<br>");
  Pg_Close($connection);
}
?>
<BR></FONT>
</body>
</html>