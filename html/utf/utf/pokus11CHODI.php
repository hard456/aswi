<?
Header("Pragma: no-cache");
Header("Cache-Control: no-cache");
Header("Expires: ".GMDate("D, d M Y H:i:s")." GMT");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Update tabulky OBDICT</title>
</head>

<body bgcolor="Silver">
<CENTER><H2>Update tabulky OBDICT</H2></CENTER>
<?

function vrat_slovo()
{
	
  global $radek;
  global $radek2;
  global $slovo;
  global $ii;
 

  while(true)  
  	{
		 $slovo="";
		  while(($ii<strlen($radek))&&($radek[$ii]==' '))
		   {
				$ii++;
				$radek2.=" ";

				
		   }	

		  if ($ii>=strlen($radek)) return(0);
		
		while(($ii<strlen($radek))&&($radek[$ii]!=' '))
			{
				$slovo.=$radek[$ii];
				$ii++;

			}

		if ($slovo[0]=="(") return(1);
		$radek2.=$slovo;
		
	}
}

static $slovo="";	
static $radek ="";
static $radek2 ="";
static $pocet_hesel=0;
static $pocet_zmen=0;
static $pocc=0;


define("odkaz1","<A HREF=\"http://www.klinopis.cz/utf/utf/t.php?s=");
define("odkaz2","\">");
define("odkaz3","</A>");

@$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
	if (!$spojeni):
		echo "Nepodarilo se pripojit k PostgreSQL.<BR>\n";
		die ("</body></html>");
	endif;


@$vysledek = Pg_Exec($spojeni, "SELECT item,text1 FROM obdict order by item,text1");
	if (!$vysledek):
		echo "Doslo k chybe pri zpracovani dotazu v databazi slovicek.<BR>\n";
		die ("</body></html>");
	endif;
echo "V tabulce obdict je <FONT  color=\"Green\"><b>".Pg_NumRows($vysledek)."</b> </FONT>slovicek.<BR>\n";

for ($m=0; $m < Pg_NumRows($vysledek); $m++)
{
	$pocc++;
    $zaznam = Pg_Fetch_Array($vysledek, $m);
		echo "<HR><br>Zaznam c.".$pocc."&nbsp;&nbsp;&nbsp;".$zaznam["item"]."<BR>";

	$ii=0;
 	$radek2="";
	$item_pom = $zaznam["item"];
	$radek=$zaznam["text1"];
	
	echo "Ahh";	
  while(vrat_slovo()):
			
		$slovo2="";
		$carka=0;
	   for ($pomm=0;$pomm<strlen($slovo);$pomm++)
		   {
	 	  	  if ($slovo[$pomm]==',') 
			  	 { 
				   $carka+=1;
			       if ($carka==1) $pomm_slovo=$slovo2;
				 }
			  if ($carka==2) break;
			  else $slovo2.=$slovo[$pomm];
			}
		if ($carka==0) $radek2.=$slovo;
		if ($carka==1) $slovo2=$pomm_slovo;
		$slovo2 = $slovo2.",";
		echo "<BR>Upravene slovo je ".$slovo2;


	   @$vysledek2 = Pg_Exec($spojeni, "SELECT bookandchapter FROM obtexts WHERE bookandchapter = '$slovo2'");
			if (!$vysledek2)
	  	       {  
				  echo "<br>Doslo k chybe pri zpracovani dotazu v tabulce obtexts.<BR>\n";
				  die ("</body></html>");
				 }		
	 	   elseif (Pg_NumRows($vysledek2)==0)
		      { 
				  //slovicko nenalezeno v OBTEXTS
				  echo "<BR>Slovicko ".$slovo2." v tabulce obtexts nenalezeno!";
				  $radek2.=$slovo;

				}
			else

				{
				  //slovicko nalezeno v OBTEXTS
					echo "<BR>Slovicko ".$slovo2." v tabulce obtexts nalezeno!";
    				$radek2.=odkaz1;
					$radek2.=$slovo2;
					$radek2.=odkaz2;
					$radek2.=$slovo;
					$radek2.=odkaz3;
				}
	 

		endwhile;

	   echo "<br>Delka radek je".strlen($radek);
	   echo "<br>Delka radek2 je".strlen($radek2);
	   echo "<br>Radek je=".$radek."=";
	   echo "<br>Radek2 je=".$radek2."=";
  
   for($o=0;$o<strlen($radek);$o++)
	{	
//		if ($radek[$o]!=$radek2[$o]) echo "<BR>cud";
	if ($radek[$o]!=$radek2[$o]) echo "<BR>Zmeneno na pozici".$o." znaky ".$radek[$o]."==".$radek2[$o];
	}

	if(strcmp($radek,$radek2)==0)
	 {
		echo "<HR><BR>Radek s oznacenim : ".$zaznam["item"]." nezmenen!";
 	 }
	else
	 {
	   $pocet_zmen++;	
	  	echo "<HR><BR>Radek s oznacenim : ".$zaznam["item"]." zmenen!";
    	echo "<BR>Opraveny radek: <BR><FONT FACE=\"Arial Unicode MS, TITUS Cyberbit Basic, Code2000\" color=#2288ff>".$radek2."</FONT>";
				
		   $vysledek3 = Pg_Exec($spojeni,"UPDATE obdict SET text1 = '$radek2' WHERE item='$item_pom'");
		    if (!$vysledek3)
				{
					echo "Doslo k chybe pri updatu databaze.<BR>\n";
					die ("</body></html>");
				}
				else	
					{
						echo "<BR>Ulozen!!!";
					}	

			}	//konec else


}
	echo "<hr><br>Provedeno ".$pocet_zmen." zmen(a).";
?>
</body>
</html>
