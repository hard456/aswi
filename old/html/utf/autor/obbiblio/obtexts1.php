<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Edit an item from the Old Babylonian Text Corpus</title>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h3><center>Edit an item from OB text corpus</center></h3>
</FONT>
<FONT FACE='Verdana' SIZE=3>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the database!";
    break;
  endif;
  $bookandchapter = rtrim($bookandchapter);
  $paragraph = rtrim($paragraph);
  @$result = Pg_Exec(
//		"select * from obtexts WHERE bookandchapter='$bookandchapter' AND paragraph='$paragraph'");
		"select * from obtexts WHERE bookandchapter like '$bookandchapter%' AND paragraph='$paragraph'");

  if (!$result):
    echo "Došlo k chybì pøi zpracování SQL dotazu!"; 
    break;
  endif;
  echo "<table border=1><tr><td><center><small>book and chapter</small></center></td><td><center><small>line</small></center></td><td><center><small><b>transliteration</b> (please leave the space before the first letter, it is before each word pattern because of enhanced search)</small></center></td></tr>";
  echo "<FORM id=form1 METHOD=\"get\" name=form1 ACTION=\"/utf/autor/obtexts/obtexts2.php\" ACCEPT-CHARSET=\"utf-8\" enctype=\"multipart/form-data\">";
  Pg_NumRows($result);
  $zaznam = Pg_Fetch_Array($result, $i);
	$radek=$zaznam["transliteration"];
//	echo "$radek";
	include "./edit2.php";
  echo ("<tr><td><p class=vstup><small>".$zaznam["bookandchapter"]."</small></p></td><td><p class=vstup cols=90 rows=10><small>".$zaznam["paragraph"].")</small></p></FONT></td><td><FONT FACE='Arial Unicode MS' SIZE=3><textarea class=vstup id=q name=text1 cols=90 rows=5>".$vysledek."</textarea></FONT></td></tr>");
  echo "</table>";
  echo (HTMLSpecialChars($text1));
  echo "<input type=hidden name=bookandchapter value=$bookandchapter>";
  echo "<input type=hidden name=paragraph value=$paragraph>";
  echo "<input type=hidden name=autor value=$auth_userkod>";
  Pg_Close ($connection);
} while (false);
include "key.inc.php";
?>
<TABLE><TR><TD>
 <INPUT class=tlacitko1 TYPE="SUBMIT" value="  send new version " style="height:32;background-color:#EEFFEE">
</TD></TR>
</TABLE>
</FORM><BR>
</FONT>
</BODY>
</HTML>