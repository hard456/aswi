<?
// if (! IsSet ($autor))
if (! $autor=="")
{
  Header ("Location: http://www.klinopis.cz/utf/autor/transrules/transrules1.php?autor=$autor");
}
else
  echo "<b>$autor</b>";
?>
<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>Editorial system - www.klinopis.cz</title>
</head>
<BODY>
<H2><center><FONT FACE="Verdana, Arial" color=#3399ff>Welcome to the editorial system of www.klinopis.cz</FONT></center></H2>
<p>
	<FORM ACTION="./identiftransrules.php" method="post"> 
		<table>
			<tr>
				<td width=40%>
					Input your login:
				</td>
				<td>
					<INPUT TYPE=text NAME="kodaut" SIZE=4>
				</td>
			</tr>
			<tr>
				<td>
					Input your password:
				</td>
				<td>
					<INPUT TYPE=password NAME="passaut" SIZE=10>
				</td>
			</tr>
			<tr>
				<td colspan="2"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<INPUT TYPE=submit VALUE="Enter into editorial system">
				</td>
			</tr><tr><td>&nbsp;</td></tr>
		</table>
<small>If you are not registered and have knowledge of the Old Babylonian Akkadian and would like to participate on this project please don't hesitate and write </small><a href="mailto:rahman@ksa.zcu.cz"><small>to the administrator Furat Rahman.</small></a>
	</FORM>
</body>
</html>