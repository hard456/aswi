<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from the Old Babylonian Dictionary</title>
</head>
<body>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $date = Date ("Y-m-d");
if ($op == "insert_2") {
  @$result_mean = Pg_exec("select id_translation from translation where translation = '$meaning'");
  if (Pg_NumRows ($result_mean) == 0) {
    $dotaz = "insert into TRANSLATION (translation) values ('$meaning')";
    @$result = Pg_Exec($dotaz);
    if (!$result) {
      echo "Sorry, SPECIFIC TRANSLATION was not correctly inserted to database";	
      break;
    }
    @$result = Pg_Exec("select id_translation from translation where translation = '$meaning'");
    $id_trans = Pg_Fetch_Row($result, 0);
    $id_trans = $id_trans[0];
  }
  else {
    $id_trans = Pg_Fetch_Row($result_mean, 0);
    $id_trans = $id_trans[0];
  }
  @$result_class = Pg_Exec("select id_classification from CLASSIFICATION WHERE id_word = $idw AND class = '$class' AND vclass = '$vclass' AND stem = '$stem' AND person = '$person' AND number1 = '$number1' AND genderverba = '$genderverba' AND form = '$form' AND subj = '$subj' AND vent = '$vent' AND val1 = '$val1' AND figetym = '$figetym' AND derivation = '$derivation'  AND stemnomina = '$stemnomina'  AND casus = '$casus' AND number2 = '$number2' AND gender = '$gender' AND status = '$status' AND specification = '$specification'");
  if (Pg_NumRows ($result_class) == 0){
          $dotaz = "insert into CLASSIFICATION (id_word, id_translation, class, vclass, stem, person, number1, genderverba, form, subj, vent, val1, figetym, derivation, stemnomina, casus, number2, gender, status, specification, author, date, ok, phrase) VALUES ($idw, $id_trans, '$class', '$vclass', '$stem', '$person', '$number1', '$genderverba', '$form', '$subj', '$vent', '$val1', '$figetym', '$derivation', '$stemnomina', '$casus', '$number2', '$gender', '$status', '$specification', '$auth', '$date', '$ok', '$phrase')";
		  @$result = Pg_Exec($dotaz);
		  if (!$result):
		    echo "Sorry, the _CLASSIFICATION_ was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$type<br></FONT>";
		    break;
		  endif;
          @$idclass = Pg_Exec("select MAX(id_classification) from CLASSIFICATION");
		  $idclass = Pg_Fetch_Row ($idclass, 0, PGSQL_NUM);
		  $idclass = $idclass[0];
  }
  else {
        $idclass = Pg_Fetch_Row ($result_class, 0, PGSQL_NUM);
		$idclass = $idclass[0];
  }
  @$result_context = Pg_Exec("select id_context from CONTEXT WHERE context = '$context' AND id_classification = $idclass");
  if (Pg_NumRows ($result_context) == 0){
		  $dotaz = 	"insert into CONTEXT (id_classification, context) VALUES ($idclass, '$context')";
		  @$result = Pg_Exec($dotaz);
		  if (!$result):
		    echo "$dotaz, Sorry, the _CONTEXT_ was not correctly inserted into the dictionary!";
		    break;
		  endif;
          $idc = Pg_Exec("select id_context from CONTEXT where context = '$context' AND id_classification = $idclass");
		  $idc = Pg_Fetch_Row ($idc, 0, PGSQL_NUM);
		  $idc = $idc[0];
  }
  else {
		  $idc = Pg_Fetch_Row ($result_context, 0, PGSQL_NUM);
		  $idc = $idc[0];
  }
  @$result_source = Pg_Exec("select id_source from source WHERE source = '$source' AND id_context = $idc");
  if (Pg_NumRows ($result_source) == 0){
		  @$result = Pg_Exec("insert into SOURCE (id_context, source) VALUES ($idc, '$source')");
		  if (!$result):
		    echo "Sorry, the _SOURCE_ was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$source<br></FONT>";
		    break;
		  endif;
  }
  else {
	// zadany zdroj i kontext jiz existuje - vypsat
  }

   if ($literature_title != "" && $idc > 0) {
	  $dotaz = "select id_literature from literature where id_context = $idc and title = '$literature_title'";
	  $result_lit = pg_exec($dotaz);
	  if (Pg_NumRows ($result_lit) == 0) {
		$dotaz = "insert into literature (author, title, source, auth, date, ok, id_context) values ('$literature_author', '$literature_title', '$literature_source', '$auth', '$date', '$ok', $idc)";	
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


} // end if op == "insert_2"
elseif ($op == "update_4") {
  @$result_mean = Pg_exec("select id_translation from translation where translation = '$meaning'");
  if (Pg_NumRows ($result_mean) == 0) {
    $dotaz = "insert into TRANSLATION (translation) values ('$meaning')";
    @$result = Pg_Exec($dotaz);
    if (!$result) {
      echo "Sorry, SPECIFIC TRANSLATION was not correctly inserted to database";	
      break;
    }
    @$result = Pg_Exec("select id_translation from translation where translation = '$meaning'");
    $id_trans = Pg_Fetch_Row($result, 0);
    $id_trans = $id_trans[0];
  }
  else {
    $id_trans = Pg_Fetch_Row($result_mean, 0);
    $id_trans = $id_trans[0];
  }
  if ($auth_level == 10) {
  $ok = 1;
  }
  else {
  $ok = 0;
  }
  $dotaz = "update classification set class = '$class', vclass = '$vclass', stem = '$stem', person = '$person', number1 = '$number1', genderverba = '$genderverba', form = '$form', subj = '$subj', vent = '$vent', val1 = '$val1', figetym = '$figetym', derivation = '$derivation', stemnomina = '$stemnomina', casus = '$casus', number2 = '$number2', gender = '$gender', status = '$status', specification = '$specification', author = '$auth', date = '$date', ok = $ok, id_translation = $id_trans, phrase = '$phrase' WHERE id_classification = $what";
//  echo $dotaz;
  @$result = Pg_exec($dotaz);
  if (!$result) {
    echo "Sorry, CLASSIFICATION was not correctly updated";	
    break;
  }
  $c_rows = sizeof($id_context);
  //echo $c_rows;
  for ($i = 0; $i < $c_rows; $i++) {
    $dotaz = "update context set context = '$context[$i]' where id_context = $id_context[$i]";
    @$result = Pg_exec($dotaz);
    // osetrit chybu??
    $s_rows = sizeof($id_source);
    for ($j = 0; $j < $s_rows; $j++) {
    	$dotaz = "update source set source = '{$source[$i][$j]}' where id_source = {$id_source[$i][$j]}";
	    @$result = Pg_exec($dotaz);
    	// osetrit chybu??
	}  
  }
}
elseif ($op == "update_4") {
  @$result_mean = Pg_exec("select id_translation from translation where translation = '$meaning'");
  if (Pg_NumRows ($result_mean) == 0) {
    $dotaz = "insert into TRANSLATION (translation) values ('$meaning')";
    @$result = Pg_Exec($dotaz);
    if (!$result) {
      echo "Sorry, SPECIFIC TRANSLATION was not correctly inserted to database";	
      break;
    }
    @$result = Pg_Exec("select id_translation from translation where translation = '$meaning'");
    $id_trans = Pg_Fetch_Row($result, 0);
    $id_trans = $id_trans[0];
  }
  else {
    $id_trans = Pg_Fetch_Row($result_mean, 0);
    $id_trans = $id_trans[0];
  }
  $dotaz = "update classification set class = '$class', vclass = '$vclass', stem = '$stem', person = '$person', number1 = '$number1', genderverba = '$genderverba', form = '$form', subj = '$subj', vent = '$vent', val1 = '$val1', figetym = '$figetym', derivation = '$derivation', stemnomina = '$stemnomina', casus = '$casus', number2 = '$number2', gender = '$gender', status = '$status', specification = '$specification', author = '$auth', date = '$date', ok = $ok, id_translation = $id_trans, phrase = '$phrase' WHERE id_classification = $what";
//  echo $dotaz;
  @$result = Pg_exec($dotaz);
  if (!$result) {
    echo "Sorry, CLASSIFICATION was not correctly updated";	
    break;
  }
  $c_rows = sizeof($id_context);
  //echo $c_rows;
  for ($i = 0; $i < $c_rows; $i++) {
    $dotaz = "update context set context = '$context[$i]' where id_context = $id_context[$i]";
    @$result = Pg_exec($dotaz);
    // osetrit chybu??
    $s_rows = sizeof($id_source);
    for ($j = 0; $j < $s_rows; $j++) {
    	$dotaz = "update source set source = '{$source[$i][$j]}' where id_source = {$id_source[$i][$j]}";
	    @$result = Pg_exec($dotaz);
    	// osetrit chybu??
	}  
  }
}
elseif ($op == "update_lit_4") {
  @$result_lit = Pg_exec("update LITERATURE set author='$lit_author', title='$lit_title', source='$lit_source' where id_literature=$what");
  if (!$result_lit) {
      echo "Sorry, LITERATURE was not correctly edited";	
      break;
  }
}
elseif ($op == "update_etym_4") {
  @$result_lit = Pg_exec("update ETYMON set item='$etym_item', translation='$etym_translation', origin='$etym_origin', author='$etym_author', title='$etym_title' where id_etymon=$what");
  if (!$result_lit) {
      echo "Sorry, LITERATURE was not correctly edited";	
      break;
  }
}


echo "<FONT FACE='Arial Unicode MS' SIZE=3>New occurrence of <b>$item</b> and description were correctly inserted into the OB dictionary by the author:&nbsp; $auth.</FONT>";
  Pg_Close ($connection);
} while (false);
echo "<form METHOD=\"get\" ACTION=\"/utf/autor/obdict/2ob2.php\">";
echo "<input type=hidden name=item value=\"$item\">";
echo "<input type=hidden name=idw value=\"$idw\">";
echo ("<input type=hidden name=idt value=\"$idt\">");
echo ("<input type=hidden name=auth value=\"$auth\">");
?>
<INPUT TYPE="SUBMIT" value="  click to go back to add or edit another occurrence " style="height:30;background-color:#EEFFEE">
</form>
<?
echo "<form METHOD=\"get\" ACTION=\"/utf/utf//sj2.php\">";
?>
<INPUT TYPE="SUBMIT" value="  click to select or add another entry  " style="height:30;background-color:#EEFFEE">
</form>
</body>
</html>