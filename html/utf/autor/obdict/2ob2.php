<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Selected items from the Old Babylonian Dictionary</title>
</HEAD>
<body>
<FORM id=form1 METHOD="get" name=form1 ACTION="/utf/autor/obdict/2ob3.php">
<?
do
{
  echo "<H4 align=center><small>Author's abbreviation:&nbsp;$auth</small></H4>";
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $ok ='0';
//  echo $op;
  if ($op == "insert_1") {
	  $date = Date ("Y-m-d");


    if ($variants != "") {
      @$result_ref = Pg_Exec("select id_word from WORD WHERE item = '$variants'");
	  if (Pg_NumRows ($result_ref) == 0){
            echo "Sorry, the _item_ was not correctly inserted into the dictionary! odkazovana polozka nebyla nalezena<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
    		break;
	  }
	  else {
	        $idref = Pg_Fetch_Row ($result_ref, 0, PGSQL_NUM);
			$idref = $idref[0];
	  }
	}
	else $idref = "null";

    if ($variants == "") {  
	  for ($i=0; $i < sizeof($translation); $i++) {	
		  if ($translation[$i] != "") {
		      @$result_translation1 = Pg_Exec("select id_translation from TRANSLATION WHERE translation = '$translation[$i]'");
			  if (Pg_NumRows ($result_translation1) == 0){
				    @$result_translation = Pg_Exec("insert into TRANSLATION (translation) VALUES ('$translation[$i]')");
					if (!$result_translation):
			            echo "Sorry, the _translation_ was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
	    				break 2;
					endif;
					$idti = Pg_Exec("select id_translation from TRANSLATION where translation = '$translation[$i]'");
					$idti = Pg_Fetch_Row ($idti, 0, PGSQL_NUM);
					$idt[$i] = $idti[0];
			  }
			  else {
				$idti = Pg_Fetch_Row ($result_translation1, 0, PGSQL_NUM);
				$idt[$i] = $idti[0];
			  }
		  }
		  else $idt[$i] = 0;
	  }
	}
	else $idt[0] = 0;

      @$result_word0 = Pg_Exec("select id_word from WORD WHERE item = '$item'");
		  if (Pg_NumRows ($result_word0) == 0){
			  $dotaz = "insert into WORD (item, logogram, ref_word, root, note, auth, date, ok) VALUES ('$item', '$logogram', $idref, '$root', '$note', '$auth', '$date', '$ok')";
              //echo "$dotaz<br>";
			  @$result_word = Pg_Exec($dotaz);
			  $dotaz = "select id_word from WORD where item = '$item'";
              //echo $dotaz;
/*                if ($id_word > 0):
//				  if (!$result_word):
				    echo "<H4 align=center>The entry <FONT color=blue>$item</FONT> exists already.</H4>";
//				    break;
				endif;*/
	          @$idw = Pg_Exec($dotaz);
			  $idw = Pg_Fetch_Row ($idw, 0, PGSQL_NUM);
			  $idw = $idw[0];
			  echo "<FONT color=blue>entry:$item<BR></FONT>";
  		  }
		  else {
    	    $idw = Pg_Fetch_Row ($result_word0, 0, PGSQL_NUM);
			$idw = $idw[0];
		  }
	
//xx
    if ($logogram != "" && $idw > 0) {  
	  $dotazfr = "update word set logogram = '$logogram', date = '$date' WHERE id_word = $idw";
//	  echo "$dotazfr";
	  @$result = Pg_exec($dotazfr);
		if (!$result) {
 			echo "Sorry, LOGOGRAM was not correctly updated";	
		 	break;
		}
   }
//xx
   if (sizeof($idt) > 0) {
	  for ($i = 0; $i < sizeof($idt); $i++) {
		  if ($idt[$i] > 0) {
			  $dotaz = "select * from MEANING WHERE id_word = $idw AND id_translation = $idt[$i]";
			  //echo $dotaz;
			  @$result_mean0 = Pg_Exec($dotaz);
			  if (Pg_NumRows ($result_mean0) == 0){
				  @$result_meaning = Pg_Exec("insert into MEANING (id_translation, id_word) values ($idt[$i], $idw)");
				  if (!$result_meaning) {
					  echo "Sorry, the _translation_ was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode 	MS\">$item<br>$text1</FONT>";
						break 2;
				  }
			  }
		  }
	  }
   }
   
   if ($etymon_item != "" && $idw > 0) {
	  $dotaz = "select id_etymon from etymon where id_word = $idw and item = '$etymon_item'";
	  $result_etym = pg_exec($dotaz);
	  if (Pg_NumRows ($result_etym) == 0) {
		$dotaz = "insert into etymon (item, translation, origin, author, title, auth, date, ok, id_word) values ('$etymon_item', '$etymon_translation', '$etymon_origin', '$etymon_author', '$etymon_title', '$auth', '$date', '$ok', $idw)";	
        @$result_etym2 = pg_exec($dotaz);
        if (!$result_etym2) {
	      echo "Sorry, the _etymology_ was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
	      break;
		}
	  }
	  else {
	    // jiz je vlozeno - vypsat??
      }
   }
	
   if ($literature_title != "" && $idw > 0) {
	  $dotaz = "select id_literature from literature where id_word = $idw and title = '$literature_title'";
	  $result_lit = pg_exec($dotaz);
	  if (Pg_NumRows ($result_lit) == 0) {
		$dotaz = "insert into literature (author, title, source, auth, date, ok, id_word) values ('$literature_author', '$literature_title', '$literature_source', '$auth', '$date', '$ok', $idw)";	
        @$result_lit2 = pg_exec($dotaz);
        if (!$result_lit2) {
	      echo "Sorry, the _literature_ was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
	      break;
		}
	  }
	  else {
	    // jiz je vlozeno - vypsat??
      }
   }


   if ($idref != "null") {
     $idw = $idref;
   }
}
else {
      @$result_word0 = Pg_Exec("select id_word from WORD WHERE item = '$item'");
		  if (Pg_NumRows ($result_word0) == 0){
			  echo "<FONT color=blue>Item <b>$item</b> 2was not found.<BR></FONT>";
  		  }
		  else {
    	    $idw = Pg_Fetch_Row ($result_word0, 0, PGSQL_NUM);
			$idw = $idw[0];
		  }
}
//echo "vypis";
// vypis  
  $dotaz = "select id_classification from CLASSIFICATION WHERE id_word = $idw";
//  echo $dotaz;
  @$result_classif = Pg_Exec($dotaz);
//  echo "$dotaz";
  if (Pg_NumRows ($result_classif) > 0){
    //echo "vypis2";
    $result = pg_exec("select id_word, item, logogram, note, date from WORD where id_word = $idw");
    List($id_word, $item, $logogram, $note, $date)= Pg_Fetch_Row ($result, 0, PGSQL_NUM);
    $result = pg_exec("select translation from MEANING left join TRANSLATION on (MEANING.id_translation = TRANSLATION.id_translation) where id_word = $idw");
	$trans_count = Pg_NumRows($result);
	$translation = "";
	for ($i=0; $i < $trans_count; $i++) {
		List($trans) = pg_fetch_row($result, $i);
		$translation .= $trans;
	 	if ($i < $trans_count-1) $translation .= ", ";
	}
    echo "<TABLE><TR><TD CLASS=TD1 align=left><B>$item</B></TD><TD  CLASS=TD2>$translation</TD><TD>$logogram</TD><TD class=td1>note: $note</TD></TR></TABLE>";
    $result = pg_exec("select id_etymon, item, translation, origin, author, title from ETYMON where id_word = $id_word");
    $rows = @Pg_NumRows ($result);
    for ($i=0; $i < $rows; $i++) {
        $row = pg_fetch_row($result, $i);
	    List($id_etymon, $etym_item, $etym_translation, $etym_origin, $etym_author, $etym_title) = $row;
		echo "etymon : $etym_item, $etym_translation, $etym_origin, $etym_author, $etym_title <a href=\"/utf/autor/obdict/2ob4.php?what=$id_etymon&op=edit_etymon&item=$item&auth=$auth\">edit</a><br>";
    }

    $result = pg_exec("select id_literature, author, title, source from LITERATURE where id_word = $id_word");
    $rows = @Pg_NumRows ($result);
    for ($i=0; $i < $rows; $i++) {
        $row = pg_fetch_row($result, $i);
	    List($id_literature, $author, $title, $source) = $row;
		echo "literature : $author: $title, $source <a href=\"/utf/autor/obdict/2ob4.php?what=$id_literature&op=edit_literature&item=$item&auth=$auth\">edit</a><br>";
    }

	echo "<br>";

    $result = pg_exec("select id_classification, CLASSIFICATION.id_translation, class, vclass, stem, person, number1, genderverba, form, subj, vent, val1, figetym, derivation, stemnomina, casus, number2, gender, status, specification, author, date, ok, translation from CLASSIFICATION left join TRANSLATION on (CLASSIFICATION.id_translation = TRANSLATION.id_translation)where id_word = $id_word");
    $rows = @Pg_NumRows ($result);
    for ($i=0; $i < $rows; $i++) {
        $row = pg_fetch_row($result, $i);
	List($id_classification, $id_translation, $class, $vclass, $stem, $person, $number1, $genderverba, $form, $subj, $vent, $val1, $figetym, $derivation, $stemnomina, $casus, $number2, $gender, $status, $specification, $author, $date, $ok, $spec_mean) = $row;
	  if ($class == 'v.'){
		    echo "<TABLE border=1><TR><TD>class</TD><TD>vocalic class</TD><TD>stem</TD><TD>person</TD><TD>number</TD><TD>gender</TD><TD>form</TD><TD>subj.</TD><TD>ventiv</TD><TD>valency</TD><TD>figura etymologica</TD><TD>author</TD><TD>date</TD><TD>OK</TD></TR>";
            echo "<TR><TD>$class</TD><TD>$vclass</TD><TD>$stem</TD><TD>$person</TD><TD>$number1</TD><TD>$genderverba</TD><TD>$form</TD><TD>$subj</TD><TD>$vent</TD><TD>$val1</TD><TD>$figetym</TD><TD>$author</TD><TD>$date</TD><TD>$ok</TD>";
		    echo "<TD><a href=\"/utf/autor/obdict/2ob4.php?what=$id_classification&op=edit_classification&item=$item&auth=$auth\">edit</a></td>";
			echo "</TR>";
      }
		elseif ($class == 's.' || $class == 'adj.') {
    echo "<TABLE border=1><TR><TD>class</TD><TD>derivation</TD><TD>from stem</TD><TD>casus</TD><TD>gender</TD><TD>status</TD><TD>number</TD><TD>specification</TD><TD>author</TD><TD>date</TD><TD>ok</TD></TR>";
            echo "<TR><TD>$class</TD><TD>$derivation</TD><TD>$stemnomina</TD><TD>$casus</TD><TD>$gender</TD><TD>$status</TD><TD>$number2</TD><TD>$specification</TD><TD>$author</TD><TD>$date</TD><TD>$ok</TD>";
    echo "<TD><a href=\"/utf/autor/obdict/2ob4.php?what=$id_classification&op=edit_classification&item=$item&auth=$auth\">edit</a></td></tr>";
        }
        else {//if ($class == 'adv.' || $class == 'prp.') {
    echo "<TABLE border=1><TR><TD>class</TD><TD>form</TD><TD>author</TD><TD>date</TD></TR>";
            echo "<TR><TD>$class</TD><TD>$author</TD><TD>$date</TD><TD>$ok</TD>";
            echo "<TD><a href=\"/utf/autor/obdict/2ob4.php?what=$id_classification&op=edit_classification&item=$item&auth=$auth\">edit</a></td></tr>";
	    }
		
	$dotaz = "select id_context, context from CONTEXT where id_classification = $id_classification";
//	echo $dotaz;
    $t_result = pg_exec($dotaz);
	$t_rows = @Pg_NumRows ($t_result);
	for ($j=0; $j < $t_rows; $j++) {
	        $t_row = pg_fetch_row($t_result, $j);
		List($id_context, $context) = $t_row;
//    $context = htmlentities("$context");
$context = str_replace("<", "&lt;", $context);
$context = str_replace(">", "&gt;", $context);
		echo "<TR><TD colspan=8 BGCOLOR=yellow>$context</TD>";
		$s_result = pg_exec("select source from SOURCE where id_context = $id_context");
		$s_rows = @Pg_NumRows ($s_result);
		for ($k=0; $k < $s_rows; $k++) {
			$s_row = pg_fetch_row($s_result, $k);
			$source = $s_row[0];
			echo "<TD class=vstup colspan=2>$source</TD>";
	    }
	    $lit_result = pg_exec("select id_literature, author, title, source from LITERATURE where id_context = $id_context");
 	    $lit_rows = @Pg_NumRows ($lit_result);
   		for ($l=0; $l < $lit_rows; $l++) {
           $lit_row = pg_fetch_row($lit_result, $l);
           List($id_literature, $lit_author, $lit_title, $lit_source) = $lit_row;
	       echo "<tr><td colspan=12>literature : $lit_author: $lit_title, $lit_source <a href=\"/utf/autor/obdict/2ob4.php?what=$id_literature&item=$item&op=edit_literature&auth=$auth\">edit</a></td></tr>";
        }
    }
//    echo "<TD><a href=\"/utf/autor/obdict/2ob4.php?what=$id_classification&op=edit_classification&item=$item&auth=$auth\">edit</a></td>";
    }
    //break;
  }
  echo "</TR></TABLE>";
  echo "<TABLE width=100% BORDER=0>";
  		/*$idw = Pg_Exec("select id_word from WORD where item = '$item'");
  		$idw = Pg_Fetch_Row ($idw, 0, PGSQL_NUM);
  		$idw = $idw[0];*/

   $result = pg_exec("select translation from MEANING left join TRANSLATION on (MEANING.id_translation = TRANSLATION.id_translation) where id_word = $idw");
	$trans_count = Pg_NumRows($result);
	$translation = "";
	for ($i=0; $i < $trans_count; $i++) {
		List($trans) = pg_fetch_row($result, $i);
		$translation .= $trans;
	 	if ($i < $trans_count-1) $translation .= ", ";
	}

  
  Pg_Close ($connection);

} while (false);
echo "<input type=hidden name=op value=\"insert_2\">";
echo "<input type=hidden name=idw value=\"$idw\">";
echo "</TABLE><table BORDER=1><TR><TD colspan=9>Input new occurrence:</TD></TR>";
echo "<TR><TD><small>class</small></TD><TD collspan=8>translation</TD></TR>";
echo "<TR><TD><select name=class value=\"$class\"><option>0</option><option>adj.</option><option>adv.</option><option>conj.</option><option>int.</option><option>num.</option><option>part.</option><option>pron.</option><option>prp.</option><option>ref.</option><option>s.</option><option>v.</option></select></TD><TD colspan=11><b>$translation</b></TD></TR>";
echo "<TR><TD rowspan=2><SMALL>verba:</SMALL></TD><TD>voc. class</TD><TD>stem</TD></TD><TD>person</TD><TD>number</TD><TD>gender</TD><TD>form</TD><TD>subj.</TD><TD>ventiv</TD></TR>";
echo ("<td><select name=vclass><option></option><option>a/a</option><option>a/u</option><option>u/u</option><option>i/i</option><option>a/i</option><option>e/e</option><option>a/u</option><option>other</option></select></TD>");
echo ("<td><select name=stem><option></option><option>G</option><option>Gt</option><option>Gtn</option><option>D</option><option>Dt</option><option>Dtn</option><option>S</option><option>St</option><option>Stn</option><option>N</option><option>Nt</option><option>Ntn</option><option>R</option><option>Rtn</option><option>RD</option><option>other</option></select></TD>");
echo ("<td><select name=person><option></option><option>3</option><option>2</option><option>1</option></select></td>");
echo ("<td><select name=number1><option></option><option>sg.</option><option>pl.</option><option>du.</option><option>uncl.</option></select></td>");
echo ("<td><select name=genderverba><option></option><option>masc.</option><option>fem.</option><option>uncl.</option></select></td>");
echo ("<td><select name=form><option></option><option>imp.</option><option>opt.</option><option>pf.</option><option>prs.</option><option>proh.</option><option>prt.</option><option>st.</option><option>vet.</option><option>uncl.</option></select></td>");
echo ("<td><select name=subj><option></option><option>yes</option></select></td>");
echo ("<td><select name=vent><option></option><option>am</option><option>ak</option><option>aš</option><option>nim</option><option>nin</option><option>niš</option></select></td>");
echo ("</TR><TR><TD></TD><TD>valency</TD><TD><small>figura etymologica</small></TD><TD colspan=3>collocation <BR><SMALL>specific phrase, e.g. ilkam alākum under alākum</SMALL></TD><TD  colspan=3>specific meaning <BR><SMALL>if same as translation leave blank</SMALL></TD></TR>");
echo ("<TR><TD></TD><td><select name=val1><option></option><option>acc.</option><option>2acc.</option><option>acc. dat.</option><option>ana gen.</option><option>ina gen.</option><option>dat.</option><option>gen.</option><option>else</option></select></td>");
echo ("<td><select name=figetym><option></option><option>yes</option></select></td><td colspan=3><input type=text name=phrase size=30 value=\"\"></TD><td colspan=3><input type=text name=meaning size=30 value=\"\"></TD></TR>");
echo ("<TR><TD rowspan=2><SMALL>substantiva etc.:</SMALL></TD>");
echo ("<TD><SMALL>derivation</SMALL></TD><TD><SMALL>from stem</SMALL></TD><TD><SMALL>casus</SMALL></TD><TD>number</TD><TD>gender</TD><TD>status</TD><TD><small>specification</small></TD><TD colspan=5></TD></TR>");
echo ("<TR><td><select name=derivation><option></option><option>inf.</option><option>pars</option><option>pirs</option><option>purs</option><option>pa:ris</option><option>parra:s</option><option>purussu:</option><option>mu-</option></select></td>");
echo ("<td><select name=stemnomina><option></option><option>G</option><option>Gt</option><option>Gtn</option><option>D</option><option>Dt</option><option>Dtn</option><option>S</option><option>St</option><option>Stn</option><option>N</option><option>Nt</option><option>Ntn</option><option>R</option><option>Rtn</option><option>RD</option><option>other</option></select></TD>");
echo ("<td><select name=casus><option></option><option>nom.</option><option>gen.</option><option>acc.</option><option>gen. acc.</option></select></td>");
echo ("<td><select name=number2><option></option><option>sg.</option><option>sg.t.</option><option>pl.</option><option>pl.t.</option><option>du.</option><option>uncl.</option></select></td>");
echo ("<td><select name=gender><option></option><option>masc.</option><option>fem.</option><option>m. f.</option></select></td>");
echo ("<td><select name=status><option></option><option>st.c.</option><option>st.p.</option><option>st.a.</option></select></td>");
echo ("<td><select name=specification><option></option><option>DN</option><option>FN</option><option>HN</option><option>LL</option><option>PN</option><option>TN</option></select></td>");
echo ("<td colspan=3></td></TR><TR><TD colspan=7>context</TD><TD colspan=2>source</TD><TD colspan=2></TD></TR>");
//$context = htmlentities($context);
echo ("<TR><TD colspan=7><textarea cols=70 rows=3 type=text id=q name=context class=vstup value=\"\"></TEXTAREA></td>");
//$context = htmlentities($context);
echo ("<td colspan=2><input type=text class=vstup name=source value=\"\"></TD>");
echo ("<input type=hidden name=auth value=\"$auth\"><td colspan=2><input type=hidden name=auth value=\"$ok\"</td>");
echo ("<input type=hidden name=translation value=\"$translation\">");
echo "<input type=hidden name=item value=\"$item\">";
echo ("</TR>");
echo "<tr>";
echo "<td colspan=\"9\">literature<br><small>author</small>&nbsp;<input type=\"text\" name=\"literature_author\">&nbsp;<small>title</small>&nbsp;<input type=\"text\" name=\"literature_title\">&nbsp;<small>source</small>&nbsp;<input type=\"text\" name=\"literature_source\"></td>";
echo "</tr>";
?>
<TR><TD>&nbsp;</TD>
<TD colspan=7><INPUT class=tlacitko2 TYPE="SUBMIT" value="  save new occurrence " style="height:30;background-color:#EEFFEE">
</TD></TR>
</table>
<? //include "key.inc.php" ?>
</FORM>
<?
echo "<form METHOD=\"get\" ACTION=\"/utf/utf/sj2.php\">";
?>
<INPUT TYPE="SUBMIT" value="  click to select or add another entry  " style="height:30;background-color:#EEFFEE">
</form>
</body>
</html>