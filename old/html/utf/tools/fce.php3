<?
/* Vypis fci
	SkryjText (text)
	ProvedFormat (text)
	ZrusFormat (text)
	ZEnter (text, typ)
	ZUvozovky2B, EscapeS, ASCII (text)
	CS2EscapeS, ASCII (text)
	ZProcento2B, EscapeS, ASCII (text)
	ZApostrof2B, EscapeS, ASCII (text)
	ZCarka2B, EscapeS, ASCII (text)
	ZVlnka2B, EscapeS, ASCII (text)
	ZStrednik2B, EscapeS, ASCII (text)
	ZOtaznik2B, EscapeS, ASCII (text)
	ZVykricnik2B, EscapeS, ASCII (text)
  ZPomlcka2B, EscapeS, ASCII (text)
  ZLZavorka2B, EscapeS, ASCII (text)
  ZPodtrzitko2B, EscapeS, ASCII (text)
	ZVetsiMensiEscapeS (text)
  ZPZavorka2B, EscapeS, ASCII (text)
*/
//FCE skryje text mezi  %s ___ %/s 
function SkryjText ($text)
{
	$pom = "";
  while ( ($kde = StrPos ($text, "%s")) || (($text[0] == "%") && ($text[1] == "s")) )
  {
    if ($kde == 0)
		  $text = SubStr ($text, 2, StrLen ($text)-2);
    else if ($text[$kde-1] != "%")
    {
      $pom .= SubStr ($text, 0, $kde);
      $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
    }
    else
    {
      $pom .= SubStr ($text, 0, $kde+2);
      $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
      continue;
    }
    if ($kde2 = StrPos ($text, "%/s"))
			$text = SubStr ($text, $kde2+3, StrLen ($text)-$kde2-3);
  }
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ProvedFormat ($text)
{
  //nahrazeni zacatku BOLD, ITALIC, UNDERLINE, HORNI a DOLNI INDEX, Time Stamp
  $pom = "";
  while ( ($kde = StrPos ($text, "%")) || ($text[0]=="%") )
  {
    switch ( $text[$kde+1] )
    {
      case "b":
      case "B":
      case "i":
      case "I":
      case "u":
      case "U":
        $pom .= SubStr ($text, 0, $kde)."<".$text[$kde+1].">";
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
      case "h":
      case "H":
        $pom .= SubStr ($text, 0, $kde)."<sup>";
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
      case "d":
      case "D":
        $pom .= SubStr ($text, 0, $kde)."<sub>";
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
      case "t":
      case "T":
        $pom .= SubStr ($text, 0, $kde);
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+2);
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
    }
  }
  if ($text != "") $pom .= $text;

  $text = $pom;
  $pom = "";
  while ( ($kde = StrPos ($text, "%/")) || (($text[0]=="%") && ($text[1] == "/")) )
  {
    switch ( $text[$kde+2] )
    {
      case "b":
      case "B":
      case "i":
      case "I":
      case "u":
      case "U":
        $pom .= SubStr ($text, 0, $kde)."</".$text[$kde+2].">";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "h":
      case "H":
        $pom .= SubStr ($text, 0, $kde)."</sup>";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "d":
      case "D":
        $pom .= SubStr ($text, 0, $kde)."</sub>";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "t":
      case "T":
        $pom .= SubStr ($text, 0, $kde);
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
    }
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZrusFormat ($text)
{
  $pom = "";
  //obstraneni BOLD, ITALIC, UNDERLINE, HORNI INDEX, DOLNI INDEX, Time Stamp
  while ( ($kde = StrPos ($text, "%")) || ($text[0]=="%") )
  {
    switch ( $text[$kde+1] )
    {
      case "b":
      case "B":
      case "i":
      case "I":
      case "u":
      case "U":
      case "h":
      case "H":
      case "d":
      case "D":
      case "t":
      case "T":
        $pom .= SubStr ($text, 0, $kde);
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+2);
        $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
        break;
    }
  }
  if ($text != "") $pom .= $text;

  //odstraneni konce BOLD, ITALIC, UNDERLINE, HORNI a DOLNI INDEX, Time Stamp
  $text = $pom;
  $pom = "";
  while ( ($kde = StrPos ($text, "%/")) || (($text[0]=="%") && ($text[1]=="/")) )
  {
    switch ( $text[$kde+2] )
    {
      case "b":
      case "B":
      case "i":
      case "I":
      case "u":
      case "U":
      case "h":
      case "H":
      case "d":
      case "D":
      case "t":
      case "T":
        $pom .= SubStr ($text, 0, $kde);
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
    }
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

//FCE pro prevod ENTERU na retezec v parametru "subst"
function ZEnter ($text, $subst)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%l")) || (($text[0]=="%") && ($text[1]=="l")) )
  {
		$pom .= SubStr ($text, 0, $kde).$subst;
     $text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
  }
  	if ($text != "") $pom .= $text;
	return ($pom);
}

//FCE pro prevod pismen s UVOZOVKY (a, e, o, u, i) a OSTRE S do 2B format
function ZUvozovky2B ($text)
{
	$pom = "";
	while ( ($kde = StrPos ($text, "%\"")) || (($text[0] == "%") && ($text[1] == "\"")) )
	{
		$pom .= SubStr ($text, 0, $kde);
		switch ($text[$kde+2])
		{
			case "a":
				$pom .= "ä";
				break;
			case "A":
				$pom .= "Ä";
				break;
			case "e":
				$pom .= "ë";
				break;
			case "E":
				$pom .= "Ë";
				break;
			case "i":
				$pom .= "ï";
				break;
			case "I":
				$pom .= "Ï";
				break;
			case "o":
				$pom .= "ö";
				break;
			case "O":
				$pom .= "Ö";
				break;
			case "u":
				$pom .= "ü";
				break;
			case "U":
				$pom .= "Ü";
				break;
      case "s":
      case "S":
        $pom .= "ß";
        break;
			default:
				$pom .= SubStr ($text, $kde, 3);
				break;
		}
		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ZUvozovkyEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%\"")) || (($text[0] == "%") && ($text[1] == "\"")) )
  {
    $pom .= SubStr ($text, 0, $kde);
    switch ($text[$kde+2])
    {
      case "a":
        $pom .= "&#x00E4;";
        break;
      case "A":
        $pom .= "&#x00C4;";
        break;
      case "e":
        $pom .= "&#x00EB;";
        break;
      case "E":
        $pom .= "&#x00CB;";
        break;
      case "i":
        $pom .= "&#x00EF;";
        break;
      case "I":
        $pom .= "&#x00CF;";
        break;
      case "o":
        $pom .= "&#x00F6;";
        break;
      case "O":
        $pom .= "&#x00D6;";
        break;
      case "u":
        $pom .= "&#x00FC;";
        break;
      case "U":
        $pom .= "&#x00DC;";
        break;
      case "s":
      case "S":
        $pom .= "&#x00DF;";
        break;
      default:
        $pom .= SubStr ($text, $kde, 3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZUvozovkyASCII ($text)
{
	//NAHRAZENI PREHLASOVANYCH pismen pro ASCII
	$pom = "";
	while ( ($kde = StrPos ($text, "%\"")) || (($text[0] == "%") && ($text[1] == "\"")) )
	{
		$pom .= SubStr ($text, 0, $kde);
		switch ($text[$kde+2])
		{
			case "a":
			case "A":
			case "e":
			case "E":
      case "i":
      case "I":
			case "o":
			case "O":
			case "u":
			case "U":
			case "s":
			case "S":
				$text = SubStr ($text, $kde+2, StrLen ($text)-$kde-2);
				break;
			default:
				$pom .= SubStr ($text, $kde, 3);
				$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
		}
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function CS2EscapeS ($text)
{
	//nahrazeni �
	while (($kde = StrPos ($text, "á")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00E1;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "č")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x010D;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ď")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x010F;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "é")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00E9;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ě")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x011B;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "í")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00ED;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ľ")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x013E;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ĺ")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x013A;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ň")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0148;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ó")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00F3;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ř")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0159;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "š")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0161;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ť")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0165;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ů")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x016F;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ú")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00FA;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ý")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00FD;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "ž")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x017E;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Á")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00C1;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Č")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x010C;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ď")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x010E;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "É")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00C9;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ě")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x011A;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Í")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00CD;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ľ")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x013D;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ĺ")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0139;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ň")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0147;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ó")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00D3;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ř")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0158;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Š")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0160;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ť")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x0164;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ů")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x016E;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ú")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00DA;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ý")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x00DD;".SubStr ($text, $kde+2, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "Ž")) || (($text[0]=="�") && ($text[1]=="�")))
		$text = SubStr ($text, 0, $kde)."&#x017D;".SubStr ($text, $kde+2, StrLen ($text)-2);

	return ($text);
}

