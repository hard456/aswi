<?
require "pripoj_zcu.php";
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=Windows-1250">
<!--  <LINK REL=StyleSheet HREF="http://www.klinopis.cz/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">-->
  <LINK REL=StyleSheet HREF="css/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>----------- list ------------------</title>
</HEAD>
<body>
<?
do
{

  $query = "SELECT * from author left join book_author on (author.IDAuthor = book_author.IDAuthor) where book_author.IDAuthor IS NOT NULL";
  @$vysledek = Pg_Exec($query);
  $radku = Pg_NumRows ($vysledek);
  echo 'RADKU: '.$radku.'<br>';
   for ($i = 0; $i < $radku; $i++)
   {
    List($idauthor, $titlebefore, $name, $surname, $titleafter, $actual) = Pg_Fetch_Row ($vysledek, $i, PGSQL_NUM);
	
    $upd = "UPDATE author SET actual='A' WHERE idauthor=$idauthor";
    @$upd_vysl = Pg_Exec($upd);
	echo $idauthor.' - ';
    if ($upd_vysl) echo "aktualni";
	echo '<br>';
   }
} while (false);
?>
</body>
</html>
