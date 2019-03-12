<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type; charset=utf-8>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</HEAD>
<body>
<H3 align=center>Selected variants <BR>from<BR> the Old Babylonian Graphemic Analyses</H3>
<br>
<?
  @$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
  if (! $spojeni)
  {
    echo ("<br>Nepodarilo se pripojit k databázi.<BR>\n");
    exit;
  }
?>
<FONT FACE="Arial Unicode MS" SIZE=3><BR>
<?  
  $borger2 = URLDecode ($borger);
  $polozky2="gnazev, lcteni, scteni, bcislo01";
  $vysledek2 = Pg_Exec ($spojeni, "SELECT $polozky2 FROM graf01 WHERE (scteni=' $borger2')");
  $pocet = Pg_NumRows ($vysledek2);
  if ($pocet == 0)
	{
//	echo ("Nothing found, try again.");
           $vysledek2 = Pg_Exec ($spojeni, "SELECT $polozky2 FROM graf01 WHERE (scteni like ' $borger2,%' OR scteni like ' $borger2*,%' OR scteni like '% $borger2,%' OR scteni like '% $borger2*,%' OR scteni like '% $borger2' OR scteni like '% $borger2*')");
	$pocet = Pg_NumRows ($vysledek2);
	  for ($i=0; $i < $pocet; $i++)
	  {
	list ($gnazev, $lcteni, $scteni, $bcislo01) = Pg_Fetch_Array ($vysledek2, $i);
	echo ("Sign name: &nbsp; $gnazev<BR>");
	echo ("Logographic values: &nbsp; $lcteni<BR>");
	echo ("Syllabic values: &nbsp;$scteni<BR>");
}

  } else {
  echo ("<BR>\n");
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($gnazev, $lcteni, $scteni, $bcislo01) = Pg_Fetch_Array ($vysledek2, $i);
    echo ("Sign name: &nbsp; $gnazev<BR>");
    echo ("Logographic values: &nbsp; $lcteni<BR>");
    echo ("Syllabic values: &nbsp;$scteni<BR>");
	 //SEM PRIJDE SEZNAM OBRAZKU PRO JEDNOTLIVE POLOZKY
  	}
	}

	$polozky="bcislo, images";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM images WHERE (bcislo='$bcislo01')");
  $pocet2 = Pg_NumRows ($vysledek);
  if ($pocet2 == 0)
	{
	echo ("There are no variants in the present corpus.");
  } elseif ($pocet2 == 1) {
  echo ("Selected Borger's number: <b>$bcislo01</b>&nbsp; <BR>\n$pocet2 variant(s) found.<br>\n");
  echo ("<BR>\n");
  for ($i=0; $i < $pocet2; $i++)
	  {
    list ($bcislo, $images) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<img src=\"../png/$images\" WIDTH=40 HEIGHT=40 BORDER=1>");
  	}
		echo ("<BR><BR>");
  } else {
  list ($bcislo) = Pg_Fetch_Array ($vysledek, $i);
  echo ("Selected Borger's number: <b>$bcislo</b>&nbsp; <BR>\n$pocet2 variant(s) found.<br>\n");
  echo ("<BR>\n");
  for ($i=0; $i < $pocet2; $i++)
	  {
    list ($bcislo, $images) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<img src=\"../png/$images\" WIDTH=40 HEIGHT=40 BORDER=1>");
  	}
		echo ("<BR><BR>");
	}
  Pg_FreeResult ($vysledek2);
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>
<br>
</FONT>
</BODY>
</HTML>