<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<TITLE>---------- Insert -----------</TITLE>
</HEAD>
<BODY>
<?
while ($odeslano == 1) {
  $odeslano = 0;

  require_once("sql.php");

  $date = Date ("Y-m-d");
  if ($subject == "") {
    echo ".....zapomneli jste patrne vyplnit nektery z povinnych udaju....";
    break;
  }
  /*
  $dotaz = "select Title from book WHERE Title = '$title'";
  //echo $dotaz;
  @$result_auto = Pg_Exec($dotaz);
  if (Pg_NumRows ($result_auto) > 0){
            List($c_title) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
            echo "Sorry, conflict -> $c_title";
    		break;
  }
  */
  $frompage = (int) $frompage;
  $topage = (int) $topage;
  $rotate = (int) $rotate;
  $dotaz = "insert into autophoto (frompage, topage, rotate) values ('$frompage', '$topage', $rotate)";
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, this record cannot be added.";
    		break;
  }
  $oid = Pg_GetLastOID($result_auto);
  $dotaz = "select IDAutophoto from autophoto where oid = $oid";
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, this record cannot be added.";
    		break;
  }
  List($id_autophoto) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
//to jsem pridal 10/2004 3 radky
  if (!$title = "") {
            $title = "0";
  }
  $rotate = (int) $rotate;

  $dotaz = "insert into book (autophoto, title, type, subtitle, volume, number, year, place, publisher, subject, fpage, tpage, auth) values ($id_autophoto, '$title', '$type', '$subtitle', '$volume', '$number', '$year', '$place', '$publisher', '$subject', '$fpage', '$tpage', 'bc03')";
  //echo $dotaz;
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, cannot be added";
    		break;
  }
  $oid = Pg_GetLastOID($result_auto);
  $dotaz = "select IDBook from book where oid = $oid";
  $result_auto = Pg_Exec($dotaz);
  if (!$result_auto) {
            echo "Sorry, this record cannot be added.";
    		break;
  }
  List($id_book) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
  
  for ($i = 0; $i < sizeof($author); $i++) {
    if ($author[$i][2] == "") continue;
    $dotaz = "select idauthor from author where Surname = '".$author[$i][2]."' and Name = '".$author[$i][1]."'";
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
        	   break 2;
    }
    if (Pg_NumRows($result_auto) > 0) {
       List($id_author) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    }
    else {
    
      $dotaz = "insert into author (TitleBefore, Name, Surname, TitleAfter) values ('".$author[$i][0]."', '".$author[$i][1]."', '".$author[$i][2]."', '".$author[$i][3]."')";    
      $result_auto = Pg_Exec($dotaz);
      if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
         		break 2;
      }
      $oid = Pg_GetLastOID($result_auto);
      $dotaz = "select IDAuthor from author where oid = $oid";
      $result_auto = Pg_Exec($dotaz);
      if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
        		break 2;
      }
      List($id_author) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    }

//tady zaremovano
    $dotaz = "insert into book_author (idbook, idauthor) values ($id_book, $id_author)";
//    echo $dotaz;
    $result_auto = Pg_Exec($dotaz);
    if (!$result_auto) {
              echo "Sorry, this record cannot be added.";
        		break 2;
    }
    if ($authors != "") $authors .= ", ";
    $authors .= $author[$i][0] . " " . $author[$i][1] . " " . $author[$i][2] . " " . $author[$i][3] ;
  }
  
  echo "<BR>Vas zaznam $subject byl uspesne zaznamenan.<br>";
  Pg_Close ($connection);

}
?>
<form METHOD="post" id=form1 name=form1 ACTION="cins_book.php">
<H3 align=center>Vitejte ve formulari pro vkladani bibliografickych dat</H3>
<LI><small>k zapsani znaku s diakritikou a indexovych cisel slouzi internetova klavesnice dole
<LI>pokud se vam znaky na obrazovce nezobrazuji dobre, neveste hlavu, pouzijte klavesnici, na obrazovce se znak sice objevi jako necitelny ctverecek, ale pozdeji bude vse v poradku
<LI>v pripade potreby znak presunte (nejprve oznacit mysi) kombinaci Ctrl c a Ctrl v (zkopirovat do schranky a presunout na dane misto kam se kurzorem presunete)
<LI>povinne polozky jsou oznaceny hvezdickou</SMALL>

<table border=0>
<tr><td>*vlozte predmet</td><td><input type=text id=q class=vstup size=25 name=subject value=""></td><td></td></tr>
<tr><td></td><td>prijmeni</td><td>jmeno (pokud je uvedeno)</td></tr>
<tr><td>prvni autor</td><td><input type=text class=vstup size=5 name=author[0][2] value=""></td><td><input type=text class=vstup size=5 name=author[0][1] value=""></td></tr>
<tr><td>druhy autor</td><td><input type=text class=vstup size=5 name=author[1][2] value=""></td><td><input type=text class=vstup size=5 name=author[1][1] value=""></td></tr>
<tr><td>treti autor</td><td><input type=text class=vstup size=5 name=author[2][2] value=""></td><td><input type=text class=vstup size=5 name=author[2][1] value=""></td></tr>
<tr><td>ctvrty autor</td><td><input type=text class=vstup size=5 name=author[3][2] value=""></td><td><input type=text class=vstup size=5 name=author[3][1] value=""></td></tr>
<tr><td>paty autor</td><td><input type=text class=vstup size=5 name=author[4][2] value=""></td><td><input type=text class=vstup size=5 name=author[4][1] value=""></td></tr>
<tr><td>titul</td><td colcount="2"><input type=text class=vstup size=12 name=title value=""></td></tr>
<tr><td>podtitul</td><td colcount="2"><input type=text class=vstup size=12 name=subtitle value=""></td></tr>
<tr><td>publikacni rada nebo casopis (zkratka napr. NABU)</td><td colcount="2"><input type=text class=vstup size=12 name=volume value=""></td></tr>
<tr><td>poradove cislo</td><td colcount="2"><input type=text class=vstup size=12 name=number value=""></td></tr>
<tr><td>od stranky (napr. pouze 57ff.)</td><td colcount="2"><input type=text class=vstup size=12 name=fpage value=""></td></tr>
<tr><td>do stranky</td><td colcount="2"><input type=text class=vstup size=12 name=tpage value=""></td></tr>
<tr><td width="100"></td><td colcount="2"><input type=hidden name=type value="studentbc2005"></td></tr>
<tr><td>rok vydani</td><td>misto vydani</td><td>vydavatel (pokud uvedeno)</td></tr>
<tr><td colcount="2"><input type=text class=vstup size=12 name=year value=""></td>
<td colcount="2"><input type=text class=vstup size=12 name=place value=""></td>
<td colcount="2"><input type=text class=vstup size=12 name=publisher value=""></td></tr>
<tr><td>*uvedte cislo strany, ze ktere prepisujte data, napr. 354</td><td></td></tr>
<tr><td colcount="2"><input type=text class=vstup size=12 name=frompage value=""></td><td colcount="2"></td></tr>
</table>
<? include "key.inc.php" ?>
<input type=hidden name=odeslano value=1>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  ulozte zadane udaje  " style="height:30;background-color:#EEFFEE">
</FORM>
</BODY>
</HTML>
