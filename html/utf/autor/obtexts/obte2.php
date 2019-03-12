<?
include "autorizace.inc.php";
require "./fcek2u2.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title></title>
</HEAD>
<body>
<?
do {
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $date = Date ("Y-m-d");
  $book = trim($book);
  $chapter = trim($chapter);
  $description = trim($description);  
//  $bookandchapter = $book . ',';
  $bookandchapter_new = $book . ',' . $chapter;
  $type = trim($type);		
  $museum = trim($museum);		
  $museum_id = trim($museum_id);		

  $texts = Explode("\n", $text);
  
  $result_book = Pg_exec("select book, chapter, descriptionp from obtextp where bookandchapterp = '$bookandchapter'");
  if (Pg_NumRows ($result_book) != 1) {
	echo "Sorry the chapter <b>$chapter</b> of the book <b>$book</b> not found, cannot update record";
	break;
  }
  
  $dotaz = "update obtextp set book='$book', chapter='$chapter', bookandchapterp='$bookandchapter_new', descriptionp='$description', autor='$auth', datum='$date', type='$type', museum='$museum', museum_id='$museum_id', rec_state='U' where trim(bookandchapterp) = '$bookandchapter'";
  	//echo $dotaz."<br>";
    @$result_ins = Pg_exec($dotaz);
    if (!$result_ins) {
      echo "Sorry, book and chapter was not correctly updated";	
      break;
    }
    echo "Book and chapter was correctly updated<br>";	
    $dotaz = "delete from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%'";
    //echo "$dotaz<br>";
    @$result_del = Pg_exec($dotaz);
      if (!$result_del) {
        echo "Sorry, texts cannot be updated.<br>";	
        break;
      }
    $dotaz = "delete from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'";
    //echo "$dotaz<br>";
    @$result_del = Pg_exec($dotaz);
      if (!$result_del) {
        echo "Sorry, literature reference cannot be updated.<br>";	
        break;
      }
	 for ($i = 0; $i < sizeof($texts); $i++) {
		$text = trim($texts[$i]);
		if ($text != "") { 
			$stext = SSLH($text);
//nove
			$text = str_replace("<", "&lt;", $text);
			$text = str_replace(">", "&gt;", $text);
			$par = $i+1;
			$dotaz = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date) values ('$bookandchapter_new', '$par', ' $text', ' $stext', '$auth', '$date')";
			//echo $dotaz."<br>";
		    @$result_ins = Pg_exec($dotaz);
		    if (!$result_ins) {
		      echo "Sorry, text number <b>$i</b> was not correctly updated in database<br>";	
		      //break;
		    }
                    else echo "Text number <b>$i</b> was successfully inserted!<br>";   

		}
  	}

 for ($i = 0; $i < sizeof($series); $i++) {
		$series[$i] = trim($series[$i]);
		$number[$i] = trim($number[$i]);
		$plate[$i] = trim($plate[$i]);
		if ($series[$i] != "") { 
			$dotaz = "insert into obtextlit(bookandchapter, series, number, plate, autor, datum) values ('$bookandchapter_new', '$series[$i]', ' $number[$i]', ' $plate[$i]', '$auth', '$date')";
			//echo $dotaz."<br>";
		    @$result_ins = Pg_exec($dotaz);
		    if (!$result_ins) {
		      echo "Sorry, reference <b>$i</b> was not correctly inserted to database<br>";	
		      //break;
		    }
			else {
		      echo "Literature successfully inserted!<br>";   
			}
		}
  	}

 
} while (false);
include "key.inc.php";
?>
</body>
</html>
