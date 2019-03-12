<?php   
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");

include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();

?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>-----------insert------------------</title>
</HEAD>
<body>
<H4 align=center><small>Add bibliography item:</small></H4>

<?php
do
{
   //pripojeni k DB

  require_once("sql.php");
  
  //nastaveni promennych
  $date = Date ("Y-m-d");
  $type=trim($_POST['type']);
  $subject=trim($_POST['subject']);
  $title=trim($_POST['title']);
  $subtitle=trim($_POST['subtitle']);
  $volume=trim($_POST['volume']);
  $number=trim($_POST['number']);
  $volumesubnumber=trim($_POST['volumesubnumber']);
  $place=trim($_POST['place']);
  $year=trim($_POST['year']);
  $publisher=trim($_POST['publisher']);
  $isbn=trim($_POST['isbn']);
  $issn=trim($_POST['issn']);
  $pageframe=trim($_POST['pageframe']);
  $signature=trim($_POST['signature']);
  $increasenumber1=trim($_POST['increasenumber1']);
  $increasenumber2=trim($_POST['increasenumber2']);
  $note=trim($_POST['note']);
  $author=$_POST['author'];
 
  // nacteme autory a ulozime je do pole
  for ($i=0,$j=0;$i<5;$i++)
  {
	 $jmeno=trim($author[$i][0]);
  	 $prijmeni=trim($author[$i][1]);
	
	 if (($jmeno!='')&&($prijmeni!='')) 
	 {
        $array_authors[$j][0]=$jmeno;
        $array_authors[$j][1]=$prijmeni;
	    $j++;
	 }
  }

  
  // kontrola vstupnich parametru
  if ($subject == "" || $title == "" || $type == "" || count($array_authors) < 1) {
    echo ".....mandatory items not filled.....";
    break;
  }

  // kontrola, zda uz je titul v DB
  $dotaz = "select Title from book WHERE Title = '$title'";
  @$result_auto = Pg_query($dotaz);
  if (Pg_Num_Rows ($result_auto) > 0)
  {
            List($c_title) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
            echo "Sorry, conflict -> $c_title";
    		break;
  }


//  $frompage = (int) $frompage;
//  $topage = (int) $topage;
//  $rotate = (int) $rotate;

//  $dotaz = "insert into autophoto (directory, frompage, topage, rotate) values ('$directory', '$frompage', '$topage', $rotate)";
//  $result_auto = Pg_Exec($dotaz);
//  if (!$result_auto) {
//            echo "Sorry, this record cannot be added.";
//    		break;
//  }
//  $oid = Pg_GetLastOID($result_auto);
//  $dotaz = "select IDAutophoto from autophoto where oid = $oid";
//  $result_auto = Pg_Exec($dotaz);
//  if (!$result_auto) {
//            echo "Sorry, this record cannot be added.";
//    		break;
//  }
//  List($id_autophoto) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
//    
  $id_autophoto="NULL";

// ulozeni udaju do DB
   $dotaz = "insert into book (autophoto, type, subject, title, subtitle, volume, number, volumesubnumber, place, year, publisher, isbn, issn, pageframe, signature, increasenumber1, increasenumber2, note, auth) 
             values ($id_autophoto, '$type', '$subject', '$title', '$subtitle', '$volume', '$number', '$volumesubnumber', '$place', '$year', '$publisher','$isbn','$issn','$pageframe', '$signature', $increasenumber1, $increasenumber2, '$note', 'ph01')";

  $result_auto = pg_query($dotaz);
  if (!$result_auto)
  {
     echo "Sorry, cannot be added";
     break;
  }

//  zjistim id posledniho vlozeneho zaznamu
    $oid = pg_last_oid ($result_auto);
	$dotaz = "select IDBook from book where oid = $oid";
	$result_auto = pg_query($dotaz);
	if (!$result_auto)
	{
	   echo "Sorry, this record cannot be added.";
	   break;
	}
  List($id_book) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);

  
// ulozeni autoru do DB
  
  for ($i = 0; $i < count($array_authors); $i++)
  {

	// kontrola, zda je autor v DB, pokud ano, nacteme jeho ID
    $dotaz = "select idauthor from author where surname = '".$array_authors[$i][1]."' and name = '".$array_authors[$i][0]."'";
    $result_auto = pg_query($dotaz);
    
	if (!$result_auto) 
	{
       echo "Sorry, this record cannot be added.";
   	   break 2;
    }

	//pokud je autor v DB, zjistime ID, pokud neni, pridame ho do DB
    if (pg_num_rows($result_auto) > 0)  List($id_author) = pg_fetch_row ($result_auto, 0, PGSQL_NUM);
    else 
	{
       $dotaz = "insert into author (TitleBefore, Name, Surname, TitleAfter) values (NULL, '".$array_authors[$i][0]."', '".$array_authors[$i][1]."', NULL)";    
       $result_auto = pg_query($dotaz);
       if (!$result_auto) 
	   {
          echo "Sorry, this record cannot be added.";
          break 2;
       }
      
	   $oid = Pg_GetLastOID($result_auto);
       $dotaz = "select IDAuthor from author where oid = $oid";
       $result_auto = pg_query($dotaz);
       if (!$result_auto)
	   {
          echo "Sorry, this record cannot be added.";
          break 2;
       }

       List($id_author) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    }

	// ulozime vazbu autor - kniha do DB
    $dotaz = "insert into book_author (idbook, idauthor) values ($id_book, $id_author)";
    $result_auto = pg_query($dotaz);
    if (!$result_auto) 
	{
       echo "Sorry, this record cannot be added.";
  	   break 2;
	}
    
	if ($authors != "") $authors .= ", ";
    $authors .= $author[$i][0] . " " . $author[$i][1] . " " . $author[$i][2] . " " . $author[$i][3] ;
  }
  
//   echo "$type $authors: $title was added. <BR>Use back arrow on the IE to come back and enter new item.<br>";

   echo "$title was added. <BR>Use back arrow on the IE to come back and enter new item.<br>";
?>
	<form action="ins_book.php" method="post">
		<input type="submit" value="new item">
	</form>

<?php
//   echo "Move its files to directory $directory.<br>";
//   echo "<a href=\"convert_all.php?autophoto=$id_autophoto\">Use this link to convert all files to png and rotate.</a>";
  Pg_Close ($connection);
  

} while (false);
?>
</body>
</html>
