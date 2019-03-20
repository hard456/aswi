<?
/* Vypis fci verze 01/2003 pouze pro obtexts
KEILN2U2 
*/
function SSLH ($text)
{
	//nahrazeni 039 &#x02BE;
	while (($kde = StrPos ($text, "'")))
		$text = SubStr ($text, 0, $kde)." æ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni < &lt;
	while (($kde = StrPos ($text, "&lt;")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);


	//nahrazeni > &gt;
	while (($kde = StrPos ($text, "&gt;")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 252 prava polovicni bylo tu ‚îê
	while (($kde = StrPos ($text, "¸")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 253 leva polovicni ‚îå
	while (($kde = StrPos ($text, "˝")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni [ 091
	while (($kde = StrPos ($text, "[")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ] 093
	while (($kde = StrPos ($text, "]")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni < 060
	while (($kde = StrPos ($text, "<")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ( 040 
	while (($kde = StrPos ($text, "(")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ) 041 
	while (($kde = StrPos ($text, ")")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni / 047
	while (($kde = StrPos ($text, "˛")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni \ 092
//	while (($kde = StrPos ($text, "\")))
//		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ! 
	while (($kde = StrPos ($text, "!")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ?
	while (($kde = StrPos ($text, "?")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni *
	while (($kde = StrPos ($text, "*")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	return ($text);
}

?>
