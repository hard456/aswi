<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>

<BODY>

<h1><center> Vkladani dat do databaze do tabulky graf02</center></h1>
<br>
<FONT FACE='Arial Unicode MS' SIZE=3>
<?
  if ( ($file1 == ""))
  {

    echo ("Nebylo zadano jmeno souboru!<br>\n");
		echo ("<br><br><a href=\"./vlozeni11gr.php3\"> Zpet</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
  if ( ($typdat != 1) && ($typdat != 2))
  {

    echo ("Nebyl zadan typ vkladanych dat!<br>\n");
		echo ("<br><br><a href=\"./vlozeni11gr.php3\"> Zpet</a>");
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
	$pocethesel = $heseldobre = $heselnevlozeno = $heselbezweb = $heselzdroj = $heselbezasc = 0;
	$spojeni = Pg_Connect("user=vadmin dbname=klinopis");

//vlozeni FCI pro konverzi
	require "./fcek2u2.php";
	define ("MAXREAD", 50000);
  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
	if ($typdat == 1)	//nova hesla
	      $number = StrTok ($text, "^");
	      $editionabbreviation = StrTok ("^");
	      $editionnumber1 = StrTok ("^");
	      $editionnumber2 = StrTok ("^");
	      $dateyear = StrTok ("^");
	      $datemonth = StrTok ("^");
	      $dateday = StrTok ("^");
	      $ancientplace = StrTok ("^");
	      $documenttype = StrTok ("^");
	      $transliteration = StrTok ("^");
	      $ancientruler = StrTok ("^");
	      $ancientyear = StrTok ("^");
//			include "./convertk2u2.php";
//			$klic = MD5 ($transliteration);
			echo ($transliteration." \n");
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("<hr>".$pocethesel."<br><hr>\n");
//vkladani dat do DB graf02
				if ($typdat == 1)
				{ //nova hesla
					if (@Pg_Exec ($spojeni, "INSERT INTO graf01 (number, editionabbreviation, editionnumber, dateyear, datemonth, dateday, ancientplace, documenttype, transliteration, ancientruler, ancientyear) VALUES ('$number', '$editionabbreviation', '$editionnumber', '$dateyear', '$datemonth', '$dateday', '$ancientplace', '$documenttype', '$transliteration', '$ancientruler', '$ancientyear')") )
						$heseldobre++;
					else
					{
						echo ("<b>Heslo nevlozeno jednim SQL prikazem.</b>");
						$heselnevlozeno++;
					}
				}
    }
    else $konec = true;

		echo (" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	} while (! $konec);

  FClose ($fr1);

	Pg_Close ($spojeni);

	echo ("<hr>Celkovy pocet nactenych hesel: $pocethesel<br>\n");
	echo ("Pocet hesel, ktere byly vlozeny: $heseldobre<br>\n");
	echo ("Pocet hesel, ktere byly moc dlouhe (nevlozeny): $heselnevlozeno<br>\n");
	echo ("Pocet hesel, ktere nemaji WEB cast: $heselbezweb<br>\n");
?>
	<form action="../index.php3">
		<input type=submit value="Zpet na administraci klinopis.cz">
	</form>
</FONT>
</BODY>
</HTML>