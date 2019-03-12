<?
if (! @$spojeni = Pg_Connect ("user=dbowner dbname=klinopis") )
{
	echo ("<html><body>");
	echo ("Not connected to the database!<BR>\n");
	echo ("<form action=\"./transrulesv1.php\"><input type=submit value=\"Bring me back\"></form>");
	echo ("</body></html>");
	exit;
}
$datum = Date ("Y-m-d H:00:00");
if (! @Pg_Exec ($spojeni, "UPDATE transrules SET bad='$bad', good='$good', notes='$notes', datum='$datum', autor='$autor')") )
{
	echo ("<html><body>");
	echo ("New rule not successfully updated!<BR>\n");
	echo ("<form action=\"./ktools.html\"><input type=submit value=\"Back to main page\"></form>");
	echo ("</body></html>");
  Pg_Close ($spojeni);
exit;
}
Pg_Close ($spojeni);
Header ("Location: http://www.klinopis.cz/utf/utf/transrulesv1.php?autor=$autor");
?>