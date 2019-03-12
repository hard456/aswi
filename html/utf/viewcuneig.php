<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>Tabulky zpracovane v ramci projektu OB Graphemic Analyses</TITLE>
</HEAD>
<BODY>

<h2><center><strong><u> Prehled zpracovanych tabulek</u></strong></center></h2>
<br>
<?
  @$spojeni = Pg_Connect("user=vviewer dbname=klinopis");
  if (! $spojeni)
  {
    echo ("<br>Nepodarilo se pripojit k databázi.<BR>\n");
    exit;
  }
?>

<table border=1>
  <tr>
    <td><center><strong> edition
      </font></strong></center></td>
    <td><center><strong> year 
      </font></strong></center></td>
    <td><center><strong> month
      </font></strong></center></td>
    <td><center><strong> day
      </font></strong></center></td>
    <td><center><strong> location
      </font></strong></center></td>
    <td><center><strong> text type
      </font></strong></center></td>
    <td><center><strong> notes
      </font></strong></center></td>
    <td><center><strong> datum 
      </font></strong></center></td>
    <td><center><strong> is entry OK?
      </font></strong></center></td>
    <td><center><strong> delete
      </font></strong></center></td>
    <td><center><strong> edit
      </font></strong></center></td>

  </tr>

<?  
	$polozky="edition, year, month, day, location, textype, notes, datum, readycuneig";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM cuneig ORDER BY datum");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($edition, $year, $month, $day, $location, $textype, $notes, $datum, $readycuneig) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<tr><center><td> $edition </td>".
          "<td> $year </td>".
          "<td> $month </td>".
          "<td> $day </td>".
          "<td> $location </td>".
          "<td> $textype </td>".
          "<td> $notes </td>".
          "<td> $datum </td>".
          "<td> $readycuneig </td>".
					"<td>&nbsp; <a href=\"./tools/novadata/inputcuneigd.php?koho=$edition\">delete</a> &nbsp;</td>".
		      "<td> <a href=\"../tools/novadata/inputcuneii1.php?co=$edition\">edit</a> &nbsp;".
	  "</td></tr>\n");
  }
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>
<br>
</font>
</BODY>
</HTML>





