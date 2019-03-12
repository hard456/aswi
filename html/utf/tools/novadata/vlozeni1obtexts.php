<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>administration klinopis.cz</TITLE>
</HEAD>

<BODY>
<h1><center> Data input to the table OBTEXTS</center></h1>
<br><br>
<? echo "Author's abbreviation: $auth_userkod"; ?>
	<form action="/utf/tools/novadata/vlozeni2obtexts.php" method="POST">
  	<fieldset>
    	<legend> <strong>Where is the file stored on the server</strong></legend>
   			&nbsp;&nbsp;&nbsp;data in UTF-8 format - please note all &lt; and &gt; and apostroph must be converted first!: 
					&nbsp;&nbsp;&nbsp;<b>/data-in/bybsrc/<b><input type=text name=file1>
				<table border=0>
					<tr><td valign=top>
						&nbsp;&nbsp;Type of inserted data:
					</td><td>
						<input type=radio name=typdat value="1" CHECKED>new data <br>
						<input type=radio name=typdat value="2">old modified data (doesn't work now)<br>
					</td></tr>
				</table>
	 </fieldset>
	 <br>
   <input type=submit value="click to insert the data from the file">
	</form>
<form action="/utf/ktools.php">
	<input type=submit value="back to main menu of klinopis.cz">
</form>
<br><br> 
</BODY>
</HTML>
