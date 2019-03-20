<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("It was imposible to connect to the database, try again later, the server is maybe down!<BR>\n");
		echo ("<form action=\"../index.php3\"><input type=submit value=\"Back to main page\"></form>");
		exit;
	}
	if ( (IsSet ($koho)) && ($koho != ""))
		Pg_Exec ($spojeni, "DELETE FROM transrules WHERE (OID=$koho)");
	Pg_Close ($spojeni);

	Header ("Location: ./transrulesv1.php");
?>
