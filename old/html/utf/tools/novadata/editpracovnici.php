<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("NepodaÅ™ilo se pÅ™ipojit k databÃ¡zi!<BR>\n");
		exit;
	}
?>

<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>IS - KSA - Úprava údajù o pracovnících</title>
</head>

<BODY>
<h2><center>Úprava údajù o pracovnících</center></h2>
<?	
	$res = Pg_Exec ($spojeni, "SELECT prijmeni, zivotopis FROM pracovnici WHERE (prijmeni='$co')");

	if (Pg_NumRows($res))
	{
//$titul1, $jmeno, $titul2, $mail, 
		List ($prijmeni, $zivotopis) = Pg_Fetch_Row ($res, 0);
?>
		<FORM ACTION="./editpracovnici2.php" METHOD="post">
			<fieldset>
				<Legend><strong> pøíjmení </strong></legend>
				<textarea name=nazev cols=80 rows=1><?echo (StripSlashes($prijmeni))?></textarea>
			</fieldset>
			<br>
			<fieldset>
				<legend><strong> odborný životopis </strong></legend>
				<textarea name=popis cols=80 rows=10><?echo (StripSlashes($notes))?></textarea>
			</fieldset>
			<br>

			<br>
			<fieldset>
			<legend> <strong> other information </strong> </legend>
//			<?
//				echo ("&nbsp;&nbsp;<b>1:</b>&nbsp;<input type=\"text\" name=\"year\" value=\"$year\" size=\"4\">\n");
//				echo ("&nbsp;&nbsp;<b>2:</b>&nbsp;<input type=\"text\" name=\"month\" value=\"$month\" size=\"4\">\n");
//				echo ("&nbsp;&nbsp;<b>3:</b>&nbsp;<input type=\"text\" name=\"day\" value=\"$day\" size=\"4\"><br>\n");

//				$msg = Pg_Exec ($spojeni, "SELECT obor, nazev FROM c_obor");

//				$pocetoboru = Pg_NumRows ($msg);
//				echo ("&nbsp;&nbsp;<b>4:</b>&nbsp; <select name=\"textype\">");
//				echo ("<option value=\"0\">Select..</option>\n");
//				for ($i = 0; $i< $pocetoboru; $i++)
//				{
//					List ($obor, $obnazev) = Pg_Fetch_Row ($msg, $i);
//					if ($obor == $textype)
//						echo ("<option value=$obor selected>$obnazev</option>\n");
//					else
//						echo ("<option value=$obor>$obnazev</option>\n");
//				}
//				echo ("</select>");

//				echo ("&nbsp;&nbsp;<b>location</b>&nbsp; <select name=\"location\">");
//				echo ("<option value=\"0\">Select..</option>\n");
//				for ($i = 0; $i< $pocetoboru; $i++)
//				{
//					List ($obor, $obnazev) = Pg_Fetch_Row ($msg, $i);
//					if ($obor == $o5)
//						echo ("<option value=$obor selected>$obnazev</option>\n");
//					else
//						echo ("<option value=$obor>$obnazev</option>\n");
//				}
//				echo ("</select>");
//			?>
			</fieldset>
			<br>
//			<?
//				echo ("<input type=hidden name=autor value=\"$autor\" >");
//				echo ("<input type=hidden name=co value=\"$co\" >");
//				echo ("<input type=hidden name=qnazev value=\"$qnazev\" >");
//				echo ("<input type=hidden name=qo1 value=\"$qo1\" >");;

//			?>
			<input type=submit value="odeslat upravenou verzi">
		</form>
<?
	}
	else
		echo "Nebylo nalezeno heslo odpovidajici danemu klici";
?>
Pokud se chcete vratit na seznam, tak pouze zavrete toto <b>nove okno
</b>.
</form>

</body>
</html>

