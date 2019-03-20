<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Edit an item from the Old Babylonian dictionary</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h3><center>Edit an item from OB dictionary</center></h3>
</FONT>
<FONT FACE='Verdana' SIZE=3>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Nepoda詬o se p詰ojit k databẩ!";
    break;
  endif;
  @$result = Pg_Exec(
		"select oid, item, text1, text2 from obdict WHERE oid='$co'");
  if (!$result):
    echo "Doڬo k chyb젰詠zpracovᮭ SQL dotazu!";
    break;
  endif;
  echo "<small>if you input new text, please don't forget to mark a chain which belongs to the item, e.g. a-wa-tum with parenthesis: {a-wa-tum} la i-la-bi-ra-ma</small><BR><BR>";
  echo "<small>if you need to mark bold, please use the following example and copy and paste it into text, e.g. &lt;b&gt;II.:&lt;/b&gt; </small><BR><BR>";
  echo "<small>please be careful to input the citation in the same way, e.g. (AbB_4,51,20-22); ...  (AbB_2,97,1).</small><BR>";
  echo "<BR>";
  echo "<table border=1>";
  echo "<tr><td><center><b> item </b></center></td><td><center><b> text1 </b></center></td></tr>";
  echo "<FORM id=form1 METHOD=\"get\" name=form1 ACTION=\"/utf/autor/obdict/obdictedit2.php\" METHOD=\"post\" ACCEPT-CHARSET=\"utf-8\" enctype=\"multipart/form-data\">";
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