<?
//include "autorizace.inc.php";
//ksa_authorize();
//if ($auth_level == 0) ksa_unauthorized();

require "pripoj_zcu.php";
?>
<HTML>
<HEAD>
 <META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<!--  <LINK REL=StyleSheet HREF="http://www.klinopis.cz/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">-->
 <LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA="screen, print">
 <TITLE>---------- Search -----------</TITLE>
</HEAD>
<BODY>
<form action="books.php" name="form1" id="form1" method="get">
<table cellspacing="0" cellpadding="3" align="center" bgcolor="#D2D2DB">
 <colgroup align="right"><colgroup>
 <tr><td height="30" colspan="3"><h3 align=center class="title"><u>Search in the Reference Library of NES in Pilsen</u></h3></td></tr>
 <tr><td colspan="3"><hr></td></tr>
 <tr>
    <td class=akt>publication's type :</td>
	<td class=akt colspan="2">
	 <select name="type" id="type">
	  <option value=-1 selected> &lt;-- choose type --&gt; </option>
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
  <td class=akt>title like :</td>
  <td colspan="2"><input type="text" name="title" id="title" size="40" class="vstup" value=""></td>
 </tr>
 <tr>
  <td>volume like :</td>
  <td colspan="2"><input type="text" name="volume" id="volume" size="40" maxlength="255" class="vstup" value=""></td>
 </tr>
 <tr>
  <td>ISBN :</td>
  <td colspan="2">
   <input type="text" class="vstup" size="2" name="isbn_1" value=""> -
   <input type="text" class="vstup" size="2" name="isbn_2" value=""> -
   <input type="text" class="vstup" size="2" name="isbn_3" value=""> -
   <input type="text" class="vstup" size="2" name="isbn_4" value="">
  </td>
 </tr>
 <tr>
  <td>increase number :</td>
  <td colspan="2">
	<input type="text" class="vstup" size="5" maxlength="10" name="increasenumber1" value=""> / 
	<input type="text" class="vstup" size="5" maxlength="10" name="increasenumber2" value="">
  </td>
 </tr>
 <tr>
  <td>signature :</td>
  <td colspan="2"><input type="text" class="vstup" size="25" maxlength="50" name="signature" value=""></td>
 </tr>
 <tr><td colspan="3"><hr></td></tr>
 <tr>
	<td class="title">subject :</td>
	<td class="subj" colspan="2">
	 <select name="subject" id="subject">
	  <option value=-1 selected> &lt;-- choose subject --&gt; </option>
	  <option value="afr">afrikanistika</option>
	  <option value="ant">antropologie</option>
	  <option value="ara">arabistika</option>
	  <option value="arc">archeologie</option>
	  <option value="bel">beletrie</option>
	  <option value="dej">dejiny umeni</option>
	  <option value="fil">filozofie</option>
	  <option value="geo">geografie</option>
	  <option value="heb">hebraistika</option>
	  <option value="his">historie</option>
	  <option value="ira">iranistika</option>
	  <option value="jaz">jazykoveda</option>
	  <option value="moh">historie od r. 1945</option>
	  <option value="poc">pocitace</option>
	  <option value="poe">poezie</option>
	  <option value="pol">politologie</option>
	  <option value="rel">religionistika</option>
	  <option value="sta">starovek</option>
	  <option value="tur">turkologie</option>
	  <option value="var">varia</option>
	  <option value="afi">Afrika</option>
	  <option value="asi">Asie</option>
	  <option value="evr">Evropa</option>
	  <option value="jam">J. Amerika</option>
	  <option value="sam">S. Amerika</option>
	  <option value="aus">Australie</option>
	 </select>
	</td>
 </tr>
 <tr><td colspan="3"><hr></td></tr>
 <tr>
  <td class=akt>author :</td>
  <td>
<?
  $dotaz = "SELECT idauthor, name, surname, titlebefore, titleafter FROM author WHERE actual='A' ORDER BY surname";
  @$result_authors = Pg_Exec($dotaz);
  $authors = Pg_NumRows ($result_authors);
?>
      <select name="author" id="author">
		 <option value=-1 selected> &lt;-- choose author --&gt; </option>
<?
  for ($j = 0; $j < $authors; $j++)
  {
    List($idauthor, $name, $surname, $titlebefore, $titleafter) = Pg_Fetch_Row ($result_authors, $j, PGSQL_NUM);
//    $author .= "$titlebefore $name $surname $titleafter";
?>
    <option value=<? echo $idauthor ?>><? echo $surname.' '.$name.' '.$titlebefore.' '.$titleafter?> </option>
<?

  }
?>
	   </select> <!--or author like : -->
  </td>
<!--  <td><input type="text" name="author2" id="author2" size="20" class="vstup"></td>-->
 </tr>
<? //include "key.inc.php" ?>
 <tr><td colspan="3"><hr></td></tr>
 <tr><td colspan="3" align="center"> 
        <input type="checkbox" name="sortbyauthor" value="sortbyauthor" title="sortbyauthor" />
        Sort results by author
      </td></tr>
 <tr><td colspan="3"><hr></td></tr>
 <tr><td colspan="3" align="center"><input type="submit" value="Search books" class="tlacitko2"></td></tr>
</table>
</FORM>
</BODY>
</HTML>
