<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>

<BODY>

<h1><center> Vkladani dat do databaze do tabulky obtexts</center></h1>
<br>
<FONT FACE='Unicode Arial MS' SIZE=3>
<?
  if ( ($file1 == ""))
  {

    echo ("Nebylo zadano jmeno souboru!<br>\n");
		echo ("<br><br><a href=\"./ktools.html\"> Zpet</a>");
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
	@$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
//vlozeni FCI pro konverzi
	require "./fcek2u2.php";
	define ("MAXPOLOZKA", 62690);
	define ("MAXREAD", 62000);
	$datum = Date ("Y-m-d H:00:00");
  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
		if ($typdat == 1)	//nova hesla

	      $bookandchapterc = StrTok ($text, "^");
	      $autographyabbreviation = StrTok ("^");
	      $transliteration = StrTok ("^");
	      $autography1 = StrTok ("^");
	      $autography2 = StrTok ("^");
	      $dateyear = StrTok ("^");
	      $datemonth = StrTok ("^");
	      $dateday = StrTok ("^");
	      $nowlocated = StrTok ("^");
	      $museumnumber1 = StrTok ("^");
	      $excavationnumber1 = StrTok ("^");
	      $ancientplace = StrTok ("^");
	      $documenttype = StrTok ("^");
	      $ancientruler = StrTok ("^");
	      $ancientyear = StrTok ("^");
	      $notes = StrTok ("^");
	      $secondarylit = StrTok ("^");
	      $individualities = StrTok ("^");
	      $secondarylit = StrTok ("^");
	      $belongsto = StrTok ("^");
	      $author = StrTok ("^");
	      $date = StrTok ("^");
				$readycatalogue = StrTok ("^");
//      $text = "";
			include "./convertk2u2.php";
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("<hr>".$pocethesel."<br><hr>\n");
			//vkladani dat do DB graf01
			if (StrLen ($number) <= MAXPOLOZKA)
			{
				if (Pg_Exec ("INSERT INTO catalogue (autographyabbreviation, autography1, autography2, dateyear, datemonth, dateday, nowlocated, museumnumber1, excavationnumber1, ancientplace, documenttype, bookandchapterc, ancientruler, ancientyear, secondarylit, notes, individualities, belongsto, author, date, readycatalogue) VALUES ('$autographyabbreviation', '$autography1', '$autography2', '$dateyear', '$datemonth', '$dateday', '$nowlocated', '$museumnumber1', '$excavationnumber1', '$webancientplace', '$documenttype', '$webbookandchapterc', '$ancientruler', '$ancientyear', '$secondarylit', '$webnotes', '$webindividualities', '$webbelongsto', '$author', '$datum', '$readycatalogue')"))
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
		<input type=submit value="Back to ktools">
	</form>
</FONT>
</BODY>
</HTML>