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
<FORM id=form1 METHOD="post" name=form1 ACTION="/utf/autor/obdict/2ob3.php">
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $date = Date ("Y-m-d");
  if ($op == "edit_classification")	{
    $result = pg_exec("select CLASSIFICATION.id_translation, id_word, class, vclass, stem, person, number1, genderverba, form, subj, vent, val1, figetym, derivation, stemnomina, casus, gender, number2, status, specification, author, date, ok, phrase, translation from CLASSIFICATION left join TRANSLATION on (CLASSIFICATION.id_translation = TRANSLATION. id_translation) where id_classification = $what");
    List($id_translation, $id_word, $class, $vclass, $stem, $person, $number1, $genderverba, $form, $subj, $vent, $val1, $figetym, $derivation, $stemnomina, $casus, $gender, $number2, $status, $specification, $author, $date, $ok, $phrase, $meaning)= Pg_Fetch_Row ($result, 0, PGSQL_NUM);
    $result_word = pg_exec("select item from WORD where id_word = $id_word");
    List($item)= Pg_Fetch_Row ($result_word, 0, PGSQL_NUM);
    $result = pg_exec("select translation from MEANING left join TRANSLATION on (MEANING.id_translation = TRANSLATION.id_translation) where id_word = $id_word");
    $trans_count = Pg_NumRows($result);
    $translation = "";
    for ($i=0; $i < $trans_count; $i++) {
    	List($trans) = pg_fetch_row($result, $i);
    	$translation .= $trans;
     	if ($i < $trans_count-1) $translation .= ", ";
    }
    echo "<H3 class=tlacitko2 align=center>Selected dictionary entry : <B>$item</B></H3>";
    echo "<TABLE>";
    echo "<input type=hidden name=op value=\"update_4\">";
    echo "<input type=hidden name=ok value=\"$ok\">";
    echo "<input type=hidden name=auth value=\"$auth\">";
    echo "<input type=hidden name=what value=\"$what\">";
//pozor tady
    echo "<input type=hidden name=item value=\"$item\">";
    echo "<input type=hidden name=idw value=\"$id_word\">";
    echo "<input type=hidden name=idt value=\"$id_translation\">";
    echo "<TR><TD colspan=9>&nbsp;</TD></TR><TR><TD colspan=9>You can here edit the selected occurrence and save it under your author's abbreviation:&nbsp;$auth</TD></TR>";
    echo "<TR><TD><small>class</small></TD><TD>translation</TD></TR>";
    echo "<TR><TD><select name=class><option>$class</option><option>adj.</option><option>adv.</option><option>conj.</option><option>int.</option><option>num.</option><option>part.</option><option>pron.</option><option>prp.</option><option>s.</option><option>v.</option><option>uncl.</option></select></TD><TD>$translation</TD></TR>";
    echo "</TABLE><table BORDER=1><TR><TD rowspan=2><SMALL>verba:</SMALL></TD><TD>voc. class</TD><TD>stem</TD></TD><TD>person</TD><TD>number</TD><TD>gender</TD><TD>form</TD><TD>subj.</TD><TD>ventiv</TD><TD>valency</TD><TD>figura etymologica</TD><TD>collocation and specific meaning <BR><SMALL>if same as translation leave blank</SMALL></TD></TR>";
    echo ("<td><select name=vclass><option>$vclass</option><option>a/a</option><option>a/u</option><option>u/u</option><option>i/i</option><option>a/i</option><option>e/e</option><option>a/u</option><option>other</option></select></TD>");
    echo ("<td><select name=stem><option>$stem</option><option>G</option><option>Gt</option><option>Gtn</option><option>D</option><option>Dt</option><option>Dtn</option><option>S</option><option>St</option><option>Stn</option><option>N</option><option>Nt</option><option>Ntn</option><option>R</option><option>Rtn</option><option>RD</option><option>other</option></select></TD>");
    echo ("<td><select name=person><option>$person</option><option>3</option><option>2</option><option>1</option></select></td>");
    echo ("<td><select name=number1><option>$number1</option><option></option><option>sg.</option><option>pl.</option><option>du.</option><option>uncl.</option></select></td>");
    echo ("<td><select name=genderverba><option>$genderverba</option><option></option><option>masc.</option><option>fem.</option><option>uncl.</option></select></td>");
    echo ("<td><select name=form><option>$form</option><option>imp.</option><option>opt.</option><option>pf.</option><option>prs.</option><option>proh.</option><option>prt.</option><option>st.</option><option>vet.</option><option>uncl.</option></select></td>"); 
    echo ("<td><select name=subj><option>$subj</option><option></option><option>yes</option></select></td>");
    echo ("<td><select name=vent><option>$vent</option><option></option><option>am</option><option>aš</option><option>nim</option><option>niš</option></select></td>");
    echo ("<td><select name=val1><option>$val1</option><option></option><option>acc.</option><option>2acc.</option><option>acc. dat.</option><option>ana gen.</option><option>ina gen.</option><option>dat.</option><option>gen.</option><option>else</option></select></td>");
    echo ("<td><select name=figetym><option>$figetym</option><option></option><option>yes</option></select></td>");
    echo ("<td colspan=3><input type=text name=phrase size=30 value=\"$phrase\"></TD>");
    echo ("</TR><TR></TD>&nbsp;<TD></TR>");
    echo ("<TR><TD rowspan=2><SMALL>substantiva etc.:</SMALL></TD>");
    echo ("<TD><SMALL>derivation</SMALL></TD><TD><SMALL>from stem</SMALL></TD><TD><SMALL>casus</SMALL></TD><TD>number</TD><TD>gender</TD><TD>status</TD><TD>specification</TD><TD></TD><TD></TD><TD></TD></TR>");
    echo ("<TR><td><select name=derivation><option></option><option>inf.</option><option>pars</option><option>pirs</option><option>purs</option><option>pa:ris</option><option>parra:s</option><option>purussu:</option><option>mu-</option></select></td>");
    echo ("<td><select name=stemnomina><option></option><option>G</option><option>Gt</option><option>Gtn</option><option>D</option><option>Dt</option><option>Dtn</option><option>S</option><option>St</option><option>Stn</option><option>N</option><option>Nt</option><option>Ntn</option><option>R</option><option>Rtn</option><option>RD</option><option>other</option></select></TD>");
    echo ("<td><select name=casus><option>$casus</option><option></option><option>nom.</option><option>gen.</option><option>acc.</option><option>gen. acc.</option></select></td>");
    echo ("<td><select name=number2><option>$number2</option><option></option><option>sg.</option><option>sg.t.</option><option>pl.</option><option>pl.t.</option><option>du.</option><option>uncl.</option></select></td>");
    echo ("<td><select name=gender><option>$gender</option><option></option><option>masc.</option><option>fem.</option><option>m. f.</option></select></td>");
    echo ("<td><select name=status><option>$status</option><option></option><option>st.c.</option><option>st.p.</option><option>st.a.</option></select></td>");
    echo ("<td><select name=specification><option>$specification</option><option></option><option>DN</option><option>FN</option><option>HN</option><option>LL</option><option>PN</option><option>TN</option></select></td>");
    echo ("<td colspan=3></td><td colspan=3><input type=text name=meaning size=30 value=\"$meaning\"></TD>");
    echo ("<td>$translation</td></TR>");
       $t_result = pg_exec("select id_context, context from CONTEXT where id_classification = $what");
      $t_rows = @Pg_NumRows ($t_result);
      for ($j=0; $j < $t_rows; $j++) {
        $t_row = pg_fetch_row($t_result, $j);
        List($id_context, $context) = $t_row;
      	echo "<TR><TD colspan=7><input type=hidden name=id_context[$j] value=$id_context>";
        echo "<textarea class=vstup id=q name=context[$j] cols=65 rows=3>$context</textarea></TD>";
     	$s_result = pg_exec("select id_source, source from SOURCE where id_context = $id_context");
     	$s_rows = @Pg_NumRows ($s_result);
        echo "<TD colspan=2>";
     	for ($k=0; $k < $s_rows; $k++) {
        	$s_row = pg_fetch_row($s_result, $k);
    	    List($id_source, $source) = $s_row;
    		echo "<input type=hidden name=id_source[$j][$k] value=$id_source>";
    		echo "<input type=text name=source[$j][$k] class=vstup value=\"$source\"><br>";
   		
    	}
        echo "</TD>";
    }
  }
  elseif ($op == "edit_literature") {
    $result = pg_exec("select author, title, source from LITERATURE where id_literature = $what");
    List($lit_author, $lit_title, $lit_source)= Pg_Fetch_Row ($result, 0, PGSQL_NUM);
    echo "<H3 class=tlacitko2 align=center>Selected entry : <B>$item</B></H3>";
    echo "<TABLE>";
    echo "<input type=hidden name=op value=\"update_lit_4\">";
    echo "<input type=hidden name=ok value=\"$ok\">";
    echo "<input type=hidden name=auth value=\"$auth\">";
    echo "<input type=hidden name=what value=\"$what\">";
    echo "<input type=hidden name=item value=\"$item\">";
    echo "<TR><TD colspan=9>&nbsp;</TD></TR><TR><TD colspan=9>You can here edit the selected occurrence and save it under your author's abbreviation:&nbsp;$auth</TD></TR>";
    echo "<TR><TD>author</TD><TD>title</TD><td>source</td></TR>";
    echo "<td><input type=\"text\" name=\"lit_author\" value=\"$lit_author\"></td>";
    echo "<td><input type=\"text\" name=\"lit_title\" value=\"$lit_title\"></td>";
    echo "<td><input type=\"text\" name=\"lit_source\" value=\"$lit_source\"></td>";
  }
  elseif ($op == "edit_etymon") {
    $result = pg_exec("select item, translation, origin, author, title from ETYMON where id_etymon = $what");
    List($etym_item, $etym_translation, $etym_origin, $etym_author, $etym_title)= Pg_Fetch_Row ($result, 0, PGSQL_NUM);
    echo "<H3 class=tlacitko2 align=center>Selected entry : <B>$item</B></H3>";
    echo "<TABLE>";
    echo "<input type=hidden name=op value=\"update_etym_4\">";
    echo "<input type=hidden name=ok value=\"$ok\">";
    echo "<input type=hidden name=auth value=\"$auth\">";
    echo "<input type=hidden name=what value=\"$what\">";
    echo "<input type=hidden name=item value=\"$item\">";
    echo "<TR><TD colspan=9>&nbsp;</TD></TR><TR><TD colspan=9>You can here edit the selected occurrence and save it under your author's abbreviation:&nbsp;$auth</TD></TR>";
    echo "<TR><TD>item</TD><TD>translation</TD><td>origin</td><td>author</td><td>title</td></TR>";
    echo "<td><input type=\"text\" name=\"etym_item\" value=\"$etym_item\"></td>";
    echo "<td><input type=\"text\" name=\"etym_translation\" value=\"$etym_translation\"></td>";
    echo "<td><input type=\"text\" name=\"etym_origin\" value=\"$etym_origin\"></td>";
    echo "<td><input type=\"text\" name=\"etym_author\" value=\"$etym_author\"></td>";
    echo "<td><input type=\"text\" name=\"etym_title\" value=\"$etym_title\"></td>";
  }

  Pg_Close ($connection);
} while (false);
?>
<TR>
<TD>&nbsp;</TD>
<TD colspan=7>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  save edited occurrence " style="height:30;background-color:#EEFFEE">
</TD>
</TR>
</FORM>
</table>
<? include "key.inc.php" ?>
</body>
</html>