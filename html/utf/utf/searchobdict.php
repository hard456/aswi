<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from the Old Babylonian Dictionary</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Selected items from the Old Babylonian Dictionary</center></FONT></h2>
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
  $chain2 = URLDecode ($chain);
  echo "<FONT FACE=\"Arial Unicode MS\">Searched item: <b>$chain2</b>&nbsp;</FONT><BR>";
  $pod1 = "(item like ' $chain2%')";
  if ($chain2 == "" || $chain2 == "%" || $chain2 == "%%" || $chain2 == "%%%" || $chain2 == "%%%%") {
    echo "... mandatory items not filled ...";
  }
  elseif (@$result = @Pg_Exec (
                "SELECT oid, item, type, text1, autor, datum FROM obdict WHERE ($pod1) ORDER BY item ASC"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE=\"Arial Unicode MS\" SIZE=3>$pocethesel item(s) found.\n<BR>";
  echo "<table border=1 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td><FONT color=#8080ff size=2>dictionary item</td><td><FONT color=#8080ff size=2>class</FONT></td><td><FONT color=#8080ff size=3>provisional dictionary definition</FONT></td><td><FONT color=#8080ff size=1>last author</FONT></TD><TD><FONT color=#8080ff size=1>edit</FONT></TD><TD><FONT color=#8080ff size=1>delete</FONT></TD></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($oid, $item, $type, $text1, $autor, $datum) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td>$item</td><td>$type<td>$text1</td><td><small>$autor</small></td><td><a href=\"/utf/autor/obdict/obdictedit1.php?co=$oid\">satarum</a></td><td><a href=\"/utf/autor/obdict/obdictdelete.php?co=$oid\">nasahum</a></td></tr>";
				}
				echo "</table>";
			}
			else
				echo "Sorry, this item is not yet written in this dictionary. Try to write <FONT FACE=\"Arial Unicode MS\" SIZE=3>$chain2</FONT>, thanks.<FORM ACTION=\"/utf/autor/obdict/obdictnew1.php\" METHOD=\"get\" ACCEPT-CHARSET=\"utf-8\" enctype=\"multipart/form-data\"><input type=hidden name=item value=\"$chain2\"><?  $chain2 = URLencode ($chain2); ?><BR><input type=submit value=\"write new dictionary item $item\">";
				echo "</FORM>";
//				$chain2 = URLencode ($chain2);
		}
		else
			echo ("Wow, sorry, too many queries, maybe try again later<br>");
  Pg_Close($connection);
}
?>
<BR>
<P><A HREF="/utf/utf/obdictabbr.php" TARGET=_blank>Click here to see a list of used abbreviations.</A></P>
</FONT>
</body>
</html>