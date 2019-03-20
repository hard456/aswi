<?

include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();

  $item = $chain;
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;

  @$result_word0 = Pg_Exec("select id_word from WORD WHERE item like '$item%'");
  if (Pg_NumRows ($result_word0) > 0){
//     Header("Location: http://www.klinopis.cz/utf/autor/obdict/2ob2.php?item=$item");
     Header("Location: /utf/autor/obdict/2ob2.php?item=$item");
  }

?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
<TITLE>Search in Old Babylonian Akkadian Dictionary</TITLE>
</HEAD>
<BODY>
<?  

	  echo "<FONT color=blue>entry:$item<BR></FONT>";

            echo "<TABLE><tr><td class=tlacitko2 colspan=6 align=center><H4>You can now input new dictionary entry or search for an existing one</H4></td></tr>";
			echo "<form id=form1 METHOD=\"get\" name=form1 ACTION=\"/utf/autor/obdict/2ob2.php\">";
			$date = Date ("Y-m-d");
			echo "<tr><td class=td3>entry name or variant</td><td class=td3>refers to</td><TD class=td3 colspan=4><SMALL>entry main translation</SMALL></TD></tr>";
			echo "<tr><td><input class=td3 id=q type=text name=item value='$item'></td>";
			echo "<td><input class=td3 type=text size=12 maxlength=50 name=variants></td>";
			echo "<td class=td3 colspan=4><input type=text class=vstup size=12 name=translation[0] value=\"\">&nbsp;<input type=text class=vstup size=12 name=translation[1] value=\"\">&nbsp;<input type=text class=vstup size=12 name=translation[2] value=\"\"></TD></TR>";
			echo "<tr><td class=td3>logogram</td><td class=td3>* root</td><td class=td3>note</td><td class=td3></td></tr><tr><td class=td3><input class=vstup type=text size=16 maxlength=50 name=logogram></td>";
			echo "<td><input class=td3 type=text size=5 maxlength=20 name=root></td>";
			echo "<td><input class=td3 type=text size=30 name=\"note\"></td>";
			echo "<input type=hidden name=\"op\" value=\"insert_1\">";
			echo "<input type=hidden name=\"auth\" value=\"$auth_userkod\">";
			echo "<input type=hidden name=\"date\" value=\"$date\">";
			echo "<td class=td3></td></tr>\n";
			echo "<tr><td class=td3>etymology if available:</td></tr>";
			echo "<tr><td class=td3>entry from another language</td><td class=td3>translation</td><td class=td3>origin of the etymology</td></tr>";
			echo "<tr><td class=td3><input type=text class=vstup name=etymon_item></td>";
			echo "<td class=td3><input type=text name=etymon_translation></td>";
			echo "<td class=td3><select name=etymon_origin><option></option><option></option><option>amor.</option><option>arab.</option><option>aram.</option><option>ethiop.</option><option>hebr.</option><option>protoeufr.</option><option>sum.</option><option>uncl.</option></select></td></tr>";
			echo "<tr><td class=td3>author</td><td class=td3>title</td><td class=td3>author's abbreviation</td></tr>";
			echo "<tr><td class=td3><input name=etymon_author></td>";
			echo "<td class=td3><input type=text name=etymon_title></td><td class=td3>$auth_userkod</TD></tr>";
			echo "<tr><td colspan=3 class=td3>Reference to the secondary literature if available:</td></tr>";
			echo "<tr><td class=td3>literature author</td><td class=td3>literature title</td><td class=td3>literature source</TD></TR>";
			echo "<tr><td class=td3><input type=text name=literature_author></td>";
			echo "<td class=td3><input type=text name=literature_title></td>";
			echo "<td class=td3><input type=text name=literature_source></td></tr>";
			echo "</TABLE>";

?>
<TABLE><TR><TD>
<INPUT class=tlacitko2 TYPE="SUBMIT" value="  send new or existing item   " style="height:30;background-color:#EEFFEE">
</TD></TR>
</FORM>
</TABLE>
<?
include "key.inc.php";
if ($auth_level == 10) {
					echo "";
				        }
					else {
					include "key.inc.php";
					}
?>
</BODY>
</HTML>