<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
		echo ("<form action=\"../index.php3\"><input type=submit value=\"Zpět na hlavni stranku nastroju\"></form>");
		exit;
	}
	if ( (IsSet ($koho)) && ($koho != ""))
		Pg_Exec ($spojeni, "DELETE FROM c_autor WHERE (kod='$koho')");
	Pg_Close ($spojeni);

	Header ("Location: ./autorv1.php");
?>
