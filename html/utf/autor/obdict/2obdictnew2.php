<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Selected items from the Old Babylonian Dictionary</title>
</head>
<body>
<?
$status = true;
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Nepodarilo se pripojit k datab�zi!";
    break;
  endif;
  $zmena ='1';
  $datum = Date ("Y-m-d");
  @$result_word = Pg_Exec("insert into WORD (item) VALUES ('$item')");
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>The item <b>$item</b> by the author <b>$autor</b> were correctly inserted into the dictionary.<BR>Please close this window!</FONT>";
  if (!$result_word) {
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
    $result = pg_exec("select id_word, item from WORD where item = '$item'");
    List($id_word, $item)= Pg_Fetch_Row ($result, 0, PGSQL_NUM);
    echo "item : $item<br>";
    $result = pg_exec("select CLASSIFICATION.id_translation, type, translation from CLASSIFICATION left join TRANSLATION on (CLASSIFICATION.id_translation = TRANSLATION.id_translation)where id_word = $id_word");
    $rows = @Pg_NumRows ($result);
    for ($i=0; $i < $rows; $i++) {
        $row = pg_fetch_row($result, $i);
	List($id_translation, $type, $translation) = $row;
	echo "\t type : $type \t translation : $translation<br>";
	$t_result = pg_exec("select id_context, context from CONTEXT where id_translation = $id_translation and id_word=$id_word");
	$t_rows = @Pg_NumRows ($t_result);
	for ($j=0; $j < $t_rows; $j++) {
	        $t_row = pg_fetch_row($t_result, $j);
		List($id_context, $context) = $t_row;
		echo "\t\t context : $context,";
		$s_result = pg_exec("select source from SOURCE where id_context = $id_context");
		
		$s_rows = @Pg_NumRows ($s_result);
		for ($k=0; $k < $s_rows; $k++) {
			$s_row = pg_fetch_row($s_result, $k);
			$source = $s_row[0];
			echo " $source";
	        }
		

        }

    }

    break;
  }

  $idw = Pg_Exec("select id_word from WORD where item = '$item'");
  $idw = Pg_Fetch_Row ($idw, 0, PGSQL_NUM);
  $idw = $idw[0];
/*  @$result_translation = Pg_Exec("insert into TRANSLATION (translation) VALUES ('$text1')");
  if (!$result_translation):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
    break;
  endif;

  $idt = Pg_Exec("select id_translation from TRANSLATION where translation = '$text1'");
  $idt = Pg_Fetch_Row ($id, 0, PGSQL_NUM);
  $idt = $idt[0];
  @$result = Pg_Exec("insert into CLASSIFICATION (id_word, id_translation) VALUES ($idw, $idt)");
  echo "<FONT FACE='Arial Unicode MS' SIZE=3>The item <b>$item</b> and description <b>$text1</b> <br>by the author <b>$autor</b> were correctly inserted into the dictionary.<BR>Please close this window!</FONT>";
  if (!$result):
    echo "Sorry, the item was not correctly inserted into the dictionary!<BR><FONT FACE=\"Arial Unicode MS\">$item<br>$text1</FONT>";
    break;
  endif;
*/
  Pg_Close ($connection);
} while (false);
?>

<FORM id=form2 METHOD="post" name=form2 ACTION="/utf/autor/obdict/2obdictnew3.php">
<? 
echo "<input type=hidden name=idw value=\"$idw\">";
echo ("<tr><td>author's a.</td><td><select name=\"autor\"><option>zh01</option><option>sl01</option><option>nn01</option><option>lp01</option><option>jp01</option><option>fr02</option></select></td></tr>\n");
//echo "<input type=hidden name=autor value=\"$autor\">"; 
?>
translation :<textarea class=vstup id=q name="translation" cols=60 rows=5 value="">
</textarea>
<BR>
type :<input type=text name=type value=\"$type\">";
<BR>
context :<input type=text name=context value=\"$context\">";
<BR>
source :<input type=text name=source value=\"$source\">";
<BR>

