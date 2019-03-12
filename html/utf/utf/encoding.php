<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>Cuneiform Circle - encoding</TITLE>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
</HEAD>
<BODY>
<BR>
<H3 align=center><STRONG>Encoding of Old Babylonian Text Corpus, OB Dictionary and List of OB Signs</CENTER></STRONG></H3>
<p align=justify><font color="#009999">The Old Babylonian Akkadian Texts</font> in transliteration and other textual material on this site are because of the diacritical signs, emphatics etc. encoded in the <A HREF="http://www.unicode.org">Unicode UTF-8 standard</A>.</P>
<p align=justify>If you would have any troubles to see special characters etc., just install a font with full support of Unicode encodings. In operating systems like Windows 9x and above you can use a font by Microsoft <A HREF="http://www.flwi.rug.ac.be/latijnengrieks/basic_files/ARIALUNI.zip" target=_blank>Arial Unicode MS</A>, or you 
can look at a web page dedicated to possible problems connected with <A HREF=http://www.unicode.org/help/display_problems.html target=_blank>Unicode</A>. <BR><BR>We tested following fonts, where the display of special characters was without problems found yet: <b>Arial Unicode MS, Lucida Sans Unicode, Code2000 and Titus Cyberbit Basic</b>. If you find other let us know, we will add them to the list.
<BR><BR>We have had a possibility to test the readability on platforms MAC OS X and Linux RedHat with X-Windows and found no problems to view the special unicode characters there. Anyway we welcome any feedback in this or other respects.</p>
<p align=justify>If you would have any insoluble trouble with the display of special characters, don't hesitate and contact us on this e-mail address: <a href="mailto:rahman@ksa.zcu.cz">administrator of OBTC</A> with the short description of your operating system, web browser name and version and font used.</P>
<BR>
<?
//  echo ("Here will be the complete list of special characters and their representation choosen from the Unicode set. There are $pocethesel entries: <BR><BR>");
//	echo ("<form action=\"/utf/autor/characters/charnew1.php\">");
//		echo ("<center><input type=submit value=\"input new item - authorization needed\"></center>");
//	echo ("</form>");
//	echo ("<FONT FACE='Arial Unicode MS, Code2000, Titus Cyberbit Basic' SIZE=3>");
//  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
//  if (!$connection)
//	{
//    echo "There are probably too many querries, please try again later!";
//	}
//  else
//	{
//  if (@$result = @Pg_Exec (
//                "SELECT oid, charview, char2b, charentity, description FROM characters"))
//	{
//  if (($pocethesel = @Pg_NumRows ($result)) > 0)
//	{
//  echo "<table border=1 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
//  echo "<tr bgColor=#006666><em><td><FONT FACE='Verdana' color=white size=2>character in Unicode font</FONT></td><td><FONT FACE='Verdana' color=white size=2>character code in 2b Unicode</FONT></td><td><FONT FACE='Verdana' color=white size=2>character code in entity Unicode</FONT></td><td><FONT FACE='Verdana' color=white size=2>character description</FONT></td><td>&nbsp; <small> <FONT FACE='Verdana' color=white size=2>edit </FONT></small>&nbsp;</tr>";
//		for ($i = 0; $i < $pocethesel; $i++)
//				{
//				List ($OID, $charview, $char2b, $charentity, $description) = Pg_Fetch_Row ($result, $i);
//          echo "<tr><td><FONT FACE=\"Arial Unicode MS, Code2000, Titus Cyberbit Basic\">$charview</FONT></td><td>$char2b</td><td>$charentity</td><td><FONT FACE=\"Arial Unicode MS, Code2000, Titus Cyberbit Basic\">$description</FONT></td><td>&nbsp; <small><a href=\"/autor/characters/charedit1.php?OID=$OID\">this item</a> </small>&nbsp;</tr>";
//				}
//				echo "</table>";
//}
//		else
//		echo "nothing found!";
//}
//  Pg_Close($connection);
//}
?>
<BR>
</FONT>
</BODY>
</HTML>
