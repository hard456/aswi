<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>

<BODY>

<h1><center> Vkladani dat do databaze</center></h1>
<br>
<FONT FACE='Unicode Arial MS' SIZE=3>
<?
  if ( ($file1 == ""))
  {

    echo ("Nebylo zadano jmeno souboru!<br>\n");
		echo ("<br><br><a href=\"./vlozeni1png.php\"> Zpet</a>");
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
	@$spojeni = Pg_Connect ("user=vviewer dbname=klinopis");
	define ("MAXPOLOZKA", 31690);
	define ("MAXREAD", 50000);
	$datum = Date ("Y-m-d H:00:00");
  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
		if ($typdat == 1)	//nova hesla
	      $bcislo = StrTok ($text, "^");
	      $images = StrTok ("^");
			echo ($bcislo." \n");
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("<hr>".$pocethesel."<br><hr>\n");
			if (StrLen ($number) <= MAXPOLOZKA)
			{
		if (@$msg = Pg_Exec ($spojeni, "INSERT INTO images (bcislo, images) VALUES ('$bcislo', '$images')"))
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
	<form action="../index.php3">
		<input type=submit value="Zpet na administraci klinopis.cz">
	</form>
</FONT>
</BODY>
</HTML>