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

	echo "<br><br>hledam $str v $heslo";	
	$poc_pos = 0;
	while (!(($poc_pos = StrPos($heslo, $str{0}, $poc_pos+1)) === false)) {
      echo "<br>start vnejsiho cyklu : poc_pos = $poc_pos";
	  $found = true;
	  for ($i = $poc_pos+1, $j = 1; ($i < strlen($heslo) && $j < strlen($str)); $i++) {
		echo "<br>start vnitrniho cyklu : i=$i, j=$j";
		if (!(($forbid = follow_forbidden(SubStr($heslo, $i))) === false)) {
            echo "<br>zacina zakazanym slovem, posun o forbid = $forbid znaku";
			$i += $forbid-1;
			continue;
		}
        echo "<br>nezacina zakazanym slovem, porovnavam 'str{j}' a 'heslo{i}' ".$str{$j}." ?= ".$heslo{$i};

		if ($str{$j} != $heslo{$i}) {
		  $found = false;
            echo "<br>znaky nejsou shodne, zaciname znovu";
		
		  break;
		}
	    $j++;
        echo "<br>znaky jsou shodne, porovnat dalsi znak";

	  }
	  if ($found == true && $j = strlen($str)) {
		echo "<br>slovo bylo nalezeno v textu";
	    return Array($poc_pos, $i-1);
	  }
	}
}

$heslo = "[x-x-x-x-o r]a-ka-sa-am aš-ta-n[a-pa-ra-kum]";
$str = "ra-ka";

$s = najdi_text($heslo, $str);
echo "<br><br>Hledany text zacina na znaku $s[0] a konci na $s[1]";


?>