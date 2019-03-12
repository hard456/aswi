<html>
<body>
<h1><center> Uprava uvodni stranky </center> </h1>
	<form action="../index.php3">
		<input type=submit value="Zpet na hlavni stranku nastroju">
	</form>

<b>Jaky obor bude zobrazen ve sloupcich na uvodni strance?</b>
<br>
<form action="./update.php">

<?
define ("SLOUPCU", 4);
define ("HESEL", 10);
	if (! @$spojeni = Pg_Connect("user=vadmin  dbname=vseved2"))
	{
    echo ("Nepodarilo se pripojit do databaze!<br>\n");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
	}
	List ($s1, $s1_h, $s2, $s2_h, $s3, $s3_h, $s4, $s4_h) = Pg_Fetch_Row (Pg_Exec ($spojeni, "SELECT sl1_obor, sl1_heslo, sl2_obor, sl2_heslo, sl3_obor, sl3_heslo, sl4_obor, sl4_heslo FROM nejhesla"), 0);
	$s = Array (1=>$s1, $s2, $s3, $s4);
	$sidhesla = Array(1=>$s1_h, $s2_h, $s3_h, $s4_h);

	for ($i=1; $i <= SLOUPCU; $i++)
	{
		if ($s[$i] >= 0) 
			$pod1 = "WHERE ((obor4='$s[$i]') OR (obor5='$s[$i]') OR (obor6='$s[$i]') OR (obor7='$s[$i]'))";
		$list[$i] = Pg_Exec ($spojeni, "SELECT heslo, web, wap FROM whitel $pod1 ORDER BY web DESC, wap DESC");
		$pocetlist[$i] = Pg_NumRows ($list[$i]);
	}

	$pocetoboru = Pg_NumRows ($msg = Pg_Exec ($spojeni, "SELECT obor, nazev FROM c_obor ORDER BY nazev"));
	for ($i=1; $i <= SLOUPCU; $i++)
	{
		echo ("&nbsp;&nbsp;<b>$i. sloupec:</b>&nbsp; <select name=\"nsl$i\">");
		echo ("<option value=\"0\">Vsechny obory</option>\n");
		for ($q = 0; $q< $pocetoboru; $q++)
		{
			List ($obor, $obnazev) = Pg_Fetch_Row ($msg, $q);
			if ($s[$i] == $obor)
				echo ("<option value=\"$obor\" selected>$obnazev</option>\n");
			else
				echo ("<option value=\"$obor\">$obnazev</option>\n");
		}
		echo ("</select>\n");

		$pocetlist[$i] = ($pocetlist[$i] > HESEL) ? HESEL : $pocetlist[$i];
		echo ("&nbsp;Jake heslo v poradi: &nbsp;<select name=\"sl".$i."por\">");
		echo ("<option value=\"\" selected> Nemenit</option>");
		for ($h=0; $h < $pocetlist[$i]; $h++)
		{
			echo ("<option value=\"$h\">");
			echo ($h+1);
			echo ("</option>\n");
		}
		echo ("</select><br>\n");
	}
?>
  <br><br>
  <input type="submit" value="Zapsat nove sloupce">
</form>

<table width="98%">
<tr>
<?
	for ($i=1; $i<=SLOUPCU; $i++)
	{
		echo ("<td valign=top width=\"");
		echo (100/SLOUPCU);
		echo ("%\">\n");
		echo ("<b>Zobrazene heslo:</b><br>");
		$msg = Pg_Exec ($spojeni, "SELECT webnazev FROM hledani WHERE (ident=$sidhesla[$i])");
		if (Pg_NumRows ($msg) > 0)
		{
				List ($nazev) = Pg_Fetch_Row ($msg, 0);
				echo ("$nazev<br>\n");
		}
		else
			echo ("<B><i>Zvolene heslo nelze zobrazit</i></b><br>\n");

		echo ("<br><b>Prehled hesel: web - wap</b><br>");
		for ($q = 0; $q <$pocetlist[$i]; $q++)
		{
			List ($heslo, $c1, $c2) = Pg_Fetch_Row ($list[$i], $q);
			echo ("$heslo : $c1 - $c2<br>\n");
		}
		echo ("</td>\n");
	}
?>
</tr>
</table>

<?  Pg_Close ($spojeni); ?>

</body>
</html>