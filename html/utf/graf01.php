<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
</HEAD>
<BODY>

<h2><center><strong><u> List of OB cuneiform signs with readings</u></strong></center></h2>
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
<table border=1>
  <tr>
    <td><center><strong> sign name
      </strong></center></td>
    <td><center><strong> Borger's no.
      </strong></center></td>
    <td><center><strong> syllabic value
      </strong></center></td>
    <td><center><strong> logographic value
      </strong></center></td>
  </tr>
</FONT>
<?  
	$polozky="gnazev, bcislo01, scteni, lcteni, OID";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM graf01 ORDER BY OID;");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($gnazev, $bcislo01, $scteni, $lcteni, $OID) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<tr><center><td>&nbsp; <FONT FACE=\"Arial Unicode MS\" SIZE=3>$gnazev </FONT></td>".
          "<td>&nbsp; $bcislo01 </td>".
          "<td>&nbsp; <FONT FACE=\"Arial Unicode MS\" SIZE=3>$scteni </FONT></td>".
          "<td>&nbsp; <FONT FACE=\"Arial Unicode MS\" SIZE=3>$lcteni </FONT></td>".
"</tr>\n");
  }
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>
<br>
</BODY>
</HTML>