<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>administrace klinopis.cz</TITLE>
</HEAD>

<BODY>
<h1><center> Vkladani novych dat do obtext popis (obtextp)</center></h1>
<br><br>
<? echo "Author's abbreviation: $auth_userkod"; ?>
	<form action="/utf/tools/novadata/vlozeni2obtextp.php" method="POST">
  	<fieldset>
    	<legend> <strong>Where is the file stored on the server</strong></legend>
   			&nbsp;&nbsp;&nbsp;Data file in UTF-8 format: 
					&nbsp;&nbsp;&nbsp;<b>/data-in/bybsrc/<b><input type=text name=file1>
				<table border=0>
					<tr><td valign=top>
						&nbsp;&nbsp;Type of inserted data:
					</td><td>
						<input type=radio name=typdat value="1" CHECKED>new data<br>
						<input type=radio name=typdat value="2">modified old data (not working now)<br>
					</td>
</tr><tr>
<td>Please indicate what kind of text you are inputing:
					</td><td>
						<INPUT TYPE=RADIO NAME="type" VALUE="document" CHECKED>documents&nbsp;&nbsp;&nbsp;
						<INPUT TYPE=RADIO NAME="type" VALUE="incantation">incantations&nbsp;&nbsp;&nbsp;
						<INPUT TYPE=RADIO NAME="type" VALUE="letter">letters&nbsp;&nbsp;&nbsp;
						<INPUT TYPE=RADIO NAME="type" VALUE="legal texts">legal texts&nbsp;&nbsp;&nbsp;<BR>
						<INPUT TYPE=RADIO NAME="type" VALUE="omina">omina&nbsp;&nbsp;&nbsp;
						<INPUT TYPE=RADIO NAME="type" VALUE="royal inscription">royal inscriptions&nbsp;&nbsp;&nbsp;
						<INPUT TYPE=RADIO NAME="type" VALUE="school excercise">school excercises&nbsp;&nbsp;&nbsp;
						<INPUT TYPE=RADIO NAME="type" VALUE="varia">varia&nbsp;&nbsp;&nbsp;
					</td></tr>
				</table>
	 </fieldset>
	 <br>
   <input type=submit value="click to insert the data from the file">
	</form>
<form action="/utf/ktools.php">
	<input type=submit value="Zpet na administraci klinopis.cz">
</form>
<br><br> 
</BODY>
</HTML>
