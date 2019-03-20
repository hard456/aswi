<?
  @$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
  if (! $spojeni)
  {
    echo ("<br>Sorry, too many querries, please try later.<BR>\n");
    exit;
  }
	$polozky="bcislo, images";
  $vysledek = Pg_Exec ($spojeni, "SELECT $polozky FROM images WHERE (bcislo='333')");
  $pocet = Pg_NumRows ($vysledek);
  if ($pocet == 0)
	{
	echo ("Nothing found, try again.");
  } else {
  list ($bcislo) = Pg_Fetch_Array ($vysledek, $i);
  for ($i=0; $i < $pocet; $i++)
	  {
    list ($bcislo, $images) = Pg_Fetch_Array ($vysledek, $i);
    echo ("<img src=\"../png/$images\" WIDTH=35 HEIGHT=35 BORDER=0>");
  	}
		echo ("<BR><BR>");
	}
  Pg_FreeResult ($vysledek);
  Pg_Close ($spojeni);
?>
