<?
	@$spojeni = Pg_Connect ("user=vadmin dbname=klinopis");
	if (! $spojeni)
	{
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
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
			echo ("Bohu�el, v� �ivotopis je p��li� dlouh�! Zkuste to trochu zkr�tit, pros�m.<br>\n");
		else
			echo ("Bohu�el nen� mo�no prov�st tuto �pravu v dan�m okam�iku, zkuste to pozd�ji, pros�m!<br>\n");
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
			echo ("�daje o pracovn�kovi byly �sp�n� aktualizov�nyeno spravne<hr>");
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