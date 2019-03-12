<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>administrace klinopis.cz</TITLE>
</HEAD>

<BODY>
<h1><center> Vkladani novych dat do GRAF01</center></h1>
<br><br>
	<form action="./vlozeni2graf02.php" method="POST">
  	<fieldset>
    	<legend> <strong>Urceni souboru</strong></legend>
   			&nbsp;&nbsp;&nbsp;Datovy soubor v UTF-8: 
					&nbsp;&nbsp;&nbsp;<b>/data-in<b><input type=text name=file1>
				<table border=0>
					<tr><td valign=top>
						&nbsp;&nbsp;Typ vkladanych dat:
					</td><td>
						<input type=radio name=typdat value="1" CHECKED>Nova data <br>
						<input type=radio name=typdat value="2">Upravena stara data <br>
					</td></tr>
				</table>
	 </fieldset>
	 <br>
   <input type=submit value="Vloz data">
	</form>
<form action="../index.php3">
	<input type=submit value="Zpet na administraci klinopis.cz">
</form>
<br><br> 
</BODY>
</HTML>
