<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Cuneiform Circle - about us</title>
<LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
</head>
<body>
<H3 align=center>What is Cuneiform Circle and how to be a member</H3>
<p class=span01>Cuneiform Circle is a circle of scientists engaged in the Old Babylonian 
Akkadian Language. The main current aim is building the Old Babylonian Text Corpus, the Old 
Babylonian Dictionary and the List of Old Babylonian Cuneiform Signs. <br>As we started already in 1988-89 some parts of the job are 
already realized and we are eagerly working on other parts. We are still very unsatisfied with 
the progress and quality of our work and hope we can improve it.<br><br>
</p>
<p class=span01>Old Babylonian Text Corpus (OBTC) on the web is an idea 
arose already in 1995, when I was a member of the Institute of Ancient Near Eastern Studies 
at the Charles University Faculty of Arts - Prague (until 1998). Mainly the technical 
obstacles didn't enabled us to realize it. </P>
<P>Anyway there was some strenge feeling, there should be a way out, some solution. 
Some years later I found it. This important step was enabled by learning the SQL.</P>

<?
$status = true;
	echo ("<FONT FACE='Arial Unicode MS, Code2000, Titus Cyberbit Basic' SIZE=3>");
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection)
	{
    echo "There are probably too many querries, please try again later!";
	}
  else
	{
  if (@$result = @Pg_Exec (
                "SELECT * FROM c_autor"))
	{
  if (($pocethesel = @Pg_NumRows ($result)) > 0)
	{
?>
<P class=vstup>Cuneiform circle is assotiation of friends of Cuneiform studies with 
the main focus in mind - the building of Old Babylonian Text Corpus and related matter (mainly dictionary, sign list etc.).</p>

<P class=vstup>Cuneiform circle does have an editorial board which manage the building 
of Old Babylonian Text Corpus.</p>

<P class=vstup>Everybode who has a serious interest to enter our assotiation is welcome.</p>
<h4>First condition</h4>
<P class=vstup>We suppose a future member does have a certain knowledge degree of Old Babylonian 
Akkadian, i.e. min. M.A. in the field of Assyriology is highly recommend but in some cases not 
indispensable.</p>

<h4>Second condition</h4>
<P class=vstup>To achieve growing range of texts we decide that the full access will be given to the members, who submitted 
transliteration of Old Babylonian texts which are not yet in the corpus in the scope of Frankena's AbB 3, i.e min. 2500 lines.</p>

<h4>Third condition</h4>
<P class=vstup>The future member agrees that every other member can use his transliteration of Old 
Babylonian texts without any other permission and that the editorial board can improve it mainly to unify the way how 
the texts are translitered.</P>


<P class=vstup>Present goals of OBTC (07/2002):</P>
<UL>
<LI> bring united transliteratation of OB texts to enable search of various items</LI>
<LI> to prepare an Old Babylonian Dictionary on this textual basis</LI>
<LI> to prepare a commented list of personal names</LI>
<LI> to prepare a commented list of professional names</LI>
<LI> to prepare a commented list of toponyms</LI>
</UL>
<?
  echo ("Currently there are $pocethesel members of the Cuneiform Circle: <BR><BR>");
  echo "<table border=1 bgcolor=\"#ecece6\" cellspacing=0 cellpadding=3>";
  echo "<tr><em><td><FONT color=#8080ff face=Verdana size=4><small></small></FONT></td></em><td><FONT color=#8080ff face=Verdana size=3>author's first name and surname</FONT></td></tr>";
		for ($i = 0; $i < $pocethesel; $i++)
				{
					List ($kod, $autor) = Pg_Fetch_Row ($result, $i);
          echo "<tr><td>$kod</td><td><FONT FACE=\"Arial Unicode MS, Code2000, Titus Cyberbit Basic\">$autor</FONT></td></tr>";
				}
				echo "</table>";
}
		else
		echo "nothing found!";
}
  Pg_Close($connection);
}
?>
</FONT>
</body>
</html>