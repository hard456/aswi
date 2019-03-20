<HTML>

<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>

<BODY>

<h1><center> Aktualizace dat pro hledani</center></h1>
<br>
<?
	$spojeni = Pg_Connect("user=vadmin dbname=vseved2");

	Pg_Exec ($spojeni, "DROP TABLE hledani");

	if ($msg = Pg_Exec ($spojeni, "SELECT klic, webnazev, webpopis, ascnazev, ascpopis, wapnazev, wappopis, obor4, obor5, obor6, obor7 INTO TABLE hledani FROM ezetdat WHERE (obor1='1') ORDER BY ascnazev"))
	{
		echo ("<br>Aktualizace dat pro HLEDANI probehla v poradku.<br>\n");
		Pg_Exec ($spojeni, "GRANT select ON hledani TO vviewer");
		Pg_Exec ($spojeni, "GRANT all ON hledani TO dbowner");
		Pg_Exec ($spojeni, "GRANT select ON hledani TO vadmin");
		echo ("<br>Prirazeni prav probehlo v poradku.<br>\n");
	}
	Pg_Close ($spojeni);

?>
 <form action="../index.php3">
	<input type=submit value="Zpet na menu">
 </form>

</BODY>
</HTML>