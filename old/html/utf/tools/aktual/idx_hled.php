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

	if (Pg_Exec ($spojeni, "DROP INDEX hledani_idx1"))
		echo ("Index1 odtranen<br>\n");
	if (Pg_Exec ($spojeni, "DROP INDEX hledani_idx2"))
		echo ("Index2 odtranen<br>\n");
	if (Pg_Exec ($spojeni, "DROP INDEX hledani_idx3"))
		echo ("Index3 odtranen<br>\n");
	if (Pg_Exec ($spojeni, "DROP INDEX hledani_idx4"))
		echo ("Index4 odtranen<br>\n");

	if (Pg_Exec ($spojeni, "CREATE INDEX hledani_idx1 ON hledani (oid, klic)"))
	  echo ("<br>Vytvoreni indexu probehlo v poradku pro id a klic. Index1<br>\n");

	if (Pg_Exec ($spojeni, "CREATE INDEX hledani_idx2 ON hledani (webnazev)"))
    echo ("<br>Vytvoreni indexu probehlo v poradku pro webnazev. Index2<br>\n");

	if (Pg_Exec ($spojeni, "CREATE INDEX hledani_idx3 ON hledani (ascnazev)"))
    echo ("<br>Vytvoreni indexu probehlo v poradku pro ascnazev. Index3<br>\n");

	if (Pg_Exec ($spojeni, "CREATE INDEX hledani_idx4 ON hledani (obor4, obor5, obor6, obor7)"))
    echo ("<br>Vytvoreni indexu probehlo v poradku pro obor4, obor5, obor6, obor7. Index4<br>\n");

	Pg_Close ($spojeni);
?>
 <form action="../index.php3">
	<input type=submit value="Zpet na administraci Vseveda">
 </form>

</BODY>
</HTML>