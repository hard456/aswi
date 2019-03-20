<?php
  include "autorizace.inc.php";
  ksa_authorize();
  if ($auth_level == 0) ksa_unauthorized();

require "pripoj_zcu.php";
?>
<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<link rel="StyleSheet" href="http://www.klinopis.cz/utf/obtc1.css" type="text/css" media="screen, print">-->
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA="screen, print">
<title>--- KBS - Insert book into biography ---</title>
</head>
<body>
<table cellspacing="0" cellpadding="0" align="center" bgcolor="#D2D2DB">
 <tr><td height="30"><p align=center class="title"><u>Vkladani knih do databaze prirucni knihovny KBS</u></p></td></tr>
 <form method="post" name="form1" action="ins_book_wr.php">
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <colgroup align="right"><colgroup width="200"><colgroup align="right"><colgroup>
   <tr>
	<td>1st author</td>
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
	   </select><font size="4" color="#FF0000"><b>*</b></font>
    </td>
	<td colspan="2" align="right"><input type="button" value="New Author" class="tlacitko" onClick="javascript:window.open('author_new.php','add','width=450,height=350,left=10,top=10,resizable,scrollbars')"></td>
   </tr>
   
   <tr>
	<td>2nd author</td>
	<td>
      <select name="author_2">
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
	   </select>
	</td>
	<td>4th author</td>
	<td>
      <select name="author_4">
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
	   </select>
	</td>
   </tr>
   <tr>
	<td>3rd author</td>
	<td>
      <select name="author_3">
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
	   </select>
	</td>
	<td>5th author</td>
	<td>
      <select name="author_5">
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
	   </select>
	</td>
   </tr>
  </table>
 </td></tr>
 <tr><td><hr></td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <tr>
	<td>title</td>
	<td><input type="text" class="vstup" size="60" maxlength="255" name="title" value=""><font size="4" color="#FF0000"><b>*</b></font></td>
   </tr>
   <tr>
	<td>subtitle</td>
	<td><input type="text" class="vstup" size="60" maxlength="255" name="subtitle" value=""></td>
   </tr>
   <tr>
	<td>volume (rada n. casopis)</td>
	<td><input type="text" class="vstup" size="60" maxlength="255" name="volume" value=""></td>
   </tr>
  </table>
 </td></tr>
 <tr><td><hr></td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <tr><td>
    <table cellpadding="1" align="center">
    <colgroup align="right"><colgroup width="200"><colgroup align="right"><colgroup>
	 <tr>
	 <td class="title">1st subject</td>
	 <td class="subj" colspan="2">
	 <select name="subject_1" id="subject_1">
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
	 </select><font size="4" color="#FF0000"><b>*</b></font>
	 </td>
	 <td class="title">3rd subject</td>
	 <td class="subj" colspan="2">
	 <select name="subject_3" id="subject_3">
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
	 <tr>
	 <td class="title">2nd subject</td>
	 <td class="subj" colspan="2">
	 <select name="subject_2" id="subject_2">
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
	 <td class="title">4th subject</td>
	 <td class="subj" colspan="2">
	 <select name="subject_4" id="subject_4">
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
	</tr></td>
   </tr>
  </table>	
 </td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <colgroup align="right"><colgroup><colgroup align="right"><colgroup><colgroup align="right"><colgroup>
    <tr>
     <td class=akt>publication's type</td>
	 <td class=akt>
	  <select name="type">
	  <option value=-1 selected> &lt;-- choose type --&gt; </option>
	  <option value="monograph">monograph</option>
	  <option value="periodical">periodical</option>
	  <option value="series">series</option>
	  <option value="offprint">offprint</option>
	  <option value="cd">cd</option>
	  <option value="vhs">vhs</option>
	  <option value="photo">photo</option>
	  <option value="unclassified">unclassified</option>
	  </select><font size="4" color="#FF0000"><b>*</b></font>
	 </td>
     <td>number/subnumber</td>
	 <td>
	  <input type="text" class="vstup" size="15" maxlength="20" name="number" value=""> / 
	  <input type="text" class="vstup" size="4" maxlength="5" name="volumesubnumber" value="">
	 </td>
	</tr>
    <tr>
	 <td>publisher</td>
	 <td><input type="text" class="vstup" size="22" maxlength="255" name="publisher" value=""></td>
	 <td>total pages / tables</td>
	 <td><input type="text" class="vstup" size="22" maxlength="15" name="pageframe" value=""></td>
	</tr>
	<tr>
	 <td>place</td>
	 <td><input type="text" class="vstup" size="25" maxlength="100" name="place" value=""></td>
	 <td>year</td>
	 <td><input type="text" class="vstup" size="12" maxlength="20" name="year" value=""></td>
	</tr>
	<tr>
     <td>ISBN :</td>
     <td>
      <input type="text" class="vstup" size="2" name="isbn_1" value=""> -
      <input type="text" class="vstup" size="2" name="isbn_2" value=""> -
      <input type="text" class="vstup" size="2" name="isbn_3" value=""> -
      <input type="text" class="vstup" size="2" name="isbn_4" value="">
     </td>
	 <td>ISSN</td>
	 <td><input type="text" class="vstup" size="12" maxlength="10" name="issn" value=""></td>
	</tr>
	<tr>
	 <td>signature</td>
	 <td><input type="text" class="vstup" size="25" maxlength="50" name="signature" value=""></td>
	 <td>increase number</td>
	 <td colspan="3">
	 <input type="text" class="vstup" size="5" maxlength="10" name="increasenumber1" value=""> / 
	 <input type="text" class="vstup" size="5" maxlength="10" name="increasenumber2" value="">
	 </td>
	</tr>
	<tr>
	 <td>note</td>
	 <td colspan="4"><input type="text" class="vstup" size="80" name="note" value=""></td>
	</tr>
  </table>
 </td></tr>
 <tr><td><hr><font size="4" color="#FF0000"><b>*</b></font> - required field</td></tr>
 <tr><td align="center" height="50"><input class="tlacitko2" type="Submit" value="Add biography record"></td></tr>
 </form>
</table>
</body>
</html>
