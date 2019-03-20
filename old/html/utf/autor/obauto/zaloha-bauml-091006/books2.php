<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>----------- list ------------------</title>
</HEAD>
<body>
<?
do
{

  require_once("sql.php");

  $date = Date ("Y-m-d");
  $dotaz = "select idbook, autophoto, title from book WHERE auth ='hr01'";
  //echo $dotaz;
//  @$result_auto = Pg_Exec($dotaz);
//  $books = Pg_NumRows ($result_auto);
  //echo $books;
  for ($i = 0; $i < $books; $i++) {
    List($idbook, $autophoto, $title) = Pg_Fetch_Row ($result_auto, $i, PGSQL_NUM);
    $dotaz = "select TitleBefore, Name, Surname, TitleAfter from book_author left join author on (author.IDAuthor = book_author.IDAuthor) where IDBook = $idbook order by Surname";
    //echo $dotaz;
    @$result_authors = Pg_Exec($dotaz);
    $authors = Pg_NumRows ($result_authors);
    $author = "";
    for ($j = 0; $j < $authors; $j++) {
      List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $j, PGSQL_NUM);
      if ($author != "") $author .= ", ";
      $author .= "$titlebefore $name $surname $titleafter";
    }
    echo "$author: <b>$title</b>       ";
    echo "<a href=\"edit_book.php?idbook=$idbook\">edit</a>";
    echo " | <a href=\"jdata.php?autophoto=$idbook\">view</a><br>";
  }

} while (false);
?>
</body>
</html>
