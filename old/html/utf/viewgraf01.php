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

<FONT FACE='Arial Unicode' SIZE=3><BR>
<table border=1>
  <tr>
    <td><center><strong> our no.
      </font></strong></center></td>
    <td><center><strong> sign name
      </font></strong></center></td>
    <td><center><strong> Borger's no.
      </font></strong></center></td>
    <td><center><strong> syllabic value
      </font></strong></center></td>
    <td><center><strong> logographic value
      </font></strong></center></td>
  </tr>
</FONT>
<?  
	$polozky="pcislo, gnazev, bcislo, scteni, lcteni";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM graf01 ORDER BY pcislo");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($pcislo, $gnazev, $bcislo, $scteni, $lcteni) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<tr><center><td>&nbsp; $pcislo </td>".
          "<td>&nbsp; $gnazev </td>".
          "<td>&nbsp; $bcislo </td>".
          "<td>&nbsp; $scteni </td>".
          "<td>&nbsp; $lcteni </td>"."
<td>&nbsp; <a href=\"./tools/novadata/graf01d.php\">delete</a> &nbsp;</td>"."
</tr>\n");
  }
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>
<br>
</FONT>
</BODY>
</HTML>