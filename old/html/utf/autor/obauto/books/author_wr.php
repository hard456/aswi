<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<link rel="StyleSheet" href="http://www.klinopis.cz/utf/obtc1.css" type="text/css" media="screen, print">-->
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA="screen, print">
<title>--- Insert new author ---</title>
</head>
<body>
<table align="center" width="400">
 <tr><td align="center">
<?
    require "pripoj_zcu.php";

	$dotaz = "SELECT max(idauthor) FROM author";	
	@$result_maxid = Pg_Exec($dotaz);
    List($maxid) = Pg_Fetch_Row ($result_maxid, 0, PGSQL_NUM);
	$hodnota= $maxid + 1;

	$dotaz = "INSERT INTO author (idauthor, titlebefore, name, surname, titleafter, actual) VALUES ($hodnota, '$titlebefore', '$name', '$surname', '$titleafter', 'A')";
    $result_auto = Pg_Exec($dotaz);
    if ($result_auto)
    {
	 echo 'Novy autor: <br><br><b>'.$titlebefore.' '.$name.' '.$surname.' '.$titleafter;
     echo '</b><br><br>BYL ULOZEN DO DATABAZE.<br><br>';
	}
    else
    {
     echo '<b><font color="red" size="4">Nastala CHYBA pri zapisu do databaze !!!</font></b>';
    }
?>
 <tr><td align="center"><a href="javascript:self.close()">close window</a></td></tr>
</table>
</body>
</html>
