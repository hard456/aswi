<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>Description of the selected items from the Old Babylonian Corpus</title>
<script language="JavaScript">
<!--
function openWindow(url, name)
{
popupWin = window.open(url, name, "scrollbars,resizable,width=740,height=490");
}
//-->
</script>
</head>
<body>
<FONT FACE='Verdana' Color="#9bbad6">
<h2 align=center>Provisional Version of Catalogue of OBTC texts</FONT></h2>
<p> If you are registrated member, you can also use <a href="http://www.klinopis.cz/nobtc/search-catalogue.php">text catalogue of OBTC v. 2</a>. </p>

<p align=justify>Please note, that this is a provisional version of the catalogue. You can choose any text and see the transliteration. <BR>It can take a while  to get the selection, please, have patience.</p>
<P align=justify>
<?
$type = 'document';
echo "<UL><LI><a href=\"javascript:openWindow('./obtexttype.php?type=$type', 'popwinP')\">documents</A>";
$origin = 'Kisura';
$type = 'document';
echo "<UL><LI><a href=\"javascript:openWindow('./obtexttype.php?origin=$origin&type=$type', 'popwinP')\">documents from Kisura</A>";
$origin = 'Kis';
$type = 'document';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?origin=$origin&type=$type', 'popwinP')\">documents from Kish</A>";
$origin = 'Lagaba';
$type = 'document';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?origin=$origin&type=$type', 'popwinP')\">documents from Lagaba</A>";
$origin = 'Larsa';
$type = 'document';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?origin=$origin&type=$type', 'popwinP')\">documents from Larsa</A>";
$origin = 'Tell Harmal';
$type = 'document';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?origin=$origin&type=$type', 'popwinP')\">documents from Tell Harmal</A>";
$origin = 'Ugarit';
$type = 'document';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?origin=$origin&type=$type', 'popwinP')\">documents from Ugarit</A></UL></UL>";
$type = 'letter';
echo "<UL><LI><a href=\"javascript:openWindow('./obtexttype.php?type=$type', 'popwinP')\">letters</A>";
$book = 'AbB_1';
echo "<UL><LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 1</A>";
$book = 'AbB_2';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 2</A>";
$book = 'AbB_3';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 3</A>";
$book = 'AbB_4';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 4</A>";
$book = 'AbB_5';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 5</A>";
$book = 'AbB_6';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 6</A>";
$book = 'AbB_7';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 7</A>";
$book = 'AbB_8';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 8</A>";
$book = 'AbB_9';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 9</A>";
$book = 'AbB_10';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 10</A>";
$book = 'AbB_11';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 11</A>";
$book = 'AbB_12';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 12</A>";
$book = 'AbB_13';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">AbB 13</A>";
$book = 'ABIM_';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">ABIM</A>";
$book = 'ARM_1';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">ARM 1 work in progress</A>";
$book = 'ARM_10';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">ARM 10</A>";
$book = 'AS_22';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">Letters from Eshnuna - AS 22</A>";
$book = 'Sumer_14';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">50 OB letters from Harmal - Sumer 14</A></LI></UL></UL>";
$type = 'legal texts';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?type=$type', 'popwinP')\">legal texts</A></LI><UL>";
$book = 'LE';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">The Laws of Eshnuna</A></LI>";
$book = 'CH';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">Codex Hammu-rapi</A></LI>";
$book = 'Ammi-ṣaduqaEdikt_A';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">Edikt of Ammi-saduqa A</A></LI></UL>";
$type= 'mathematics';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?type=$type', 'popwinP')\">mathematics - in preparation</A>";
$type = 'omina';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?type=$type', 'popwinP')\">omina - new 05/2004 - in preparation</A>";
$book = 'UM_1,2,';
echo "<UL><LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">smoke omina UM 1/2,99</A></LI>";
$book = 'YOS_10';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?book=$book', 'popwinP')\">šumma izbum omina YOS X,56</A></LI></UL></UL>";
$type = 'royal inscription';
echo "<LI><a href=\"javascript:openWindow('./obtexttype.php?type=$type', 'popwinP')\">royal inscription</A>";
?>
</UL>
</P>
<BR>
</FONT>
</body>
</html>
