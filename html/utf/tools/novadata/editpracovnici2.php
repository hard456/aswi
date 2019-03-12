<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("NepodaÅ™ilo se pÅ™ipojit k databÃ¡zi!<BR>\n");
		exit;
	}
	require "http://www.klinopis.cz/autor/fce.php3";
	require "http://www.klinopis.cz/autor/convert.php3";

	$klic = MD5 ($prijmeni);
	$datum = Date ("Y-m-d H:i:s");
	$maxdelka = 31690;

	if (StrLen ($notes) > $maxdelka)
	{
		if (@$msg = Pg_Exec ($spojeni, "INSERT INTO pracovnici (klic, prijmeni, zivotopis) VALUES ('$klic', '$prijmeni', '$zivotopis', '$date')"))
			echo ("Bohužel, váš životopis je pøíliš dlouhý! Zkuste to trochu zkrátit, prosím.<br>\n");
		else
			echo ("Bohužel není možno provést tuto úpravu v daném okamžiku, zkuste to pozdìji, prosím!<br>\n");
	}
	else if (StrLen ($notes) > $maxdelka)
	{
		if ($msg = Pg_Exec ($spojeni, "INSERT INTO pracovnici (klic, prijmeni, zivotopis, date) VALUES ('$klic', '$prijmeni', '$zivotopis', '$date')"))
			echo ("Sorry, your notes are too long and therefore not saved.<br>\n");
		else
			echo ("It is imposible to change this item now, try later again please!<br>\n");
	}
	else
	{
		if (! @$msg = Pg_Exec ($spojeni, "INSERT INTO pracovnici (klic, prijmeni, zivotopis, date) VALUES ('$klic', '$prijmeni', '$zivotopis', '$date')"))
//old		if (! @$msg = Pg_Exec ($spojeni, "INSERT INTO cuneig (klic, edition, notes, datum) VALUES ('$klic', '$edition', '$notes', '$datum')"))
		{

			if (@$msg = Pg_Exec ($spojeni, "INSERT INTO pracovnici (klic, prijmeni, zivotopis, date) VALUES ('$klic', '$prijmeni', '$zivotopis', '$date')"))
			{
//		$msg = Pg_Exec ($spojeni, "SELECT max(oid) FROM cuneig");
//		List ($ioid) = Pg_Fetch_Row ($msg, 0);
//		if (@$msg = Pg_Exec ($spojeni, "UPDATE cuneig SET edition='$edition', notes='$notes' WHERE (edition=$co)"))
			}
		}
		else
		{
			echo ("Údaje o pracovníkovi byly úspìšnì aktualizoványeno spravne<hr>");
			echo ($prijmeni."<br><br>".$zivotopis."<hr>");
		}
	}				

	if ($msg)
	{
//		Pg_Exec ($spojeni, "DELETE FROM cuneig WHERE (edition='$co')");
	}

	Pg_Close ($spojeni);
	echo ("Just close the window and have a break!");
?>