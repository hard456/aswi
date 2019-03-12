<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>vkladani dat do obdict</title>
</head>
<body>
<h1><center> Vkladani dat do databaze</center></h1>
<br>
<?
  if ( ($file1 == ""))
  {

    echo ("Nebylo zadano jmeno souboru!<br>\n");
		echo ("<br><br><a href=\"./vlozeni1obdict.php\"> Zpet</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
  $file1="/home/webowner/data-in/".$file1;
  if ( ($fr1 = FOpen ($file1, "r")) == false )
  {
    echo ("Nepodarilo se otevrit soubor!<br> Jmeno ".$file1."\n");
		echo ("<br><br><a href=\"../index.php3\"> Zpet na administraci klinopis.cz</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
	$konec = false;
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
//vlozeni FCI pro konverzi
	require "./fcek2u2.php";
	define ("MAXPOLOZKA", 64000);
	define ("MAXREAD", 1274400);
	$datum = Date ("Y-m-d");
  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
		if ($typdat == 1)	//nova hesla
	      $item = StrTok ($text, "^");
	      $type = StrTok ("^");
	      $text1 = StrTok ("^");
	      $text2 = StrTok ("^");
			include "./convertk2u2.php";
			echo ("<FONT FACE=\"Unicode Arial MS\" SIZE=3>$webitem\n</FONT>");
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("<hr>".$pocethesel."<br><hr>\n");
			if (StrLen ($item) <= MAXPOLOZKA)
			{
		if (@$msg = Pg_Exec ($spojeni, "INSERT INTO obdict (item, type, text1, text2, zmena, autor, datum) VALUES ('$webitem', '$type', '$webtext1', '', '0', 'fr02', '$datum')"))
					{
						$heseldobre++;
					}
			}
    }
    else
		$konec = true;
		echo (" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	} while (! $konec);
  FClose ($fr1);
	Pg_Close ($spojeni);
	echo ("<hr>Celkovy pocet nactenych hesel: $pocethesel<br>\n");
	echo ("Pocet hesel, ktere byly vlozeny: $heseldobre<br>\n");
	echo ("Pocet hesel, ktere byly moc dlouhe (nevlozeny): $heselnevlozeno<br>\n");
?>
	<form action="./ktools.html">
		<input type=submit value="Zpet na administraci klinopis.cz">
	</form>
</BODY>
</HTML>