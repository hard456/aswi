<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<HTML>
<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>
<BODY>
<h1><center> Data insert into database table obtexts</center></h1>
<br>
<FONT FACE='Unicode Arial MS' SIZE=3>
<?
  if ( ($file1 == ""))
  {
    echo ("Filename not given!<br>\n");
		echo ("<br><br><a href=\"./ktools.html\"> back</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
  $file1="/home/webowner/data-in/bybsrc/".$file1;
  if ( ($fr1 = FOpen ($file1, "r")) == false )
  {
    echo ("The file is probably read-only, check it!<br> Name: ".$file1."\n");
		echo ("<br><br><a href=\"../index.php3\"> Back to tools menu</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
	$konec = false;
	@$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
	require "./fcek2u2.php";
	define ("MAXPOLOZKA", 62690);
	define ("MAXREAD", 62000);
//	$date = Date ("Y-m-d");
	$date = '2003-08-07';
  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
		if ($typdat == 1)	//nova hesla
	      $bookandchapter = StrTok ($text, "^");
	      $paragraph = StrTok ("^");
	      $transliteration = StrTok ("^");
	      $zmena = StrTok ("^");
//      $text = "";
			include "./convertk2u2.php";
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("&nbsp;".$pocethesel."&nbsp;");
			if (StrLen ($number) <= MAXPOLOZKA)
			{
				if (Pg_Exec ("INSERT INTO obtexts (bookandchapter, paragraph, transliteration, stransliteration, autor, date) VALUES ('$webbookandchapter', '$paragraph', '$webtransliteration', '$stransliteration', '$auth_userkod', '$date')"))
				{
					$heseldobre++;
				}
				$state = pg_exec("select rec_state from obtextp where bookandchapter LIKE '%$webbookandchapter%'");
				$state = pg_fetch_row($state, 0);
				$state = $state[0];
				if ($state != 'U' && $state != 'N') {
					pg_exec("update obtextp set rec_state='U' where bookandchapter LIKE '%$webbookandchapter%'");
				}
			}
    }
    else
		$konec = true;
		echo (" &nbsp;&nbsp;&nbsp;$bookandchapter&nbsp;");
	} while (! $konec);
  FClose ($fr1);
	Pg_Close ($spojeni);
	echo ("<hr>Total number of inserted lines: $pocethesel<br>\n");
	echo ("Number of lines inserted: $heseldobre<br>\n");
	echo ("Number of lines which were too long (not inserted): $heselnevlozeno<br>\n");
?>
	<form action="/utf/ktools.php">
		<input type=submit value="back to ktools">
	</form>
</FONT>
</BODY>
</HTML>