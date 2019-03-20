<?php
  include "autorizace.inc.php";
  ksa_authorize();
  if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="StyleSheet" href="http://www.klinopis.cz/utf/obtc1.css" type="text/css" media="screen, print">
<title>---------- Insert -----------</title>
</head>
<body>
<p align=center class="title">Vkládání knih do databáze příruční knihovny KBS</p>
	<form method="post" name="form1" action="ins_book2.php">
		<table border="0">
			<tr>
				<td class=akt width="100">choose publication's type</td>
				<td class=akt colspan="2">
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
				<td class="title">choose subject</td>
				<td class="subj" colspan="2">
					<select name="subject">
						<option value="ane">ane</option>
						<option value="arab.">arab.</option>
						<option value="hebr.">hebr.</option>
						<option value="arab. and hebr.">arab. and hebr.</option>
						<option value="turk.">turk.</option>
						<option value="arch.">arch.</option>
						<option value="africa">africa</option>
						<option value="pers.">pers.</option>
						<option value="relig.">relig.</option>
						<option value="comp.">comp.</option>
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
				<td class=akt>1st author</td>
				<td class=akt><input type="text" class="vstup" size="10" name="author[0][1]" value=""></td>
				<td class=akt><input type="text" class="vstup" size="5" name="author[0][0]" value=""></td>
			</tr>
			<tr>
				<td><small>2nd author</small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[1][1]" value=""></small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[1][0]" value=""></small></td>
			</tr>
			<tr>
				<td><small>3rd author</small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[2][1]" value=""></small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[2][0]" value=""></small></td>
			</tr>
			<tr>
				<td><small>4th author</small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[3][1]" value=""></small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[3][0]" value=""></small></td>
			</tr>
			<tr>
				<td><small>5th author</small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[4][1]" value=""></small></td>
				<td><small><input type="text" class="vstup" size="5" name="author[4][0]" value=""></small></td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>title</td>
				<td><input type="text" class="vstup" size="42" name="title" value=""></td>
			</tr>
			<tr>
				<td><small>subtitle</small></td>
				<td><small><input type="text" class="vstup" size="52" name="subtitle" value=""></small></td>
			</tr>
			<tr>
				<td><small>volume (rada n. casopis)</small></td>
				<td><small><input type="text" class="vstup" size="46" name="volume" value=""></small></td>
			</tr>
			<tr>
				<td><small>number/subnumber</small></td>
				<td><small>
					<input type="text" class="vstup" size="2" name="number" value="">&nbsp;/&nbsp;					
					<input type="text" class="vstup" size="12" name="volumesubnumber" value="">
				</small></td>
			</tr>
</table>
<table>
			<tr>
				<td><small>place</small></td>
				<td><small><input type="text" class="vstup" size="22" name="place" value=""></small></td>
				<td><small>year</small></td>
				<td><small><input type="text" class="vstup" size="12" name="year" value=""></small></td>
				<td><small>publisher</small></td>
				<td><small><input type="text" class="vstup" size="22" name="publisher" value=""></td>
			</tr>
			<tr>
				<td><small>ISBN</small></td>
				<td><small><input type="text" class="vstup" size="12" name="isbn" value=""></small></td>
				<td><small>ISSN</small></td>
				<td><small><input type="text" class="vstup" size="12" name="issn" value=""></small></td>
				<td><small>total pages / tables</small></td>
				<td><small><input type="text" class="vstup" size="12" name="pageframe" value=""></small></td>
			</tr>
			<tr>
				<td><small>signature</small></td>
				<td><small><input type="text" class="vstup" size="12" name="signature" value=""></small></td>
				<td><small>increase number</small></td>
				<td><small><input type="text" class="vstup" size="6" name="increasenumber1" value="">
				<td>&nbsp;/&nbsp;</td>					
				<td><small><input type="text" class="vstup" size="6" name="increasenumber2" value=""></small></td>
			</tr>
			<tr>
				<td><small>note</small></td>
				<td colspan=3><small><input type="text" class="vstup" size="72" name="note" value=""></small></td>
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
