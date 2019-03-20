<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title></title>
</head>
<body>
<?php


echo"<table border=\"1\"><FONT color=#8080ff face=\"Arial Unicode MS\">
";
$radky = file('slovnik.utx');
for($i=0;$i<Count($radky);$i++) {
     echo("<tr>\n
     ");
  $radek = explode(';', $radky[$i]);

  for($j=0;$j<Count($radek);$j++) {
    echo"<td>";
    echo"$radek[$j]";
    echo"</td>\n";
  }

  echo("</tr> \n
  ");
}

echo('</font></table>
');

?>
</body>
</html>
