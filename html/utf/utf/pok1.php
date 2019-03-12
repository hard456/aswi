<html>
<head>
<title>Pokusy</title>
</head>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Selection of attested variants according to syllabic value</title>
<STYLE TYPE="text/css">
<!--
body {font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;}
.tlacitko2 {cursor:hand;font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;font-weight:normal;font-size:100%;color:#000000;background-color:#FFFFEE}
.vstup {font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;font-weight:normal;font-size:100%;color:#000000;background-color:#FFFFFF}
.tlacitko1 {cursor:hand;font-family:Arial Unicode MS,TITUS Cyberbit Basic,Code2000;font-weight:normal;font-size:80%;color:#000000;background-color:#FFFFEE}
-->
</STYLE>
<SCRIPT>
<body topmargin="15" leftmargin="15" bgcolor="#EFF1FF">
<BODY BGCOLOR="#FFFFFF">
<FORM id=form1 method="get" name=form1 action="http://www.klinopis.cz/utf/utf/show2syllabic.php">
<H3><FONT FACE="Arial Unicode MS, TITUS Cyberbit Basic, Code2000" color=#3399ff>Selection of variants according to syllabical value</H3>
<p>Type in syllabical value to see all attested variants in the corpus used for Old Babylonian Graphemic Analyses:<br>
<small>e.g. lam, ṭup etc. (if you don't see the special characters properly, you need to install a font with Unicode support.</small>
</p>
<!--
function Add2Str(str){var str;document.form1.q.value+=str;document.form1.q.focus();}
-->
</SCRIPT>
</head>
Type in:
<INPUT class=vstup id=q name="borger" size=15 maxlength=100 value="">
<? $borger = urlencode($borger); ?><BR>
<? 
echo "Ahoj";
require "./keyboard.php";
?>
</body>
</html>

