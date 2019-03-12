<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level < 10) ksa_unauthorized();

$heslo = MD5($password); 

if ($heslo=="")
{
	echo ("<html><body>");
  echo ("Password was not written!<BR>\n");
	echo ("<form action=\"./autori1.php\"><input type=submit value=\"Zpět na vlozeni autora\"></form>");
	echo ("</body></html>");
	exit;
}
elseif ($autor=="")
{
	echo ("<html><body>");
  echo ("Author's name was not written!<BR>\n");
	echo ("<form action=\"./autori1.php\"><input type=submit value=\"Zpět na vlozeni autora\"></form>");
	echo ("</body></html>");
	exit;
}
else
{
	if (! @$spojeni = Pg_Connect ("user=dbowner dbname=klinopis") )
	{
		echo ("<html><body>");
    echo ("Impossible to connect to the database!<BR>\n");
		echo ("<form action=\"../index.php\"><input type=submit value=\"Back to the main tools page\"></form>");
		echo ("</body></html>");
		exit;
	}
	if (! @Pg_Exec ($spojeni, "INSERT INTO c_autor VALUES ('$kod', '$autor', '$heslo', '$menu')") )
	{
		echo ("<html><body>");
    echo ("Impossible to input new author to the database!<BR>\n");
		echo ("<form action=\"./tools.html\"><input type=submit value=\"Back to the main tools page\"></form>");
		echo ("</body></html>");
  	Pg_Close ($spojeni);
		exit;
	}
 	Pg_Close ($spojeni);
	Header ("Location: ./autorv1.php");
}
?>