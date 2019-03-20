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
  $descriptionp = trim($descriptionp);  
//  $bookandchapter = $book . ',';
  $bookandchapter = $book . ',' . $chapter;
  $type = trim($type);		
  $museum = trim($museum);		
  $museum_id = trim($museum_id);		

  $texts = Explode("\n", $text);
  
  @$result_book = Pg_exec("select book, chapter, descriptionp from obtextp where book='$book' AND chapter='$chapter'");
  if (Pg_NumRows ($result_book) > 0) {
	echo "Sorry the chapter <b>$chapter</b> of the book <b>$book</b> already exists, please go back and check it, if it is OK";
	break;
  }
  
  @$result_book = Pg_exec("select museum_id, bookandchapterp from obtextp where museum_id LIKE '%$museum_id%'");
  if (Pg_NumRows ($result_book) > 0 && $museum_id != "" && $znova != "1") {
	echo "Museum number already exists. Check these records and only if you are sure in adding new record press button.<br>";
	for ($i = 0; $i < Pg_Num_Rows($result_book); $i++) {
	  List ($museum_ids, $bookandchapter) = Pg_Fetch_Row ($result_book, $i);
	  echo "$museum_ids : <a target=\"_blank\" href=\"/utf/utf/catalogue.php?bookandchapter=$bookandchapter\">$bookandchapter</a><br>";
	}
	echo "<form id=form1 METHOD=\"post\" name=form1 ACTION=\"/utf/autor/obtexts/obti2.php\">";
	echo "If you are sure, click to add the text to the database.";
        echo "<input type=\"submit\" value=\"add new text to the database\">";
        echo "<input type=hidden name=book value=\"$book\">";
        echo "<input type=hidden name=chapter value=\"$chapter\">";
        echo "<input type=hidden name=description value=\"$description\">";
        echo "<input type=hidden name=type value=\"$type\">";
        echo "<input type=hidden name=museum value=\"$museum\">";
        echo "<input type=hidden name=museum_id value=\"$museum_id\">";
        echo "<input type=hidden name=text value=\"$text\">";
        echo "<input type=hidden name=auth value=\"$auth\">";
        echo "<input type=hidden name=znova value=\"1\">";
	echo "</form>";
	break;
  }
  
  else {
    $dotaz = "insert into obtextp(book, descriptionp, chapter, bookandchapterp, autor, datum, type, museum, museum_id) values ('$book', '$description', '$chapter', '$bookandchapter', '$auth', '$date', '$type', '$museum', '$museum_id')";
	//echo $dotaz."<br>";
    @$result_ins = Pg_exec($dotaz);
    if (!$result_ins) {
      echo "Sorry, book and chapter was not correctly inserted to database";	
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
			$dotaz = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date) values ('$bookandchapter', '$par', ' $text', ' $stext', '$auth', '$date')";
			//echo $dotaz."<br>";
		    @$result_ins = Pg_exec($dotaz);
		    if (!$result_ins) {
		      echo "Sorry, text number <b>$i</b> was not correctly inserted to database<br>";	
		      //break;
		   }
		}
     echo "Text successfully inserted!<br>";   
  	}
	 for ($i = 0; $i < sizeof($series); $i++) {
		$series[$i] = trim($series[$i]);
		$number[$i] = trim($number[$i]);
		$plate[$i] = trim($plate[$i]);
		if ($series[$i] != "") { 
			$dotaz = "insert into obtextlit(bookandchapter, series, number, plate, autor, datum) values ('$bookandchapter', '$series[$i]', ' $number[$i]', ' $plate[$i]', '$auth', '$date')";
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

  }
} while (false);
include "key.inc.php";
?>
</body>
</html>
