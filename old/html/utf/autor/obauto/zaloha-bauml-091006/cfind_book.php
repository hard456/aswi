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
<TITLE>---------- Search -----------</TITLE>
</HEAD>
<BODY>
<form METHOD="post" name=form1 ACTION="c_books.php">
from page : <input type=text class=vstup size=12 name=fpage value=""><br>

<? //include "key.inc.php" ?>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  search biography records  " style="height:30;background-color:#EEFFEE">
</FORM>
</BODY>
</HTML>
