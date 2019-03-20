<?
	@$spojeni = Pg_Connect ("user=vautor dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
		exit;
	}
	$msg = Pg_Exec ($spojeni, "SELECT autor, menu FROM c_autor WHERE kod='$autor'");
	if (! Pg_NumRows ($msg) )
	{
	  @$res = Pg_Exec ($spojeni, "INSERT INTO BadEntry (datum, ip, host, popis) VALUES ('".Date ("Y-m-d H:i:s")."', '$REMOTE_ADDR', '$REMOTE_HOST', 'Vstup neznameho autora do MENU.php3')");

		Pg_Close ($spojeni);
	  Header ("Location: ./enter.html");
  	exit;
	}
	else
		List ($jmeno, $menu) = Pg_Fetch_Row ($msg, 0);
	Pg_Close ($spojeni);
?>
<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>Editorial system - klinopis.cz</title>
</head>

<BODY bgcolor="#FFFFFF" text="#000000">
<h2><center>
<FONT FACE="Verdana, Arial" color=#3399ff>Welcome to the editorial system of www.klinopis.cz</center></font></h2>
<? 		
echo ("<p><SMALL>You are successfully logged in, your name is: $jmeno</SMALL></p>");
?>
<hr>
	<fieldset>
<form>
			<BR>&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="Button" VALUE="Bring me back" onClick="history.go(-2)">
			</form>
	</fieldset>
<hr>
	<fieldset>
		<form action="../index.html">
			<br>&nbsp;&nbsp;&nbsp;
			<input type=submit value="Sign off">
		</form>
	</fieldset>
<!-- <script language="Javascript"> if (top.location == self.location) {    top.location = 'index.html' } </script> //-->
</body>
</html>