#!c:/Php/php.exe
<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>Nastaveni hesel s obrazky</TITLE>
</HEAD>
<body>
<h2><center> obrazky </center></h2>
<hr>
<?
$status = true;
do
{
	@$res = Pg_Connect ("user=vviewer dbname=klinopis");
//  @$res = MySQL_Connect("localhost");
  if (!$res):
    echo "Nepodaøilo se pøipojit k databázi!";
    break;
  endif;
//  MySQL_Select_DB("klinopis");
  @$result = Pg_Exec("select * from images");
//  @$result = MySQL_Query("select * from images");
  if (!$result):
    echo "Došlo k chybì pøi zpracování SQL dotazu!";
    break;
  endif;
//  echo "<FONT color=#000099 face=Verdana size=2>There was found ".Pg_Num_Rows($result)." sign variants included in the Corpus for Graphemical Analysis.\n</FONT><BR>";
//  echo "<FONT color=#000099 face=Verdana size=2>There was found ".MySQL_Num_Rows($result)." sign variants included in the Corpus for Graphemical Analysis.\n</FONT><BR>";
  echo "<BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=1 cellpadding=5>";
  echo "<tr bgcolor=#94B6BD align=\"center\"><b><td><b>Borger's No.</b></td><td><b>Sign</b></td><td><b>File Name</b></td></tr>";
//  $zdroj = .$images;
  while ($row = Pg_Fetch_Array($result,0))
//  while ($row = MySQL_Fetch_Array($result))
    echo "<tr><td>".$row["bcislo"]."</td><td>
<IMG SRC=".$row["images"].">
</td><td>".$row["images"]."</td></tr>\n";
//    echo "$bcislo";
//"<img src=\"images\">"
//"<img src=\"$zdroj\">
// <td>&nbsp; <a href=\"./deleteg1.php?koho=$ncislo\">delete</a> &nbsp;</td>"."<td><a href=\"./editg1.php?co=$ncislo\">edit</a> &nbsp;"."</td>
  echo "</table>";
//    echo ".$row["<A HREF=\"images\">\"images\"</A>"].";
} while (false);
  Pg_Close($res);
//  MySQL_Close($res);
?>
</body>
</html>