<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Selection of attested variants according to syllabic value</title>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body topmargin="15" leftmargin="15" bgcolor="#EFF1FF">
<FORM id=form1 method="get" name=form1 action="/utf/utf/show2syllabic.php">
<H3><FONT FACE="Verdana, Arial" color=#3399ff>Selection of variants according to syllabical value</FONT></H3>
<p>Type in syllabical value to see all attested variants in the corpus used for Old Babylonian Graphemic Analyses:<br>
<small><small>e.g. lam, á¹­up etc. (<a href="http://140.132.1.204/msdownload/Font%20for%20Publisher%202000/aruniupd.exe" TARGET="_blank">if you don't see special characters below, you need to download and install a font with unicode support)</small></small></a>
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
