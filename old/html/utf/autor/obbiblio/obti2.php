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

  $texts = Explode("\n", $text);

  @$result_book = Pg_exec("select book, chapter, descriptionp from obtextp where book='$book' AND chapter='$chapter'");
  if (Pg_NumRows ($result_book) > 0) {
	echo "Sorry the chapter <b>$chapter</b> of the book <b>$book</b> already exists, please go back and check it, if it is OK";
	break;
  }
  else {
    $dotaz = "insert into obtextp(book, descriptionp, chapter, bookandchapterp, autor, datum, type) values ('$book', '$description', '$chapter', '($bookandchapter,', '$auth', '$date', '$type')";
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
			$dotaz = "insert into obtexts(bookandchapter, paragraph, transliteration, stransliteration, autor, date) values ('($bookandchapter,', '$par', ' $text', ' $stext', '$auth', '$date')";
			//echo $dotaz."<br>";
		    @$result_ins = Pg_exec($dotaz);
		    if (!$result_ins) {
		      echo "Sorry, text number <b>$i</b> was not correctly inserted to database<br>";	
		      //break;
		   }
		}
     echo "Text successfully inserted!<br>";   
  	}
  }
} while (false);
include "key.inc.php";
?>
</body>
</html>