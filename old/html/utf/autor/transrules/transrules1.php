<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>Input new item</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>

<BODY>
<h1><center><FONT FACE="Verdana, Arial" color=#3399ff>Input new rule for transliteration in OBTC</font></center></h1>

<p>
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/autor/transrules/transrules2.php">
		<table border>
			<tr>
				<td width=30%>
					<small>input a transliteration which should be improved:</small>
				</td>
				<td>
<INPUT class=vstup id=q name="bad" size=80 maxlength=100 value="">
<? $bad = urlencode($bad); ?><BR>
				</td>
			</tr>
			<tr>
				<td>
					<small>input right transliteration:</small>
				</td>
				<td>
					<INPUT TYPE=text NAME="good" SIZE=80>
				</td>
			</tr>
			<tr>
				<td>
					<small>input note to this rule, if it is necessary:</small>
				</td>
				<td>
					<TEXTAREA NAME="notes" ROWS=5 COLS=62></TEXTAREA>
				</td>
			</tr>
			<tr>
				<td>
					<small>Your abbreviation code is : </small>
				</td>
				<td><b><?echo $kodaut;?></b></td>
<? 
echo ("<input type=hidden name=autor value=\"$kodaut\">"); 
echo "<small>$autor</small>"; 
?>
				</td>
			</tr>
		</table>

<BR>


<TABLE>
<TR>
<TD>
 <INPUT class=tlacitko1 TYPE="SUBMIT" value="  send  " style="height:32;background-color:#EEFFEE">
</TD>
</TR>
</TABLE>
</FORM>
<? include "key.inc.php" ?>
</BODY>
</HTML>
