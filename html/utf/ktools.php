<?
include "autorizace.inc.php";
ksa_authorize();
//if ($auth_level == 0) ksa_unauthorized();
if ($auth_level < 10) ksa_unauthorized();
?>
<HTML>
<HEAD>
<META content=text/html;charset=utf-8 http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE>IS - klinopis - prehled moznych ukolu</TITLE>
</HEAD>
<BODY>

<h2><center><strong><u>Základní přehled možných úkolů</u></strong></center></h2>
<br>
<a href="./tools/novadata/vlozeni1graf01.php\">vložení nových dat do tabulky graf01 - názvy a čtení grafémů</b></a><BR>
<BR><a href="./tools/novadata/vlozeni1graf02.php\">vložení nových dat do tabulky graf02 - soupis zpracovaných textů v projektu grafemická analýza </a><BR>
<BR><a href="./tools/novadata/vlozeni1png.php\">vložení nových dat do tabulky images - soupis všech variant v rámci projektu grafemická analýza </a><BR>
<BR><a href="./tools/novadata/vlozeni1obtextp.php\">vložení popisů k novým textům do tabulky obtextp - textový korpus</a><BR>
<BR><a href="./tools/novadata/vlozeni1obtexts.php\">vložení nových textů do tabulky obtexts - textový korpus</a><BR>
<BR><a href="./tools/novadata/vlozeni1obtextsutf.php\">vložení nových textů do tabulky obtexts - textový korpus - UTF8</a><BR>
<BR><a href="./tools/novadata/vlozeni1catalogue.php\">vložení nových popisů do tabulky <b>catalogue</b> - textový korpus</a><BR>
<BR><a href="./tools/novadata/vlozeni1obdict.php\">vložení do tabulky obdict - starobabylónský slovník</a><BR>
<BR><a href="./utf/utf/pokus11.php\">sesrotovani - vytvoreni odkazu ve slovniku v tabulce obdict - starobabylónský slovník</a><BR>
<BR><a href="./tools/novadata/vlozeni1dictrefer.php\">vložení do tabulky dictrefer - názvy hesel a odkazy</a><BR>
<BR><a href="./utf/pokus6.php">sesrotovani obtexts s dictrefer</a><BR>
<BR><a href="./utf/skript2.php">aktualizace zmen obdict do dictrefer</a><BR>
<BR><a href="./tools/author/autorv1.php">sprava uctu aktivnich spolupracovniku</a><BR>
<br><a href="./tools/xml/run.php">Vygenerovani xml - casove znacne narocne</a><br>
<br>
</font>
</BODY>
</HTML>

