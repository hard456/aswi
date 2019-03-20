<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
</HEAD>
<body topmargin="15" leftmargin="15" bgcolor="#EFF1FF">
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
  $polozky1="bcislo01, scteni";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky1 FROM graf01");
  $pocet = Pg_NumRows ($vysledek);
  if ($pocet == 0)
	{
	echo ("Nothing found, try again.");
  } else {
  list ($bcislo01) = Pg_Fetch_Array ($vysledek, $i);
  echo ("Selected Borger's number: <b>$bcislo01</b>&nbsp; <BR>\n$pocet variants found.<br>\n");
  echo ("<BR>\n");
  list ($bcislo01) = Pg_Fetch_Array ($vysledek, $i);
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($bcislo01, $scteni) = Pg_Fetch_Array ($vysledek, $i);
    echo ("$bcislo01");
    echo ("$scteni");
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