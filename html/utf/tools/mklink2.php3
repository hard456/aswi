<HTML>

<HEAD>
<META content=text/html; http-equiv=Content-Type>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD W3 HTML//EN">
<TITLE></TITLE>
</HEAD>

<BODY>

<h1><center> Tvorba vnitrnich odkazu</center></h1>
<br>
<?
  $pocetOKodkazu = 0;
  @$spojeni = Pg_PConnect("user=vadmin dbname=vseved");
  if ($spojeni)
  {
    $find = "v. t.";
    $pod1 = "lower(webpopis) LIKE '%".AddSlashes($find)."%'";
    $dotaz1 = "SELECT id, webnazev, webpopis FROM ezet WHERE ($pod1)";
    @$vysledek = Pg_Exec($spojeni, "($dotaz1)");
    if ($vysledek)
    {
      $pocethesel = Pg_NumRows ($vysledek);
      if ($pocethesel == 0) 
        echo ("Zadne heslo neobsahuje \"v. t.\".<br>\n");
      else
      {
        echo ("Pocet slov, ktere obsahuji \"v. t.\": $pocethesel <br><br>");
        for ($i=0; $i < $pocethesel; $i++)
        {
          list ($idhesla, $nazev1, $popis1) = Pg_Fetch_Array($vysledek, $i);
          $pos1 = StrPos ($popis1, "v. t.");
          $pos2 = StrPos ($popis1, "V. t.");
          if ($pos1 != false)
            $findvzor = "v. t.";
          elseif ($pos2 != false)
            $findvzor = "V. t.";
          else
          {
            echo ("pocet moznych odkazu ".$pocetOKodkazu."<br>");
            echo ("<br><a href=\"../index.php3\">Zpet</a>\n");
            exit;
          }
          //presun textu do OUT vcetne "v. t."
          $textOUT = SubStr ($popis1, 0, StrPos ($popis1, $findvzor)+6);
//          echo ($oktext."<br>");

          if ( ($vttext = StrStr ($popis1, $findvzor)) != false)
          {
            //odstraneni "v. t."
            $vttext = SubStr ($vttext, 5, StrLen ($vttext)-5);
//            echo ($vttext."<br>");
            $odkazdelka = 0;
            while (($vttext[$odkazdelka] != ".") && ($vttext[$odkazdelka] != ")") && ($vttext[$odkazdelka] != ",") && ($vttext[$odkazdelka] != ";"))
              $odkazdelka++;

            //ziskani textu odkazu
            $odkaztext = SubStr ($vttext, 1 , $odkazdelka-1);

//            echo ($odkaztext."<br>");

//hledani v databazi
            $pod2 = "lower(webnazev) LIKE lower('".$odkaztext."%') ";
            $dotaz2 = "SELECT id, webnazev FROM ezet WHERE ($pod2)";
            $vysledek2 = Pg_Exec($spojeni, "($dotaz2)");
            if ($vysledek2)
            {
              $pocethesel2 = Pg_NumRows ($vysledek2);
              if ($pocethesel2 == false) 
              {
//                echo ("Zadne heslo pro dany odkaz neni!<br><br>\n");
echo ("\n");
              }
              else
              {
                list ($idhesla2, $nazev2) = Pg_Fetch_Array($vysledek2, 0);
                //je jeste jmeno odkazu mozne?
                if ( (Strlen ($nazev2) < Strlen ($odkaztext) +5) && (StrLen ($odkaztext) > 2) )
                {
                  $textOUT .= "<a href=\"./monwhite.php3?idhesla=$idhesla2\">$odkaztext</a>";
                  $textzaodkazem = SubStr ($vttext, $odkazdelka, StrLen ($vttext));
                  $textOUT .= $textzaodkazem;

//vlozeni noveho textu do databaze
echo ($popis1."<br>\n");
echo ($textOUT."<br>\n");
                  
                  $Mzpr = Pg_Exec ($spojeni, "UPDATE ezet SET webpopis='".AddSlashes($textOUT)."' WHERE id=$idhesla");
                  if ($Mzpr != false)
                    echo ("ok<br><br>\n");
                  else
                    echo ("chyba!<br><br>\n");
                  $pocetOKodkazu++;
                }
              }
            }
          }
        }
      }
    }
    else
      echo ("Došlo k chybě při zpracování dotazu v databázi!<br>\n");
  }
  else
    echo ("Nepodařilo se připojit k databázi!<BR>\n");
  echo ("pocet moznych odkazu ".$pocetOKodkazu."<br>");
  echo ("<br><a href=\"../index.php3\">Zpet</a>\n");
?>

</BODY>
</HTML>