<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 1) {
					echo "sorry, the editing is available for active members, <A HREF="http://www.klinopis.cz/utf/utf/howtobeamember.php">see the rules</A>";
				        }
					else {
echo "XXX";
					}
?>

<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<TITLE>Search in Old Babylonian Akkadian Dictionary</TITLE>

<STYLE TYPE="text/css">
<!--
body {font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;}
.tlacitko2 {cursor:hand;font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;font-weight:normal;font-size:100%;color:#000000;background-color:#FFFFEE}
.vstup {font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;font-weight:normal;font-size:100%;color:#000000;background-color:#FFFFFF}
.tlacitko1 {cursor:hand;font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;font-weight:normal;font-size:80%;color:#000000;background-color:#FFFFEE}
-->
</STYLE>

<SCRIPT>
<!--
function Add2Str(str){var str;document.form1.q.value+=str;document.form1.q.focus();}
-->
</SCRIPT>
</HEAD>

<BODY BGCOLOR="#FFFFFF">
<?  
$chain2 = $item;
echo "<FONT FACE=\"Arial Unicode MS\">You can now input new dictionary item: </FONT><BR>";
?>
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/autor/obdict/2obdictnew2.php">
<? 
echo "<tr><td></td><td></td><td></td></tr>";
echo "<tr><td><input type=text name=\"logogram\"></td></tr>\n";
echo "<tr><td><input type=text name=\"note\"></td></tr>\n";
echo "<tr><td><input type=text name=\"note\"></td></tr>\n";
echo ("<tr><td>author's a.</td><td><select name=\"auth\"><option>zh01</option><option>sl01</option><option>nn01</option><option>lp01</option><option>jp01</option><option>fr02</option></select></td></tr>\n");
echo "<tr><td><input type=text name=\"auth\"></td></tr>\n";
echo ("<tr><td>is the item OK</td><td><select name=\"ok\"><option>1</option><option>0</option></td></tr>\n");
echo "<tr><td><input type=hidden name=autor value=\"$auth\">"; 
echo "<input type=hidden name=\"ok\">";
$text1 = urlencode($text1); 
?>
<BR><BR>
<? include "key.inc.php" ?>
<TABLE>
<TR>
<TD>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  send new or existing item   " style="height:30;background-color:#EEFFEE">
</TD>
</TR>
</FORM>
</TABLE>

<SCRIPT>
<!--
document.form1.q.focus();
-->
</SCRIPT>


</BODY>
</HTML>
