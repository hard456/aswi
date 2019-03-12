<?
if ($good=="")
{
	echo ("<html><body>");
  echo ("You forgot to input good transliteration!<BR>\n");
	echo ("<form action=\"./transrules1.php\"><input type=submit value=\"Bring me back\"></form>");
	echo ("</body></html>");
	exit;
}
elseif ($bad=="")
{
	echo ("<html><body>");
  echo ("bad not included!<BR>\n");
	echo ("<form action=\"./transrules1.php\"><input type=submit value=\"Bring me back\"></form>");
	echo ("</body></html>");
	exit;
}
else
{
	if (! @$spojeni = Pg_Connect ("user=dbowner dbname=klinopis") )
	{
		echo ("<html><body>");
    echo ("Not connected to the database!<BR>\n");
		echo ("<form action=\"./transrules1.php\"><input type=submit value=\"Bring me back\"></form>");
		echo ("</body></html>");
		exit;
	}
	$datum = Date ("Y-m-d H:00:00");
	if (! @Pg_Exec ($spojeni, "INSERT INTO transrules VALUES (' $bad', ' $good', ' $notes', '$datum', '$author')") )
	{
		echo ("<html><body>");
    echo ("New rule not successfully inserted!<BR>\n");
		echo ("<form action=\"./tools.html\"><input type=submit value=\"Back to main page\"></form>");
		echo ("</body></html>");
  	Pg_Close ($spojeni);
		exit;
	}
 	Pg_Close ($spojeni);
	Header ("Location: /utf/utf/transrulesv1.php?autor=$autor");
}
?>