<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>Nastaveni hesel s obrazky</TITLE>
</HEAD>
<body>
<h2><center> Nastaveni hesel s obrazky </center></h2>
	<form action="../index.php3">
		<input type=submit value="Zpet na hlavni stranku nastroju">
	</form>
<hr>
<?
	if (! @$spojeni = Pg_Connect("user=vadmin  dbname=vseved2"))
	{
    echo ("Nepodarilo se pripojit do databaze!<br>\n");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
	}

	if ($res = Pg_Exec ($spojeni, "SELECT id, fk_obor, fk_heslo, obr_hesla, gen_obr FROM obrhesla ORDER BY id") )
	{
		$pocet = Pg_NumRows ($res);
		echo ("<table border><tr><td><b><center> Obor </center></b></td><td><b><center> Heslo </center></b></td><td><b><center> Obrazek </center></b></td><td><b><center> Soubor </center></b></td><td><b><center> Nastroje </center></b></td></tr>\n");
		for ($i = 0; $i < $pocet; $i++)
		{
			List ($id, $obor, $idhesla, $obr, $obrsoub) = Pg_Fetch_Row($res, $i);
			echo ("<tr><td>");
				List ($nazevo) = Pg_Fetch_Row ( Pg_Exec ($spojeni, "SELECT nazev FROM c_obor WHERE (obor='$obor')"), 0);
				echo ($nazevo);
			echo ("</td><td>");
				List ($nazevh) = Pg_Fetch_Row (Pg_Exec ($spojeni, "SELECT webnazev FROM ezetdat WHERE (ident='$idhesla')"), 0);
				echo ($nazevh);
			echo ("</td><td>");
				$typ = $obr == "t" ? "Urceny s heslem" : "Jednotny";
				echo ($typ);
			echo ("</td><td>");
				echo ($obrsoub);
			echo ("</td><td>");
				echo ("<a href=\"./edit.php?polozka=$id\"> upravit </a>");
			echo ("</td></tr>");
		}
		echo ("</table>");
	}
	Pg_Close ($spojeni);
?>
</body>
</html>