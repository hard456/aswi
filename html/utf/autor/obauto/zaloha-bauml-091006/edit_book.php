<?php
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>

<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<TITLE>---------- Edit -----------</TITLE>
</HEAD>
<BODY>

<?php

do
{

  require_once("sql.php");

 
  //kontrola, zda je vyplneno ID
  $idbook=$_GET['idbook'];
  if (($idbook=="")||($idbook==0))
  {
     echo "Requested operation failed.";
     break;
  }
 
  $dotaz = "select idbook, autophoto, type, subject, title, subtitle, volume, number, volumesubnumber, place, year, publisher, isbn, issn, pageframe, signature, increasenumber1, increasenumber2, note, auth from book WHERE idbook = $idbook";
  //echo $dotaz;
  @$result_auto = Pg_query($dotaz);
  $books = pg_num_rows ($result_auto);
  if ($books != 1)
  {
     echo "Requested operation failed.";
     break;
  }
  List($idbook, $autophoto, $type, $subject, $title, $subtitle, $volume, $number, $volumesubnumber, $place, $year, $publisher, $isbn, $issn, $pageframe, $signature, $increasenumber1, $increasenumber2, $note, $auth) = pg_fetch_row ($result_auto, 0, PGSQL_NUM);


  $dotaz = "select name, surname from book_author left join author on (author.IDAuthor = book_author.IDAuthor) where IDBook = $idbook order by surname,name";  
  $result_author = Pg_query($dotaz);
  $authors = pg_num_rows ($result_author);
  for ($i = 0; $i < $authors; $i++)  List($author[$i][0], $author[$i][1]) =  pg_Fetch_Row ($result_author, $i, PGSQL_NUM);   
  
/*  
  $dotaz = "select directory, frompage, topage, rotate from autophoto where idautophoto = $autophoto";
  $result_photo = Pg_Exec($dotaz);
  List($directory, $frompage, $topage, $rotate) = Pg_Fetch_Row ($result_photo, 0, PGSQL_NUM);
*/  
?>

<form METHOD="post" name="form1" ACTION="edit_book2.php">
<input type="hidden" name="idbook" value="<?php echo $idbook?>" >
<input type="hidden" name="autophoto" value="<?php echo $autophoto?>" >

<table border=0>
<tr>
	<td width="100">type</td>
	<td colspan="2">
					<select name="type">
						<option value="monograph" <?php if ($type=="monograph") echo "selected"; ?> >monograph</option>
						<option value="periodical" <?php if ($type=="periodical") echo "selected"; ?> >periodical</option>
						<option value="series" <?php if ($type=="series") echo "selected"; ?> >series</option>
						<option value="offprint" <?php if ($type=="offprint") echo "selected"; ?>  >offprint</option>
						<option value="cd" <?php if ($type=="cd") echo "selected"; ?> >cd</option>
						<option value="vhs" <?php if ($type=="vhs") echo "selected"; ?> >vhs</option>
						<option value="photo" <?php if ($type=="photo") echo "selected"; ?> >photo</option>
						<option value="unclassified" <?php if ($type=="unclassified") echo "selected"; ?> >unclassified</option>
						<?php if (($type!="")&&($type!="monograph")&&($type!="periodical")&&($type!="series")&&($type!="offprint")&&($type!="cd")&&($type!="vhs")&&($type!="photo")&&($type!="unclassified")): ?>
						<option value="<?php echo $type ?>" selected ><?php echo $type ?></option>
						<?php endif; ?>

					</select>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>surname</td>
	<td>first name</td>
</tr>
<tr>
	<td>1st author</td>
	<td><input type="text" class="vstup" size="5" name="author[0][1]" value="<?php echo $author[0][1]?>"></td>
	<td><input type="text" class="vstup" size="5" name="author[0][0]" value="<?php echo $author[0][0]?>"></td>
</tr>
<tr>
	<td>2nd author</td>
	<td><input type="text" class="vstup" size="5" name="author[1][1]" value="<?php echo $author[1][1]?>"></td>
	<td><input type="text" class="vstup" size="5" name="author[1][0]" value="<?php echo $author[1][0]?>"></td>
</tr>
<tr>
	<td>3rd author</td>
	<td><input type="text" class="vstup" size="5" name="author[2][1]" value="<?php echo $author[2][1]?>"></td>
	<td><input type="text" class="vstup" size="5" name="author[2][0]" value="<?php echo $author[2][0]?>"></td>
</tr>
<tr>
	<td>4th author</td>
	<td><input type="text" class="vstup" size="5" name="author[3][1]" value="<?php echo $author[3][1]?>"></td>
	<td><input type="text" class="vstup" size="5" name="author[3][0]" value="<?php echo $author[3][0]?>"></td>
</tr>
<tr>
	<td>5th author</td>
	<td><input type="text" class="vstup" size="5" name="author[4][1]" value="<?php echo $author[4][1]?>"></td>
	<td><input type="text" class="vstup" size="5" name="author[4][0]" value="<?php echo $author[4][0]?>"></td>
</tr>
<tr>
	<td>title</td>
	<td colspan="2"><input type="text" class="vstup" size="12" name="title" value="<?php echo $title ?>"></td>
</tr>
<tr>
	<td>subtitle</td>
	<td colspan="2"><input type="text" class="vstup" size="12" name="subtitle" value="<?php echo $subtitle ?>"></td>
</tr>
<tr>
	<td>volume</td>
	<td colspan="2"><input type="text" class="vstup" size="12" name="volume" value="<?php echo $volume ?>"></td>
</tr>
<tr>
	<td>number/subnumber</td>
	<td colspan="2"><input type="text" class="vstup" size="2" name="number" value="<?php echo $number ?>">&nbsp;/&nbsp;					
					<input type="text" class="vstup" size="12" name="volumesubnumber" value="<?php echo $volumesubnumber ?>">
	</td>
</tr>
<tr>
	<td>place</td>
	<td colspan="2"><input type="text" class="vstup" size="12" name="place" value="<?php echo $place ?>"></td>
</tr>
<tr>
	<td>year</td>
	<td colspan="2" ><input type="text" class="vstup" size="12" name="year" value="<?php echo $year ?>"></td>
</tr>
<tr>
	<td>publisher</td>
	<td colspan="2"><input type="text" class="vstup" size="12" name="publisher" value="<?php echo $publisher ?>"></td>
</tr>
<tr>
	<td>ISBN</td>
	<td><input type="text" class="vstup" size="12" name="isbn" value="<?php echo $isbn ?>"></td>
	<td>ISSN</td>
	<td><input type="text" class="vstup" size="12" name="issn" value="<?php echo $issn ?>"></td>
	<td>total pages / tables</td>
	<td><input type="text" class="vstup" size="12" name="pageframe" value="<?php echo $pageframe ?>"></td>
</tr>
<tr>
	<td>signature</td>
	<td><input type="text" class="vstup" size="12" name="signature" value="<?php echo $signature ?>"></td>
	<td>increase number</td>
	<td><input type="text" class="vstup" size="6" name="increasenumber1" value="<?php echo $increasenumber1 ?>">
	<td>&nbsp;/&nbsp;</td>					
	<td><input type="text" class="vstup" size="6" name="increasenumber2" value="<?php echo $increasenumber2 ?>"></td>
</tr>
<tr>
	<td>note</td>
	<td colspan="3"><input type="text" class="vstup" size="72" name="note" value="<?php echo $note ?>"></td>
</tr>

<!--
<tr>
	<td>directory</td><td colspan="2"><input type="text" class="vstup" size="12" name="directory" value="<?php echo $directory ?>"></td>
</tr>
<tr><td>from page</td><td colspan="2"><input type=text class=vstup size=12 name=frompage value="<? echo $frompage ?>"></td></tr>
<tr><td>to page</td><td colspan="2"><input type=text class=vstup size=12 name=topage value="<? echo $topage ?>"></td></tr>
<tr><td>rotate (degrees)</td><td colspan="2"><input type=text class=vstup size=12 name=rotate value="<? echo $rotate ?>"></td></tr>
-->
</table>

<input class="tlacitko2" type="submit" value="  change biography record  " style="height:30;background-color:#EEFFEE">
</form>

<?php

} while (false);

?>

</BODY>
</HTML>

