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
  <title>----------- Edit ------------------</title>
</head>
<body>
<H4 align=center><small>edit bibliography item:</small></H4>

<?php
do
{

  //pripojeni k DB

  require_once("sql.php");
 
 
  //nastaveni promennych
  $type=trim($_POST['type']);
//  $subject=trim($_POST['subject']);
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
  $idbook=$_POST['idbook'];
  $autophoto=$_POST['autophoto'];
 
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
  if ($idbook =="" || $idbook ==0 ||  $title == "" || $type == "" || count($array_authors) < 1)
  {
    echo ".....mandatory items not filled.....";
    break;
  }
 
/*
  $frompage = (int) $frompage;
  $topage = (int) $topage;
 
  $dotaz = "select directory from autophoto where idautophoto = $autophoto";
  $result_auto = Pg_Exec($dotaz);
  $is = Pg_NumRows($result_auto);
  if ($is == 1) { // edit
    $rotate = (int) $rotate;
    $dotaz = "update autophoto set directory = '$directory', frompage = '$frompage', topage = '$topage', rotate = $rotate where idautophoto = $autophoto";
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
                echo "Sorry, this record cannot be changed.";
        		break;
    }
  }

  else { // insert
    $rotate = (int) $rotate;
    $dotaz = "insert into autophoto (directory, frompage, topage, rotate) values ('$directory', '$frompage', '$topage', $rotate)";
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
                echo "Sorry, this record cannot be changed.";
        		break;
    }
    $oid = Pg_GetLastOID($result_auto);
    $dotaz = "select IDAutophoto from autophoto where oid = $oid";
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
              echo "Sorry, this record cannot be changed.";
        	  break;
    }
    List($id_autophoto) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
  }

*/


  //update zaznamu o knize  
  $dotaz = "update book set type='$type', title='$title', subtitle='$subtitle',	volume='$volume', number='$number', volumesubnumber='$volumesubnumber',
							place='$place', year='$year', publisher='$publisher', isbn='$issn', issn='$issn', pageframe='$pageframe', signature='$signature',
							increasenumber1=$increasenumber1, increasenumber2=$increasenumber2, note='$note'  where idbook = $idbook";
  //echo $dotaz;
  $result_auto = pg_query($dotaz);
  if (!$result_auto)
  {
     echo "Sorry, this record cannot be changed.";
     break;
  }

  //smazeme vazbu autoru na knihu
  $dotaz = "delete from book_author where idbook = $idbook";
  $result_auto = pg_query($dotaz);
  if (!$result_auto) 
  {
     echo "Sorry, this record cannot be changed.";
   	 break;
  }
  

  // projdeme autory, zkontrolujeme, zda se zmenili jmena a ulozime vazbu autoru na knihu do DB
  for ($i = 0; $i < count($array_authors); $i++)
  {

	// kontrola, zda je autor v DB, pokud ano, nacteme jeho ID
    $dotaz = "select idauthor from author where surname = '".$array_authors[$i][1]."' and name = '".$array_authors[$i][0]."'";
    $result_auto = pg_query($dotaz);

	if (!$result_auto) 
	{
       echo "Sorry, this record cannot be updated.";
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
    $dotaz = "insert into book_author (idbook, idauthor) values ($idbook, $id_author)";
    echo $dotaz;
    $result_auto = pg_query($dotaz);
    if (!$result_auto) 
	{
       echo "Sorry, this record cannot be added.";
  	   break 2;
	}
    
	if ($authors != "") $authors .= ", ";
    $authors .= $author[$i][0] . " " . $author[$i][1] . " " . $author[$i][2] . " " . $author[$i][3] ;

  }
  
  echo "Record was changed.<br>";
//  echo "<a href=\"convert_all.php?autophoto=$autophoto\">Use this link to convert all files to png and rotate.</a>";
  Pg_Close ($connection);
  


} while (false);
?>
</body>
</html>
