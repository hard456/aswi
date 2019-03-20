<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Edit an item from the Old Babylonian Text Corpus</title>
</head>
<body>
<?
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
	if (! $spojeni)
	{
    echo ("The database is overcrowded or it is down, sorry!<BR>\n");
		exit;
	}
    
    echo $text1;
    $text = $text1;
    $transliteration = HTMLSpecialChars($text1);
//    require "http://www.klinopis.cz/utf/tools/novadata/fcek2u2.php";
//    include "http://www.klinopis.cz/utf/tools/novadata/convertk2u2.php";
    require "./fcek2u2.php";
    include "./convertk2u2.php";
		if (@Pg_Exec ($spojeni, "UPDATE obtexts SET transliteration='$webtransliteration', stransliteration='$stransliteration', autor='$autor' WHERE (bookandchapter like '$bookandchapter%' AND paragraph='$paragraph')"))
			echo ("<BR>Item saved successfully.<BR><BR>\n");
		else			
		{
			echo ("An error occured, item change was not saved !<br>Error!\n");
		}
  @$result = Pg_Exec("select * from obtexts WHERE (bookandchapter like '$bookandchapter%' AND paragraph='$paragraph')");
  if (!$result):
    echo "There was an error, sorry!";
    break;
  endif;
  @$result2 = Pg_Exec("select * from obtexts WHERE (bookandchapter like '$bookandchapter%' AND paragraph='$paragraph')");
  echo "<table border=1>";
  Pg_NumRows($result2);
  $zaznam = Pg_Fetch_Array($result2, $j);
  echo ("<tr><td><b>book and chapter</b></td><td><b>paragraph&nbsp;</b></td><td>transliteration</td><td>stripped transliteration</td><TD>autor's abbreviation</TD></tr>\n");
  echo ("<tr><td>".$zaznam["bookandchapter"]."</td><td>".$zaznam["paragraph"]."):&nbsp;</td><td><FONT FACE='Arial Unicode MS' SIZE=3><b>".$zaznam["transliteration"]."</b></FONT></td><td><FONT FACE='Arial Unicode MS' SIZE=3><b>".$zaznam["stransliteration"]."</b></FONT></td><TD align=\"right\">".$zaznam["autor"]."</TD></tr>\n");
  echo "</table>";
  echo "<form><BR>&nbsp;&nbsp;&nbsp;";
  echo "<INPUT TYPE=\"Button\" VALUE=\"Bring me back to the selected text and click reload button (usually F5 for IE or Ctrl plus r for Mozilla in Linux).\" onClick=\"history.go(-2)\">";                
  echo "</form>";
	Pg_Close ($spojeni);
?>
</body>
</html>