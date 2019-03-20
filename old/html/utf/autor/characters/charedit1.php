<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
  <title>Edit an item from the OBTC rules</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<SCRIPT>
<!--
function Add2Str(str){var str;document.form1.q.value+=str;document.form1.q.focus();}
-->
</SCRIPT>
</head>
<body>
<h3><center>Edit the selected character</center></h3>
<?
$status = true;
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "There was an error by connecting to the database, sorry.";
    break;
  endif;
  @$result = Pg_Exec(
		"select oid, charview, char2b, charentity, description from characters WHERE oid='$OID'");
  if (!$result):
    echo "There was an error by the SQL query, sorry.";
    break;
  endif;
  echo "<table border=1>";
  echo "<tr><td><center><small>character in Unicode font</small></center></td><td><center><small> character in 2b Unicode UTF-8</small></center></td><td><center><small> character in entity Unicode UTF-8</small></center></td><td><center><small> description</small></center></td></tr>";
  echo "<FORM id=form1 name=form1 ACTION=\"/autor/characters/charedit2.php\" METHOD=\"post\" ACCEPT-CHARSET=\"utf-8\" enctype=\"multipart/form-data\">";
  for ($i=0; $i < Pg_NumRows($result); $i++):
    $zaznam = Pg_Fetch_Array($result, $i);
    echo ("<tr><td><textarea class=vstup  id=q name=charview cols=7 rows=2>".$zaznam["charview"]."</textarea></td><td><textarea class=vstup name=char2b cols=7 rows=1>".$zaznam["char2b"]."</textarea></td></tr>");
    echo ("<tr><td><center><textarea class=vstup name=charentity cols=7 rows=1>".$zaznam["charentity"]."</textarea></center></td><td><textarea class=vstup name=description cols=40 rows=2>".$zaznam["description"]."</textarea></td></tr>\n");
  endfor;
  echo "</table>";
  echo "<input type=hidden name=OID value=$OID>";
  Pg_Close ($connection);
} while (false);
?>
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
 <INPUT class=tlacitko1 TYPE="SUBMIT" value="  send new version " style="height:32;background-color:#EEFFEE">
</TD>
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
