<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
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
echo "<FONT FACE=\"Arial Unicode MS\">You can now input new description for the dictionary item: <B>$item</B></FONT><BR>";
echo "<BR>Type in your description:"; 
?>
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/autor/obdict/obdictnew2.php">
<? 
echo "<input type=hidden name=item value=\"$item\">";
echo ("<tr><td>author's a.</td><td><select name=\"autor\"><option>zh01</option><option>sl01</option><option>nn01</option><option>lp01</option><option>jp01</option><option>fr02</option></select></td></tr>\n");
//echo "<input type=hidden name=autor value=\"$autor\">"; 
?>
<TEXTAREA
<textarea class=vstup id=q name="text1" cols=60 rows=5 value="">
</textarea>
<? $text1 = urlencode($text1); ?><BR>
<BR>

<TABLE>
<TR>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00E1;' onclick="Add2Str('&#x00E1;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00E9;" onclick="Add2Str('&#x00E9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00ED;" onclick="Add2Str('&#x00ED;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00FA;" onclick="Add2Str('&#x00FA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F3;" onclick="Add2Str('&#x00F3;')"></TD>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00C1;' onclick="Add2Str('&#x00C1;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C9;" onclick="Add2Str('&#x00C9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00CD;" onclick="Add2Str('&#x00CD;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00DA;" onclick="Add2Str('&#x00DA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D3;" onclick="Add2Str('&#x00D3;')"></TD>
</TR>
<TR>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00E0;' onclick="Add2Str('&#x00E0;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00E8;" onclick="Add2Str('&#x00E8;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00EC;" onclick="Add2Str('&#x00EC;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F9;" onclick="Add2Str('&#x00F9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F2;" onclick="Add2Str('&#x00F2;')"></TD>
<TD>&nbsp;</TD><TD>&nbsp;&nbsp;&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C0;" onclick="Add2Str('&#x00C0;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C8;" onclick="Add2Str('&#x00C8;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00CC;" onclick="Add2Str('&#x00CC;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D9;" onclick="Add2Str('&#x00D9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D2;" onclick="Add2Str('&#x00D2;')"></TD>
</TR><TR>

<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00E2;' onclick="Add2Str('&#x00E2;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00EA;" onclick="Add2Str('&#x00EA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00EE;" onclick="Add2Str('&#x00EE;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00FB;" onclick="Add2Str('&#x00FB;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F4;" onclick="Add2Str('&#x00F4;')"></TD>
</TD><TD>&nbsp;</TD><TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C2;" onclick="Add2Str('&#x00C2;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00CA;" onclick="Add2Str('&#x00CA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00DB;" onclick="Add2Str('&#x00DB;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D4;" onclick="Add2Str('&#x00D4;')"></TD>
</TR>

<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x0101;' onclick="Add2Str('&#x0101;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0113;" onclick="Add2Str('&#x0113;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x012B;" onclick="Add2Str('&#x012B;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x016B;" onclick="Add2Str('&#x016B;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x014D;" onclick="Add2Str('&#x014D;')"></TD>
</TD><TD>&nbsp;</TD><TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0100;" onclick="Add2Str('&#x0100;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0112;" onclick="Add2Str('&#x0112;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x012A;" onclick="Add2Str('&#x012A;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x016A;" onclick="Add2Str('&#x016A;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x014C;" onclick="Add2Str('&#x014C;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E63;" onclick="Add2Str('&#x1E63;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0161;" onclick="Add2Str('&#x0161;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E6D;" onclick="Add2Str('&#x1E6D;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="ḫ" onclick="Add2Str('ḫ')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E62;" onclick="Add2Str('&#x1E62;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x0160;" onclick="Add2Str('&#x0160;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E6C;" onclick="Add2Str('&#x1E6C;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E2A;" onclick="Add2Str('&#x1E2A;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E63;" onclick="Add2Str('&#x1E63;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0161;" onclick="Add2Str('&#x0161;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E6D;" onclick="Add2Str('&#x1E6D;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="ḫ" onclick="Add2Str('ḫ')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E62;" onclick="Add2Str('&#x1E62;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x0160;" onclick="Add2Str('&#x0160;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E6C;" onclick="Add2Str('&#x1E6C;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E2A;" onclick="Add2Str('&#x1E2A;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  send new item definition  " style="height:30;background-color:#EEFFEE">
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
