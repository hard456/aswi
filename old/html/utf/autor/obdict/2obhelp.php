<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
<title>OBTC - OBDICT2</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body>
<H4 align=center><SMALL>A list of instructions for OBDICT2</SMALL></H4>
<TABLE>
<?
echo "<TR><TD class=td3><a href=\"/utf/utf/st.php\" target=\"_blank\">click to open new window for search in OBTC</a></TD><TD class=td3><a href=\"/utf/autor/obdict/2obea.php\" target=\"_blank\">click to open new window for english-old babylonian dictionary</a></TD></TR>";
echo "<TR><TD class=td3 colspan=2><a href=\"/utf/utf/stwithout.php\" target=\"_blank\">click to open new window for search in OBTC without keyboard</a></TD></TR>";
?>
<TR><TD class=td3>please read <i>carefully</i> explanation of the above main entries:</TD></TR>
<TR><TD class=td3><LI>entry name - main entry field under each entry will be listed in the printed and el. version, e.g. erēšum I or erēšum II this entry must be unique!</TD></TR>
<TR><TD class=td3><LI>refers to - e.g. if the entry name is e.g. alľAlum here will be written the word which refers to that is in this case : ḫalālum</TD></TR>
<TR><TD class=td3><LI>entry main translation - please put only one translation to each form entr to enable the future vice versa dictionary (english - akkadian)</TD></TR>
<TR><TD class=td3><LI>entry main translation - do not enter to drive but only drive to enable the proper unproblematic listing under d letter</TD></TR>
<TR><TD class=td3><LI>logogram - written with capital letters, e.g. DUB</TD></TR>
<TR><TD class=td3><LI>logogram - if more than one logogram, than it must be devided by semicolon ;</TD></TR>
<TR><TD class=td3><LI>root - written with capital letters, e.g. RKB for rakābum, RBJ for rabûm, PRŠD for naparšudum</TD></TR>
<TR><TD class=td3><LI>root - by the primary nouns there will be only pr.n.</TD></TR>
<TR><TD class=td3><LI>note - this note is intended to store the information about the femine plural forms from sg. masc., e.g. pl.fem. tuppatum, it could contain info about the main entry which is ambiguous or not so much clear to the internal discussion</TD></TR>
<TR><TD class=td3><LI>note - it may not contain the links to the primary or secondary sources, because this should be put into another table which is designed but not prepared for the input yet</TD></TR>
<TR><TD class=td3><LI>possible troubles: if there are opt. and st. together onl st. is marker, i.e. lu salil</TD></TR>
</TABLE>
</body>
</html>
