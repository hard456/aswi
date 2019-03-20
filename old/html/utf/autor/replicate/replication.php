<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level != 10) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>replicate database</title>
</head>
<body>
<?
while ($do == 'rep') {

  $lc = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$lc):
    echo "Impossible to connect to the local SQL database!";
    break;
  endif;
  $sc = Pg_Connect ("host=$server user=dbowner dbname=klinopis");
  if (!$sc):
    echo "Impossible to connect to the $server!";
    break;
  endif;

  

  // nove zaznamy z localu na server
  $lnew = pg_query($lc, "select book, descriptionp, chapter, bookandchapterp, autor, datum, type, origin, ruler, year, month, notedate, museum, museum_id, id, rec_state from obtextp where rec_state = 'N'");
  $lid = pg_fetch_row(pg_query($lc, "select max(id) from obtextp"), 0);
  $sid = pg_fetch_row(pg_query($sc, "select max(id) from obtextp"), 0);
  $lid = $lid[0];
  $sid = $sid[0];
  $new_id = max($lid, $sid);
    
  echo "Pøenáším " . Pg_NumRows($lnew) . " nových záznamù z lokálního stroje na server.<br>";
  for ($i=0; $i < Pg_NumRows($lnew); $i++) {

	  $new_id += 1;
	  
	  List ($book, $descriptionp, $chapter, $bookandchapter, $autor, $datum, $type, $origin, $ruler, $year, $month, $notedate, $museum, $museum_id, $id,  $rec_state) = Pg_Fetch_Row ($lnew, $i);

	  $bchori = $bookandchapter;
	  $bookandchapter = trim($bookandchapter);
	  if ($year == "") $year = 'NULL';
	  if ($month == "") $month = 'NULL';
	  if ($datum == "") $datum = 'NULL';
	  else $datum = "'$datum'";
      
	  $qsins = "insert into obtextp(book, descriptionp, chapter, bookandchapterp, autor, datum, type, origin, ruler, year, month, notedate, museum, museum_id, id, rec_state) values ('$book', '$descriptionp', '$chapter', '$bookandchapter', '$autor', $datum, '$type', '$origin', '$ruler', $year, $month, '$notedate', '$museum', '$museum_id', $new_id,  'O')";
	  $sins = pg_query($sc, $qsins);


      // + podrizene
	  if ($bookandchapter != "") {

		  $qsins = "delete from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $sins = pg_query($sc, $qsins);

		  $lnewp = pg_query($lc, "select bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%' order by paragraph");
		  for ($j=0; $j < Pg_NumRows($lnewp); $j++) {
			  List ($bookandchapters, $paragraph, $transliteration, $stransliteration, $autor, $date, $ok) = Pg_Fetch_Row ($lnewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qsins = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok) values ('$bookandchapters', $paragraph, '$transliteration', '$stransliteration', '$autor', $date, '$ok')";
			  $sins = pg_query($sc, $qsins);
		  }
  
		  $qsins = "delete from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $sins = pg_query($sc, $qsins);

		  $lnewp = pg_query($lc, "select bookandchapter, series, number, plate, datum, autor from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'");
		  for ($j=0; $j < Pg_NumRows($lnewp); $j++) {
			  List ($bookandchapter, $series, $number, $plate, $date, $autors) = Pg_Fetch_Row ($lnewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qsins = "insert into obtextlit(bookandchapter, series, number, plate, datum, autor) values ('$bookandchapter', '$series', ' $number', '$plate', $date, '$autors')";
			  $sins = pg_query($sc, $qsins);
		  }
	  }	  

	  // na local zrusit N	
	  $qlins = "update obtextp set rec_state = 'O', id = $new_id where bookandchapterp = '$bchori'";
	  $lins = pg_query($lc, $qlins);
  }


  // zmenene zaznamy z localu na server
  $lupdt = pg_query($lc, "select book, descriptionp, chapter, bookandchapterp, autor, datum, type, origin, ruler, year, month, notedate, museum, museum_id, id, rec_state from obtextp where rec_state = 'U'");
    
  echo "Pøenáším " . Pg_NumRows($lupdt) . " zmìnìných záznamù z lokálního stroje na server.<br>";
  for ($i=0; $i < Pg_NumRows($lupdt); $i++) {
	  List ($book, $descriptionp, $chapter, $bookandchapter, $autor, $datum, $type, $origin, $ruler, $year, $month, $notedate, $museum, $museum_id, $id,  $rec_state) = Pg_Fetch_Row ($lupdt, $i);

	  $bchori = $bookandchapter;
	  $bookandchapter = trim($bookandchapter);
	  if ($year == "") $year = 'NULL';
	  if ($month == "") $month = 'NULL';
	  if ($datum == "") $datum = 'NULL';
	  else $datum = "'$datum'";
	  
	  // nebudeme zkoumat kolizi UxU, UxD, klient je prednejsi, vysledek bude vzdy jako na klientovi, zaznam smazany na serveru a zmeneny na klientovi tedy smazan nebude
	  $qsupd = "update obtextp set book='$book', chapter='$chapter', bookandchapterp='$bookandchapter', autor='$autor', datum=$datum, type='$type', origin='$origin', ruler='$ruler', year=$year, month=$month, notedate='$notedate', museum='$museum', museum_id='$museum_id', rec_state='O' where id=$id";
	  $supd = pg_query($sc, $qsupd);

      // + podrizene
	  if ($bookandchapter != "") {

		  $qsins = "delete from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $sins = pg_query($sc, $qsins);

		  $lnewp = pg_query($lc, "select bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%' order by paragraph");
		  for ($j=0; $j < Pg_NumRows($lnewp); $j++) {
			  List ($bookandchapters, $paragraph, $transliteration, $stransliteration, $autor, $date, $ok) = Pg_Fetch_Row ($lnewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qsins = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok) values ('$bookandchapters', $paragraph, '$transliteration', '$stransliteration', '$autor', $date, '$ok')";
			  $sins = pg_query($sc, $qsins);
		  }

		  $qsins = "delete from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $sins = pg_query($sc, $qsins);

		  $lnewp = pg_query($lc, "select bookandchapter, series, number, plate, datum, autor from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'");
		  for ($j=0; $i < Pg_NumRows($lnewp); $i++) {
			  List ($bookandchapters, $series, $number, $plate, $date, $autor) = Pg_Fetch_Row ($lnewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qsins = "insert into obtextlit(bookandchapter, series, number, plate, datum, autor) values ('$bookandchapters', '$series', ' $number', '$plate', $date, '$autor')";
			  $sins = pg_query($sc, $qsins);
		  }
	  }	  

	  $qlupd = "update obtextp set rec_state = 'O' where id = $id";
	  $lupd = pg_query($lc, $qlupd);
  }

  // nove zaznamy ze serveru na local
  $snew = pg_query($sc, "select book, descriptionp, chapter, bookandchapterp, autor, datum, type, origin, ruler, year, month, notedate, museum, museum_id, id, rec_state from obtextp where rec_state = 'N'");
  $lid = pg_fetch_row(pg_query($lc, "select max(id) from obtextp"), 0);
  $sid = pg_fetch_row(pg_query($sc, "select max(id) from obtextp"), 0);
  $lid = $lid[0];
  $sid = $sid[0];
  $new_id = max($lid, $sid);
    
  echo "Pøenáším " . Pg_NumRows($snew) . " nových záznamù ze serveru.<br>";
  for ($i=0; $i < Pg_NumRows($snew); $i++) {

	  $new_id += 1;
	  List ($book, $descriptionp, $chapter, $bookandchapter, $autor, $datum, $type, $origin, $ruler, $year, $month, $notedate, $museum, $museum_id, $id,  $rec_state) = Pg_Fetch_Row ($snew, $i);

	  $bchori = $bookandchapter;
	  $bookandchapter = trim($bookandchapter);
	  if ($year == "") $year = 'NULL';
	  if ($month == "") $month = 'NULL';
	  if ($datum == "") $datum = 'NULL';
	  else $datum = "'$datum'";

	  $qlins = "insert into obtextp(book, descriptionp, chapter, bookandchapterp, autor, datum, type, origin, ruler, year, month, notedate, museum, museum_id, id, rec_state) values ('$book', '$descriptionp', '$chapter', '$bookandchapter', '$autor', $datum, '$type', '$origin', '$ruler', $year, $month, '$notedate', '$museum', '$museum_id', $new_id,  'O')";
	  $lins = pg_query($lc, $qlins);

      // + podrizene
	  if ($bookandchapter != "") {
		  $qlins = "delete from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $lins = pg_query($lc, $qlins);

		  $snewp = pg_query($sc, "select bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%' order by paragraph");
		  for ($j=0; $j < Pg_NumRows($snewp); $j++) {
			  List ($bookandchapters, $paragraph, $transliteration, $stransliteration, $autors, $date, $ok) = Pg_Fetch_Row ($snewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qlins = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok) values ('$bookandchapters', $paragraph, '$transliteration', '$stransliteration', '$autors', $date, '$ok')";
			  $lins = pg_query($lc, $qlins);
		  }

		  $qlins = "delete from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $lins = pg_query($lc, $qlins);

		  $snewp = pg_query($sc, "select bookandchapter, series, number, plate, datum, autor from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'");
		  for ($j=0; $j < Pg_NumRows($snewp); $j++) {
			  List ($bookandchapters, $series, $number, $plate, $date, $autors) = Pg_Fetch_Row ($snewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qlins = "insert into obtextlit(bookandchapter, series, number, plate, datum, autor) values ('$bookandchapters', '$series', ' $number', '$plate', $date, '$autors')";
			  $lins = pg_query($lc, $qlins);
		  }
	  }	  
	  $qsins = "update obtextp set rec_state = 'O', id = $new_id where bookandchapterp = '$bchori'";
	  $sins = pg_query($sc, $qsins);
  }
  
  
  // zmenene zaznamy ze serveru na local
  $supdt = pg_query($sc, "select book, descriptionp, chapter, bookandchapterp, autor, datum, type, origin, ruler, year, month, notedate, museum, museum_id, id, rec_state from obtextp where rec_state = 'U'");
  echo "Pøenáším " . Pg_NumRows($supdt) . " zmìnìných záznamù ze serveru.<br>";
  for ($i=0; $i < Pg_NumRows($supdt); $i++) {
	  List ($book, $descriptionp, $chapter, $bookandchapter, $autor, $datum, $type, $origin, $ruler, $year, $month, $notedate, $museum, $museum_id, $id,  $rec_state) = Pg_Fetch_Row ($supdt, $i);
	  $bchori = $bookandchapter;
	  $bookandchapter = trim($bookandchapter);
	  if ($year == "") $year = 'NULL';
	  if ($month == "") $month = 'NULL';
	  if ($datum == "") $datum = 'NULL';
	  else $datum = "'$datum'";
	  
	  // nemuze dojit ke kolizi
	  $qlupd = "update obtextp set book='$book', chapter='$chapter', bookandchapterp='$bookandchapter', autor='$autor', datum=$datum, type='$type', origin='$origin', ruler='$ruler', year=$year, month=$month, notedate='$notedate', museum='$museum', museum_id='$museum_id', rec_state='O' where id=$id";
	  $lupd = pg_query($lc, $qlupd);

      // + podrizene
	  if ($bookandchapter != "") {

		  $qlins = "delete from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $lins = pg_query($lc, $qlins);

		  $snewp = pg_query($sc, "select bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%' order by paragraph");
		  for ($j=0; $j < Pg_NumRows($snewp); $j++) {
			  List ($bookandchapters, $paragraph, $transliteration, $stransliteration, $autors, $date, $ok) = Pg_Fetch_Row ($snewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qlins = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date, ok) values ('$bookandchapters', $paragraph, '$transliteration', '$stransliteration', '$autors', $date, '$ok')";
			  $lins = pg_query($lc, $qlins);
		  }

		  $qlins = "delete from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'";
		  $lins = pg_query($lc, $qlins);

		  $snewp = pg_query($sc, "select bookandchapter, series, number, plate, datum, autor from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'");
		  for ($j=0; $j < Pg_NumRows($snewp); $j++) {
			  List ($bookandchapters, $series, $number, $plate, $date, $autors) = Pg_Fetch_Row ($snewp, $j);
			  if ($date == "") $date = 'NULL';
			  else $date = "'$date'";
			  $qlins = "insert into obtextlit(bookandchapter, series, number, plate, datum, autor) values ('$bookandchapters', '$series', ' $number', '$plate', $date, '$autors')";
			  $lins = pg_query($lc, $qlins);
		  }
	  }	  

	  $qsupd = "update obtextp set rec_state = 'O' where id = $id";
	  $supd = pg_query($sc, $qsupd);
  }

  // vymazane zaznamy z localu vymazat na serveru (oznacit D)
  $ldel = pg_query($lc, "select bookandchapterp, id from obtextp where rec_state = 'D'");
    
  echo "Oznaèuji " . Pg_NumRows($lupdt) . " záznamù jako smazaných na serveru.<br>";
  for ($i=0; $i < Pg_NumRows($ldel); $i++) {
	  List ($bookandchapter, $id) = Pg_Fetch_Row ($ldel, $i);

	  $qsdel = "update obtextp set rec_state = 'D' where id=$id";
	  $sdel = pg_query($sc, $qsdel);

      // + podrizene --> nechat beze zmeny - to nevadi

	  // na klientovi beze zmeny
  }

  // vymazane zaznamy ze serveru vymazat na local (oznacit D)
  $sdel = pg_query($sc, "select bookandchapterp, id from obtextp where rec_state = 'D'");
    
  echo "Oznaèuji " . Pg_NumRows($sdel) . " záznamù jako smazaných na lokálním stroji.<br>";
  for ($i=0; $i < Pg_NumRows($sdel); $i++) {
	  List ($bookandchapter, $id) = Pg_Fetch_Row ($sdel, $i);

	  $qldel = "update obtextp set rec_state = 'D' where id=$id";
	  $ldel = pg_query($lc, $qldel);

      // + podrizene

	  // na serveru beze zmeny
  }


echo "All replications was made. Database is consolidated now.";
$do = "not";

} 

if ($do == "") {
?>
	Enter name of server with master database and run replications
	<form method="post" action="replication2.php">
	  <input type="hidden" name="do" value="rep">
	  <input type="text" name="server" value="www.klinopis.cz">
	  <input type="submit" value="replicate">
	</form>	

<?
}

?>
</body>
</html>