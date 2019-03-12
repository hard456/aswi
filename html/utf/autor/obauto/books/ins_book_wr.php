<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<link rel="StyleSheet" href="http://www.klinopis.cz/utf/obtc1.css" type="text/css" media="screen, print">-->
<LINK REL=StyleSheet HREF="css/main.css" TYPE="text/css" MEDIA="screen, print">
<title>--- Insert new book ---</title>
</head>
<body>
<?
  require "pripoj_zcu.php";

// hledám duplicitu v knihách
/*  $vysl = Pg_Exec ( "SELECT * FROM book WHERE title = '$title'");
  if (@Pg_NumRows ($vysl) != 0)
  {
   echo ' ZAZNAM JE JIZ V DATABAZI';
  }
  else
  {
*/
// zapisuji knihu
   $registred = DATE("Y-m-d");

   $vysl = Pg_Exec ( "SELECT max(idbook) FROM book");
   $zaznam = Pg_Fetch_Row ($vysl);
   $idbook= $zaznam[0] + 1;

   $isbn = $isbn_1.'-'.$isbn_2.'-'.$isbn_3.'-'.$isbn_4;
   if (Empty($increasenumber1)) $increasenumber1 = 0;
   if (Empty($increasenumber2)) $increasenumber2 = 0;
   

   $query = "INSERT INTO book VALUES ($idbook, NULL, NULL, '$type', '$title', '$subtitle', '$volume', '$volume_shortcut', '$number', '$year', '$place', '$publisher', '$isbn', '$description', 'SUBJECT', 'FPAGE', 'TPAGE', 'AUTH', '$issn', '$volumesubnumber', '$pageframe', $increasenumber1, $increasenumber2, '$note', '$signature')";//, '$registred')";

   //echo $query;
   $vysl = Pg_Exec ($query);
   if ($vysl)
   {
    echo '</b><br><br>KNIHA ZAPSANA.<br><br>';
   }
	  
// zapisuji autory

   if ($author!= -1)
   {
    $query = "INSERT INTO book_author VALUES ($idbook, $author, 0)";
    //echo $query;
    $vysl = Pg_Exec ($query);
    if ($vysl)
    {
     echo '</b><br><br>AUTOR 1 ZAPSAN.<br><br>';
    }
   }
   if ($author_2!= -1)
   {
   
    $vysl = Pg_Exec ("INSERT INTO book_author VALUES ($idbook, $author_2, 0)");
    if ($vysl)
    {
     echo '</b><br><br>AUTOR 2 ZAPSAN.<br><br>';
    }
   }
   if ($author_3!= -1)
   {
    $vysl = Pg_Exec ("INSERT INTO book_author VALUES ($idbook, $author_3, 0)");
    if ($vysl)
    {
     echo '</b><br><br>AUTOR 3 ZAPSAN.<br><br>';
    }
   }
   if ($author_4!= -1)
   {
    $vysl = Pg_Exec ("INSERT INTO book_author VALUES ($idbook, $author_4, 0)");
    if ($vysl)
    {
     echo '</b><br><br>AUTOR 4 ZAPSAN.<br><br>';
    }
   }

// zapisuji autory
   if ($subject_1!= -1)
   {
    $vysl = Pg_Exec ("INSERT INTO book_subject VALUES ($idbook, '$subject_1')");
    if ($vysl)
    {
     echo '</b><br><br>SUBJECT 1 ZAPSAN.<br><br>';
    }
   }
   if ($subject_2!= -1)
   {
    $vysl = Pg_Exec ("INSERT INTO book_subject VALUES ($idbook, '$subject_2')");
    if ($vysl)
    {
     echo '</b><br><br>SUBJECT 2 ZAPSAN.<br><br>';
    }
   }
   if ($subject_3!= -1)
   {
    $vysl = Pg_Exec ("INSERT INTO book_subject VALUES ($idbook, '$subject_3')");
    if ($vysl)
    {
     echo '</b><br><br>SUBJECT 3 ZAPSAN.<br><br>';
    }
   }
   if ($subject_4!= -1)
   {
    $vysl = Pg_Exec ("INSERT INTO book_subject VALUES ($idbook, '$subject_4')");
    if ($vysl)
    {
     echo '</b><br><br>SUBJECT 4 ZAPSAN.<br><br>';
    }
   }


 // }
?>
</body>
</html>
