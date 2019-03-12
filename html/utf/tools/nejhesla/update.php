<?
define ("SLOUPCU", 4);
	if (! @$spojeni = Pg_Connect("user=vadmin  dbname=vseved2"))
	{
    echo ("Nepodarilo se pripojit do databaze!<br>\n");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
	}
	Pg_Exec ($spojeni, "UPDATE nejhesla SET sl1_obor='$nsl1', sl2_obor='$nsl2', sl3_obor='$nsl3', sl4_obor='$nsl4'");

	$sporadi = Array (1=>$sl1por, $sl2por, $sl3por, $sl4por);
	$s = Array (1=>$nsl1, $nsl2, $nsl3, $nsl4);
	for ($i=1; $i <= SLOUPCU; $i++)
	{
		if ($sporadi[$i] != "")
		{
			if ($s[$i] >= 0) 
				$pod1 = "WHERE ((obor4='$s[$i]') OR (obor5='$s[$i]') OR (obor6='$s[$i]') OR (obor7='$s[$i]'))";
			$list[$i] = Pg_Exec ($spojeni, "SELECT fk_ez_id FROM whitel $pod1 ORDER BY web DESC, wap DESC");
			if ($sporadi[$i] < Pg_NumRows ($list[$i]) )
				List ($nidhesla[$i]) = Pg_Fetch_Row ($list[$i], $sporadi[$i]);

			if (! @Pg_Exec ($spojeni, "UPDATE nejhesla SET sl".$i."_heslo='$nidhesla[$i]'") )
			{
				echo ("Zvolene heslo ve sloupci $i nema odpovidajici heslo v EZETDAT<br>\n");
				Pg_Close ($spojeni);
				exit;
			}
		}
	}

	Pg_Close ($spojeni);

  Header ("Location: ./show.php");
?>