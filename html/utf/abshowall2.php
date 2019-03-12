<html>
<body>
<?
  @$spojeni = Pg_PConnect("user=vviewer dbname=klinopis");
  if ($spojeni)
  {
  $pod1 = ("transliteration like '$chain%'");
    $dotaz1 = "SELECT oid, paragraph, transliteration FROM abtexts WHERE ($pod1)";
//    $dotaz1 = "SELECT oid, klic, wapnazev FROM hledani WHERE ($pod1)";

    @$vysledek = Pg_Exec($spojeni, "$dotaz1");
    if ($vysledek)
    {
      $pocethesel = Pg_NumRows ($vysledek);
      if ($pocethesel == 0) 
        echo ("Nenasli!<br/><br/>\n");
      else
      {
        echo ("Items: \n");
        $rozsah = 8;
          if (($pocethesel - $start) > $rozsah)
            $konec = $start + $rozsah;
          else
            $konec = $pocethesel;

          $start++;
          echo ("$start - $konec from $pocethesel<br/><br/>\n");
          $start--;

          for ($i=$start; $i < $konec; $i++)
          {
            list ($oid, $paragraph, $transliteration) = Pg_Fetch_Array($vysledek, $i);
						$transliteration = StripSlashes ($transliteration);
						$paragraph=$paragraph.$oid;

            echo ("Nic5<br/>\n");
            echo ("$paragraph<br/>TADY\n");
// Vypis popisu
	  $konec2 = ($paragraph+5);
          for ($j=$paragraph; $j < $konec2; $j++)
          {

            $len1 = StrLen ($transliteration);
            $pocradek = 10;
            if (StrLen ($transliteration) > ($pocradek+$len1) )
            {
              while ($transliteration[$len1+$pocradek] != " ") $pocradek--;
              echo (SubStr ($transliteration, $len1, $pocradek)." ...<br/>\n");
            }
            else
              echo (SubStr ($transliteration, $len1, StrLen ($transliteration)-$len1)."<br/>\n");
// konec popisu
          }
} 
// TADYXXx
          if ($start != 0)
          {
            $cis = $start - $rozsah;
            echo ("Nic4<br/>\n");
          }
          if ( ($pocethesel - $start) > $rozsah)
          {
            $cis = $start + $rozsah;
            echo ("Nic3<br/>\n");
          }
      }
    }
    else
      echo ("Nic2!<br/>\n");
  }
  else
    echo ("Nic1!<br/>\n");
?>
</body>
</html>