<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
  <title>Edit an item from the OBTC rules</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body>
<h3><center>Edit the selected rule</center></h3>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "There was an error by connecting to the database, sorry.";
    break;
  endif;
  @$result = Pg_Exec(
		"select oid, bad, good, notes, autor from transrules WHERE oid='$OID'");
  if (!$result):
    echo "There was an error by the SQL query, sorry.";
    break;
  endif;
  echo "<table border=1>";
  echo "<tr><td><center><small>transcription in editio princeps</small></center></td><td><center><small> our unified transcription</small></center></td></tr>";
  echo "<FORM id=form1 name=form1 ACTION=\"/utf/autor/transrules/rulesedit2.php\" METHOD=\"post\" ACCEPT-CHARSET=\"utf-8\" enctype=\"multipart/form-data\">";
  echo "<input type=hidden name=OIDN value='$OID'>";
  for ($i=0; $i < Pg_NumRows($result); $i++):
    $zaznam = Pg_Fetch_Array($result, $i);
    echo ("<tr><td><textarea class=vstup name=bad cols=30 rows=2>".$zaznam["bad"]."</textarea></td><td><textarea class=vstup id=q name=good cols=70 rows=2>".$zaznam["good"]."</textarea></td></tr>");
    echo "<tr><td><center><small>author's code</small></center></td><td><center><small>notes</small></center></td></tr>";
    echo ("<tr><td><center><textarea class=vstup name=autorN cols=6 rows=1>".$zaznam["autor"]."</textarea></center></td><td><textarea class=vstup name=notes cols=70 rows=2>".$zaznam["notes"]."</textarea></td></tr>\n");
  endfor;
  echo "</table>";
  Pg_Close ($connection);
} while (false);
?>

<TABLE>
<TR>
<TD>
 <INPUT class=tlacitko1 TYPE="SUBMIT" value="  save new version " style="height:32;background-color:#EEFFEE">
</TD>
</TR>
</TABLE>
</FORM>
<? include "key.inc.php" ?>
</body>
</html>
