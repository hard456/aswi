<?
Header("Pragma: no-cache");
Header("Cache-Control: no-cache");
Header("Expires: ".GMDate("D, d M Y H:i:s")." GMT");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Update tabulky DICTREFER</title>
</head>

<body bgcolor="Silver">
<CENTER><H2>Update tabulky DICTREFER</H2></CENTER>

<?

function vrat_slovo()
{
		
  static $Zacatek="{";
  static $Konec="}";	
  global $radek;
  global $slovo;
  static $i=0;
//  static $mezera=" ";
  $pom1="";	
  $slovo="";

  for($i;$i<=strlen($radek);$i++):  
     if (($radek[$i]==" ")||($i==strlen($radek)))
      {
	    	if (strlen($slovo)<(strlen($Zacatek))+(strlen($Konec)+1)) 
		      {
			     $slovo="";
			     continue;
		      }

		   for($p=0;$p<strlen($Zacatek);$p++) 
		      {
	         	if ($Zacatek[$p]!=$slovo[$p]) {$slovo="";break;}
		      }

  		if ($slovo=="") continue;

	    for($p=(strlen($slovo)-strlen($Konec)),$q=0;$p<strlen($slovo);$p++,$q++) 
		      {
			     if ($Konec[$q]!=$slovo[$p]) {$slovo="";break;}
		      }
	 		if ($slovo=="") continue;

	  	$pom1=$slovo;
		  $slovo="";
		  for($p=strlen($Zacatek);$p<(strlen($pom1)-(strlen($Konec)));$p++)
          if (($pom1[$p]!='[')&&($pom1[$p]!=']')&&($pom1[$p]!='�')&&($pom1[$p]!='�'))  
            { $slovo.=$pom1[$p];}
		  $i++;
//			$slovo=$mezera.$slovo;
    	return(1);	
      }
    else $slovo.=$radek[$i];
	    
  endfor;

  return(0);

}

 static $slovo="";	
 static $radek="";
 static $pocitadlo_novych_radku=0;

  @$spojeni = Pg_Connect("user=dbowner dbname=klinopis");
	if (!$spojeni):
		echo "Nepodarilo se pripojit k PostgreSQL.<BR>\n";
		die ("</body></html>");
	endif;

   @$vysledek1 = Pg_Exec($spojeni, "SELECT item,text1 FROM obdict WHERE zmena = 1  order by item");
	if (!$vysledek1):
		echo "Doslo k chybe pri zpracovani dotazu v tabulce OBDICT.<BR>\n";
		die ("</body></html>");
	endif;
   echo "<b>V tabulce OBDICT bylo zmeneno <FONT  color=\"Green\">".Pg_NumRows($vysledek1)." </FONT>radek/radku.</b> <BR>\n";
   
   if (Pg_NumRows($vysledek1)==0):
		echo "<b>Neni treba updatovat zadne tabulky.<BR>\n</b>";
		die ("</body></html>");
   endif;
   
   for ($m=0; $m < Pg_NumRows($vysledek1); $m++):
	$zaznam1 = Pg_Fetch_Array($vysledek1, $m);
	$radek = $zaznam1["text1"];
	echo "<br><b>Zpracovavam radek: </b>".$radek."<BR>";
	while(vrat_slovo()):
	    @$vysledek2 = Pg_Exec($spojeni, "SELECT item1,refer1 FROM dictrefer WHERE refer1 = '$slovo' AND item1 = '$zaznam1[item]' ");
		if (!$vysledek2)
	      {  
			echo "Doslo k chybe pri zpracovani dotazu v tabulce dictrefer.<BR>\n";
			die ("</body></html>");

		  }		
           
	    elseif (Pg_NumRows($vysledek2)==0)
		      { 
			  //slovicko nenalezeno v OBDICT
			     $item1_pom=$zaznam1["item"];
				 $vysledek3 = Pg_Exec($spojeni,"INSERT INTO dictrefer(item1,refer1) VALUES ('$item1_pom',' $slovo')" );			
				 if (!$vysledek3)
        			{
					   echo "Doslo k chybe pri insertu slovicka do tabulky DICTREFER.<BR>\n";
                	   echo "\nINSERT INTO dictrefer(item1,refer1) VALUES ('".$zaznam1["item"]."',' ".$slovo."')\n<HR>";
					   die ("</body></html>");
					} 
				 else { 
		    			echo "\n<HR><BR><FONT  color=\"green\"><b>Nova radka v tabulce DICTREFER ulozena!!! </b></font><br>";
			    		echo "\nINSERT INTO dictrefer(item1,refer1) VALUES ('".$zaznam1["item"]."',' ".$slovo."')\n<HR>";
						$pocitadlo_novych_radku++;
					  }	
			  }
		else  { //slovicko nalezeno
				echo "\n<HR><BR><FONT color=\"red\"><b>Zaznam jiz nalezen!!</b></font><BR> ";
				echo "refer1 = '".$slovo."'   &   item1 = '".$zaznam1["item"]."'";
				echo "\n<HR>";
				continue;
			  }
	  endwhile;

    $item_pom=$zaznam1["item"];
	$text1_pom=$zaznam1["text1"];
	@$vysledek4 = Pg_Exec($spojeni,"UPDATE obdict SET zmena = '0' WHERE ((item='$item_pom') AND (text1='$text1_pom'))");
       if (!$vysledek4)
         {
	        echo "Doslo k chybe pri updatu polozky zmena v tabulce OBDICT.<BR>\n";
	        die ("</body></html>");
	     }
       else  echo "<HR><B> <FONT color=\"green\">  Zmena 1 -> 0  - uspesne ulozeno!!!</b></font>";


   endfor;
echo "\n<BR><HR><b>Do tabulky DICTREFER bylo ulozeno  <FONT color=\"green\">".$pocitadlo_novych_radku."</font> novych radek/radku.</b>";

?>
</body>
</html>
