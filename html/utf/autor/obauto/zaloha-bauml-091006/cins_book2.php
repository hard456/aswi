<?   
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
<?
do
{
  echo "<H4 align=center><small>Add bibliography item:</small></H4>";

  require_once("sql.php");

  $date = Date ("Y-m-d");
//  if ($directory == "" || $subject == "" || $title == "" || $type == "" || $author[0][2] == "") {
    if ($subject == "" || $frompage == "" || $type == "" || $author[0][2] == "") {
    echo ".....nebyly vyplneny povinne udaje, napr. stranka, ze ktere prepisujete.....";
    break;
  }
  $dotaz = "select Title from book WHERE Title = '$title'";
  //echo $dotaz; ZAREMOVANO aby mohlo byt vice stejnych titulu
//  @$result_auto = Pg_Exec($dotaz);
//  if (Pg_NumRows ($result_auto) > 0){
//            List($c_title) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
//            echo "Sorry, conflict -> $c_title";
//    		break;
  }
  $frompage = (int) $frompage;
  $topage = (int) $topage;
  $topage = 0;
  $rotate = (int) $rotate;
  $dotaz = "insert into autophoto (directory, frompage, topage, rotate) values ('$directory', '$frompage', '$topage', $rotate)";
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, this record cannot be added.";
    		break;
  }
  $oid = Pg_GetLastOID($result_auto);
  $dotaz = "select IDAutophoto from autophoto where oid = $oid";
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, this record cannot be added.";
    		break;
  }
  List($id_autophoto) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    
  $dotaz = "insert into book (autophoto, title, type, subtitle, volume, number, year, place, publisher, subject) values ($id_autophoto, '$title', '$type', '$subtitle', '$volume', '$number', '$year', '$place', '$publisher', '$subject')";
  //echo $dotaz;
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, cannot be added";
    		break;
  }
  $oid = Pg_GetLastOID($result_auto);
  $dotaz = "select IDBook from book where oid = $oid";
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, this record cannot be added.";
    		break;
  }
  List($id_book) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
  
  for ($i = 0; $i < sizeof($author); $i++) {
    if ($author[$i][2] == "") continue;
    $dotaz = "select idauthor from author where Surname = '".$author[$i][2]."' and Name = '".$author[$i][1]."'";
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
        	   break 2;
    }
    if (Pg_NumRows($result_auto) > 0) {
       List($id_author) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    }
    else {
    
      $dotaz = "insert into author (TitleBefore, Name, Surname, TitleAfter) values ('".$author[$i][0]."', '".$author[$i][1]."', '".$author[$i][2]."', '".$author[$i][3]."')";    
      $result_auto = Pg_Exec($dotaz);
      if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
         		break 2;
      }
      $oid = Pg_GetLastOID($result_auto);
      $dotaz = "select IDAuthor from author where oid = $oid";
      $result_auto = Pg_Exec($dotaz);
      if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
        		break 2;
      }
      List($id_author) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    }

    $dotaz = "insert into book_author (idbook, idauthor) values ($id_book, $id_author)";
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
        		break 2;
    }
    if ($authors != "") $authors .= ", ";
    $authors .= $author[$i][0] . " " . $author[$i][1] . " " . $author[$i][2] . " " . $author[$i][3] ;
  }
  
   echo "$type $authors: $title was added. Move its files to directory $directory.<br>";
   echo "<a href=\"convert_all.php?autophoto=$id_autophoto\">Use this link to convert all files to png and rotate.</a>";
  Pg_Close ($connection);
  


} while (false);
?>
</body>
</html>
