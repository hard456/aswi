<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>edit an item</title>
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
</head>
<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("It was imposible to connect to the database, try again later, the server is maybe down!<BR>\n");
		echo ("<form action=\"../nic.php\"><input type=submit value=\"back to main page\"></form>");
		exit;
	}
?>
	<form action="./transrules1.php">
		<input type=submit value="input new item">
	</form>
	<form action="../nic.php">
		<input type=submit value="back to main page">
	</form>
<table border=1>
<FORM id=form1 METHOD="get" name=form1 ACTION="/autor/transrules/transrulesedit2.php">
	<tr bgcolor=#808080>
		<td><center><b> wrong transliteration </b></center></td>
		<td><center><b> good transliteration </b></center></td>
		<td><center><b> notes </b></center></td>
		<td><center><b> date </b></center></td>
		<td><center><b> author </b></center></td>
	</tr>
<?
	@$msg = Pg_Exec ($spojeni, "SELECT bad, good, notes, OID FROM transrules where OID='$OID'");
	Pg_Close ($spojeni);
	
	for ($i = 0; $i < Pg_NumRows ($msg); $i++)
	{
		List ($bad, $good, $notes, $datum, $autor, $OID) = Pg_Fetch_Row ($msg, $i);
?>
<tr>
<td><small>input wrong transliteration:</small><INPUT TYPE=text NAME="bad" SIZE=80 value="<? echo "&nbsp; $bad &nbsp;" ?>">
	</td>
</tr><tr>
	<td><small>right transliteration:</small><INPUT TYPE=text NAME="good" SIZE=80 value="<? echo "&nbsp; $good &nbsp;" ?>">
	</td>
</tr><tr>
	<td><small>edit note to this rule, if it is necessary:</small>
	<TEXTAREA class=vstup id=q name="notes" ROWS=5 COLS=62 value="<? echo "$notes"; ?></TEXTAREA></td>
<? $notes = urlencode($notes); ?>
</tr>
<tr>
	<td><small>Your abbreviation is : <? echo "&nbsp; $autor &nbsp;" ?></small></td>
</tr>
</table>
<? 
}
echo ("<input type=hidden name=autor value=\"$autor\">"); 
echo "<small>$autor</small>"; 
?>
<BR>
<TABLE>
<TR>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value='&#x00E1;' onclick="Add2Str('&#x00E1;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00E9;" onclick="Add2Str('&#x00E9;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00ED;" onclick="Add2Str('&#x00ED;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00FA;" onclick="Add2Str('&#x00FA;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00F3;" onclick="Add2Str('&#x00F3;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00FD;" onclick="Add2Str('&#x00FD;')"></TD>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value='&#x00C1;' onclick="Add2Str('&#x00C1;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00C9;" onclick="Add2Str('&#x00C9;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00CD;" onclick="Add2Str('&#x00CD;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00DA;" onclick="Add2Str('&#x00DA;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00D3;" onclick="Add2Str('&#x00D3;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00DD;" onclick="Add2Str('&#x00DD;')"></TD>
</TR>
<TR>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value='&#x00E0;' onclick="Add2Str('&#x00E0;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00E8;" onclick="Add2Str('&#x00E8;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00EC;" onclick="Add2Str('&#x00EC;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00F9;" onclick="Add2Str('&#x00F9;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00F2;" onclick="Add2Str('&#x00F2;')"></TD>
<TD>&nbsp;</TD><TD>&nbsp;&nbsp;&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00C0;" onclick="Add2Str('&#x00C0;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00C8;" onclick="Add2Str('&#x00C8;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00CC;" onclick="Add2Str('&#x00CC;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00D9;" onclick="Add2Str('&#x00D9;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00D2;" onclick="Add2Str('&#x00D2;')"></TD>
</TR><TR>

<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value='&#x00E2;' onclick="Add2Str('&#x00E2;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00EA;" onclick="Add2Str('&#x00EA;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00EE;" onclick="Add2Str('&#x00EE;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00FB;" onclick="Add2Str('&#x00FB;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00F4;" onclick="Add2Str('&#x00F4;')"></TD>
</TD><TD>&nbsp;</TD><TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00C2;" onclick="Add2Str('&#x00C2;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00CA;" onclick="Add2Str('&#x00CA;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00DB;" onclick="Add2Str('&#x00DB;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x00D4;" onclick="Add2Str('&#x00D4;')"></TD>
</TR>

<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value='&#x0101;' onclick="Add2Str('&#x0101;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x0113;" onclick="Add2Str('&#x0113;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x012B;" onclick="Add2Str('&#x012B;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x016B;" onclick="Add2Str('&#x016B;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x014D;" onclick="Add2Str('&#x014D;')"></TD>
</TD><TD>&nbsp;</TD><TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x0100;" onclick="Add2Str('&#x0100;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x0112;" onclick="Add2Str('&#x0112;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x012A;" onclick="Add2Str('&#x012A;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x016A;" onclick="Add2Str('&#x016A;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x014C;" onclick="Add2Str('&#x014C;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="ʾ" onclick="Add2Str('ʾ')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="ʿ" onclick="Add2Str('ʿ')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x1E63;" onclick="Add2Str('&#x1E63;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x0161;" onclick="Add2Str('&#x0161;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x1E6D;" onclick="Add2Str('&#x1E6D;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="ḫ" onclick="Add2Str('ḫ')"></TD>
<TD WIDTH=85>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x1E62;" onclick="Add2Str('&#x1E62;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x0160;" onclick="Add2Str('&#x0160;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x1E6C;" onclick="Add2Str('&#x1E6C;')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="&#x1E2A;" onclick="Add2Str('&#x1E2A;')"></TD>
</TR>
</TABLE>
<TABLE>
<TR>
<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₁" onclick="Add2Str('₁')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₂" onclick="Add2Str('₂')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₃" onclick="Add2Str('₃')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₄" onclick="Add2Str('₄')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₅" onclick="Add2Str('₅')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₆" onclick="Add2Str('₆')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₇" onclick="Add2Str('₇')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₈" onclick="Add2Str('₈')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₉" onclick="Add2Str('₉')"></TD>
<TD><INPUT class=tlacitko2 style="height:28;width:32" TYPE=button value="₀" onclick="Add2Str('₀')"></TD>

</TR>
</TABLE>

<TABLE>
<TR>
<TD>
 <INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:32;background-color:#EEFFEE">
</TD>
<TD WIDTH=30>&nbsp;</TD>
<TD><a href="http://office.microsoft.com/downloads/2000/aruniupd.aspx" TARGET="_blank"><small>if you don't see special characters above, you need to download and install a font with unicode support</small></a></TD>
</TR>
</TABLE>
</FORM>

<SCRIPT>
<!--
document.form1.q.focus();
-->
</SCRIPT>

</body>
</html>