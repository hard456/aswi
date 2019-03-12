<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
</HEAD>
<body topmargin="15" leftmargin="15" bgcolor="#EFF1FF">
<FONT FACE=Verdana color=#3399ff>
<h2><center><strong>Selected variants <BR>from<BR> the Old Babylonian Graphemic Analyses</strong></center></h2>
</FONT>
<br>
<?
  @$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
  if (! $spojeni)
  {
    echo ("<br>Nepodarilo se pripojit k databázi.<BR>\n");
    exit;
  }
?>
<FONT FACE='Arial Unicode MS' SIZE=3><BR>
<?  
  $polozky="fi.images, gr.gnazev, gr.lcteni, gr.scteni, gr.bcislo01, fi.bcislo";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM images fi, graf01 gr WHERE (bcislo=bcislo01 AND bcislo='015')");
  $pocet = Pg_NumRows ($vysledek);
  if ($pocet == 0)
	{
	echo ("Nothing found, try again.");
  } else {
  echo ("<BR>\n");
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($images, $gnazev, $lcteni, $scteni, $bcislo01) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<img src=\"../png/$images\" WIDTH=40 HEIGHT=40 BORDER=0>");
  	}
    echo ("<BR><BR>Sign Name: &nbsp;$gnazev<BR>");
    echo ("<BR>Logographic values:&nbsp;$lcteni<BR>");
    echo ("<BR>Syllabic values:&nbsp;$scteni<BR>");
    echo ("<BR>Borgers number:&nbsp;$bcislo01<BR>");
	}
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>
</table>
<br>
</FONT>
</BODY>
</HTML>