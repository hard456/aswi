<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>insert new texts</title>
</head>
<body>
<form id=form1 METHOD="post" name=form1 ACTION="/utf/autor/obtexts/obti2.php">
<?
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $date = Date ("Y-m-d");
  echo "<TR><TD><H4 align=center>You can enter new text, please, check first if it doesn't already exist in the database</H4></TD></TR>";
  echo "<table width=100%>";
  echo "<tr valign=top>";
  echo "<td width=60%>";

    echo "<table>";
    echo "<TR><TD><small>book</small></TD><TD><input type=text name=book></TD><TD></TD></TR>";
    echo "<TR><TD colspan=3><small>&nbsp;&nbsp;&nbsp;only in a form like e.g. Sumer_23</small></TD><TD></TD></TR>";
    echo "<TR><TD><small>chapter</small></TD><TD><input type=text name=chapter></TD></TR";
    echo "<TR><TD colspan=3><small>&nbsp;&nbsp;&nbsp;only in a form like 1</small></TD><td></td></TR>";
    echo "<TR><TD><small>description</small></TD><TD colspan=2><input type=text name=description></TD><TD></TD></TR>";
    echo "<TR><TD colspan=4><small>&nbsp;&nbsp;&nbsp;full source quotation like Ch. A. A'adami, Old Babylonian Letters, Sumer 23, 1967, 151ff.</small></TD></TR>";
    echo "<tr><td><small>type</small></TD><TD><select name=type><option></option><option>document</option><option>incantation</option><option>legal text</option><option>letter</option><option>mathematics</option><option>myth</option><option>narrative text</option><option>omina</option><option>royal inscription</option><option>other</option></select></TD><TD></TD></tr>";
    echo "<TR><TD><small>museum</small></TD><TD colspan=2><input type=text name=museum></TD><TD></TD></TR>";
    echo "<TR><TD><small>exhibit number</small></TD><TD colspan=2><input type=text name=museum_id></TD><TD></TD></TR>";
    echo "<TR><TD valign=top><small>series - number - plate/page</small></TD><TD colspan=2><input size=\"5\" type=text name=\"series[0]\">-<input type=text name=\"number[0]\" size=\"5\">-<input type=text name=\"plate[0]\" size=\"5\"><br><input type=text name=\"series[1]\" size=\"5\">-<input type=text name=\"number[1]\" size=\"5\">-<input type=text name=\"plate[1]\" size=\"5\"><br><input type=text name=\"series[2]\" size=\"5\">-<input type=text name=\"number[2]\" size=\"5\">-<input type=text name=\"plate[2]\" size=\"5\"><br><input type=text name=\"series[3]\" size=\"5\">-<input type=text name=\"number[3]\" size=\"5\">-<input type=text name=\"plate[3]\" size=\"5\"><br><input type=text name=\"series[4]\" size=\"5\">-<input type=text name=\"number[4]\" size=\"5\">-<input type=text name=\"plate[4]\" size=\"5\"></TD><TD></TD></TR>";
    echo "<tr><td class=vstup><small>text (without line numbers, each line must be separate by an enter)</small></TD><TD><textarea name=text id=q rows=4 cols=50 class=vstup></textarea></TD><TD></TD></tr>";
        echo "</table>";
        echo "<table>";
    echo "<tr><td></td><td><input type=\"submit\" value=\"add new text to the database\"><input type=hidden name=auth value=\"$auth\"></td></tr>";

    echo "<tr><td colspan=2>";
    include "key.inc.php";
	echo "</td></tr>";

    echo "</table>";

  echo "</td>";

  echo "<td width=60%>";

  echo "</td>";

  echo "</tr>";
  echo "</table>";

?>
</form>
</body>
</html>
