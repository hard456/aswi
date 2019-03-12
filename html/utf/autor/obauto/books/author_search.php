<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<link rel="StyleSheet" href="http://www.klinopis.cz/utf/obtc1.css" type="text/css" media="screen, print">-->
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA="screen, print">
<title>--- KBS - Insert new author ---</title>
</head>
<body>
<table align="center" width="400">
 <tr><td>
<?
    $kontrola=0;
    require "pripoj_zcu.php";

	$dotaz = "SELECT titlebefore, name, surname, titleafter FROM author WHERE LOWER(name)=LOWER('$name') AND LOWER(surname)=LOWER('$surname') AND actual='A'";	
	@$result_authors = Pg_Exec($dotaz);
    $authors = Pg_NumRows ($result_authors);
    if ($authors != 0)
    {
	 echo '<table cellpadding="0" cellspacing="0" width="100%">';
	 echo '<tr><td colspan="4">Autor: <b><u>'.$titlebefore.' '.$name.' '.$surname.' '.$titleafter.'</u></b>';
	 echo '<br><br><small>je jiz pravdepodobne zapsan v databazi jako:</small><br><hr></td></tr>';
     for ($i = 0; $i < $authors; $i++)
     {
      List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $i, PGSQL_NUM);
	  echo '<tr>';
	  echo '<td>'.$titlebefore.'</td>';
	  echo '<td>'.$name.'</td>';
	  echo '<td>'.$surname.'</td>';
	  echo '<td>'.$titleafter.'</td>';
	  echo '</tr>';
	 }
  	 echo '</table>';
	 echo '<hr></td></tr>';
     $kontrola=1;
	}
	else
	{
	 $podretez=substr($surname,0,5);
	 $podretez2=substr($name,0,3);
//	 $podretez=substr($surname,0,3);
//	ori  $dotaz = "SELECT titlebefore, name, surname, titleafter FROM author WHERE LOWER(surname) LIKE LOWER('$podretez%') AND actual='A'";
	 $dotaz = "SELECT titlebefore, name, surname, titleafter FROM author WHERE LOWER(surname) LIKE LOWER('$podretez%') AND LOWER(name) LIKE LOWER('$podretez2%') AND actual='A'";
	 @$result_authors = Pg_Exec($dotaz);
     $authors = Pg_NumRows ($result_authors);
     if ($authors != 0)
     {
	  echo '<table cellpadding="2" cellspacing="0" width="100%">';
	  echo '<tr><td colspan="4">Autor: <b><u>'.$titlebefore.' '.$name.' '.$surname.' '.$titleafter.'</u></b>';
	  echo '<br><br><small>Podobnost v jiz zadanych autorech:</small><br><hr></td></tr>';
      for ($i = 0; $i < $authors; $i++)
      {
       List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $i, PGSQL_NUM);
	   echo '<tr>';
	   echo '<td>'.$titlebefore.'</td>';
	   echo '<td>'.$name.'</td>';
	   echo '<td>'.$surname.'</td>';
	   echo '<td>'.$titleafter.'</td>';
	   echo '</tr>';
	  }
  	  echo '</table>';
	  echo '<hr></td></tr>';
      $kontrola=1;
	 }
    }
	if ($kontrola==0) echo '<tr><td align="center">Kontrola duplicity v tabulce autoru<br>probehla uspesne.<br><br></td></tr>';
    echo '<tr><td align="center"><a href="author_wr.php?titlebefore='.$titlebefore.'&name='.$name.'&surname='.$surname.'&titleafter='.$titleafter.'">add new author</a></td></tr>';
    echo '<tr><td align="center"><a href="author_new.php">back</a></td></tr>';
?>

 <tr><td align="center"><a href="javascript:self.close()">close window</a></td></tr>
</table>
</body>
</html>
