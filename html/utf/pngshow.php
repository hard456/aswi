<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>List of OB signs in the scope of OB Graphemic Analyses Project</TITLE>
</HEAD>
<BODY>
<h2><center><strong><u> test</u></strong></center></h2>
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
    <td><center><strong> bcislo
      </font></strong></center></td>
    <td><center><strong> images
      </font></strong></center></td>
  </tr>
</FONT>
<?  
	$polozky="bcislo, images";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM images ORDER BY bcislo");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($bcislo, $images) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<tr><center><td>&nbsp; $bcislo </td>"."<td><img src=\"../png/$images\" WIDTH=45 HEIGHT=45 BORDER=0></td>"."</tr>\n");
  }
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>
<br>
</FONT>
</BODY>
</HTML>