function CS2ASCII ($text)
{
  //nahrazeni �
  while (($kde = StrPos ($text, "á")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."a".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "č")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."c".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ď")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."d".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "é")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."e".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ě")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."e".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "í")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."i".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ľ")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."l".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ĺ")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."l".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ň")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."n".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ó")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."o".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ř")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."r".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "š")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."s".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ť")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."t".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ů")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."u".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ú")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."u".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ý")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."y".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "ž")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."z".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Á")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."A".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Č")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."C".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ď")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."D".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "É")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."E".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ě")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."E".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Í")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."I".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ľ")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."L".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ĺ")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."L".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ň")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."N".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ó")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."O".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ř")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."R".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Š")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."S".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ť")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."T".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ů")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."U".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ú")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."U".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ý")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."Y".SubStr ($text, $kde+2, StrLen ($text)-2);

  //nahrazeni �
  while (($kde = StrPos ($text, "Ž")) || (($text[0]=="�") && ($text[1]=="�")))
    $text = SubStr ($text, 0, $kde)."Z".SubStr ($text, $kde+2, StrLen ($text)-2);
  
  return ($text);
}
//------------------------------------------------------------------
//Znaky PROCENTO
function ZProcento2B ($text)
{
	$pom = "";

  while ( ($kde = StrPos ($text, "%%")) || (($text[0]=="%") && ($text[1]=="%")) )
	{
		switch ( $text[$kde+2] )
		{
			case "+": //umrti
				$pom .= SubStr ($text, 0, $kde)."†";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "p": //promile
				$pom .= SubStr ($text, 0, $kde)."‰";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "s": //zn. stupne
				$pom .= SubStr ($text, 0, $kde)."°";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "m": //mensirovno 
				$pom .= SubStr ($text, 0, $kde)."≤";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "v": //vetsirovno
				$pom .= SubStr ($text, 0, $kde)."≥";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "i": //identita
				$pom .= SubStr ($text, 0, $kde)."≡";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "n": //nerovna se
				$pom .= SubStr ($text, 0, $kde)."≠";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "o": //odmocnina 
				$pom .= SubStr ($text, 0, $kde)."√";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
      case "e": //2vlnky
        $pom .= SubStr ($text, 0, $kde)."≈";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "f": //fce
        $pom .= SubStr ($text, 0, $kde)."ƒ";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "8": //nekonecno
        $pom .= SubStr ($text, 0, $kde)."∞";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "g": //Gausuv integral
        $pom .= SubStr ($text, 0, $kde)."∫";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "r": //prunik
        $pom .= SubStr ($text, 0, $kde)."∩";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
			default:
				$pom .= SubStr ($text, 0, $kde+3);
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
		}
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ZProcentoEscapeS ($text)
{
	$pom = "";

  while ( ($kde = StrPos ($text, "%%")) || (($text[0]=="%") && ($text[1]=="%")) )
	{
		switch ( $text[$kde+2] )
		{
			case "+": //umrti
				$pom .= SubStr ($text, 0, $kde)."&#x2020;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "p": //promile
				$pom .= SubStr ($text, 0, $kde)."&#x2030;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "s": //zn. stupne
				$pom .= SubStr ($text, 0, $kde)."&#x02DA;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "m": //mensirovno 
				$pom .= SubStr ($text, 0, $kde)."&#x2264;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "v": //vetsirovno
				$pom .= SubStr ($text, 0, $kde)."&#x2265;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "i": //identita
				$pom .= SubStr ($text, 0, $kde)."&#x2261;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "n": //nerovna se
				$pom .= SubStr ($text, 0, $kde)."&#x2260;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
			case "o": //odmocnina ‣
				$pom .= SubStr ($text, 0, $kde)."&#x221A;";
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
      case "e": //2vlnky
        $pom .= SubStr ($text, 0, $kde)."&#x2248;";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "f": //fce
        $pom .= SubStr ($text, 0, $kde)."&#x0192;";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "8": //nekonecno
        $pom .= SubStr ($text, 0, $kde)."&#x221E;";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "g": //Gausuv integral
        $pom .= SubStr ($text, 0, $kde)."&#x222B;";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "r": //prunik
        $pom .= SubStr ($text, 0, $kde)."&#x2229;";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
			default:
				$pom .= SubStr ($text, 0, $kde+3);
    		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
				break;
		}
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ZProcentoASCII ($text)
{
  $pom = "";

  while ( ($kde = StrPos ($text, "%%")) || (($text[0]=="%") && ($text[1]=="%")) )
  {
    switch ( $text[$kde+2] )
    {
      case "+": //umrti
        $pom .= SubStr ($text, 0, $kde)."+";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "p": //promile
        $pom .= SubStr ($text, 0, $kde)."%%";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "s": //zn. stupne
        $pom .= SubStr ($text, 0, $kde)."st.";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "m": //mensirovno 
        $pom .= SubStr ($text, 0, $kde)."<=";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "v": //vetsirovno
        $pom .= SubStr ($text, 0, $kde).">=";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "i": //identita
        $pom .= SubStr ($text, 0, $kde)."=";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "n": //nerovna se
        $pom .= SubStr ($text, 0, $kde)."<>";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "o": //odmocnina 
        $pom .= SubStr ($text, 0, $kde)."odm.";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "e": //2vlnky
        $pom .= SubStr ($text, 0, $kde)."=";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "f": //fce
        $pom .= SubStr ($text, 0, $kde)."F";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "8": //nekonecno
        $pom .= SubStr ($text, 0, $kde)."oo";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "g": //Gausuv integral
        $pom .= SubStr ($text, 0, $kde)."I";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      case "r": //prunik
        $pom .= SubStr ($text, 0, $kde)."/\\";
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
        break;
    }
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZApostrof2B ($text)
{
	$pom = "";
  while ( ($kde = StrPos ($text, "%'")) || (($text[0]=="%") && ($text[1]=="'")) )
	{
		switch ( $text[$kde+2] )
		{
			case "a": 
				$pom .= SubStr ($text, 0, $kde)."à";
				break;
			case "A": 
				$pom .= SubStr ($text, 0, $kde)."À";
				break;
      case "c": 
        $pom .= SubStr ($text, 0, $kde)."ç";
        break;
      case "C": 
        $pom .= SubStr ($text, 0, $kde)."Ç";
        break;
			case "e": 
				$pom .= SubStr ($text, 0, $kde)."è";
				break;
			case "E": 
				$pom .= SubStr ($text, 0, $kde)."È";
				break;
     	case "i": 
       	$pom .= SubStr ($text, 0, $kde)."ì";
       	break;
     	case "I": 
       	$pom .= SubStr ($text, 0, $kde)."Ì";
       	break;
			case "o": 
				$pom .= SubStr ($text, 0, $kde)."ò";
				break;
			case "O": 
				$pom .= SubStr ($text, 0, $kde)."Ò";
				break;
			case "u": 
				$pom .= SubStr ($text, 0, $kde)."ù";
				break;
			case "U": 
				$pom .= SubStr ($text, 0, $kde)."Ù";
				break;
			case "y": 
				$pom .= SubStr ($text, 0, $kde)."ỳ";
				break;
			case "Y": 
				$pom .= SubStr ($text, 0, $kde)."Ỳ";
				break;
			case "w": 
				$pom .= SubStr ($text, 0, $kde)."ẁ";
				break;
			case "W": 
				$pom .= SubStr ($text, 0, $kde)."Ẁ";
				break;
			default:
				$pom .= SubStr ($text, 0, $kde+3);
				break;
		}
 		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ZApostrofEscapeS ($text)
{
	$pom = "";
  while ( ($kde = StrPos ($text, "%'")) || (($text[0]=="%") && ($text[1]=="'")) )
	{
		switch ( $text[$kde+2] )
		{
			case "a": 
				$pom .= SubStr ($text, 0, $kde)."&#x00E0;";
				break;
			case "A": 
				$pom .= SubStr ($text, 0, $kde)."&#x00C0;";
				break;
      case "c": 
        $pom .= SubStr ($text, 0, $kde)."&#x00E7;";
        break;
      case "C": 
        $pom .= SubStr ($text, 0, $kde)."&#x00C7;";
        break;
			case "e": 
				$pom .= SubStr ($text, 0, $kde)."&#x00E8;";
				break;
			case "E": 
				$pom .= SubStr ($text, 0, $kde)."&#x00C8;";
				break;
     case "i": 
       	$pom .= SubStr ($text, 0, $kde)."&#x00EC;";
       	break;
     	case "I": 
       	$pom .= SubStr ($text, 0, $kde)."&#x00CC;";
       	break;
			case "o": 
				$pom .= SubStr ($text, 0, $kde)."&#x00F2;";
				break;
			case "O": 
				$pom .= SubStr ($text, 0, $kde)."&#x00D2;";
				break;
			case "u": 
				$pom .= SubStr ($text, 0, $kde)."&#x00F9;";
				break;
			case "U": 
				$pom .= SubStr ($text, 0, $kde)."&#x00D9;";
				break;
			case "y": 
				$pom .= SubStr ($text, 0, $kde)."&#x1EF3;";
				break;
			case "Y": 
				$pom .= SubStr ($text, 0, $kde)."&#x1EF2;";
				break;
			case "w": 
				$pom .= SubStr ($text, 0, $kde)."&#x1E81;";
				break;
			case "W": 
				$pom .= SubStr ($text, 0, $kde)."&#x1E80;";
				break;
			default:
				$pom .= SubStr ($text, 0, $kde+3);
				break;
		}
 		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ZApostrofASCII ($text)
{
	$pom = "";
	while ( ($kde = StrPos ($text, "%'")) || (($text[0]=="%") && ($text[1]=="'")) )
	{
		switch ( $text[$kde+2] )
		{
			case "a": 
			case "A": 
			case "c": 
			case "C": 
			case "e": 
			case "E": 
     	case "i": 
     	case "i": 
			case "o": 
			case "O": 
			case "u": 
			case "U": 
			case "y": 
			case "Y": 
			case "w": 
			case "W": 
				$pom .= SubStr ($text, 0, $kde).$text[$kde+2];
				break;
			default:
				$pom .= SubStr ($text, 0, $kde+3);
				break;
		}
 		$text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
	}
	if ($text != "") $pom .= $text;
	return ($pom);
}

function ZCarka2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%,")) || (($text[0]=="%") && ($text[1]==",")) )
  {
    switch ( $text[$kde+2] )
    {
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."ą";
        break;
      case "A": 
        $pom .= SubStr ($text, 0, $kde)."Ą";
        break;
      case "c": 
        $pom .= SubStr ($text, 0, $kde)."ç";
        break;
      case "C": 
        $pom .= SubStr ($text, 0, $kde)."Ç";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."ę";
        break;
      case "E": 
        $pom .= SubStr ($text, 0, $kde)."Ę";
        break;
      case "g": 
        $pom .= SubStr ($text, 0, $kde)."ģ";
        break;
      case "G": 
        $pom .= SubStr ($text, 0, $kde)."Ģ";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."į";
        break;
      case "I": 
        $pom .= SubStr ($text, 0, $kde)."Į";
        break;
      case "k": 
        $pom .= SubStr ($text, 0, $kde)."ķ";
        break;
      case "K": 
        $pom .= SubStr ($text, 0, $kde)."Ķ";
        break;
      case "l": 
        $pom .= SubStr ($text, 0, $kde)."ļ";
        break;
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."Ļ";
        break;
      case "n": 
        $pom .= SubStr ($text, 0, $kde)."ņ";
        break;
      case "N": 
        $pom .= SubStr ($text, 0, $kde)."Ņ";
        break;
      case "r": 
        $pom .= SubStr ($text, 0, $kde)."ŗ";
        break;
      case "R": 
        $pom .= SubStr ($text, 0, $kde)."Ŗ";
        break;
      case "s": 
        $pom .= SubStr ($text, 0, $kde)."ş";
        break;
      case "S": 
        $pom .= SubStr ($text, 0, $kde)."Ş";
        break;
      case "t": 
        $pom .= SubStr ($text, 0, $kde)."ţ";
        break;
      case "T": 
        $pom .= SubStr ($text, 0, $kde)."Ţ";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."ų";
        break;
      case "U": 
        $pom .= SubStr ($text, 0, $kde)."Ų";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZCarkaEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%,")) || (($text[0]=="%") && ($text[1]==",")) )
  {
    switch ( $text[$kde+2] )
    {
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x0105;";
        break;
      case "A": 
        $pom .= SubStr ($text, 0, $kde)."&#x0104;";
        break;
      case "c": 
        $pom .= SubStr ($text, 0, $kde)."&#x00E7;";
        break;
      case "C": 
        $pom .= SubStr ($text, 0, $kde)."&#x00C7;";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."&#x0119;";
        break;
      case "E": 
        $pom .= SubStr ($text, 0, $kde)."&#x0118;";
        break;
      case "g": 
        $pom .= SubStr ($text, 0, $kde)."&#x0123;";
        break;
      case "G": 
        $pom .= SubStr ($text, 0, $kde)."&#x0122;";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."&#x012F;";
        break;
      case "I": 
        $pom .= SubStr ($text, 0, $kde)."&#x012E;";
        break;
      case "k": 
        $pom .= SubStr ($text, 0, $kde)."&#x0137;";
        break;
      case "K": 
        $pom .= SubStr ($text, 0, $kde)."&#x0136;";
        break;
      case "l": 
        $pom .= SubStr ($text, 0, $kde)."&#x013C;";
        break;
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."&#x013B;";
        break;
      case "n": 
        $pom .= SubStr ($text, 0, $kde)."&#x0146;";
        break;
      case "N": 
        $pom .= SubStr ($text, 0, $kde)."&#x0145;";
        break;
      case "r": 
        $pom .= SubStr ($text, 0, $kde)."&#x0157;";
        break;
      case "R": 
        $pom .= SubStr ($text, 0, $kde)."&#x0156;";
        break;
      case "s": 
        $pom .= SubStr ($text, 0, $kde)."&#x015F;";
        break;
      case "S": 
        $pom .= SubStr ($text, 0, $kde)."&#x015E;";
        break;
      case "t": 
        $pom .= SubStr ($text, 0, $kde)."&#x0163;";
        break;
      case "T": 
        $pom .= SubStr ($text, 0, $kde)."&#x0162;";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."&#x0173;";
        break;
      case "U": 
        $pom .= SubStr ($text, 0, $kde)."&#x0172;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZCarkaASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%,")) || (($text[0]=="%") && ($text[1]==",")) )
  {
    switch ( $text[$kde+2] )
    {
      case "a": 
      case "A": 
      case "c": 
      case "C": 
      case "e": 
      case "E": 
      case "g": 
      case "G": 
      case "i": 
      case "I": 
      case "k": 
      case "K": 
      case "l": 
      case "L": 
      case "n": 
      case "N": 
      case "r": 
      case "R": 
      case "s": 
      case "S": 
      case "t": 
      case "T": 
      case "u": 
      case "U": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZVlnka2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%~")) || (($text[0]=="%") && ($text[1]=="~")) )
  {
    switch ( $text[$kde+2] )
    {
      case "a":
        $pom .= SubStr ($text, 0, $kde)."ã";
        break;
      case "A": 
        $pom .= SubStr ($text, 0, $kde)."Ã";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."ĩ";
        break;
      case "I": 
        $pom .= SubStr ($text, 0, $kde)."Ĩ";
        break;
      case "n": 
        $pom .= SubStr ($text, 0, $kde)."ñ";
        break;
      case "N": 
        $pom .= SubStr ($text, 0, $kde)."Ñ";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."õ";
        break;
      case "O": 
        $pom .= SubStr ($text, 0, $kde)."Õ";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZVlnkaEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%~")) || (($text[0]=="%") && ($text[1]=="~")) )
  {
    switch ( $text[$kde+2] )
    {
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x00E3;";
        break;
      case "A": 
        $pom .= SubStr ($text, 0, $kde)."&#x00C3;";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."&#x0129;";
        break;
      case "I": 
        $pom .= SubStr ($text, 0, $kde)."&#x0128;";
        break;
      case "n": 
        $pom .= SubStr ($text, 0, $kde)."&#x00F1;";
        break;
      case "N": 
        $pom .= SubStr ($text, 0, $kde)."&#x00D1;";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."&#x00F5;";
        break;
      case "O": 
        $pom .= SubStr ($text, 0, $kde)."&#x00D5;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZVlnkaASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%~")) || (($text[0]=="%") && ($text[1]=="~")) )
  {
    switch ( $text[$kde+2] )
    {
      case "a": 
      case "A": 
      case "i": 
      case "I": 
      case "n": 
      case "N": 
      case "o": 
      case "O": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZStrednik2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%;")) || (($text[0]=="%") && ($text[1]==";")) )
  {
    switch ( $text[$kde+2] )
    {
      case "d":    
        $pom .= SubStr ($text, 0, $kde)."đ";
        break;
      case "D": 
        $pom .= SubStr ($text, 0, $kde)."Đ";
        break;
      case "l": 
        $pom .= SubStr ($text, 0, $kde)."ł";
        break;
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."Ł";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."ø";
        break;
      case "O": 
        $pom .= SubStr ($text, 0, $kde)."Ø";
        break;
      case "t": 
        $pom .= SubStr ($text, 0, $kde)."ŧ";
        break;
      case "T": 
        $pom .= SubStr ($text, 0, $kde)."Ŧ";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZStrednikEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%;")) || (($text[0]=="%") && ($text[1]==";")) )
  {
    switch ( $text[$kde+2] )
    {
      case "d": 
        $pom .= SubStr ($text, 0, $kde)."&#x0111;";
        break;
      case "D": 
        $pom .= SubStr ($text, 0, $kde)."&#x0110;";
        break;
      case "l": 
        $pom .= SubStr ($text, 0, $kde)."&#x0142;";
        break;
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."&#x0141;";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."&#x00F8;";
        break;
      case "O": 
        $pom .= SubStr ($text, 0, $kde)."&#x00D8;";
        break;
      case "t": 
        $pom .= SubStr ($text, 0, $kde)."&#x0167;";
        break;
      case "T": 
        $pom .= SubStr ($text, 0, $kde)."&#x0166;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZStrednikASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%;")) || (($text[0]=="%") && ($text[1]==";")) )
  {
    switch ( $text[$kde+2] )
    {
      case "d": 
      case "D": 
      case "l": 
      case "L": 
      case "o": 
      case "O": 
      case "t": 
      case "T": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZOtaznik2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%?")) || (($text[0]=="%") && ($text[1]=="?")) )
  {
    switch ( $text[$kde+2] )
    {
      case "e":        
      case "E": 
        $pom .= SubStr ($text, 0, $kde)."€";
        break;
      case "f": 
      case "F": 
        $pom .= SubStr ($text, 0, $kde)."₣";
        break;
      case "l": 
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."₤";
        break;
      case "p": 
      case "P": 
        $pom .= SubStr ($text, 0, $kde)."₧";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZOtaznikEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%?")) || (($text[0]=="%") && ($text[1]=="?")) )
  {
    switch ( $text[$kde+2] )
    {
      case "e":    
      case "E": 
        $pom .= SubStr ($text, 0, $kde)."&#x20AC;";
        break;
      case "f": 
      case "F": 
        $pom .= SubStr ($text, 0, $kde)."&#x20A3;";
        break;
      case "l": 
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."&#x20A4;";
        break;
      case "p": 
      case "P": 
        $pom .= SubStr ($text, 0, $kde)."&#x20A7;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZOtaznikASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%?")) || (($text[0]=="%") && ($text[1]=="?")) )
  {
    switch ( $text[$kde+2] )
    {
      case "e": 
      case "E": 
      case "f": 
      case "F": 
      case "l": 
      case "L": 
      case "p": 
      case "P": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZVykricnik2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%!")) || (($text[0]=="%") && ($text[1]=="!")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A": 
        $pom .= SubStr ($text, 0, $kde)."Α";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."α";
        break;
      case "B": 
        $pom .= SubStr ($text, 0, $kde)."Β";
        break;
      case "b": 
        $pom .= SubStr ($text, 0, $kde)."β";
        break;
      case "G": 
        $pom .= SubStr ($text, 0, $kde)."Γ";
        break;
      case "g": 
        $pom .= SubStr ($text, 0, $kde)."γ";
        break;
      case "D": 
        $pom .= SubStr ($text, 0, $kde)."Δ";
        break;
      case "d": 
        $pom .= SubStr ($text, 0, $kde)."δ";
        break;
      case "E": 
        $pom .= SubStr ($text, 0, $kde)."Ε";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."ε";
        break;
      case "Z": 
        $pom .= SubStr ($text, 0, $kde)."Ζ";
        break;
      case "z": 
        $pom .= SubStr ($text, 0, $kde)."ζ";
        break;
      case "J": 
        $pom .= SubStr ($text, 0, $kde)."Η";
        break;
      case "j": 
        $pom .= SubStr ($text, 0, $kde)."η";
        break;
      case "H": 
        $pom .= SubStr ($text, 0, $kde)."Θ";
        break;
      case "h": 
        $pom .= SubStr ($text, 0, $kde)."θ";
        break;
      case "I": 
        $pom .= SubStr ($text, 0, $kde)."Ι";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."ι";
        break;
      case "K": 
        $pom .= SubStr ($text, 0, $kde)."Κ";
        break;
      case "k": 
        $pom .= SubStr ($text, 0, $kde)."κ";
        break;
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."Λ";
        break;
      case "l": 
        $pom .= SubStr ($text, 0, $kde)."λ";
        break;
      case "M": 
        $pom .= SubStr ($text, 0, $kde)."Μ";
        break;
      case "m": 
        $pom .= SubStr ($text, 0, $kde)."μ";
        break;
      case "N": 
        $pom .= SubStr ($text, 0, $kde)."Ν";
        break;
      case "n": 
        $pom .= SubStr ($text, 0, $kde)."ν";
        break;
      case "Q": 
        $pom .= SubStr ($text, 0, $kde)."Ξ";
        break;
      case "q": 
        $pom .= SubStr ($text, 0, $kde)."ξ";
        break;
      case "U": 
        $pom .= SubStr ($text, 0, $kde)."Ο";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."ο";
        break;
      case "P": 
        $pom .= SubStr ($text, 0, $kde)."Π";
        break;
      case "p": 
        $pom .= SubStr ($text, 0, $kde)."π";
        break;
      case "R": 
        $pom .= SubStr ($text, 0, $kde)."Ρ";
        break;
      case "r": 
        $pom .= SubStr ($text, 0, $kde)."ρ";
        break;
      case "S": 
        $pom .= SubStr ($text, 0, $kde)."Σ";
        break;
      case "s": 
        $pom .= SubStr ($text, 0, $kde)."σ";
        break;
      case "T": 
        $pom .= SubStr ($text, 0, $kde)."Τ";
        break;
      case "t": 
        $pom .= SubStr ($text, 0, $kde)."τ";
        break;
      case "Y": 
        $pom .= SubStr ($text, 0, $kde)."Υ";
        break;
      case "y": 
        $pom .= SubStr ($text, 0, $kde)."υ";
        break;
      case "F": 
        $pom .= SubStr ($text, 0, $kde)."Φ";
        break;
      case "f": 
        $pom .= SubStr ($text, 0, $kde)."φ";
        break;
      case "C": 
        $pom .= SubStr ($text, 0, $kde)."Χ";
        break;
      case "c": 
        $pom .= SubStr ($text, 0, $kde)."χ";
        break;
      case "X": 
        $pom .= SubStr ($text, 0, $kde)."Ψ";
        break;
      case "x": 
        $pom .= SubStr ($text, 0, $kde)."ψ";
        break;
      case "O": 
        $pom .= SubStr ($text, 0, $kde)."Ω";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."ω";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZVykricnikEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%!")) || (($text[0]=="%") && ($text[1]=="!")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A": 
        $pom .= SubStr ($text, 0, $kde)."&#x0391;";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B1;";
        break;
      case "B": 
        $pom .= SubStr ($text, 0, $kde)."&#x0392;";
        break;
      case "b": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B2;";
        break;
      case "G": 
        $pom .= SubStr ($text, 0, $kde)."&#x0393;";
        break;
      case "g": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B3;";
        break;
      case "D": 
        $pom .= SubStr ($text, 0, $kde)."&#x0394;";
        break;
      case "d": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B4;";
        break;
      case "E": 
        $pom .= SubStr ($text, 0, $kde)."&#x0395;";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B5;";
        break;
      case "Z": 
        $pom .= SubStr ($text, 0, $kde)."&#x0396;";
        break;
      case "z": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B6;";
        break;
      case "J": 
        $pom .= SubStr ($text, 0, $kde)."&#x0397;";
        break;
      case "j": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B7;";
        break;
      case "H": 
        $pom .= SubStr ($text, 0, $kde)."&#x0398;";
        break;
      case "h": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B8;";
        break;
      case "I": 
        $pom .= SubStr ($text, 0, $kde)."&#x0399;";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."&#x03B9;";
        break;
      case "K": 
        $pom .= SubStr ($text, 0, $kde)."&#x039A;";
        break;
      case "k": 
        $pom .= SubStr ($text, 0, $kde)."&#x03BA;";
        break;
      case "L": 
        $pom .= SubStr ($text, 0, $kde)."&#x039B;";
        break;
      case "l": 
        $pom .= SubStr ($text, 0, $kde)."&#x03BB;";
        break;
      case "M": 
        $pom .= SubStr ($text, 0, $kde)."&#x039C;";
        break;
      case "m": 
        $pom .= SubStr ($text, 0, $kde)."&#x03BC;";
        break;
      case "N": 
        $pom .= SubStr ($text, 0, $kde)."&#x039D;";
        break;
      case "n": 
        $pom .= SubStr ($text, 0, $kde)."&#x03BD;";
        break;
      case "Q": 
        $pom .= SubStr ($text, 0, $kde)."&#x039E;";
        break;
      case "q": 
        $pom .= SubStr ($text, 0, $kde)."&#x03BE;";
        break;
      case "U": 
        $pom .= SubStr ($text, 0, $kde)."&#x039F;";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."&#x03BF;";
        break;
      case "P": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A0;";
        break;
      case "p": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C0;";
        break;
      case "R": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A1;";
        break;
      case "r": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C1;";
        break;
      case "S": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A3;";
        break;
      case "s": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C3;";
        break;
      case "T": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A4;";
        break;
      case "t": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C4;";
        break;
      case "Y": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A5;";
        break;
      case "y": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C5;";
        break;
      case "F": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A6;";
        break;
      case "f": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C6;";
        break;
      case "C": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A7;";
        break;
      case "c": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C7;";
        break;
      case "X": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A8;";
        break;
      case "x": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C8;";
        break;
      case "O": 
        $pom .= SubStr ($text, 0, $kde)."&#x03A9;";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."&#x03C9;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

function ZVykricnikASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%!")) || (($text[0]=="%") && ($text[1]=="!")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A": 
      case "a": 
      case "B": 
      case "b": 
      case "G": 
      case "g": 
      case "D": 
      case "d": 
      case "E": 
      case "e": 
      case "Z": 
      case "z": 
      case "J": 
      case "j": 
      case "H": 
      case "h": 
      case "I": 
      case "i": 
      case "K": 
      case "k": 
      case "L": 
      case "l": 
      case "M": 
      case "m": 
      case "N": 
      case "n": 
      case "Q": 
      case "q": 
      case "U": 
      case "u": 
      case "P": 
      case "p": 
      case "R": 
      case "r": 
      case "S": 
      case "s": 
      case "T": 
      case "t": 
      case "Y": 
      case "y": 
      case "F": 
      case "f": 
      case "C": 
      case "c": 
      case "X": 
      case "x": 
      case "O": 
      case "o": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
//---------------------------------------------------------------------------------------------
//  ZPomlcka2B, EscapeS, ASCII (text)
function ZPomlcka2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%-")) || (($text[0]=="%") && ($text[1]=="-")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."Ā";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."ā";
        break;
      case "E":    
        $pom .= SubStr ($text, 0, $kde)."Ē";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."ē";
        break;
      case "I":
        $pom .= SubStr ($text, 0, $kde)."Ī";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."ī";
        break;
      case "O":
        $pom .= SubStr ($text, 0, $kde)."Ō";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."ō";
        break;
      case "U":
        $pom .= SubStr ($text, 0, $kde)."Ū";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."ū";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZPomlckaEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%-")) || (($text[0]=="%") && ($text[1]=="-")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."&#x0100;";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x0101;";
        break;
      case "E":    
        $pom .= SubStr ($text, 0, $kde)."&#x0112;";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."&#x0113;";
        break;
      case "I":
        $pom .= SubStr ($text, 0, $kde)."&#x012A;";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."&#x012B;";
        break;
      case "O":
        $pom .= SubStr ($text, 0, $kde)."&#x014C;";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."&#x014D;";
        break;
      case "U":
        $pom .= SubStr ($text, 0, $kde)."&#x016A;";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."&#x016B;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZPomlckaASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%-")) || (($text[0]=="%") && ($text[1]=="-")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
      case "a": 
      case "E":    
      case "e": 
      case "I":
      case "i": 
      case "O":
      case "o": 
      case "U":
      case "u": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
//---------------------------------------------------------------------------------------------
//  ZLZavorka2B, EscapeS, ASCII (text)
function ZLZavorka2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%(")) || (($text[0]=="%") && ($text[1]=="(")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."Â";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."â";
        break;
      case "E":    
        $pom .= SubStr ($text, 0, $kde)."Ê";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."ê";
        break;
      case "I":
        $pom .= SubStr ($text, 0, $kde)."Î";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."î";
        break;
      case "O":
        $pom .= SubStr ($text, 0, $kde)."Ô";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."ô";
        break;
      case "U":
        $pom .= SubStr ($text, 0, $kde)."Û";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."û";
        break;
      case "W":
        $pom .= SubStr ($text, 0, $kde)."Ŵ";
        break;
      case "w": 
        $pom .= SubStr ($text, 0, $kde)."ŵ";
        break;
      case "Y":
        $pom .= SubStr ($text, 0, $kde)."Ŷ";
        break;
      case "y": 
        $pom .= SubStr ($text, 0, $kde)."ŷ";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZLZavorkaEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%(")) || (($text[0]=="%") && ($text[1]=="(")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."&#x00C2;";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x00E2;";
        break;
      case "E":    
        $pom .= SubStr ($text, 0, $kde)."&#x00CA;";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."&#x00EA;";
        break;
      case "I":
        $pom .= SubStr ($text, 0, $kde)."&#x00CE;";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."&#x00EE;";
        break;
      case "O":
        $pom .= SubStr ($text, 0, $kde)."&#x00D4;";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."&#x00F4;";
        break;
      case "U":
        $pom .= SubStr ($text, 0, $kde)."&#x00DB;";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."&#x00FB;";
        break;
      case "W":
        $pom .= SubStr ($text, 0, $kde)."&#x0174;";
        break;
      case "w": 
        $pom .= SubStr ($text, 0, $kde)."&#x0175;";
        break;
      case "Y":
        $pom .= SubStr ($text, 0, $kde)."&#x0176;";
        break;
      case "y": 
        $pom .= SubStr ($text, 0, $kde)."&#x0177;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZLZavorkaASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%(")) || (($text[0]=="%") && ($text[1]=="(")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
      case "a": 
      case "E":    
      case "e": 
      case "I":
      case "i": 
      case "O":
      case "o": 
      case "U":
      case "u": 
      case "W":
      case "w": 
      case "Y":
      case "y": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
//---------------------------------------------------------------------------------------------
//  ZPodtrzitko2B, EscapeS, ASCII (text)
function ZPodtrzitko2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%_")) || (($text[0]=="%") && ($text[1]=="_")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."Å";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."å";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZPodtrzitkoEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%_")) || (($text[0]=="%") && ($text[1]=="_")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."&#x00C5;";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x00E5;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZPodtrzitkoASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%_")) || (($text[0]=="%") && ($text[1]=="_")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
      case "a": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
     $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
//----------------------------------------------------------------------
// Prevod znaku <, > do EscapeS
function ZVetsiMensiEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "< ")) || (($text[0]=="<") && ($text[1]==" ")) )
  {
    switch ( $text[$kde] )
    {
      case "<":
        $pom .= SubStr ($text, 0, $kde)."&#x003C;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+1);
        break;
    }
    $text = SubStr ($text, $kde+1, StrLen ($text)-$kde-1);
  }
  if ($text != "") $pom .= $text;

	$text = $pom;
  $pom = "";
  while ( ($kde = StrPos ($text, "> ")) || (($text[0]==">") && ($text[1]==" ")) )
  {
    switch ( $text[$kde] )
    {
      case ">":
        $pom .= SubStr ($text, 0, $kde)."&#x003E;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+1);
        break;
    }
    $text = SubStr ($text, $kde+1, StrLen ($text)-$kde-1);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
//---------------------------------------------------------------------------------------------
//  ZPZavorka2B, EscapeS, ASCII (text)
function ZPZavorka2B ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%)")) || (($text[0]=="%") && ($text[1]==")")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."Ă";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."ă";
        break;
      case "E":    
        $pom .= SubStr ($text, 0, $kde)."Ĕ";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."ĕ";
        break;
      case "G":
        $pom .= SubStr ($text, 0, $kde)."Ğ";
        break;
      case "g": 
        $pom .= SubStr ($text, 0, $kde)."ğ";
        break;
      case "I":
        $pom .= SubStr ($text, 0, $kde)."Ĭ";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."ĭ";
        break;
      case "O":
        $pom .= SubStr ($text, 0, $kde)."Ŏ";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."ŏ";
        break;
      case "U":
        $pom .= SubStr ($text, 0, $kde)."Ŭ";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."ŭ";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZPZavorkaEscapeS ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%)")) || (($text[0]=="%") && ($text[1]==")")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
        $pom .= SubStr ($text, 0, $kde)."&#x0102;";
        break;
      case "a": 
        $pom .= SubStr ($text, 0, $kde)."&#x0103;";
        break;
      case "E":    
        $pom .= SubStr ($text, 0, $kde)."&#x0114;";
        break;
      case "e": 
        $pom .= SubStr ($text, 0, $kde)."&#x0115;";
        break;
      case "G":
        $pom .= SubStr ($text, 0, $kde)."&#x011E;";
        break;
      case "g": 
        $pom .= SubStr ($text, 0, $kde)."&#x011F;";
        break;
      case "I":
        $pom .= SubStr ($text, 0, $kde)."&#x012C;";
        break;
      case "i": 
        $pom .= SubStr ($text, 0, $kde)."&#x012D;";
        break;
      case "O":
        $pom .= SubStr ($text, 0, $kde)."&#x014E;";
        break;
      case "o": 
        $pom .= SubStr ($text, 0, $kde)."&#x014F;";
        break;
      case "U":
        $pom .= SubStr ($text, 0, $kde)."&#x016C;";
        break;
      case "u": 
        $pom .= SubStr ($text, 0, $kde)."&#x016D;";
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}
function ZPZavorkaASCII ($text)
{
  $pom = "";
  while ( ($kde = StrPos ($text, "%)")) || (($text[0]=="%") && ($text[1]==")")) )
  {
    switch ( $text[$kde+2] )
    {
      case "A":
      case "a": 
      case "E":    
      case "e": 
      case "G":
      case "g": 
      case "I":
      case "i": 
      case "O":
      case "o": 
      case "U":
      case "u": 
        $pom .= SubStr ($text, 0, $kde).$text[$kde+2];
        break;
      default:
        $pom .= SubStr ($text, 0, $kde+3);
        break;
    }
    $text = SubStr ($text, $kde+3, StrLen ($text)-$kde-3);
  }
  if ($text != "") $pom .= $text;
  return ($pom);
}

?>
