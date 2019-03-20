<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Update descr.1</title>
</head><body>
<h3><center>Update text description</center></h3>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Imp. to connect to db!";
    break;
  endif;
  @$result = Pg_Exec(
		"select oid, book, chapter, type, origin, ruler, year, month, notedate from obdict WHERE oid='$co'");
  if (!$result):
    echo "An er by SQL querry!";
    break;
  endif;
  echo "<table border=1>";
  echo "<tr><td><center><b> item </b></center></td><td><center><b> text1 </b></center></td></tr>";
  echo "<FORM id=form1 METHOD=\"get\" name=form1 ACTION=\"/utf/autor/obtextp/obtextpup2.php\" METHOD=\"post\" ACCEPT-CHARSET=\"utf-8\" enctype=\"multipart/form-data\">";
  for ($i=0; $i < Pg_NumRows($result); $i++):
    $zaznam = Pg_Fetch_Array($result, $i);
    $radek=$zaznam["text1"];
    include "./edit2.php";
    echo ("<tr><td><p class=vstup>".$zaznam["item"]."</p></td><td><FONT FACE='Arial Unicode MS' SIZE=3><textarea class=vstup id=q name=text1 cols=90 rows=10>".$vysledek."</textarea></FONT></td></tr><tr><td></td><td><FONT FACE='Arial Unicode MS' SIZE=3><textarea class=vstup name=text2 cols=70 rows=3>".$zaznam["text2"]."</textarea></font></td></tr>\n");
    echo ("<tr><td>author's a.</td><td><select name=\"autor\"><option>zh01</option><option>sl01</option><option>nn01</option><option>lp01</option><option>jp01</option><option>fr02</option></select></td></tr>\n");
  endfor;
  echo "</table>";
  echo "<input type=hidden name=co value=$co>";
  Pg_Close ($connection);
} while (false);
?>
<TABLE><TR><TD>
<INPUT class=tlacitko1 TYPE="SUBMIT" value="  send new version " style="height:32;background-color:#EEFFEE">
</TD></TR></TABLE>
<? include "key.inc.php" ?>
</FORM>
</FONT>
</body>
</html>