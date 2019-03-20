<?
if (! IsSet ($kodaut))
{
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");

  @$res = Pg_Exec ($spojeni, "INSERT INTO badentry (datum, ip, host, popis) VALUES ('".Date ("Y-m-d H:i:s")."', '$REMOTE_ADDR', '$REMOTE_HOST', 'Spatne volani identifikace autora')");

	Pg_Close ($spojeni);
  Header ("Location: ./entertransrules.html");
  exit;
}
elseif ($passaut=="")
{
	echo ("<form action=\"./identif.php\" method=\"post\"><input type=hidden name=kodaut value=$kodaut>");
	echo ("You forgot to enter your password: <input type=password name=passaut><br><br><input type=submit value=\"Enter into editorial system\"></form>");
	exit;
}
else
{
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("It was imposible to connect to the database!<BR>\n");
		echo ("<form action=\"./entertransrules.html\"><input type=submit value=\"Back to main page\"></form>");
		exit;
	}
	@$msg = Pg_Exec ($spojeni, "SELECT heslo, autor FROM c_autor WHERE kod='$kodaut'");
	if (! Pg_NumRows ($msg) )
	{
	  @$res = Pg_Exec ($spojeni, "INSERT INTO badentry (datum, ip, host, popis) VALUES ('".Date ("Y-m-d H:i:s")."', '$REMOTE_ADDR', '$REMOTE_HOST', 'Vstup neznameho autora')");

		Pg_Close ($spojeni);
	  Header ("Location: ./entertransrules.html");
  	exit;
	}
	else
	{
		List ($heslo, $autor) = Pg_Fetch_Row ($msg, 0);
//		List ($heslo, $jmeno) = Pg_Fetch_Row ($msg, 0);
		if ($heslo == $passaut)
		{
			Pg_Close ($spojeni);
		  Header ("Location: http://www.klinopis.cz/utf/autor/transrules/transrules1.php?autor=$kodaut");
			exit;
		}
		else
		{
		  @$res = Pg_Exec ($spojeni, "INSERT INTO badentry (datum, ip, host, popis) VALUES ('".Date ("Y-m-d H:i:s")."', '$REMOTE_ADDR', '$REMOTE_HOST', 'Autor $jmeno vlozil spatne heslo pri prihlasovani')");
			echo ("You entered wrong password, try it again!<br>");
			echo ("<form action=\"./entertransrules.html\"><input type=submit value=\"Back to begin\"></form>");
		}
	}
	Pg_Close ($spojeni);
}
?>