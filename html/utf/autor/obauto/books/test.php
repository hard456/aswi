<?

//include "autorizace.inc.php";
//ksa_authorize();
//if ($auth_level == 0) ksa_unauthorized();

?>
<HTML>
<HEAD>
 <META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<!--  <LINK REL=StyleSheet HREF="http://www.klinopis.cz/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">-->
 <LINK REL=StyleSheet HREF="css/main.css" TYPE="text/css" MEDIA="screen, print">
 <TITLE>---------- Search -----------</TITLE>
</HEAD>
<BODY>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=books");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;

  $dotaz = "SELECT TitleBefore, Name, Surname, TitleAfter FROM author ORDER BY surname";
  @$result_authors = Pg_Exec($dotaz);
  $authors = Pg_NumRows ($result_authors);
  for ($j = 0; $j < $authors; $j++) {
    List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $j, PGSQL_NUM);
//    if ($author != "") $author .= ", ";
//    $author .= "$titlebefore $name $surname $titleafter";
    echo $surname;
  }
//    echo "$author: ";

} while (false);
?>
</BODY>
</HTML>
