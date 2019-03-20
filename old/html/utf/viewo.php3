<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>Whitelist for klinopis.cz</TITLE>
</HEAD>
<BODY>

<h2><center><strong><u> ukaz objednavky</u></strong></center></h2>
<br>
<?
  @$spojeni = Pg_Connect("user=vviewer password=nothing dbname=vseved2");
  if (! $spojeni)
  {
    echo ("<br>Nepodarilo se pripojit k databázi.<BR>\n");
    exit;
  }
?>

<table border=1>
  <tr>
    <td><center><strong> C. 
      </font></strong></center></td>
    <td><center><strong> Item
      </font></strong></center></td>
    <td colspan="9"><center><strong> Obory
      </font></strong></center></td>
    <td><center><strong> Date 
      </font></strong></center></td>
    <td><center><strong> Wap 
      </font></strong></center></td>
    <td><center><strong> Web 
      </font></strong></center></td>
    <td><center><strong> Tasks </font></strong></center></td>
  </tr>

<?  
  $polozky="prijmeni, jmeno";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM palmord ORDER BY prijmeni");
  $pocet = Pg_NumRows ($vysledek);

  for ($i=0; $i < $pocet; $i++)
  {
    list ($prijmeni, $jmeno) = Pg_Fetch_Array ($vysledek, $i);
  }
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>

</table>

<br>


</font>
</BODY>
</HTML>





