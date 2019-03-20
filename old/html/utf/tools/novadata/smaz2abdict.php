<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
		echo ("<form action=\"../index.php3\"><input type=submit value=\"Zpět na hlavni stranku nastroju\"></form>");
		exit;
	}
	if ( (IsSet ($koho)) && ($koho != ""))
		Pg_Exec ($spojeni, "DELETE FROM graf02 WHERE (edition='$koho')");
	Pg_Close ($spojeni);


	Header ("Location: http://www.klinopis.cz/utf/viewcuneig.php");
?>
