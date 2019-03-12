<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<TITLE>Search in Old Babylonian Akkadian Dictionary</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF">
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/utf/searchobdict.php">
<H3 align=center>Search for a dictionary item in the Provisional Dictionary <BR>of the Old Babylonian Akkadian Language</H3>
Type in:
<INPUT class=vstup id=q name="chain" size=20 maxlength=100 value="">
<? $chain = urlencode($chain); ?><BR>
<BR>
<? include "key.inc.php" ?>
<TABLE>
<TR>
<TD>
<INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:30;background-color:#EEFFEE">
</TD>
<TD WIDTH=30>&nbsp;</TD>
<TD><a href="
http://www.flwi.rug.ac.be/latijnengrieks/basic_files/ARIALUNI.zip" TARGET="_blank"><small>if you don't see special characters above, you need to download and install a font with unicode support</small></a></TD>
</TR>
</TABLE>
</FORM>
</BODY>
</HTML>
