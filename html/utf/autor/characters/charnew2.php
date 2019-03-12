<?
if ($charview=="")
{
	echo ("<html><body>");
  echo ("You forgot to input charview item!<BR>\n");
	echo ("<form action=\"./charnew1.php\"><input type=submit value=\"Bring me back\"></form>");
	echo ("</body></html>");
	exit;
}
elseif ($char2b=="")
{
	echo ("<html><body>");
  echo ("char2b not included!<BR>\n");
	echo ("<form action=\"./charnew1.php\"><input type=submit value=\"Bring me back\"></form>");
	echo ("</body></html>");
	exit;
}
else
{
	if (! @$spojeni = Pg_Connect ("user=dbowner dbname=klinopis") )
	{
		echo ("<html><body>");
    echo ("Not connected to the database!<BR>\n");
		echo ("<form action=\"./charnew1.php\"><input type=submit value=\"Bring me back\"></form>");
		echo ("</body></html>");
		exit;
	}
	if (! @Pg_Exec ($spojeni, "INSERT INTO characters VALUES (' $charview', ' $char2b', ' $charentity', ' $description')") )
	{
		echo ("<html><body>");
    echo ("New character not successfully inserted!<BR>\n");
		echo ("<form action=\"./tools.html\"><input type=submit value=\"Back to main page\"></form>");
		echo ("</body></html>");
  	Pg_Close ($spojeni);
		exit;
	}
 	Pg_Close ($spojeni);
	Header ("Location: http://www.klinopis.cz/utf/utf/encoding.php");
}
?>