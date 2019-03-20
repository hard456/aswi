<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<TITLE>Search in Old Babylonian Akkadian Dictionary</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF">
<FORM id=form1 METHOD="get" name=form1 ACTION="http://www.klinopis.cz/utf/utf/searchobdictfull.php">
<H3 align=center>Search for a dictionary item in the Provisional Dictionary <BR>of the Old Babylonian Akkadian Language</H3>
Type in:
<INPUT class=vstup id=q name="chain" size=20 maxlength=100 value="">
<? $chain = urlencode($chain); ?><BR>
<BR>
<? include "./key.php" ?>
</FORM>
</BODY>
</HTML>
