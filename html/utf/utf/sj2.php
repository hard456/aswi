<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<TITLE>Search in Old Babylonian Akkadian Dictionary</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF">
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/autor/obdict/2ob1.php">
<H3 align=center>Search for a dictionary entry in the Dictionary <BR>of the Old Babylonian Akkadian Language v.2</H3>
Type in:
<INPUT class=vstup id=q name="chain" size=20 maxlength=100 value="">
<BR>
type (doesnt work in prep.):<SELECT name="derivation"><option></option><option>inf.</option><option>pars</option><option>pirs</option><option>purs</option><option>pa:ris</option><option>parra:s</option><option>purussu:</option><option>mu-</option></SELECT>
<BR>
<?
include "key.inc.php";
//if ($auth_level == 10) {
		//			echo "";
				//        }
			//		else {
			//		include "key.inc.php";
			//		}
?>
<TABLE>
<TR>
<TD>
<INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:30;background-color:#EEFFEE">
</TD>
<TD WIDTH=30>&nbsp;</TD>
<?
if ($auth_level == 10) {
					echo "";
				        }
					else {
					echo "<TD><a href=\"http://140.132.1.204/msdownload/Font%20for%20Publisher%202000/aruniupd.exe\" TARGET=\"_blank\"><small>if you don't see special characters above, you need to download and install a font with unicode support</small></a></TD>";
					}
?>
</TR>
</TABLE>
</FORM>
</BODY>
</HTML>