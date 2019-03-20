<?
//include "autorizace.inc.php";
//ksa_authorize();
//if ($auth_level == 0) ksa_unauthorized();

require "pripoj_zcu.php";
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--  <LINK REL=StyleSheet HREF="http://www.klinopis.cz/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">-->
  <LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA="screen, print">
  <title>----------- list ------------------</title>
</HEAD>
<body>
<h2>Reference library - Near Eastern Studies in Pilsen</h2>

<?
do
{
if ($subject == -1 AND $author == -1)
{
// skládám podmínku;
  $prvni = 1;
  $query = "SELECT idbook, title, volume_shortcut, number, place, year, signature FROM book WHERE ";

  if ($type!= -1)
   {
    $query = $query."type='$type'";
    $prvni = 0;
   }
  if ($subject!= -1)
   {
    if ($prvni== 0)
	 {
	  $query = $query." AND subject='$subject'";
      $prvni = 0;
	 }
	else
	 {
	  $query = $query."subject='$subject'";
	 }
   }
  if ($title!= '')
   {
    if ($prvni== 0)
	 {
	  $query = $query." AND title LIKE '%$title%'";
      $prvni = 0;
	 }
	else
	 {
	  $query = $query."title LIKE '%$title%'";
	 }
   }
  if ($volume!= '')
   {
    if ($prvni== 0)
	 {
	  $query = $query." AND volume LIKE '%$volume%'";
      $prvni = 0;
	 }
	else
	 {
	  $query = $query."volume LIKE '%$volume%'";
	 }
   }
  if ($isbn_1!= '')
   {
    $isbn = $isbn_1.'-'.$isbn_2.'-'.$isbn_3.'-'.$isbn_4;
    if ($prvni== 0)
	 {
	  $query = $query." AND isbn = '$isbn'";
      $prvni = 0;
	 }
	else
	 {
	  $query = $query."isbn = '$isbn'";
	 }
   }

// --------

  if ($signature!= '')
   {
    if ($prvni== 0)
	 {
	  $query = $query." AND signature LIKE '%$signature%'";
      $prvni = 0;
	 }
	else
	 {
	  $query = $query."signature LIKE '%$signature%'";
	 }
   }
  if ($type=-1 AND $title='' AND $volume='' AND $isbn_1='' AND $increasenumber1='' AND $increasenumber2='' AND $signature='')
  {
   $query = "SELECT idbook, title, subtitle, volume_shortcut, number, place, year FROM book ORDER BY title";
  }
  else
  {
   $query = $query." ORDER BY title";
  }
   
//  echo $query.'<br><br><hr>';

// vybírám publikace;
  @$result_books = Pg_Exec($query);
  //echo $query;
  $books = Pg_NumRows ($result_books);
  if ($books != 0)
  {
   //echo "<table cellpadding='1' cellspacing='0' align='center' bgcolor='#ffffff'>\n";
   for ($i = 0; $i < $books; $i++)
   {
    List($idbook, $title, $subtitle, $volume_shortcut, $number, $place, $year, $signature) = Pg_Fetch_Row ($result_books, $i, PGSQL_NUM);
	
// naèítám autory;
    $query2 = "select TitleBefore, Name, Surname, TitleAfter from book_author left join author on (author.IDAuthor = book_author.IDAuthor) where IDBook = $idbook order by Surname";
    @$result_authors = Pg_Exec($query2);
    $authors = Pg_NumRows ($result_authors);
    
    if ($authors != 0)
	{
  	 echo " ";
     for ($j = 0; $j < $authors; $j++)
     {
      List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $j, PGSQL_NUM);
	  echo $titlebefor.' '.$name.' '.$surname.' '.$titleafter;
	  if ($authors > 1 AND $j < $authors-1) echo' - ';
	  echo " ";
	 }
     
	}

	echo "<b><a href=\"detail.php?book=$idbook\">$title</a></b>$subtitle\n";
	echo ", ".$volume_shortcut."\n";
  echo " ".$number.", ".$place." $year \n";

  echo "<hr />";
   }
  // echo "</table>";
  }
  else
  {
   echo "DANEMU KRITERIU NEVYHOVUJE ZADNA PUBLIKACE";
  }
}

