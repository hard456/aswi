<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Search in Old Babylonian Text Corpus</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<script language="JavaScript">
<!--
function openWindow(url, name)
{
popupWin = window.open(url, popup, "scrollbars,resizable,width=500,height=400");
}
-->
</SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF">
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/utf/obtextsshowlist.php">
<H4 align=center>Search for a string in the Old Babylonian Text Corpus</H4>
<TABLE BORDER=0>
<TR><TD>Type in searched chain: </TD><TD><INPUT class=vstup id=q name="chain" size=20 maxlength=100 value=""></TD><TD></TD></TR>
<TR><TD>type:</TD><TD><SELECT name="type"><OPTION></OPTION><OPTION>document</OPTION><OPTION>letter</OPTION><OPTION>legal text</OPTION><OPTION>omina</OPTION><OPTION>royal inscription</OPTION></SELECT></TD><TD></TD></TR>
<TR><TD>origin:</TD><TD><SELECT class=vstup name="origin"><OPTION></OPTION><OPTION>Kisura</OPTION><OPTION>Kish</OPTION><OPTION>Lagaba</OPTION><OPTION>Larsa</OPTION><OPTION>Tell Harmal</OPTION></SELECT></TD><TD></TD></TR>
<TR><TD>ruler:</TD><TD><INPUT class=vstup name="ruler" size=20 maxlength=100 value="">
</TD><TD></TD></TR>
<TR><TD>year:</TD><TD><INPUT class=vstup name="year" size=20 maxlength=100 value="">
</TD><TD></TD></TR>
<TR><TD>month:</TD><TD><INPUT class=vstup name="month" size=20 maxlength=100 value="">
</TD><TD></TD></TR>
</TABLE>
<? $chain = urlencode($chain); ?><BR>
<? include "key.inc.php" ?>
<TABLE>
<TR>
<TD>
<INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:32;background-color:#EEFFEE">
</TD>
<TD WIDTH=30>&nbsp;</TD>
<TD><a href="http://140.132.1.204/msdownload/Font%20for%20Publisher%202000/aruniupd.exe" TARGET="_blank"><small>if you don't see special characters above, you need to download and install a font with unicode support</small></a></TD>
</TR>
</TABLE>
</FORM>
</BODY>
</HTML>