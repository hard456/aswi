<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
</HEAD>
<BODY>
<h2><center><strong>Selected variants from the Old Babylonian Graphemic Analyses</strong></center></h2>
<br>
<?
  @$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
  if (! $spojeni)
  {
    echo ("<br>Nepodarilo se pripojit k databázi.<BR>\n");
    exit;
  }
?>
<FONT FACE='Arial Unicode' SIZE=3><BR>
</FONT>
<?  
	$polozky="bcislo, images";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM images WHERE (bcislo='$borger')");
  $pocet = Pg_NumRows ($vysledek);
  if ($pocet == 0)
	{
	echo ("Nothing found, try again.");
  } else {
  list ($bcislo) = Pg_Fetch_Array ($vysledek, $i);
  echo ("Selected Borger's number: <b>$bcislo</b>&nbsp; <BR>\n$pocet variants found.<br>\n");
  echo ("<BR>\n");
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($bcislo, $images) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<img src=\"../png/$images\" WIDTH=40 HEIGHT=40 BORDER=0>");
  	}
	}
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>
<br>
</FONT>
</BODY>
</HTML>