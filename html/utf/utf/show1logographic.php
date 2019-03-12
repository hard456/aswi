<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Selection of attested variants according to logographic value</title>
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
<body topmargin="15" leftmargin="15" bgcolor="#EFF1FF">
<BODY BGCOLOR="#FFFFFF">
<FORM id=form1 method="get" name=form1 action="/utf/utf/show2logographic.php">
<H3><FONT FACE="Verdana, Arial" color=#3399ff>Selection of variants according to logographic value</FONT></H3>
<p>Type in existing logographic value to see all attested variants in the corpus used for Old Babylonian Graphemic Analyses:<br>
<small><small>e.g. LUM, KAM etc.&nbsp;&nbsp;<a href="http://140.132.1.204/msdownload/Font%20for%20Publisher%202000/aruniupd.exe" TARGET="_blank">(if you don't see special characters below, you need to download and install a font with unicode support)</small></small></a>
</p>
Type in: 
<INPUT class=vstup id=q name="borger" size=15 maxlength=100 value="">
<?
$borger = urlencode($borger);
include "key.inc.php";
?>
<TABLE>
<TR>
<TD>
<INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:32;background-color:#EEFFEE">
</TD>
</TR>

</TABLE>

</FORM>

<SCRIPT>
<!--
document.form1.q.focus();
-->
</SCRIPT>

<BR>
</BODY>
</HTML>

