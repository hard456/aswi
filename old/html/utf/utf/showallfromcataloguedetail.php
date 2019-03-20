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
//  $pod1 = ("bookandchapterp like '%$bookandchapter%'");
//  if (@$result = @Pg_Exec ("SELECT * FROM catalogue WHERE $pod1"))
  if (@$result = @Pg_Exec ("SELECT * FROM catalogue"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>$pocethesel item(s) found.\n<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td class=td1>book</td><td class=td1>volume</td><td class=td1>plate</td><td class=td1>year</td><td class=td1>month</td><td class=td1>day</td><td class=td1>now located</td><td class=td1>museum number</td><td class=td1>excavation</td><td class=td1>ancient place</td><td class=td1>document type</td><td class=td1>book and chapter</td><td class=td1>ancient ruler</td><td class=td1>ancient year</td><td class=td1>secondary literature</td><td class=td1>notes</td><td class=td1>individualities mentioned</td><td class=td1>belongs to archive</td><td class=td1>author</td><td class=td1>date</td><td class=td1><small>catalogue entry is OK</small></td></tr>";
			for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($autographyabbreviation, $autography1, $autography2, $dateyear, $datemonth, $dateday, $nowlocated, $museumnumber1, $excavationnumber1, $ancientplace, $documenttype, $bookandchapterc, $ancientruler, $ancientyear, $secondarylit, $notes, $individualities, $belongsto, $autor, $date, $readycatalogue) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td class=td2>$autographyabbreviation</td><td class=td2>$autography1</td><td class=td2>$autography2</td><td class=td2>$dateyear</td><td class=td2>$datemonth</td><td class=td2>$dateday</td><td class=td2>$nowlocated</td><td class=td2>$museumnumber1</td><td class=td2>$excavationnumber1</td><td class=td2>$ancientplace</td><td class=td2>$documenttype</td><td class=td2>$bookandchapterc</td><td class=td2>$ancientruler</td><td class=td2>$ancientyear</td><td class=td2>$secondarylit</td><td class=td2>$notes</td><td class=td2>$individualities</td><td class=td2>$belongsto</td><td class=td2>$autor</td><td class=td2>$date</td><td class=td2>$readycatalogue</td></tr>";
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
