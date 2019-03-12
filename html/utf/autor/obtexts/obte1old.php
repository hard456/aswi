<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>edit text</title>
</head>
<body>
<form id=form1 METHOD="post" name=form1 ACTION="/utf/autor/obtexts/obte2.php">
<?
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $dotaz = "select book, chapter, bookandchapterp, descriptionp, type, museum, museum_id from obtextp where trim(bookandchapterp) = '$bookandchapter'"; 
  //echo $dotaz;
  $result_book = Pg_exec($dotaz);
  $recs = Pg_NumRows ($result_book);
  if ($recs != 1) {
	echo "I'm unable to find requested record.<br>";
  }
  else {
	List ($book, $chapter, $bookandchapter, $description, $type, $museum, $museum_id) = Pg_Fetch_Row ($result_book, 0);
	$bookandchapter = trim($bookandchapter);
	$dotaz = "select transliteration from obtexts where trim(bookandchapter) LIKE '%$bookandchapter%'";
	//echo "<br>$dotaz";
	$result_text = Pg_exec($dotaz);
	$textik = "";
        for ($i = 0; $i < Pg_Num_Rows($result_text); $i++) {
	  List($add_text) = Pg_Fetch_Row($result_text, $i);
	  //echo "add_text : " . $add_text . "<br>";
	  $textik .= "$add_text \n";  
	}
	//echo $textik;

	$dotaz = "select series, number, plate from obtextlit where trim(bookandchapter) LIKE '%$bookandchapter%'";
	$result_lit = Pg_exec($dotaz);
    for ($i = 0; $i < Pg_Num_Rows($result_lit); $i++) {
	  List($series[$i], $number[$i], $plate[$i]) = Pg_Fetch_Row($result_lit, $i);
	}

  }
  
  $date = Date ("Y-m-d");
  echo "<TR><TD><H4 align=center>You can edit text.</H4></TD></TR>";
  echo "<table width=100%>";
  echo "<tr valign=top>";
  echo "<td width=60%>";

    echo "<table>\n";
    echo "<TR><TD><small>book</small></TD><TD><input type=text name=book value='$book'></TD><TD></TD></TR>\n";
    echo "<TR><TD colspan=3><small>&nbsp;&nbsp;&nbsp;only in a form like e.g. Sumer_23</small></TD><TD></TD></TR>\n";
    echo "<TR><TD><small>chapter</small></TD><TD><input type=text name=chapter value='$chapter'></TD></TR>\n";
    echo "<TR><TD colspan=3><small>&nbsp;&nbsp;&nbsp;only in a form like 1</small></TD><td></td></TR>\n";
    echo "<TR><TD><small>description</small></TD><TD colspan=2><input type=text name=description value='$description'></TD><TD></TD></TR>\n";
    echo "<TR><TD colspan=4><small>&nbsp;&nbsp;&nbsp;full source quotation like Ch. A. A'adami, Old Babylonian Letters, Sumer 23, 1967, 151ff.</small></TD></TR>\n";
    echo "<tr><td><small>type</small></TD><TD><select name=type><option>$type</option><option>document</option><option>incantation</option><option>legal text</option><option>letter</option><option>mathematics</option><option>myth</option><option>narrative text</option><option>omina</option><option>royal inscription</option><option>other</option></select></TD><TD></TD></tr>\n";
    echo "<TR><TD><small>museum</small></TD><TD colspan=2><input type=text name=museum value='$museum'></TD><TD></TD></TR>\n";
    echo "<TR><TD><small>exhibit number</small></TD><TD colspan=2><input type=text name=museum_id value='$museum_id'></TD><TD></TD></TR>\n";
    echo "<TR><TD valign=top><small>series - number - plate/page</small></TD><TD colspan=2>";
	echo "<input size=\"5\" type=text name=\"series[0]\" value=\"$series[0]\">-<input type=text name=\"number[0]\" size=\"5\" value=\"$number[0]\">-<input type=text name=\"plate[0]\" value=\"$plate[0]\" size=\"5\"><br>";
	echo "<input type=text name=\"series[1]\" size=\"5\" value=\"$series[1]\">-<input type=text name=\"number[1]\" value=\"$number[1]\" size=\"5\">-<input type=text name=\"plate[1]\" value=\"$plate[1]\" size=\"5\"><br>";
	echo "<input type=text name=\"series[2]\" value=\"$series[2]\" size=\"5\">-<input type=text name=\"number[2]\" value=\"$number[2]\" size=\"5\">-<input type=text name=\"plate[2]\" value=\"$plate[2]\" size=\"5\"><br>";
	echo "<input type=text name=\"series[3]\" value=\"$series[3]\" size=\"5\">-<input type=text name=\"number[3]\" value=\"$number[3]\" size=\"5\">-<input type=text value=\"$plate[3]\" name=\"plate[3]\" size=\"5\"><br>";
	echo "<input type=text name=\"series[4]\" value=\"$series[4]\" size=\"5\">-<input type=text name=\"number[4]\" value=\"$number[4]\" size=\"5\">-<input type=text name=\"plate[4]\" value=\"$plate[4]\" size=\"5\"></TD><TD></TD></TR>";
    echo "<tr><td class=vstup><small>text (without line numbers, each line must be separate by an enter)</small></TD><TD><textarea name=text id=q rows=4 cols=50 class=vstup>". $textik . "</textarea></TD><TD></TD></tr>\n";
        echo "</table>\n";
    echo "<input type='hidden' name='bookandchapter' value='$bookandchapter'>";	
    //echo "<input type='hidden' name='chapter' value='$chapter'>";	
        echo "<table>";
    echo "<tr><td></td><td><input type=\"submit\" value=\"save text to the database\"><input type=hidden name=auth value=\"$auth\"></td></tr>";

    echo "<tr><td colspan=2>";
    include "key.inc.php";
	echo "</td></tr>";

    echo "</table>";

  echo "</td>";

  echo "<td width=60%>";

  echo "<table border=1>";
  echo "<th><tr><td colspan=2><b>List of books and chapters already inserted:</b></td></tr</th>";
    @$result_books = Pg_exec("select distinct book from obtextp");
    $book_count = Pg_NumRows ($result_books);
    for ($i = 0; $i < $book_count; $i++) {
		echo "<tr>";
	    $book = Pg_Fetch_Row($result_books, $i);
        echo "<td>";
	    $book = $book[0];
		echo $book;
        echo "</td>";
	    @$result_chapter = Pg_exec("select distinct chapter from obtextp where book='$book'");
	    $chapter_count = Pg_NumRows ($result_chapter);
        echo "<td>";
	    for ($j = 0; $j < $chapter_count; $j++) {
		    $chapter = Pg_Fetch_Row($result_chapter, $j);
		    $chapter = $chapter[0];
			echo "$chapter ";
		}
        echo "</td>";
	    echo "</tr>";
	}
  echo "</table>";

  echo "</td>";

  echo "</tr>";
  echo "</table>";

?>
</form>
</body>
</html>
