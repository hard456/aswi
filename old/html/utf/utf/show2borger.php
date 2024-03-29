<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</HEAD>
<body>
<h3 align=center>Selected variants <BR>from<BR> the Old Babylonian Graphemic Analyses</H3>
</FONT>
<br>
<?
  @$spojeni = Pg_Connect("user=postgres dbname=klinopis");
  if (! $spojeni)
  {
    echo ("<br>Nepodarilo se pripojit k datab�zi.<BR>\n");
    exit;
  }
?>
<BR>
    <FONT FACE="Arial Unicode MS" SIZE=3>
<?  
	$polozky="bcislo, images";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM images WHERE (bcislo='$borger')");
  $pocet = Pg_NumRows ($vysledek);
  if ($pocet == 0)
	{
	echo ("Nothing found, try again.");
  } else {
  list ($bcislo) = Pg_Fetch_Array ($vysledek, $i);
  echo ("Selected Borger's number: <b>$bcislo</b>&nbsp; <BR>\n$pocet variant(s) found.<br>\n");
  echo ("<BR>\n");
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($bcislo, $images) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<img src=\"../png/$images\" WIDTH=40 HEIGHT=40 BORDER=1>");
  	}
		echo ("<BR><BR>");
	}
  Pg_FreeResult ($vysledek);
	$polozky2="gnazev, lcteni, scteni, bcislo01";
  $vysledek2 = Pg_Exec ($spojeni, "SELECT $polozky2 FROM graf01 WHERE (bcislo01='$borger')");
  $pocet = Pg_NumRows ($vysledek2);
  if ($pocet == 0)
	{
	echo ("Nothing found, try again.");
  } else {
  echo ("<BR>\n");
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($gnazev, $lcteni, $scteni, $bcislo01) = Pg_Fetch_Array ($vysledek2, $i);
    echo ("Sign name: &nbsp; $gnazev<BR>");
    echo ("Logographic values: &nbsp; $lcteni<BR>");
    echo ("Syllabic values: &nbsp;<i>$scteni</i><BR>");
  	}
	}
  Pg_FreeResult ($vysledek2);
  Pg_Close ($spojeni);
?>
</table>
<br>
</BODY>
</HTML>