if ($author != -1)
{
//----------------------------------------------------------------------------------------
// hledani podle autora
// nactu, jake ma autor publikace
  $query3 = "SELECT idbook FROM book_author WHERE idauthor = $author";
  @$vysl3 = Pg_Exec($query3);
  $vysl_row3 = Pg_NumRows ($vysl3);
  if ($vysl_row3 != 0)
  {
   echo "<table cellpadding='1' cellspacing='0' align='center' bgcolor='#ffffff'>";
   for ($i = 0; $i < $vysl_row3; $i++)
   {
    List($idbook) = Pg_Fetch_Row ($vysl3, $i, PGSQL_NUM);
	$idbook_tmp=$idbook;
	$query4 = "SELECT idbook, title, volume_shortcut, number, place, year FROM book WHERE idbook = $idbook_tmp";
    @$vysl4 = Pg_Exec($query4);
    $vysl_row4 = Pg_NumRows ($vysl4);
    if ($vysl_row4 != 0)
    {
     for ($j = 0; $j < $vysl_row4; $j++)
     {
      List($idbook, $title, $volume_shortcut, $number, $place, $year) = Pg_Fetch_Row ($vysl4, $j, PGSQL_NUM);
// naèítám autory;
      $query5 = "SELECT TitleBefore, Name, Surname, TitleAfter FROM book_author LEFT JOIN author ON (author.IDAuthor = book_author.IDAuthor) WHERE IDBook = $idbook ORDER BY Surname";
      @$result_authors = Pg_Exec($query5);
      $authors = Pg_NumRows ($result_authors);
      if ($authors != 0)
	  {
  	   echo "<tr><td><small>";
       for ($k = 0; $k < $authors; $k++)
       {
        List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $k, PGSQL_NUM);
	    echo $titlebefore.' '.$name.' '.$surname.' '.$titleafter;
	    if ($authors > 1 AND $k < $authors-1) echo' - ';
	   }
       echo "</small></td>";
	  }

	  echo "<td><small><b>".$title."</b></small></td></tr>";
	  echo "<tr><td colspan='2'><table><tr><td><small>".$volume_shortcut."</small></td><td><small>".$number."</small></td><td><small>".$place."</small></td><td><small>".$year."</small></td></tr></table><hr></td></tr>";
     }
    }
    else
    {
     echo "DANEMU KRITERIU NEVYHOVUJE ZADNA PUBLIKACE";
    }
   }
   echo "</table>";   
  }
}

if ($subject != -1)
{
//----------------------------------------------------------------------------------------
// hledani podle subjectu
// nactu, jake ma subject publikace
  $query3 = "SELECT idbook FROM book_subject WHERE subject = '$subject'";
  @$vysl3 = Pg_Exec($query3);
  $vysl_row3 = Pg_NumRows ($vysl3);
  if ($vysl_row3 != 0)
  {
   echo "<table cellpadding='1' cellspacing='0' align='center' bgcolor='#ffffff'>";
   for ($i = 0; $i < $vysl_row3; $i++)
   {
    List($idbook) = Pg_Fetch_Row ($vysl3, $i, PGSQL_NUM);
	$idbook_tmp=$idbook;
	$query4 = "SELECT idbook, title, volume_shortcut, number, place, year FROM book WHERE idbook = $idbook_tmp";
    @$vysl4 = Pg_Exec($query4);
    $vysl_row4 = Pg_NumRows ($vysl4);
    if ($vysl_row4 != 0)
    {
     for ($j = 0; $j < $vysl_row4; $j++)
     {
      List($idbook, $title, $volume_shortcut, $number, $place, $year) = Pg_Fetch_Row ($vysl4, $j, PGSQL_NUM);
// naèítám autory;
      $query5 = "SELECT TitleBefore, Name, Surname, TitleAfter FROM book_author LEFT JOIN author ON (author.IDAuthor = book_author.IDAuthor) WHERE IDBook = $idbook ORDER BY Surname";
      @$result_authors = Pg_Exec($query5);
      $authors = Pg_NumRows ($result_authors);
      if ($authors != 0)
	  {
  	   echo "<tr><td><small>";
       for ($k = 0; $k < $authors; $k++)
       {
        List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $k, PGSQL_NUM);
	    echo $titlebefore.' '.$name.' '.$surname.' '.$titleafter;
	    if ($authors > 1 AND $k < $authors-1) echo' - ';
	   }
       echo "</small></td>";
	  }

	  echo "<td><small><b>".$title."</b></small></td></tr>";
	  echo "<tr><td colspan='2'><table><tr><td><small>".$volume_shortcut."</small></td><td><small>".$number."</small></td><td><small>".$place."</small></td><td><small>".$year."</small></td></tr></table><hr></td></tr>";
     }
    }
    else
    {
     echo "DANEMU KRITERIU NEVYHOVUJE ZADNA PUBLIKACE";
    }
   }
  echo "</table>";
  }
}
} while (false);
?>

</body>
</html>
