<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>Administrace Vseved</title>
</head>

<BODY>
<h1><center>Vkladani noveho autora</center></h1>

<p>
	<FORM ACTION="./autori2.php3" method="post">
		<table border>
			<tr>
				<td width=30%>
					Zadejte identifikacni kod autora:
				</td>
				<td>
					<INPUT TYPE=text NAME="kodaut" SIZE=4> (max 4 pismena)
				</td>
			</tr>
			<tr>
				<td>
					Zadejte heslo autora:
				</td>
				<td>
					<INPUT TYPE=password NAME="passaut" SIZE=10>
				</td>
			</tr>
			<tr>
				<td>
					Zadejte jmeno autora:
				</td>
				<td>
					<INPUT TYPE=text NAME="jmenoaut" SIZE=20>
				</td>
			</tr>
			<tr>
				<td><br>
					Mozne ukoly autora:
				</td>
				<td>
					Vkladany uzivatel bude moci provadet vsechny ukoly vypsane nad oznacenou polozkou (vcetne) <br>
					<input type=radio name=menu value="1" Checked>Vkladani hesel <br>
					<input type=radio name=menu value="2" >Tvorba alias <br>
					<input type=radio name=menu value="9" >Kontrola hesel <br>
					<input type=radio name=menu value="10" >Super editor <br>
				</td>
			</tr>
			<tr>
				<td colspan="2"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<INPUT TYPE=submit VALUE="Pridat autora">
					</form>
				</td>
			</tr>
		</table>
<form action="./autorv1.php3">
	<input type=submit value="Zpět na upravu autoru">
</form>

</body>
</html>