<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>Prohlizeni autoru pro publikacni system</title>
</head>

<BODY>
<h1><center>Prohlizeni autoru pro publikacni system</center></h1>

<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
		echo ("<form action=\"../index.php3\"><input type=submit value=\"Zpet na hlavni stranku nastroju\"></form>");
		exit;
	}
?>
	<form action="./autori1.php3">
		<input type=submit value="Vlozeni noveho autora">
	</form>
	<form action="../index.php3">
		<input type=submit value="Zpet na hlavni stranku nastroju">
	</form>

<table border=1>
	<tr>
		<td><center><b> Kod </b></center></td>
		<td><center><b> Heslo </b></center></td>
		<td><center><b> Autor </b></center></td>
		<td><center><b> &nbsp; Menu &nbsp;</b></center></td>
		<td><center><b> &nbsp; Nastroje &nbsp;</b></center></td>
	</tr>
<?
	@$msg = Pg_Exec ($spojeni, "SELECT kod, autor, heslo, menu FROM c_autor ORDER BY kod");
	Pg_Close ($spojeni);
	
	for ($i = 0; $i < Pg_NumRows ($msg); $i++)
	{
		List ($kod, $jmeno, $heslo, $menu) = Pg_Fetch_Row ($msg, $i);

		echo ("<tr><td>&nbsp; $kod &nbsp;</td>".
					"<td>&nbsp; $heslo &nbsp;</td>".
					"<td>&nbsp; $jmeno &nbsp;</td>".
					"<td>&nbsp; $menu &nbsp;</td>".
					"<td>&nbsp; <a href=\"./autord.php?koho=$kod\">smazat</a> &nbsp;".
					"</tr>\n");
	}
?>

</table>
</body>
</html>