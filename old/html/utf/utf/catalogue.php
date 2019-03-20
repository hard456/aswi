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
	//$heslo = trim($heslo);
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
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Selected items from the Old Babylonian Text Corpus</title>
<script language="JavaScript">
<!--
function openWindow(url, name)
{
popupWin = window.open(url, name, "scrollbars,resizable,width=740,height=490");
}
//-->
</script>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2><center>Chapter or text in full - in the Old Babylonian Text Corpus</center></FONT></h2>
<?
  echo ("<FONT FACE='Arial Unicode MS, Code2000, Titus Cyberbit Basic' SIZE=3>");
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
//  $pod = ("bookandchapter='$bookandchapter'")
  $bookandchapter = trim($bookandchapter);
  $pod = ("trim(bookandchapter) like '%$bookandchapter%'");
  //echo $pod;
  if (@$result = @Pg_Exec (
                "SELECT * FROM obtexts WHERE $pod ORDER BY BOOKANDCHAPTER,PARAGRAPH"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
  $source = "/obtexts/obtexts1.php";
  echo "<table border=0 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><td align=center><FONT color=#8080ff face=Verdana size=3></FONT>&nbsp;";
//  echo "<SPAN CLASS=text1><a href=\"javascript:openWindow('./showauto.php&bookandchapter=$bookandchapter', 'popwinP')\">$bookandchapter</A> in transliteration) :</SPAN></td></tr>";
echo "<SPAN CLASS=text1>$bookandchapter in transliteration) :</SPAN></td></tr>";

	for ($i = 0; $i < $pocethesel; $i++)
	{
	List ($bookandchapter, $paragraph, $transliteration) = Pg_Fetch_Row ($result, $i);
	echo "<TR><td><a href=\"javascript:openWindow('./obtextcoment.php?paragraph2=$paragraph&bookandchapter=$bookandchapter', 'popwinP')\">$paragraph</A>&nbsp;&nbsp;&nbsp;";
              $trns = $transliteration;
			  $out_trns = "";
			  $len = StrLen($chain);	
			  $lastpos = 0;
			  if ((($pos = najdi_text($trns, $chain)) === false)) {
				//$out_trns = $trns;
			  }
			  while (!(($pos = najdi_text($trns, $chain)) === false)) {
				//$pos[1] = $pos[0] + $len -1;
				$out_trns .= SubStr($trns, $lastpos, ($pos[0]-$lastpos));
				$out_trns .= "<Font color=magenta>" . SubStr($trns, $pos[0], $pos[1]-$pos[0]+1) . "</font>";
				$trns = SubStr($trns, $pos[1]+1, (StrLen($trns)));
			  }
			  $out_trns .= $trns; 


           echo "<SPAN CLASS=text1>$out_trns</SPAN></td>";
            echo "<td><a href=\"../autor/obtexts/obtexts1.php?paragraph=$paragraph&bookandchapter=$bookandchapter\"><img src=\"/img/shutur.png\" BORDER=1></TD></TR>";
	}
}
}
  $polozky2 = ("bookandchapterc='$bookandchapter'");
  $result2 = Pg_Exec ($connection, "SELECT * FROM obtextc WHERE $polozky2");
  if (($pocet2 = @Pg_NumRows ($result2)) > 0)
	{
	for ($j = 0; $j < $pocet2; $j++)
	{
	List ($bookandchapterc, $paragraphc, $comment1, $autor) = Pg_Fetch_Row ($result2, $j);
	echo "<TR><td colspan=3><HR>see notes / comments to this text if there are any:</td></TR>";
	echo "<TR><TD>$bookandchapterc&nbsp;$paragraphc</td><td SPAN=text1>$comment1</td><td>Author:&nbsp;$autor</td></TR>";
	}
}
	echo "</table>";
  Pg_Close($connection);
}
echo "<form>";
	echo "<BR>&nbsp;&nbsp;&nbsp;";
if ($option != "") {
	echo "<INPUT TYPE=\"Button\" VALUE=\"Bring me back to choose other text.\" onClick=\"history.go(-1)\">";                
	}
	else {
	echo "<INPUT TYPE=\"Button\" VALUE=\"Bring me back to search other text chain.\" onClick=\"history.go(-2)\">";                
	}
	echo "</form>";
?>
</FONT>
</body>
</html>
