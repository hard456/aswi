<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level < 10) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<META content=text/html; http-equiv=Content-Type>
<title>Tools - OBTC</title>
</head>
<BODY>
<h1><center>Input of new author</center></h1>
<p>
	<FORM ACTION="./autori2.php" method="post">
		<table border>
			<tr>
				<td width=30%>
					input id (4 chars):
				</td>
				<td>
					<INPUT TYPE=text NAME="kod" SIZE=4> (max 4 pismena)
				</td>
			</tr>
			<tr>
				<td>
					input the password (4 chars):
				</td>
				<td>
					<INPUT TYPE=password NAME="password" SIZE=10>
				</td>
			</tr>
			<tr>
				<td>
					name and surname of the author:
				</td>
				<td>
					<INPUT TYPE=text NAME="autor" SIZE=20>
				</td>
			</tr>
			<tr>
				<td><br>
					possible tasks of the author:
				</td>
				<td>
					the inserted user could have access to:<br>
					<input type=radio name=menu value="1" Checked>data input<br>
                    <input type=radio name=menu value="9" >data input and control<br>
					<input type=radio name=menu value="10" >webowner <br>
				</td>
			</tr>
			<tr>
				<td colspan="2"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<INPUT TYPE=submit VALUE="Add the new author">
					</form>
				</td>
			</tr>
		</table>
<form action="./autorv1.php">
	<input type=submit value="Back to the author's list">
</form>
</body>
</html>