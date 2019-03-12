<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>

<BODY>

<h1><center> Vkladani dat do databaze</center></h1>
<br>
<FONT FACE='Arial Unicode MS' SIZE=4>
<?
  if ( ($file1 == ""))
  {

    echo ("Nebylo zadano jmeno souboru!<br>\n");
		echo ("<br><br><a href=\"./vlozeni1gr.php3\"> Zpet</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
  if ( ($typdat != 1) && ($typdat != 2))
  {

    echo ("Nebyl zadan typ vkladanych dat!<br>\n");
		echo ("<br><br><a href=\"./vlozeni1gr.php3\"> Zpet</a>");
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

	$spojeni = Pg_Connect("user=dbowner dbname=klinopis");

//vlozeni FCI pro konverzi
	require "./fcek2u2.php";

	define ("MAXPOLOZKA", 73380);
	define ("MAXREAD", 50000);
	$datum = Date ("Y-m-d H:00:00");

  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
			if ($typdat == 1)	//nova hesla
	      $cislo = StrTok ($text, "^");
	      $autor = StrTok ("^");
	      $titul = StrTok ("^");
	      $neco1 = StrTok ("^");
	      $neco2 = StrTok ("^");
	      $neco3 = StrTok ("^");
	      $neco4 = StrTok ("^");
	      $cislopor1 = StrTok ("^");
	      $cislopor2 = StrTok ("^");
	      $vzdavatel = StrTok ("^");
	      $mistovydani = StrTok ("^");
	      $rok = StrTok ("^");
	      $neco5 = StrTok ("^");
	      $neco6 = StrTok ("^");
	      $cislox = StrTok ("^");
	      $signatura1 = StrTok ("^");
	      $signatura2 = StrTok ("^");
	      $venoval = StrTok ("^");
			if ( StrLen ($lcteni) > MAXPOLOZKA)
			{
				//docteni konce textu na radku
				if (StrLen ($text) >= MAXREAD-10) $text = FGetS ($fr1, MAXREAD);
			
				echo ("<b>heslo \"$nazev\" je moc dlouhe ve vstupnim souboru, nebude prevedeno</b><br>\n");
				continue;
				$heselnevlozeno++;
			}
      $text = "";

			include "./convertk2u2.php";
//			$klic = MD5 ($gnazev);
			echo ($titul." \n");
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("<hr>".$pocethesel."<br><hr>\n");

			//vkladani dat do DB graf01
			if (StrLen ($lcteni) >= MAXPOLOZKA)
			{
				//vymazani dlouheho textu
				$webpopis="";
				$wappopis="";
				$heselbezweb++;
				echo ("Heslo bez scteni");
			}
			else if (StrLen ($scteni) >= MAXPOLOZKA)
			{
				//vymazani dlouheho textu
				$wappopis="";
			}
	 
			if (StrLen ($lcteni) <= MAXPOLOZKA)
			{
				if ($typdat == 1)
				{ //nova hesla
					if (@Pg_Exec ($spojeni, "INSERT INTO monokl (cislo, autor, titul, neco1, neco2, neco3, neco4, cislopor1, cislopor2, vydavatel, mistovydani, rok, neco5, neco6, cislox, signatura1, signatura2, venoval) VALUES ('$cislo', '$webautor', '$webtitul', '$neco1', '$neco2', '$neco3', '$neco4', '$cislopor1', '$cislopor2', '$vydavatel', '$mistovydani', '$rok', '$neco5', '$neco6', '$cislox', '$signatura1', '$signatura2', '$venoval')") )
						$heseldobre++;
					else
					{
						echo ("<b>Heslo nevlozeno jednim SQL prikazem.</b>");
						$heselnevlozeno++;
					}
				}
				else
				{  //update hesel
					if (Pg_Exec ($spojeni, "UPDATE graf01 SET klic='$klic', pcislo='$pcislo', gnazev='$gnazev', bcislo01='$bcislo', scteni='$scteni', lcteni='$lcteni'") )
						$heseldobre++;
					else
					{
						echo ("<b>Heslo neopraveno jednim SQL prikazem.</b>");
						$heselnevlozeno++;
					}
				}
			}
			else
			{
				echo ("<b>Zadane heslo se po konverzi zvetsilo, Nevlozeno!</b><br>\n");
				$heselnevlozeno++;
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