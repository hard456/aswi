<?

function chyba()
	{
	 global $radek;	

	 printf("\n<BR>Pri zpracovani radku  %s  se vyskytla chyba!!!!!\n<BR>",$radek);
	 echo "</body></html>";
	 exit();
	}

function chyba2()
	{
	 global $radek;	

	 printf("\n<BR>2x: Pri zpracovani 2radku  %s  se vyskytla chyba!!!!!\n<BR>",$radek);
	 echo "</body></html>";
	 exit();
	}

function chyba3()
	{
	 global $radek;	

	 printf("\n<BR>3: Pri zpracovani 3radku  %s  se vyskytla chyba!!!!!\n<BR>",$radek);
	 echo "</body></html>";
	 exit();
	}
function chyba4()
	{
	 global $radek;	

	 printf("\n<BR>4: Pri zpracovani 4radku  %s  se vyskytla chyba!!!!!\n<BR>",$radek);
	 echo "</body></html>";
	 exit();
	}
function chyba5()
	{
	 global $radek;	

	 printf("\n<BR>5: Pri zpracovani 5radku  %s  se vyskytla chyba!!!!!\n<BR>",$radek);
	 echo "</body></html>";
	 exit();
	}

function zpracuj_heslo()
{
	global $heslo;
	global $vysledek;

	$vysledek.=" ";
	$vysledek.=$heslo;
//	echo "<BR>".$vysledek;
	$heslo="";
	return;
}

function zpracuj_radek()
	{
		global $radek;
  	global $heslo;

		$i=0;
		$d=strlen($radek);
		$stav=0;
//		echo "<BR>Cely radek".$radek;
		while ($i<$d)
			{
				 $c=$radek[$i];
				 $i++;
				 switch($stav)
				   {
				    case 0: if($c=='<A HREF="http://www.klinopis.cz/utf/utf/t.php?s=') {$stav=1;break;}
						    if($c==' ') break;
						    else {$stav=9;$heslo.=$c;$j=1;break;}

//				    case 1: if($c=='<a href') {$stav=2;}
//	    					else chyba2();
//						    break;

				    case 2: if($c=='>') {$stav=3;}
						    break;

				    case 3: if($c=='<')	{$stav=4;}
						    else  {$heslo.=$c;}
						    break;

				    case 4: if (($c=='b')||($c=='B')) {$stav=5;break;}
						    if ($c=='/'){$stav=7;zpracuj_heslo();}
						    else chyba();
					 	    break;

				    case 5: if((($c=='a')||($c=='A'))&&($radek[$i-2]=='/')) $stav=6;
						    break;

				    case 6: if ($c=='>') {$stav=0;}
						    else chyba3();
						    break;

				    case 7: if(($c=='a')||($c=='A')) $stav=8;
						    else chyba4();
						    break;

				    case 8: if($c=='>') {$stav=0;}
						    else chyba5();
						    break;

				    case 9: if ($c==' ') {zpracuj_heslo(); $stav=0;}
						    else {$heslo.=$c;}
						    break;

				    default: break;
				   }
			}

  		if ($stav==9) {zpracuj_heslo();}
		if (($stav==9)||($stav==0)) /*printf("\n<BR>Probehlo to OK!")*/;
		else chyba();

	return;
	}

$vysledek="";
$heslo="";
zpracuj_radek();

?>
