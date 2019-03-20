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

<BR>
<table border=1>
  <tr>
    <td><center><strong> item1
      </strong></center></td>
    <td><center><strong> refer1
      </strong></center></td>
    <td><center><strong> refer2
  </tr>
</FONT>
<?  
	$polozky="item1, refer1";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM dictrefer;");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($item1, $refer1) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<tr><center><td>&nbsp; <FONT FACE='Arial Unicode MS' SIZE=3>$item1 </FONT></td>".
          "<td>&nbsp; <FONT FACE='Arial Unicode MS' SIZE=3>$refer1 </FONT></td>"."
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