<TABLE>
<TR>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00E1;' onclick="Add2Str('&#x00E1;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00E9;" onclick="Add2Str('&#x00E9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00ED;" onclick="Add2Str('&#x00ED;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00FA;" onclick="Add2Str('&#x00FA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F3;" onclick="Add2Str('&#x00F3;')"></TD>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00C1;' onclick="Add2Str('&#x00C1;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C9;" onclick="Add2Str('&#x00C9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00CD;" onclick="Add2Str('&#x00CD;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00DA;" onclick="Add2Str('&#x00DA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D3;" onclick="Add2Str('&#x00D3;')"></TD>
</TR>
<TR>
<TD WIDTH=82>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00E0;' onclick="Add2Str('&#x00E0;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00E8;" onclick="Add2Str('&#x00E8;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00EC;" onclick="Add2Str('&#x00EC;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F9;" onclick="Add2Str('&#x00F9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F2;" onclick="Add2Str('&#x00F2;')"></TD>
<TD>&nbsp;</TD><TD>&nbsp;&nbsp;&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C0;" onclick="Add2Str('&#x00C0;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C8;" onclick="Add2Str('&#x00C8;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00CC;" onclick="Add2Str('&#x00CC;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D9;" onclick="Add2Str('&#x00D9;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D2;" onclick="Add2Str('&#x00D2;')"></TD>
</TR><TR>

<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x00E2;' onclick="Add2Str('&#x00E2;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00EA;" onclick="Add2Str('&#x00EA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00EE;" onclick="Add2Str('&#x00EE;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00FB;" onclick="Add2Str('&#x00FB;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00F4;" onclick="Add2Str('&#x00F4;')"></TD>
</TD><TD>&nbsp;</TD><TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00C2;" onclick="Add2Str('&#x00C2;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00CA;" onclick="Add2Str('&#x00CA;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00DB;" onclick="Add2Str('&#x00DB;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x00D4;" onclick="Add2Str('&#x00D4;')"></TD>
</TR>

<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value='&#x0101;' onclick="Add2Str('&#x0101;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0113;" onclick="Add2Str('&#x0113;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x012B;" onclick="Add2Str('&#x012B;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x016B;" onclick="Add2Str('&#x016B;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x014D;" onclick="Add2Str('&#x014D;')"></TD>
</TD><TD>&nbsp;</TD><TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0100;" onclick="Add2Str('&#x0100;')"></TD>

<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0112;" onclick="Add2Str('&#x0112;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x012A;" onclick="Add2Str('&#x012A;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x016A;" onclick="Add2Str('&#x016A;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x014C;" onclick="Add2Str('&#x014C;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E63;" onclick="Add2Str('&#x1E63;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0161;" onclick="Add2Str('&#x0161;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E6D;" onclick="Add2Str('&#x1E6D;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="ḫ" onclick="Add2Str('ḫ')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E62;" onclick="Add2Str('&#x1E62;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x0160;" onclick="Add2Str('&#x0160;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E6C;" onclick="Add2Str('&#x1E6C;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E2A;" onclick="Add2Str('&#x1E2A;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD WIDTH=90>&nbsp;</TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E63;" onclick="Add2Str('&#x1E63;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x0161;" onclick="Add2Str('&#x0161;')"></TD>
<TD><INPUT class=tlacitko1 style="height:30;width:30" TYPE=button value="&#x1E6D;" onclick="Add2Str('&#x1E6D;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="ḫ" onclick="Add2Str('ḫ')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E62;" onclick="Add2Str('&#x1E62;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x0160;" onclick="Add2Str('&#x0160;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E6C;" onclick="Add2Str('&#x1E6C;')"></TD>
<TD><INPUT class=tlacitko2 style="height:30;width:30" TYPE=button value="&#x1E2A;" onclick="Add2Str('&#x1E2A;')"></TD>
</TR>
</TABLE>

<TABLE>
<TR>
<TD>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  send new item definition  " style="height:30;background-color:#EEFFEE">
</TD>
</TR>
</FORM>

</body>
</html>