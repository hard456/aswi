<?
/*
%b, %/b -bold; %i, %/i -italic; %u, %/u -underline; %h, %/h -horni index; %d, %/d -dolni index;
%s, %/s -skryty text; %t, %/t -casovy udaj
%l - enter
%%p - promile; %%m - mensirovno; %%v - vetsirovno; %%i - identita; %%n - nerovna se
%%s - zn. stupne %%+ - krizek (umrti) %%o - odmocnina %%e - 2vlnky
%%f - funkce, %%8 - nekonecno, %%g - Gausuv integral, %%r - prunik
á  è  ï  é  ì  í  ¾  å  ò  ó  ø  š    ù  ú  ý  ž
Á  È  Ï  É  Ì  Í  ¼  Å  Ò  Ó  Ø  Š    Ù  Ú  Ý  Ž
%"aA, eE, iI, oO, uU, sS - prehlasovana pism.
%'aA, eE, iI, oO, uU, yY, wW - pismena s obracenou carkou nahore
%,aA, cC, eE, gG, iI, kK, lL, nN, rR, sS, tT, uU - pismena s carkou dole
%~aA, iI, nN, oO - pismena s vlnkou nahore
%;dD, lL, oO, tT	- preskrtnute
%?e, f, l, p - Euro, Frank, Libra, Peny
%!a...	- recka abeceda
%-a, A, e, E, i, I, o, O, u, U - pismena s -
%(a, A, e, E, i, I, o, O, u, U - pismena s ^
%_a, A - a s krouzkem
<,> -pro WAP do EscapeS
%)a, A, e, E, g, G, i, I, o, O, u, U - pismena s kulatym hackem nahore
*/

//odtraneni nekterych '/'
	$nazev = StripSlashes($nazev);
	$popis = StripSlashes($popis);

//ULOZENI nazev a popis pro SCR
	$srcnazev = AddSlashes ($nazev);
	$srcpopis = AddSlashes ($popis);

//------------------------------------
// skryj casti v popisu
  $nazev = SkryjText ($nazev);
  $popis = SkryjText ($popis);

//----------------------------------------------
//NAZEV pro WEB

	$webnazev = ProvedFormat ($nazev);
	$webnazev = ZUvozovky2B ($webnazev);
	$webnazev = ZProcento2B ($webnazev);
	$webnazev = ZApostrof2B ($webnazev);
	$webnazev = ZCarka2B ($webnazev);
	$webnazev = ZVlnka2B ($webnazev);
	$webnazev = ZStrednik2B ($webnazev);
	$webnazev = ZOtaznik2B ($webnazev);
	$webnazev = ZVykricnik2B ($webnazev);
	$webnazev = ZPomlcka2B ($webnazev);
	$webnazev = ZLZavorka2B ($webnazev);
	$webnazev = ZPZavorka2B ($webnazev);
	$webnazev = ZPodtrzitko2B ($webnazev);
	$webnazev = AddSlashes ($webnazev);

//POPIS pro WEB
	$webpopis = ProvedFormat ($popis);
	$webpopis = ZEnter ($webpopis, "<br>"); // web enter <br>
	$webpopis = ZUvozovky2B ($webpopis);
	$webpopis = ZProcento2B ($webpopis);
	$webpopis = ZApostrof2B ($webpopis);
	$webpopis = ZCarka2B ($webpopis);
	$webpopis = ZVlnka2B ($webpopis);
	$webpopis = ZStrednik2B ($webpopis);
	$webpopis = ZOtaznik2B ($webpopis);
	$webpopis = ZVykricnik2B ($webpopis);
	$webpopis = ZPomlcka2B ($webpopis);
	$webpopis = ZLZavorka2B ($webpopis);
	$webpopis = ZPZavorka2B ($webpopis);
	$webpopis = ZPodtrzitko2B ($webpopis);
	$webpopis = AddSlashes ($webpopis);

//----------------------------------------------
	//obstraneni BOLD, ITALIC, UNDERLINE, HORNI INDEX, DOLNI INDEX
	$popisTR = ZrusFormat ($popis);
	$nazevTR = ZrusFormat ($nazev);

