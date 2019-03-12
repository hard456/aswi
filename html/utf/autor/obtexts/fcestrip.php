<?
/* Vypis fci verze 06/2002
KEILN2U2 
*/
function FCESTRIP ($text)
{
	//nahrazeni <
	while (($kde = StrPos ($text, "<")))
		$text = SubStr ($text, 0, $kde)."&lt;".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni >
	while (($kde = StrPos ($text, ">")))
		$text = SubStr ($text, 0, $kde)."&gt;".SubStr ($text, $kde+1, StrLen ($text)-2);

	return ($text);
}

?>
