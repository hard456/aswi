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
<h1><center> Data input into database table obtextp</center></h1>
<br>
<FONT FACE='Unicode Arial MS' SIZE=3>
<?
  if ( ($file1 == ""))
  {

    echo ("Filename not given!<br>\n");
		echo ("<br><br><a href=\"./vlozeni1obtextp.php\"> back</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
  $file1="/home/webowner/data-in/bybsrc/".$file1;
  if ( ($fr1 = FOpen ($file1, "r")) == false )
  {
    echo ("Impossible to open the file, is it read-only? Check it!<br> Name: ".$file1."\n");
		echo ("<br><br><a href=\"../index.php3\"> back to tools menu of klinopis.cz</a>");
    echo ("</BODY>");
    echo ("</HTML>");
    exit;
  }
	$konec = false;
	@$spojeni = Pg_Connect ("user=dbowner dbname=klinopis");
//vlozeni FCI pro konverzi
	require "./fcek2u2.php";
	define ("MAXPOLOZKA", 31690);
	define ("MAXREAD", 50000);
//	$datum = Date ("Y-m-d");
	$datum = '2003-08-07';
  do
  {
    if (($text = FGetS ($fr1, MAXREAD)) != false )
    {
		if ($typdat == 1)	//nova hesla
	      $book = StrTok ($text, "^");
	      $descriptionp = StrTok ("^");
	      $chapter = StrTok ("^");
	      $bookandchapterp = StrTok ("^");
	      $origin = StrTok ("^");

			include "./convertk2u2.php";
			echo ($book." \n");
			$pocethesel++;
			if (($pocethesel % 100) == 0) echo ("&nbsp;".$pocethesel."&nbsp;");
			if (StrLen ($book) <= MAXPOLOZKA)
			{
		if (@$msg = Pg_Exec ($spojeni, "INSERT INTO obtextp (book, descriptionp, bookandchapterp, chapter, autor, datum, type, origin) VALUES ('$book', '$webdescriptionp', '$webbookandchapterp', '$webchapter', '$auth_userkod', '$datum', '$type', '$origin')"))
					{
						$heseldobre++;
					}
			}
    }
    else
		$konec = true;
		echo (" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	} while (! $konec);
  FClose ($fr1);
	Pg_Close ($spojeni);
	echo ("<hr>Total number of inserted lines: $pocethesel<br>\n");
	echo ("Number of lines inserted: $heseldobre<br>\n");
	echo ("Number of lines which were too long (not inserted): $heselnevlozeno<br>\n");
?>
	<form action="/utf/ktools.php">
		<input type=submit value="back to tools menu of klinopis.cz">
	</form>
</FONT>
</BODY>
</HTML>