//transformace pro ASCII
//NAZEV

	$ascnazev = CS2ASCII ($nazevTR);
	$ascnazev = ZUvozovkyASCII ($ascnazev);
	$ascnazev = ZProcentoASCII ($ascnazev);
	$ascnazev = ZApostrofASCII ($ascnazev);
	$ascnazev = ZCarkaASCII ($ascnazev);
	$ascnazev = ZVlnkaASCII ($ascnazev);
	$ascnazev = ZStrednikASCII ($ascnazev);
	$ascnazev = ZOtaznikASCII ($ascnazev);
	$ascnazev = ZVykricnikASCII ($ascnazev);
	$ascnazev = ZPomlckaASCII ($ascnazev);
	$ascnazev = ZLZavorkaASCII ($ascnazev);
	$ascnazev = ZPZavorkaASCII ($ascnazev);
	$ascnazev = ZPodtrzitkoASCII ($ascnazev);
	$ascnazev = AddSlashes ($ascnazev);

//POPIS ASCII
	$ascpopis = CS2ASCII ($popisTR);
	$ascpopis = ZEnter ($ascpopis, "");  //ASCII enter -----
	$ascpopis = ZUvozovkyASCII ($ascpopis);
	$ascpopis = ZProcentoASCII ($ascpopis);
	$ascpopis = ZApostrofASCII ($ascpopis);
	$ascpopis = ZCarkaASCII ($ascpopis);
	$ascpopis = ZVlnkaASCII ($ascpopis);
	$ascpopis = ZStrednikASCII ($ascpopis);
	$ascpopis = ZOtaznikASCII ($ascpopis);
	$ascpopis = ZVykricnikASCII ($ascpopis);
	$ascpopis = ZPomlckaASCII ($ascpopis);
	$ascpopis = ZLZavorkaASCII ($ascpopis);
	$ascpopis = ZPZavorkaASCII ($ascpopis);
	$ascpopis = ZPodtrzitkoASCII ($ascpopis);
	$ascpopis = AddSlashes ($ascpopis);

//---------------------------------------------------------
//transformace pro WAP

//NAZEV WAP
	$wapnazev = CS2EscapeS ($nazevTR);
	$wapnazev = ZVetsiMensiEscapeS ($wapnazev);
	$wapnazev = ZUvozovkyEscapeS ($wapnazev);
	$wapnazev = ZProcentoEscapeS ($wapnazev);
	$wapnazev = ZApostrofEscapeS ($wapnazev);
	$wapnazev = ZCarkaEscapeS ($wapnazev);
	$wapnazev = ZVlnkaEscapeS ($wapnazev);
	$wapnazev = ZStrednikEscapeS ($wapnazev);
	$wapnazev = ZOtaznikEscapeS ($wapnazev);
	$wapnazev = ZVykricnikEscapeS ($wapnazev);
	$wapnazev = ZPomlckaEscapeS ($wapnazev);
	$wapnazev = ZLZavorkaEscapeS ($wapnazev);
	$wapnazev = ZPZavorkaEscapeS ($wapnazev);
	$wapnazev = ZPodtrzitkoEscapeS ($wapnazev);
	$wapnazev = AddSlashes ($wapnazev);

//POPIS WAP
	$wappopis = CS2EscapeS ($popisTR);
	$wappopis = ZVetsiMensiEscapeS ($wappopis);
	$wappopis = ZEnter ($wappopis, "<br/>");	//wap enter <br/>
	$wappopis = ZUvozovkyEscapeS ($wappopis);
	$wappopis = ZProcentoEscapeS ($wappopis);
	$wappopis = ZApostrofEscapeS ($wappopis);
	$wappopis = ZCarkaEscapeS ($wappopis);
	$wappopis = ZVlnkaEscapeS ($wappopis);
	$wappopis = ZStrednikEscapeS ($wappopis);
	$wappopis = ZOtaznikEscapeS ($wappopis);
	$wappopis = ZVykricnikEscapeS ($wappopis);
	$wappopis = ZPomlckaEscapeS ($wappopis);
	$wappopis = ZLZavorkaEscapeS ($wappopis);
	$wappopis = ZPZavorkaEscapeS ($wappopis);
	$wappopis = ZPodtrzitkoEscapeS ($wappopis);
	$wappopis = AddSlashes ($wappopis);
?>