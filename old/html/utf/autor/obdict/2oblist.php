<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>All entries from the Old Babylonian Dictionary</title>
</head>
<body>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Database reported: I am lazy and busy!";
    break;
  endif;
  echo "<H4 align=center>All entries in the OBD</H4>";
  $result = pg_exec("select id_classification, CLASSIFICATION.id_translation, CLASSIFICATION.id_word, class, vclass, stem, person, number1, form, subj, vent, casus, gender, number2, status, specification, author, CLASSIFICATION.date, CLASSIFICATION.ok, phrase, translation, item, WORD.id_translation from CLASSIFICATION left join TRANSLATION on (CLASSIFICATION.id_translation = TRANSLATION. id_translation) left join WORD on (WORD.id_word = CLASSIFICATION.id_word) where item LIKE '$chain%'");
  $rows = Pg_NumRows($result);

  if ($rows > 0) {
	echo "<table border=1>";
    echo "<tr><td>entry</td><td>class</td><td>translation</td><td>context</td><td>source</td><td>edit</td><tr>";
  	for ($i = 0 ; $i < $rows; $i++) {
      List($id_classification, $id_translation, $id_word, $class, $vclass, $stem, $person, $number1, $form, $subj, $vent, $casus, $gender, $number2, $status, $specification, $author, $date, $ok, $phrase, $meaning, $item, $translation)= Pg_Fetch_Row ($result, $i, PGSQL_NUM);
      $result_translation = pg_exec("select translation from TRANSLATION where id_translation = $translation");
      List($translation)= Pg_Fetch_Row ($result_translation, 0, PGSQL_NUM);
	  echo "<tr><td><b>$item</b></td><td>$class</td>";
	  echo "<td>\"$translation\"</td>";
	  if ($phrase != "" && $meaning != "") echo ", $phrase : \"$meaning\"";
	  elseif ($meaning != "") echo ", \"$meaning\"";	
	  
	  $dotaz = "select id_context, context from context where id_classification = $id_classification";	
      $result_con = pg_exec($dotaz);
      $c_rows = Pg_NumRows($result_con);
	  
      for ($j = 0; $j < $c_rows; $j++) {
        List($id_context, $context)= Pg_Fetch_Row ($result_con, $j, PGSQL_NUM);
        echo "<td BGCOLOR=yellow>$context</td>";
        $dotaz = "select source from source where id_context = $id_context";
        @$result_source = Pg_exec($dotaz);
        $s_rows = Pg_NumRows($result_source);
           for ($k = 0; $k < $s_rows; $k++) {
             List($source)= Pg_Fetch_Row ($result_source, $k, PGSQL_NUM);
             echo "<td>$source";
           }  
      }
	  echo "</td><td> <a href=\"/utf/autor/obdict/2ob4.php?what=$id_classification\">edit</a></td>";
      echo "</tr>";
    }
  }
  else {
	echo "nothing found";
  }

  
  echo "<table>";
  Pg_Close ($connection);
} while(false); 
?>
</body>
</html>