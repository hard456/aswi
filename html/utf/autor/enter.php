<html>
<head>
<META content=text/html; http-equiv=Content-Type>
<title>editorial system of klinopis.cz</title>
</head>
<BODY>
<h2><center>editorial system klinopis.cz</center></h2>
<p>
	<?echo "B:$bookandchapter&nbsp;P:$paragraph<BR>";?>
	<?echo "S:$source<BR>";?>
	<?echo "<FORM ACTION=\"/utf/autor$source\" method=\"post\">";?>
		<table>
			<tr>
				<td width=40%>
					Input your ID code (4 characters):
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
				<INPUT TYPE=hidden NAME="bookandchapter" VALUE="$bookandchapter">
				<INPUT TYPE=hidden NAME="paragraph" VALUE="$paragraph">
//				<INPUT TYPE=hidden NAME="OID" VALUE="$OID">
				</td>
			</tr>
			<tr>
				<td colspan="2"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?
   echo "kontrola :$paragraph!";
//if ($OID > 0):
//   echo "volano dobre:$OID!";
//   break;
//endif;
?>
					<INPUT TYPE=submit VALUE="enter to the system">
				</td>
			</tr>
		</table>
	</FORM>

</body>
</html>
