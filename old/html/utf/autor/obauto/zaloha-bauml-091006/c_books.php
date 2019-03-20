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
  $auth = "bc03";
  $docas = "Rahman"; 
  $dotaz = "select fpage, tpage, idbook, autophoto, title, location, type, subtitle, volume, volume_shortcut, number, year, place, publisher, frompage, topage, auth from book left join autophoto on (book.autophoto = autophoto.idautophoto) WHERE fpage='$fpage' AND subject='$docas' order by frompage, title";
  //echo $dotaz;
  @$result_auto = Pg_Exec($dotaz);
  $books = Pg_NumRows ($result_auto);
  //echo $books;
  echo "\$author: <b>\$title - \$subtitle</b>. in: \$volume (\$volume_shortcut) \$number (\$fpage-\$tpage). \$publisher, \$place, \$year.<br>";
  for ($i = 0; $i < $books; $i++) {
    List($fpage, $tpage, $idbook, $autophoto, $title, $location, $type, $subtitle, $volume, $volume_shortcut, $number, $year, $place, $publisher, $frompage, $topage) = Pg_Fetch_Row ($result_auto, $i, PGSQL_NUM);
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
    echo "$author: <b>$title - $subtitle</b>. in: $volume ($volume_shortcut) $number ($fpage-$tpage). $publisher, $place, $year.";
    echo "<a href=\"edit_book.php?idbook=$idbook\">edit</a>";
    //echo " | <a href=\"jdata.php?autophoto=$idbook\">view</a><br>";
	echo "<br> frompage - topage : $frompage - $topage<br>";
  }

} while (false);
?>
</body>
</html>
