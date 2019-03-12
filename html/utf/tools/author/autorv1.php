<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level < 10) ksa_unauthorized();
?>
<html>
<head>
<META content=text/html; http-equiv=Content-Type>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<title>List of authors in OBTC</title>
</head>

<BODY>
<h1><center>List of authors in OBTC</center></h1>

<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Impossible to connect to the database!<BR>\n");
		echo ("<form action=\"../ktools.php\"><input type=submit value=\"Back to the main tools page\"></form>");
		exit;
	}
?>
	<form action="./autori1.php">
		<input type=submit value="Click here to add new author">
	</form>
	<form action="../ktools.php">
		<input type=submit value="Back to the main tools page">
	</form>
<table border=1>
	<tr>
		<td><center><b> author's code </b></center></td>
		<td><center><b> password </b></center></td>
		<td><center><b> author's name and surname </b></center></td>
		<td><center><b> &nbsp; access rights &nbsp;</b></center></td>
		<td><center><b> &nbsp; tools &nbsp;</b></center></td>
	</tr>
<?
	@$msg = Pg_Exec ($spojeni, "SELECT kod, autor, heslo, menu FROM c_autor ORDER BY kod");
	Pg_Close ($spojeni);
	for ($i = 0; $i < Pg_NumRows ($msg); $i++)
	{
		List ($kod, $jmeno, $heslo, $menu) = Pg_Fetch_Row ($msg, $i);

		echo ("<tr><td>&nbsp; $kod &nbsp;</td>".
					"<td>&nbsp; $heslo &nbsp;</td>".
					"<td>&nbsp; $jmeno &nbsp;</td>".
					"<td>&nbsp; $menu &nbsp;</td>".
					"<td>&nbsp; <a href=\"./autord.php?koho=$kod\">delete</a> &nbsp;".
					"</tr>\n");
	}
?>
</table>
</body>
</html>