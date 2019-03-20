<?
	if (! @$spojeni = Pg_Connect("user=vadmin  dbname=vseved2"))
	{
    echo ("Nepodarilo se pripojit do databaze!<br>\n");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
	}

	if ($nidhesla != "")
		$upravah = ", fk_heslo='$nidhesla'";
	else
		$upravah = "";
	if ($nobrsoub != "")
		$upravao = ", gen_obr='$nobrsoub'";
	else
		$upravao = "";
	
	if (Pg_Exec ($spojeni, "UPDATE obrhesla SET fk_obor='$nobor', obr_hesla='$nobr' $upravah $upravao WHERE (id='$polozka')") )
		Header ("Location: ./edit.php?polozka=$polozka");
//		echo ("OK");
	else
		echo ("Chyba pri ukladani hodnot<br>");
	Pg_Close ($spojeni);
?>
