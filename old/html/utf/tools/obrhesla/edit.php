<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>Uprava hesla s obrazkem</TITLE>
</HEAD>
<body>
<h2><center> Uprava hesla s obrazkem </center></h2>
	<form action="./show.php">
		<input type=submit value="Zpet na prehled">
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

	if ($res = Pg_Exec ($spojeni, "SELECT fk_obor, fk_heslo, obr_hesla, gen_obr FROM obrhesla WHERE (id='$polozka')") )
	{
		List ($obor, $idhesla, $obr, $obrsoub) = Pg_Fetch_Row($res, 0);

		echo ("<form action=\"edit2.php\" method=\"post\">");
			echo ("Obor zvoleneho policka: ");
			$pocet = Pg_NumRows ($lob = Pg_Exec ($spojeni, "SELECT obor, nazev FROM c_obor ORDER BY nazev"));
			echo ("<select name=\"nobor\">");
			for ($i = 0; $i < $pocet; $i++)
			{
				List ($hod, $naz) = Pg_Fetch_Row ($lob, $i);
				if ($hod == $obor) $sel = "selected";
				else $sel = "";
				echo ("<option value=\"$hod\" $sel> $naz </option>");
			}
			echo ("</select>");
			echo ("<br><br>");

			echo ("Vybrane heslo: ");
				List ($nazevh) = Pg_Fetch_Row (Pg_Exec ($spojeni, "SELECT webnazev FROM ezetdat WHERE (ident='$idhesla')"), 0);
				echo ($nazevh);
				$lhesla = Pg_Exec ($spojeni, "SELECT ident, webnazev FROM hledani WHERE ((obor4='$obor') OR (obor5='$obor') OR (obor6='$obor') OR (obor7='$obor'))");
				$lhespocet = Pg_NumRows ($lhesla);
				echo ("<br>&nbsp;&nbsp;Nove heslo: <select name=\"nidhesla\">");
					echo ("<option value=\"\" selected> Nemenit </option>");
					for ($i=0; $i < $lhespocet; $i++)
					{
						List ($idh, $nh) = Pg_Fetch_Row ($lhesla, $i);
						echo ("<option value=\"$idh\"> ".SubStr ($nh, 0, 15)." </option>");
					}
				echo ("</select>");
			echo ("<br><br>");
			
			echo ("Jaky zobrazovat obrazek: ");
			echo ("<select name=\"nobr\">");
				if ($obr == "t") $s1 = "selected";
				else $s2 = "selected";
				echo ("<option value=\"true\" $s1> Prirazene k heslu </option>");
				echo ("<option value=\"false\" $s2> Jednotne pro vsechna hesla </option>");
			echo ("</select>");
			echo ("<br><br>");

			echo ("Jednotny obrazek: $obrsoub");
			echo ("<br>");
			echo ("&nbsp;&nbsp;Novy obrazek: /obrazky/obecne/<input type=edit name=nobrsoub> ");
			echo ("<br><br>");
			
			echo ("<input type=submit value=\"Ulozit zmeny\">");
			echo ("<input type=hidden name=\"polozka\" value=\"$polozka\">");
		echo ("</form>\n");
	}
	Pg_Close ($spojeni);
?>
</body>
</html>