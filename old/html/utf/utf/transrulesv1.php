<html>
<head>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<title>View the rules for transliteration</title>
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<BODY>
<H3 align=center>Rules for transliteration valid in OBTC</H3>
<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("It was imposible to connect to the database, try again later, the server is maybe down!<BR>\n");
		exit;
	}
?>
<H4 align=center>General remarks</H4>
<P align = justify class=SPAN3>The transliteration used in OBTC differs from the tranliterations used in editio princeps. 
<UL><LI>Above all there is a use of special marks to identify personal names, professional names and toponyma. 
<LI>Other difference can be found by the logograms which are every time given in the capitals and never together with their possible Old Babylonian 
Akkadian reading. 
<LI>The determinatives are every time written by the capitals and also never together with their possible Old Babylonian Akkadian reading. They are connected to the chain, to which they refer, by colons. 
<LI>The transliteration of personal names, professional names, toponyma and other text may significantly differ from the one in editio princeps.<br>
<LI>It was impossible to collate any text, we are trying to check the hand copies. If you do have some better hand copies or even photos, please, don't hesitate and send a copy of it to us. Of course we are responsible for all errors which can arise in the transliteration given in OBTC, please check the editio princeps any time when you would like to quote a part of the text.
</UL></P>
<H4 align=center>Particular transliteration rules to achieve united transliteration</H4>
	<form action="/utf/autor/transrules/transrules1.php">
		<center><input type=submit value="input new item - authorization needed"></center>
	</form>
<table border=1>
	<tr bgcolor=#808080>
		<td><center><b> <FONT color=white face=Verdana size=1>transliteration in editio princeps </font></font></b></center></td>
		<td><center><b> <FONT color=white face=Verdana size=1>transliteration in OBTC</font></b></center></td>
		<td><center><b> <FONT color=white face=Verdana size=1>notes </font></b></center></td>
		<td><center><b> <FONT color=white face=Verdana size=1>date </font></b></center></td>
		<td><center><b> <FONT color=white face=Verdana size=1>author </font></b></center></td>
	</tr>
<?
	@$msg = Pg_Exec ($spojeni, "SELECT bad, good, notes, datum, autor, OID FROM transrules ORDER BY bad, datum");
	Pg_Close ($spojeni);
	
	for ($i = 0; $i < Pg_NumRows ($msg); $i++)
	{
		List ($bad, $good, $notes, $datum, $autor, $OID) = Pg_Fetch_Row ($msg, $i);
		echo ("<tr><td class=td3>&nbsp; $bad &nbsp;</td>".
					"<td class=td3>&nbsp; $good &nbsp;</td>".
					"<td class=td3>&nbsp; $notes &nbsp;</td>".
					"<td class=td3>&nbsp; <small>$datum </small>&nbsp;</td>".
					"<td class=td3>&nbsp; <small>$autor</small> &nbsp;</td>".
					"<td>&nbsp; <small><a href=\"/utf/autor/transrules/rulesedit1.php?OID=$OID\">edit</a> </small>&nbsp;".
					"</tr>\n");
	}
?>
</table>
</body>
</html>