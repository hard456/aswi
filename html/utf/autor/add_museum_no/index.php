<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Aplikace Vkládání muzeálních čísel</title>
<link rel="stylesheet" type="text/css" href="./css/kbs.css"> 
</head>
<body>

<?php
  require_once("./sql/db.php");
  $spojeni = new DB_Sql();
  
  $pocet = 0;
  
  //print_r($museum_no);
  if (!empty($actione) && $actione == "save") {
    //print_r($museum_no);
  	foreach ($museum_no as $key=>$value) {
  	  //echo("$key=>$value");
   	  if (!Empty($value)) {
   	    //echo "vlozime $value na $key";
   	    $dotaz = "UPDATE museum_no SET museum_no = '$value'
                            WHERE museum_no_id = $key";
        //echo $dotaz;
      	$spojeni->query($dotaz);
      	$pocet++;
      }
    }
  }
  
  if (!isset($limit)) {
  	$limit = 20;
  }
  if (!isset($offset)) {
  	$offset = 0;
  }
  
  $dotaz = "SELECT * from museum_no ORDER BY bookandchapter LIMIT $limit OFFSET $offset ";
  $spojeni->query($dotaz);

?>
<h2>Aplikace pro uložení muzeálních čísel ke korpusu OB</h2>
<h6><?if (!empty($pocet)) :?>Uloženo <?=$pocet?> museálních čísel.<? endif; ?> </h6>
<h6>Stránky:
<?php
  $spojeni_razeni = new DB_Sql();
  $spojeni_razeni->query("SELECT Count(*) FROM museum_no");
  $spojeni_razeni->next_record();
  $all = $spojeni_razeni->Record["count"];
  $pages = $all / $limit;
  
  for ($i = 0; $i < $pages; $i++) {
    if ($i*$limit != $offset) {
    	echo ('<a href="?limit=' . $limit . '&offset=' . ($i * $limit) . '">' . ($i+1) . '</a> ');
    }
    else {
    	echo ($i+1)." ";
    }
  }
  $navrat = '<a href="?limit='.$limit.'&offset=0"> První </a> | ';
  if ($offset-$limit >= 0)           
    $navrat .="<a href=\"?limit=$limit&offset=".($offset-$limit)."\"> Předchozí </a> |       ";
  if ($offset+$limit < $all)
    $navrat .="<a href=\"?limit=$limit&offset=".($offset+$limit)."\"> Další </a> |   ";
  $navrat .="<a href=\"?limit=$limit&offset=".($all-$limit)."\"> Poslední </a> ";
  
  //echo $navrat;
?>
</h6>
<form action="<?=$PHP_SELF?>" method="post">
<table>
  <tr class="nadpis_sekce">
    <td>bookandchapter</td>
    <td>museum_no</td>
    <td></td>
  </tr>
<?php
  while ($spojeni->next_record()) {
?>
  <tr class="akt">
    <td>
      <?=$spojeni->Record['bookandchapter']?>
    </td>
    <td>
      <input type="text" name="museum_no[<?=$spojeni->Record['museum_no_id']?>]" value="<?=$spojeni->Record['museum_no']?>" />
    </td>
    <td><!--input type="submit" name="submit[<?=$spojeni->Record['museum_no_id']?>]" value="Uloz!" /-->
        </td>
  </tr>
<?php
  }  
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <input type="hidden" name="actione" value="save" />
      <input type="submit" name="submit" value="Ulož!" />
    </td>
  </tr>
</table>

</form>
</body>
</html>
