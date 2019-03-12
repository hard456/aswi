<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<?
$space_char = chr(216);
function follow_forbidden($znak) {
      $ignoruj=Array("[","]","⌈","⌉","&lt;D:&gt;","&lt;B:&gt;" );  //slova pro ignorovani
	  //echo "<br>follow_forbidden $znak : ";

	  for ($i=0; $i < sizeof($ignoruj); $i++) {
		//echo "<br><br>hledam {$ignoruj[$i]} ";
	    $is = true;
		for ($j=0; $j < min(strlen($ignoruj[$i]), strlen($znak)); $j++) {
		  //echo "<br> ".$znak{$j} ." = " . $ignoruj[$i]{$j} . " ??? "	;
	      if ($znak{$j} != $ignoruj[$i]{$j}) {
			$is = false;
			break;
		  }
		  //echo "ano";
	    }
		if ($is == true) return min(strlen($ignoruj[$i]), strlen($znak));
	  } 
      //echo "<br>";
	  return false;
}

function najdi_text($heslo, $str)
	{

	//echo "<br>hledam $str v $heslo";	
	$poc_pos = 0;
	while (!(($poc_pos = @StrPos($heslo, $str{0}, $poc_pos+1)) === false)) {
      //echo "<br>start vnejsiho cyklu : poc_pos = $poc_pos";
	  $found = true;
	  for ($i = $poc_pos+1, $j = 1; ($i < strlen($heslo) && $j < strlen($str)); $i++) {
		//echo "<br>start vnitrniho cyklu : i=$i, j=$j";
		if (!(($forbid = follow_forbidden(SubStr($heslo, $i))) === false)) {
            //echo "<br>zacina zakazanym slovem, posun o forbid = $forbid znaku";
			$i += $forbid-1;
			continue;
		}
        //echo "<br>nezacina zakazanym slovem, porovnavam 'str{j}' a 'heslo{i}' ".$str{$j}." ?= ".$heslo{$i};

		if ($str{$j} != $heslo{$i}) {
		  $found = false;
            //echo "<br>znaky nejsou shodne, zaciname znovu";
		
		  break;
		}
	    $j++;
        //echo "<br>znaky jsou shodne, porovnat dalsi znak";

	  }
	  if ($found == true && $j == strlen($str)) {
		//echo "<br>slovo bylo nalezeno v textu";
	    return Array($poc_pos, $i-1);
	  }
	}
	return false;
}


?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from Old Babylonian Text Corpus</title>
</head>
<body>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<FONT FACE='Verdana' Color="#9bbad6"><h2><center>Attested chains - in the Old Babylonian Text Corpus</center></FONT></h2>
<?
	echo ("<FONT FACE='Arial Unicode MS, Code2000, Titus Cyberbit Basic' SIZE=3>");
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  $popis2 = URLDecode ($chain);
  if ($popis2 == "" || $popis2 == "%" || $popis2 == "%%" || $popis2 == "%%%" || $popis2 == "%%%%") {
    echo "... mandatory items not filled ...";
  }
  echo ("For the searched chain <b>$popis2:</b>  ");

  $pod = "";
  if ($type != "") $pod .= "obtextp.type = '$type' and ";
  if ($origin != "") $pod .= "obtextp.origin = '$origin' and ";
  if ($ruler != "") $pod .= "obtextp.ruler = '$ruler' and ";
  if ($year != "") {
   $year = (int) $year;
   $pod .= "obtextp.year = $year and ";
  }
  if ($month != "") {
	$month = (int) $month;
    $pod .= "obtextp.month = $month and ";
  }
  $pod .= "stransliteration like '%$popis2%'";

  $dotaz = "SELECT bookandchapter, paragraph, transliteration FROM obtexts left join obtextp on (obtexts.bookandchapter = obtextp.bookandchapterp) WHERE $pod";
//  echo $dotaz;
  if (@$result = @Pg_Exec ($dotaz))
	{

  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  echo "$pocethesel occurence(s) found.<BR><BR>";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><em><td><FONT color=#8080ff face=Verdana size=4><small>transliteration</small></FONT></td></em><td><FONT color=#8080ff face=Verdana size=3>text quotation</FONT></td></tr>";
  echo "<tr><em><td>&nbsp;</td></em><td><FONT color=#8080ff face=Verdana size=3><small>click to read the text in full</FONT></td></tr>";
		for ($i = 0; $i < $pocethesel; $i++)	{
			  List ($bookandchapter, $paragraph, $transliteration) = Pg_Fetch_Row ($result, $i);
              //$trns = zpracuj_heslo($transliteration);
              $trns = $transliteration;
			  $out_trns = "";
			  $len = StrLen($chain);	
			  $lastpos = 0;
			  if ((($pos = najdi_text($trns, $chain)) === false)) {
				$out_trns = $trns;
			  }
			  while (!(($pos = najdi_text($trns, $chain)) === false)) {
				//$pos[1] = $pos[0] + $len -1;
				$out_trns .= SubStr($trns, $lastpos, ($pos[0]-$lastpos));
				$out_trns .= "<FONT COLOR=red>" . SubStr($trns, $pos[0], $pos[1]-$pos[0]+1) . "</FONT>";
				$trns = SubStr($trns, $pos[1]+1, (StrLen($trns)));
			  }
			  $out_trns .= $trns; 
			  
		      echo "<tr><td><FONT FACE=\"Arial Unicode MS, Code2000, Titus Cyberbit Basic\">$out_trns</FONT></td><td><a href=\"./catalogue.php?bookandchapter=$bookandchapter&chain=$chain\">$bookandchapter</a>$paragraph)</td></tr>";
//		      echo "<tr><td><FONT FACE=\"Arial Unicode MS, Code2000, Titus Cyberbit Basic\">$out_trns</FONT></td><td><a href=\"./catalogue.php?bookandchapter=$bookandchapter&chain=$chain\">$bookandchapter</a><a href=\"./obtextsmore.php?paragraph2=$paragraph&bookandchapter=$bookandchapter\">$paragraph</a>)</td></tr>";
		}
				echo "</table>";
}
		else
		echo "nothing found!";
		echo "<form>";
					echo "<BR>&nbsp;&nbsp;&nbsp;";
					echo "<INPUT TYPE=\"Button\" VALUE=\"Bring me back to search other text chain.\" onClick=\"history.go(-1)\">";
		echo "<input type=hidden name=option value='2'>";
		echo "</form>";
}
  Pg_Close($connection);
}
?>
</FONT>
</body>
</html>
