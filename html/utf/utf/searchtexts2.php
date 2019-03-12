<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
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
<FORM id=form1 METHOD="get" name=form1 ACTION="http:/utf/utf/obtextsshowlist2.php">
<H4 align=center>Search for a string in the Old Babylonian Text Corpus</H4>
Type in: 
<INPUT class=vstup id=q name="chain" size=20 maxlength=100 value="">
<? $chain = urlencode($chain); ?><BR>
<? include "key.inc.php" ?>
<TABLE>
<TR><TD><INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:32;background-color:#EEFFEE">
</TD><TD></TD></TR>
<TR><TD>&nbsp;</TD><TD>Welcome! Members area only, please report errors to the administrator of OBTC.</TD></TR>
<TR><TD>&nbsp;</TD><TD colspan=3></TD></TR>
</TABLE>
</FORM>
</BODY>
</HTML>