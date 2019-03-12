<?
Header("Pragma: no-cache");
Header("Cache-Control: no-cache");
Header("Expires: ".GMDate("D, d M Y H:i:s")." GMT");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Pokusy</title>
</head>

<body>
<?


function chyba()
	{
	 printf("\n<BR>Je tam chyba !!!!!\n<BR>");
	 echo "</body></html>";
	 exit();
	}

function zpracuj_heslo()
	{
	  global $heslo;
	  global $heslo2;
	  global $pocet_hesel;
	  global $slovnik;
	  global $radek2;
	 
	  $pocet_hesel++;

	  $ignoruj=Array("&lt;D:&gt;","&lt;B:&gt;" );  //slova pro ignorovani
//	  printf("\n<BR>Heslo je :  %s",$heslo);

  
	  $delka=strlen($heslo);
	  for ($k=0;$k<$delka;$k++)
		{
		   if(($heslo[$k]=='[')||($heslo[$k]==']')||($heslo[$k]=='ý')||($heslo[$k]=='þ')) continue;
		   $heslo2.=$heslo[$k];
		}
 
	  for ($k=0;$k<Count($ignoruj);$k++):
	  	$delka2=strlen($heslo2);
		$pomocny="";
//		echo "<BR> Hledam: ".$ignoruj[$k];
	
		if (($pos=StrPos($heslo2,$ignoruj[$k]))||(($heslo2[0]==$ignoruj[$k][0])&&($heslo2[1]==$ignoruj[$k][1])))
    	 {
//		  echo " nalezeno na pozici: ".$pos;
		  $t=strlen($ignoruj[$k]);					
		  if ($pos==0)
			{
			  for ($t;$t<=$delka2;$t++) { $pomocny.=$heslo2[$t];}
			}
  		  else
			{
   			  for ($s=0;$s<$pos;$s++)	{ $pomocny.=$heslo2[$s];}
			  for ($pos+$t;$pos+$t<$delka2;$pos++) {$pomocny.=$heslo2[$pos+$t];}
			}
		  $heslo2=$pomocny;
		  $k--;
    	 }	
// 	    else	echo " Nenalezeno";
	  endfor;

// 	  printf("\n<BR>Upravene heslo je :  %s ",$heslo2);
// 	  echo "<BR>Hledam v : ".$slovnik[$heslo2];
	  if ($radek2[0]!="") $radek2.=" ";
	  if (IsSet($slovnik[$heslo2]))
		{

		 $radek2.=odkaz1;
		 $radek2.=($slovnik[$heslo2][1]);
		 $radek2.=odkaz2;
		 $radek2.=$heslo;
		 $radek2.=odkaz3;
	 
//	     printf ("\n<BR><FONT  color=\"Green\">Nalezeno!<HR></FONT>");
		}
	  else	
		{
		 $radek2.=$heslo;
//	  	 printf ("\n<BR><FONT  color=\"Red\" >Nenalezeno!<HR></FONT>");
		}

	  $heslo="";
	  $heslo2="";
  return;
}



function zpracuj_radek()
	{
		global $radek;
		global $heslo;

		$i=0;
		$d=strlen($radek);
		$stav=0;
//		printf("\n<BR>Radka je\n<BR> %s\n<BR>",$radek);

		while ($i<$d)
			{
				 $c=$radek[$i];
				 $i++;
				 switch($stav)
				   {
				    case 0: if($c=='<') {$stav=1;break;}
						    if($c==' ') break;
						    else {$stav=9;$heslo.=$c;$j=1;break;}

				    case 1: if(($c=='a')||($c=='A')) {$stav=2;}
	    					else chyba();
						    break;

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
						    else chyba();
						    break;

				    case 7: if(($c=='a')||($c=='A')) $stav=8;
						    else chyba();
						    break;

				    case 8: if($c=='>') {$stav=0;}
						    else chyba();
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


static $heslo ="";
static $heslo2 ="";
static $radek ="";
static $radek2 ="";
static $pocet_hesel=0;
static $slovnik;

define("odkaz1","<A HREF=\"http://www.klinopis.cz/utf/utf/search.php?chain=+");
define("odkaz2","\">");
define("odkaz3","</A>");

@$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
	if (!$spojeni):
		echo "Nepodarilo se pripojit k PostgreSQL.<BR>\n";
		die ("</body></html>");
	endif;

@$vysledek = Pg_Exec($spojeni, "SELECT item1,refer1 FROM dictrefer order by item1,refer1");
	if (!$vysledek):
		echo "Doslo k chybe pri zpracovani dotazu v databazi slovicek.<BR>\n";
		die ("</body></html>");
	endif;
	echo "V tabulce dictrefer je ".Pg_NumRows($vysledek)." slovicek.<BR>\n";

	for ($m=0; $m < Pg_NumRows($vysledek); $m++):
	    $zaznam = Pg_Fetch_Array($vysledek, $m);

		if (IsSet($slovnik[$zaznam["refer1"]]))	
			   {
			     end ($slovnik[$zaznam["refer1"]]);	
			     $d=key($slovnik[$zaznam["refer1"]]);
			     $d+=1;
			   }
		else  $d=1;
		$slovnik[$zaznam["refer1"]][$d]=$zaznam["item1"];

	endfor;


// Vypis slovniku
/*
reset ($slovnik);
do
{
  $ukazatel=key($slovnik);
  reset ($slovnik[$ukazatel]);
  echo "<HR><BR>".$ukazatel."<BR>";
   do
    {
     echo key($slovnik[$ukazatel])."<BR>";
     echo current($slovnik[$ukazatel])."<BR>";
    }while (next($slovnik[$ukazatel]));

}while (next($slovnik));
*/


@$vysledek = Pg_Exec($spojeni, "SELECT * FROM obtexts");
	if (!$vysledek):
		echo "Doslo k chybe pri zpracovani dotazu v databazi.<BR>\n";
		die ("</body></html>");
	endif;
	echo "V tabulce obtexts je ".Pg_NumRows($vysledek)." radku.<BR>\n";

	for ($m=0; $m < Pg_NumRows($vysledek); $m++):
	    $zaznam = Pg_Fetch_Array($vysledek, $m);
//	    echo $zaznam["bookandchapter"]." ".$zaznam["paragraph"]." ".$zaznam["transliteration"]."<BR>\n";
        $radek=$zaznam["transliteration"];
		$radek2="";
		zpracuj_radek();
		echo "<BR>Puvodni radek: <BR>".$radek;
		echo "<BR>Opraveny radek: <BR>".$radek2;
		echo "<HR><HR>";
	endfor;

  echo "\n<BR>Text obsahuje ".$pocet_hesel." hesel. <BR>";

?>
</body>
</html>
