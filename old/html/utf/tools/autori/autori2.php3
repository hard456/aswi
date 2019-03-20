<?
if ($passaut=="")
{
	echo ("<html><body>");
  echo ("Nebylo vlozeno heslo!<BR>\n");
	echo ("<form action=\"./autori1.php3\"><input type=submit value=\"Zpět na vlozeni autora\"></form>");
	echo ("</body></html>");
	exit;
}
elseif ($jmenoaut=="")
{
	echo ("<html><body>");
  echo ("Nebylo vlozeno plne jmeno autora!<BR>\n");
	echo ("<form action=\"./autori1.php3\"><input type=submit value=\"Zpět na vlozeni autora\"></form>");
	echo ("</body></html>");
	exit;
}
else
{
	if (! @$spojeni = Pg_Connect ("user=vadmin dbname=klinopis") )
	{
		echo ("<html><body>");
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
		echo ("<form action=\"../index.php3\"><input type=submit value=\"Zpět na hlavni stranku nastroju\"></form>");
		echo ("</body></html>");
		exit;
	}
	if (! @Pg_Exec ($spojeni, "INSERT INTO c_autor VALUES ('$kodaut', '$jmenoaut', '$passaut', '$menu')") )
	{
		echo ("<html><body>");
    echo ("Nepodařilo se vlozit zadaneho autora do databáze!<BR>\n");
		echo ("<form action=\"./tools.html\"><input type=submit value=\"Zpět na hlavni stranku nastroju\"></form>");
		echo ("</body></html>");
  	Pg_Close ($spojeni);
		exit;
	}
 	Pg_Close ($spojeni);
	Header ("Location: ./autorv1.php3");
}
?>