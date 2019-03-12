<?
include "autorizace.inc.php";

function print_line($t_translation, $t_item, $t_class, $t_context, $t_source)
{
    global $p_translation, $p_item, $p_class, $p_context, $auth_level, $item, $id_classification ;

        	    echo "<tr>";
				if ($t_translation == $p_translation) {
					$t_translation = "";
					if ($t_item == $p_item) {
						$t_item = "";
						if ($t_class == $p_class) {
							$t_class = "";
							if ($t_context == $p_context) {
								$t_context = "";
							}
							else {
								$p_context = $t_context;
							}
						}
						else {
							$p_class = $t_class;
							$p_context = $t_context;
						}
					}
					else {
						$p_item = $t_item;
						$p_class = $t_class;
						$p_context = $t_context;
					}
				}
				else {
					$p_translation = $t_translation;
					$p_item = $t_item;
					$p_class = $t_class;
					$p_context = $t_context;
				}
				if ($t_item == "") $t_item = "&nbsp;";
				if ($t_class == "") $t_class = "&nbsp;";
				if ($t_translation == "") $t_translation = "&nbsp;";
				if ($t_context == "") $t_context = "&nbsp;";
				if ($t_source == "") $t_source = "&nbsp;";
    	        echo "<td><a href=\"/utf/autor/obdict/2ob2.php?item=$item&op=insert_1&auth=$auth_userkod&date=$date\" target=\"MAIN\">$t_item</A></td>";    
//        	    echo "<td>$t_class</td>";    
	            echo "<td class=td3>$t_translation</td>";    
//	            echo "<td>$t_context</td>";    
//    	        echo "<td>$t_source</td>";    
//			    if ($auth_level == 10) {
//					echo "<td><a href=\"/utf/autor/obdict/2obdelete.php?item=$item&id_classification=$id_classification\">delete now</a></td>";
//		        }
        	    echo "</tr>";    

}


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
  $dotaz = "select id_classification, CLASSIFICATION.id_translation, WORD.id_word, class, vclass, stem, person, number1, form, subj, vent, casus, gender, number2, status, specification, author, CLASSIFICATION.date, CLASSIFICATION.ok, phrase, translation, item, ref_word from CLASSIFICATION left join TRANSLATION on (CLASSIFICATION.id_translation = TRANSLATION.id_translation) right outer join WORD on (CLASSIFICATION.id_word = WORD.id_word) where item LIKE '$chain%' ORDER BY item, class";
  //echo $dotaz;
  $result = pg_exec($dotaz);
  $rows = Pg_NumRows($result);
  if ($rows > 0) {
	echo "<table border=1>\n";
    echo "<tr>\n<td class=td3>entry - click to edit</td>\n<td class=td3>class</td>\n<td class=td3>translation</td>\n<td class=td3>context</td>\n<td class=td3>source</td>\n<td class=td3>delete</td>\n</tr>\n";
  	for ($i = 0 ; $i < $rows; $i++) {
      List($id_classification, $id_translation, $id_word, $class, $vclass, $stem, $person, $number1, $form, $subj, $vent, $casus, $gender, $number2, $status, $specification, $author, $date, $ok, $phrase, $meaning, $item, $ref_word)= Pg_Fetch_Row ($result, $i, PGSQL_NUM);

	  $dotaz = "select translation from MEANING left join TRANSLATION on (MEANING.id_translation = TRANSLATION.id_translation) where id_word = $id_word";
      //echo $dotaz;
      $result_translation = pg_exec($dotaz);
      $trans_count = Pg_NumRows($result_translation);
//      echo "<tr>\n<td class=td3><b><a href=\"/utf/autor/obdict/2ob2.php?item=$item&op=insert_1&auth=$auth_userkod&date=$date\" target=\"MAIN\">$item</a></b></td>\n";
//<a href=\"/utf/utf/st.php\" target=\"_blank\">
	  $f_item = $item;
      $f_class = $class;
	  if ($trans_count > 0) {
 	      $translation = "";
	      for ($j=0; $j < $trans_count; $j++) {
		    List($trans) = pg_fetch_row($result_translation, $j);
		    $translation .= $trans;
	 	    if ($j < $trans_count-1) $translation .= ", ";
	      }

          //echo "<td class=td3>$class</td>\n";
          //echo "<td class=td3>\"$translation\"";
          //if ($phrase != "" && $meaning != "") echo ", $phrase : \"$meaning\"";
	      //elseif ($meaning != "") echo ", \"$meaning\"";	
	      //echo "</td>\n";
		  $f_translation = "\"$translation\"";
          if ($phrase != "" && $meaning != "") $f_translation .= ", $phrase : \"$meaning\"";
	      elseif ($meaning != "") $f_translation .= ", \"$meaning\"";	

       }
       elseif ($ref_word > 0) {
	   	  $dotaz = "select item from word where id_word = $ref_word";
		  $result_ref = pg_exec($dotaz);
		  List($ref_word) = Pg_Fetch_Row($result_ref, 0);
		  //echo "<td colspan=2 class=td3>see $ref_word</td>";
		  $f_class = "see $ref_word";
       }
       else {
		   $f_translation = "";
         //echo "<td /><td />";
       }
	  
	   if ($id_classification > 0) {
	     $dotaz = "select id_context, context from context where id_classification = $id_classification";	
         $result_con = pg_exec($dotaz);
         $c_rows = Pg_NumRows($result_con);
	  
         for ($j = 0; $j < $c_rows; $j++) {
           List($id_context, $context)= Pg_Fetch_Row ($result_con, $j, PGSQL_NUM);
           //echo "<td class=td3 BGCOLOR=yellow>$context</td>\n";
		   $f_context = $context;
           $dotaz = "select source from source where id_context = $id_context";
           @$result_source = Pg_exec($dotaz);
           $s_rows = Pg_NumRows($result_source);
		   if ($s_rows > 0) {
	           for ($k = 0; $k < $s_rows; $k++) {
		           List($source)= Pg_Fetch_Row ($result_source, $k, PGSQL_NUM);
			       //echo "<td class=td3>$source</td>\n";
				   $f_source = $source;
					print_line($f_translation, $f_item, $f_class, $f_context, $f_source);
		       }  
		   }	
		   else {
			   $f_source = "";
				print_line($f_translation, $f_item, $f_class, $f_context, $f_source);
		   }
         }
       }
	   else {
		   $f_context = "";
		   $f_source = "";
			print_line($f_translation, $f_item, $f_class, $f_context, $f_source);
	   }
       //echo "</tr>\n";
    } // end for all items
  }
  else {
	echo "nothing found";
  }
  Pg_Close ($connection);
} while(false); 
?>
</table>
</body>
</html>
