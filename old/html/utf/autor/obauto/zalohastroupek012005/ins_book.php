<?php
/*
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
*/
?>
<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="StyleSheet" href="/utf/obtc1.css" type="text/css" media="screen, print">
<title>---------- Insert -----------</title>
</head>
<body>
	<form method="post" name="form1" action="ins_book2.php">
		<table border="0">
			<tr>
				<td width="100">type</td>
				<td colspan="2">
					<select name="type">
						<option value="monograph">monograph</option>
						<option value="periodical">periodical</option>
						<option value="series">series</option>
						<option value="offprint">offprint</option>
						<option value="cd">cd</option>
						<option value="vhs">vhs</option>
						<option value="photo">photo</option>
						<option value="unclassified">unclassified</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>enter subject</td>
				<td colspan="2">
					<select name="subject">
						<option value="ane">ane</option>
						<option value="arab.">arab.</option>
						<option value="hebr.">hebr.</option>
						<option value="arab. and hebr.">arab. and hebr.</option>
						<option value="turk.">turk.</option>
						<option value="arch.">arch.</option>
						<option value="unclassified">unclassified</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>surname</td>
				<td>first name</td>
			</tr>
			<tr>
				<td>author 1</td>
				<td><input type="text" class="vstup" size="5" name="author[0][1]" value=""></td>
				<td><input type="text" class="vstup" size="5" name="author[0][0]" value=""></td>
			</tr>
			<tr>
				<td>author 2</td>
				<td><input type="text" class="vstup" size="5" name="author[1][1]" value=""></td>
				<td><input type="text" class="vstup" size="5" name="author[1][0]" value=""></td>
			</tr>
			<tr>
				<td>author 3</td>
				<td><input type="text" class="vstup" size="5" name="author[2][1]" value=""></td>
				<td><input type="text" class="vstup" size="5" name="author[2][0]" value=""></td>
			</tr>
			<tr>
				<td>author 4</td>
				<td><input type="text" class="vstup" size="5" name="author[3][1]" value=""></td>
				<td><input type="text" class="vstup" size="5" name="author[3][0]" value=""></td>
			</tr>
			<tr>
				<td>author 5</td>
				<td><input type="text" class="vstup" size="5" name="author[4][1]" value=""></td>
				<td><input type="text" class="vstup" size="5" name="author[4][0]" value=""></td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>title</td>
				<td><input type="text" class="vstup" size="42" name="title" value=""></td>
			</tr>
			<tr>
				<td>subtitle</td>
				<td><input type="text" class="vstup" size="42" name="subtitle" value=""></td>
			</tr>
			<tr>
				<td>volume</td>
				<td><input type="text" class="vstup" size="6" name="volume" value=""></td>
			</tr>
			<tr>
				<td>number/subnumber</td>
				<td>
					<input type="text" class="vstup" size="2" name="number" value="">&nbsp;/&nbsp;					
					<input type="text" class="vstup" size="12" name="volumesubnumber" value="">
				</td>
			</tr>
			<tr>
				<td>place</td>
				<td><input type="text" class="vstup" size="22" name="place" value=""></td>
			</tr>
			<tr>
				<td>year</td>
				<td><input type="text" class="vstup" size="12" name="year" value=""></td>
			</tr>
			<tr>
				<td>publisher</td>
				<td><input type="text" class="vstup" size="22" name="publisher" value=""></td>
			</tr>
			<tr>
				<td>ISBN</td>
				<td><input type="text" class="vstup" size="12" name="isbn" value=""></td>
			</tr>
			<tr>
				<td>ISSN</td>
				<td><input type="text" class="vstup" size="12" name="issn" value=""></td>
			</tr>
			<tr>
				<td>total pages / tables</td>
				<td><input type="text" class="vstup" size="12" name="pageframe" value=""></td>
			</tr>
			<tr>
				<td>signature</td>
				<td><input type="text" class="vstup" size="12" name="signature" value=""></td>
			</tr>
			<tr>
				<td>increase number</td>
				<td>
					<input type="text" class="vstup" size="12" name="increasenumber1" value="">&nbsp;/&nbsp;					
					<input type="text" class="vstup" size="12" name="increasenumber2" value="">
				</td>
			</tr>
			<tr>
				<td>note</td>
				<td><input type="text" class="vstup" size="112" name="note" value=""></td>
			</tr>
<?php
//<tr><td>NEVYPLNOVAT nasl.:directory</td><td><input type="text" class="vstup" size="12" name="directory" value=""></td></tr>
//<tr><td>from page</td><td><input type="text" class="vstup" size="12" name="frompage" value=""></td></tr>
//<tr><td>to page</td><td><input type="text" class="vstup" size="12" name="topage" value=""></td></tr>
//<tr><td>rotate (degrees)</td><td><input type="text" class="vstup" size="12" name="rotate" value=""></td></tr>
?>
		</table>
<?php //include "key.inc.php" ?>		
		<input class="tlacitko2" type="Submit" value="  add biography record  " style="height:30;background-color:#EEFFEE">
	</form>
</body>
</html>
