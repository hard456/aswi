<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
</HEAD>
<BODY>

<h2><center><strong><u> List of OB cuneiform signs with readings graf02 <u></strong></center></h2>
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
    <td><center><strong> number
      </font></strong></center></td>
    <td><center><strong> abbreviation of an edition
      </font></strong></center></td>
    <td><center><strong> number in an edition
      </font></strong></center></td>
    <td><center><strong> date - year
      </font></strong></center></td>
    <td><center><strong> date - month
      </font></strong></center></td>
    <td><center><strong> date - day
      </font></strong></center></td>
    <td><center><strong> ancient place
      </font></strong></center></td>
    <td><center><strong> document type
      </font></strong></center></td>
    <td><center><strong> transliteration
      </font></strong></center></td>
    <td><center><strong> ancient ruler
      </font></strong></center></td>
    <td><center><strong> ancient year
      </font></strong></center></td>
  </tr>
</FONT>
<?  
	$polozky="number, editionabbreviation, editionnumber, dateyear, datemonth, dateday, ancientplace, documenttype, transliteration, ancientruler, ancientyear, OID";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM graf02 ORDER BY OID;");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($number, $editionabbreviation, $editionnumber, $dateyear, $datemonth, $dateday, $ancientplace, $documenttype, $transliteration, $ancientruler, $ancientyear, $OID) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<tr><center><td>&nbsp; $number </td>".
          "<td>&nbsp; $editionabbreviation </td>".
          "<td>&nbsp; $editionnumber1 </td>".
          "<td>&nbsp; $editionnumber2 </td>".
          "<td>&nbsp; $dateyear </td>".
          "<td>&nbsp; $datemonth </td>".
          "<td>&nbsp; $dateday </td>".
          "<td>&nbsp; $ancientplace </td>".
          "<td>&nbsp; $documenttype </td>".
          "<td>&nbsp; $transliteration </td>".
          "<td>&nbsp; $ancientruler </td>".
          "<td>&nbsp; $ancientyear </td>".
"</tr>\n");
  }
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>
<br>
</FONT>
</BODY>
</HTML>