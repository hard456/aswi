<?
/* Vypis fci verze 06/2002
30.01.03 pridany prehlasky a ostre ss
KEILN2U2 
*/
function KEILN2U2 ($text)
{
	//nahrazeni �;
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ü".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ostre �;
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ß".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 039 &#x02BE;
	while (($kde = StrPos ($text, "'")))
		$text = SubStr ($text, 0, $kde)."ʾ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 185
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ĝ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 152
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ù".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 221 +1
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Š".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 182
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ř".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni �;
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ö".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 148
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ö".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."á".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni a3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."à".SubStr ($text, $kde+1, StrLen ($text));

	//nahrazeni 162
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Á".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 164
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Â".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni �;
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ä".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ^a 131
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."â".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 132
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ä".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni �;
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ä".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 133
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ā".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 170
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."�".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 169
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ī".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ~i 142
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ĩ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ~i 170 __ problem
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Î".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 134
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."é".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 147
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ô".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 135
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ē".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 153
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ũ".SubStr ($text, $kde+1, StrLen ($text)-1);

	//nahrazeni ^e 136
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ê".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 178
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."È".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 154
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."û".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 171
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ú".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 223
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ú".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 155
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ū".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 137
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ě".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 173
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ū".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 176
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ü".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 174
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ű".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 172
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ù".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni i3 141
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ì".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 140
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."î".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 168
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ì".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 138
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."è".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 139 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ẽ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 143
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."í".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 144
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ī".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 179
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ē".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni o2 146
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ó".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 149
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ő".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 150
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ō".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 151
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ú".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 156
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ü".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 165
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ā".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 166
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ä".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 167
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Í".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 191 +3 TADY
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ṭ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 226 TADYX OK
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ž".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 163 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."À".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ~a 130 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ã".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 239 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₀".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 177 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."É".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 181
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ö".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 192
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ú".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 194 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ṭ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 200
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."č".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 204
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ß".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 209
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ň".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 211
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ť".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 212
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Č".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 214 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ḫ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 217 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ḫ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 218
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ṣ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 220 +1
	while (($kde = StrPos ($text, "�")))
 		$text = SubStr ($text, 0, $kde)."š".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 222
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ṣ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 224
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ž".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 229
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ý".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 230 cisla 1 under
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₁".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 231 + 3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₂".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 232
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₃".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 233
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₄".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 234
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₅".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 235
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₆".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 236
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₇".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 237
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₈".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 238
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₉".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 240
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ď".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 241
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ř".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 243
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ů".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 244
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ĝ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 245
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ｘ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 246 ajn
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ʿ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 247
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ʾ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 249
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."§".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 250
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ĺ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 252 prava polovicni bylo tu ┐
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."⌉".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 253 leva polovicni ┌
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."⌈".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 254 prava polovicni bylo tu ┐
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."⌉".SubStr ($text, $kde+1, StrLen ($text)-2);

	return ($text);
}

function SSLH ($text)
{
	//nahrazeni 039 &#x02BE;
	while (($kde = StrPos ($text, "'")))
		$text = SubStr ($text, 0, $kde)."ʾ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 185
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ĝ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 152
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ù".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 221 +1
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Š".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 182
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ř".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 148
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ö".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni �
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."á".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni a3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."à".SubStr ($text, $kde+1, StrLen ($text));

	//nahrazeni 162
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Á".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 164
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Â".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ^a 131
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."â".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 132
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ä".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 133
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ā".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 170
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."�".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 169
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ī".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ~i 142
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ĩ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ~i 170 __ problem
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Î".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 134
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."é".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 147
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ô".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 135
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ē".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 153
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ũ".SubStr ($text, $kde+1, StrLen ($text)-1);

	//nahrazeni ^e 136
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ê".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 178
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."È".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 154
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."û".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 171
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ú".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 223
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ú".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 155
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ū".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 137
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ě".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 173
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ū".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 176
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ü".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 174
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ű".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 172
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ù".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni i3 141
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ì".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 140
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."î".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 168
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ì".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 138
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."è".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 139 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ẽ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 143
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."í".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 144
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ī".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 179
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ē".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni o2 146
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ó".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 149
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ő".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 150
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ō".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 151
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ú".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 156
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ü".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 165
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ā".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 166
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ä".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 167
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Í".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 191 +3 TADY
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ṭ".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 226 TADYX OK
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ž".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 163 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."À".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ~a 130 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ã".SubStr ($text, $kde+1, StrLen ($text)+1);

	//nahrazeni 239 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₀".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 177 TADYX
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."É".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 181
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ö".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 192
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ú".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 194 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ṭ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 200
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."č".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 204
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ß".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 209
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ň".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 211
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ť".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 212
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Č".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 214 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ḫ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 217 +3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ḫ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 218
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ṣ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 220 +1
	while (($kde = StrPos ($text, "�")))
 		$text = SubStr ($text, 0, $kde)."š".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 222
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ṣ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 224
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ž".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 229
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ý".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 230 cisla 1 under
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₁".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 231 + 3
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₂".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 232
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₃".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 233
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₄".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 234
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₅".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 235
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₆".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 236
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₇".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 237
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₈".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 238
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."₉".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 240
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ď".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 241
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ř".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni 243
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ů".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 244
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ĝ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 245
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ｘ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 246 ajn
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ʿ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 247
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."ʾ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 249
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."§".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 250
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."Ĺ".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 252 prava polovicni bylo tu ┐
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);
	
	//nahrazeni 253 leva polovicni ┌
	while (($kde = StrPos ($text, "�")))
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

	//nahrazeni < &lt;
	while (($kde = StrPos ($text, "&lt;")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);


	//nahrazeni > &gt;
	while (($kde = StrPos ($text, "&gt;")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ( 040 
	while (($kde = StrPos ($text, "(")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ) 041 
	while (($kde = StrPos ($text, ")")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni / 047
	while (($kde = StrPos ($text, "�")))
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

	//nahrazeni ceskych znaku nasleduje uuu
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ceskych znaku r
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ceskych znaku nasleduje
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	//nahrazeni ceskych znaku nasleduje
	while (($kde = StrPos ($text, "�")))
		$text = SubStr ($text, 0, $kde)."".SubStr ($text, $kde+1, StrLen ($text)-2);

	return ($text);
}

?>
