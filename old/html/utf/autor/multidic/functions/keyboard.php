<?


/**
 * pro zpetnou konpatibilitu po pridani hebrejstiny
 */
function insert_keyboard($text_field) {
  global $language;

  ?>
<script language="JavaScript">

  var kam = "<? echo $text_field ?>";
  
  function aktivujKlavesnici(param){
    kam = param;
  }
  function add(znak) {
    //alert(kam);
    eval("document."+kam+".value = document."+kam+".value + znak");
    //document.getElementById(kam).value = document.getElementById(kam).value + znak;
  }
  
</script>
<?
  if (Empty($text_field)) {
    $text_field = "form1.text1";
    ?>
<form name="form1">
  <table align="center" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td dir="rtl">
          <center>
          <!--input type="text" SIZE="62" name="text1" value=""-->
          <textarea 
            style="font-size: 11pt; color: rgb(0, 0, 0); font-family: Tahoma; background-color: rgb(222, 227, 231);" 
            name="text1" 
            rows="5" 
            wrap="PHYSICAL" 
            cols="61">
          </textarea>
          </center>
        </td>      
      </td>
    </tbody>
  </table>
</form>

<?
  }

  //echo $language;
  if ($language == 2)
    insert_keyboard_he($text_field);
  else if ($language == 3)
    insert_keyboard_ak($text_field);
  else
    insert_keyboard_ar($text_field);
}


/**
 * Staticka globalni promenna
 * slouzi jako pocitadlo klavesnic - pri vkladani vice klavesnic do 
 * jednoho souboru.
 */
$pocet_klavesnic = 0;


function insert_keyboard_he($text_field) {
  //echo "hebrejska klavesnice";
    
  $cesta_k_obrazkum = "pict/";
  global $pocet_klavesnic;
 

?>

<table align="center" border="0" cellpadding="10" cellspacing="0" width="600">
  <tbody>
  <tr>
    <td class="bodyline">
      <p align="center">
      <map name="keybd<?php echo $pocet_klavesnic;     ?>">

        <area shape="rect" coords="27,3,50,31" onclick="add('/');" />
        <area shape="rect" coords="56,3,80,31" onclick="add('\'');" />
        <area shape="rect" coords="86,3,107,31" onclick="add('&#1511;');" />
        <area shape="rect" coords="114,3,139,31" onclick="add('&#1512;');" />
        <area shape="rect" coords="145,3,167,31" onclick="add('&#1488;');" />
        <area shape="rect" coords="174,3,196,31" onclick="add('&#1496;');" />
        <area shape="rect" coords="202,3,226,31" onclick="add('&#1493;');" />
        <area shape="rect" coords="232,3,256,31" onclick="add('&#1503;');" />
        <area shape="rect" coords="261,3,285,31" onclick="add('&#1501;');" />
        <area shape="rect" coords="290,3,312,31" onclick="add('&#1508;');" />
        <area shape="rect" coords="318,3,342,31" onclick="add('_');" />

        <!--area shape="rect" coords="348,3,384,31" onclick="javascript:del_letter();" />
        <area shape="rect" coords="389,3,416,31" onclick="add(' ĺŕ ');" />
        <area shape="rect" coords="423,3,449,31" onclick="add(' íâ ');" /-->
        
        <area shape="rect" coords="4,37,30,61" onclick="add('&gt;');" /> 
        <area shape="rect" coords="34,37,56,61" onclick="add('&#1513;');" />
        <area shape="rect" coords="61,37,85,61" onclick="add('&#1491;');" />
        <area shape="rect" coords="92,37,114,61" onclick="add('&#1490;');" />
        <area shape="rect" coords="121,37,144,61" onclick="add('&#1496;');" />
        <area shape="rect" coords="151,37,173,61" onclick="add('&#1506;');" />
        <area shape="rect" coords="181,37,204,61" onclick="add('&#1497;');" />
        <area shape="rect" coords="209,37,232,61" onclick="add('&#1495;');" />
        <area shape="rect" coords="239,37,261,61" onclick="add('&#1500;');" />
        <area shape="rect" coords="268,37,291,61" onclick="add('&#1498;');" />
        <area shape="rect" coords="296,37,319,61" onclick="add('&#1507;');" />
        <area shape="rect" coords="326,37,354,61" onclick="add('\"');" />
        <!--area shape="rect" coords="357,37,435,61" onclick="javascript:search();" /-->
        <!--area shape="rect" coords="442,37,477,61" onclick="javascript:emptyfield();" /-->
        
        <!--area shape="rect" coords="3,66,46,90" onclick="javascript:shiftlock();" /-->
        <area shape="rect" coords="51,66,71,90" onclick="add('&#1494;');" />
        <area shape="rect" coords="79,66,100,90" onclick="add('&#1505;');" />
        <area shape="rect" coords="107,66,129,90" onclick="add('&#1489;');" />
        <area shape="rect" coords="136,66,157,90" onclick="add('&#1492;');" />
        <area shape="rect" coords="165,66,187,89" onclick="add('&#1504;');" />
        <area shape="rect" coords="194,66,218,90" onclick="add('&#1502;');" />
        <area shape="rect" coords="225,66,247,90" onclick="add('&#1510;');" />
        <area shape="rect" coords="254,66,276,90" onclick="add('&#1514;');" />
        <area shape="rect" coords="282,66,305,90" onclick="add('&#1509;');" />
        <area shape="rect" coords="312,66,334,90" onclick="add('/');" />
        <area shape="rect" coords="340,66,477,90" onclick="add(' ');" />
        
        <area shape="rect" coords="456,3,479,31" onclick="add('0');" />
        <area shape="rect" coords="484,3,507,31" onclick="add('7');" />
        <area shape="rect" coords="512,3,535,31" onclick="add('8');" />
        <area shape="rect" coords="540,3,565,31" onclick="add('9');" />
        <area shape="rect" coords="484,37,507,61" onclick="add('4');" />
        <area shape="rect" coords="512,37,535,61" onclick="add('5');" />
        <area shape="rect" coords="540,37,565,61" onclick="add('6');" />
        <area shape="rect" coords="484,66,507,90" onclick="add('1');" />
        <area shape="rect" coords="512,66,535,90" onclick="add('2');" />
        <area shape="rect" coords="540,66,565,90" onclick="add('3');" />

        <!--area shape="default" nohref-->
      </map>

      <img src="<?php echo $cesta_k_obrazkum?>heb-keybd.gif" 
           usemap="#keybd<?php echo $pocet_klavesnic;?>" 
           border="0" />
      </p>
    </td>
  </tr>
  </tbody>
</table>
<?php
  $GLOBALS["pocet_klavesnic"] += 1;
}


/**
 *  Funkce vlozi do stranky js/klavesnici pro psani tech klikihacku:)
 *
 *  @param $text_field "adresa" ciloveho vstupniho policka v libovolnem  
 *                      formulari (vcetne toho formulare Pr: 'form1.text1' )
 */
function insert_keyboard_ar($text_field) {
  
  $cesta_k_obrazkum = "pict/";
  global $pocet_klavesnic;
 

?>

<table align="center" border="0" cellpadding="10" cellspacing="0" width="600">
  <tbody>
  <tr>
    <td class="bodyline">
      <p align="center">
      <img src="<?php echo $cesta_k_obrazkum?>key1.gif" 
           usemap="#key_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="156" 
           width="450" /><br />
      <img src="<?php echo $cesta_k_obrazkum?>key2.gif" 
           usemap="#key2_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="43" 
           width="354" /><br />
      <img src="<?php echo $cesta_k_obrazkum?>key3.gif" 
           usemap="#key3_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="43" 
           width="354" /> 
      </p>
      
      <map name="key_<?php echo $pocet_klavesnic;?>">
        <area onclick="add(' ');" shape="RECT" coords="119,123,292,146" />
        <area onclick="add('&#1584;');" shape="RECT" coords="7,5,32,29" />
        <area onclick="add('1');" shape="RECT" coords="37,4,60,26" />
        <area onclick="add('2');" shape="RECT" coords="65,4,89,28" />
        <area onclick="add('3');" shape="RECT" coords="96,3,117,28" />
        <area onclick="add('4');" shape="RECT" coords="125,5,147,27" />
        <area onclick="add('5');" shape="RECT" coords="155,5,176,28" />
        <area onclick="add('6');" shape="RECT" coords="183,4,205,27" />
        <area onclick="add('7');" shape="RECT" coords="212,5,235,27" />
        <area onclick="add('8');" shape="RECT" coords="241,6,263,28" />
        <area onclick="add('9');" shape="RECT" coords="271,6,292,30" />
        <area onclick="add('0');" shape="RECT" coords="298,4,324,30" />
        <area onclick="add('&#1592;');" shape="RECT" coords="334,92,361,118" />
        <area onclick="add('&#1586;');" shape="RECT" coords="306,92,331,114" />
        <area onclick="add('&#1608;');" shape="RECT" coords="276,93,300,115" />
        <area onclick="add('&#1577;');" shape="RECT" coords="246,93,271,115" />
        <area onclick="add('&#1609;');" shape="RECT" coords="219,91,245,115" />
        <area onclick="add('&#1604;&#1575;');" shape="RECT" coords="190,91,214,115" />
        <area onclick="add('&#1585;');" shape="RECT" coords="159,93,186,115" />
        <area onclick="add('&#1572;');" shape="RECT" coords="130,95,153,118" />
        <area onclick="add('&#1569;');" shape="RECT" coords="101,90,127,117" />
        <area onclick="add('&#1574;');" shape="RECT" coords="74,92,96,115" />
        <area onclick="add('&#1591;');" shape="RECT" coords="351,61,376,88" />
        <area onclick="add('&#1603;');" shape="RECT" coords="321,63,348,86" />
        <area onclick="add('&#1605;');" shape="RECT" coords="293,64,315,87" />
        <area onclick="add('&#1606;');" shape="RECT" coords="263,63,286,87" />
        <area onclick="add('&#1578;');" shape="RECT" coords="234,62,258,85" />
        <area onclick="add('&#1575;');" shape="RECT" coords="206,64,229,87" />
        <area onclick="add('&#1604;');" shape="RECT" coords="178,64,200,87" />
        <area onclick="add('&#1576;');" shape="RECT" coords="148,63,170,86" />
        <area onclick="add('&#1610;');" shape="RECT" coords="118,64,142,89" />
        <area onclick="add('&#1587;');" shape="RECT" coords="90,64,112,87" />
        <area onclick="add('&#1588;');" shape="RECT" coords="60,64,84,86" />
        <area onclick="add('&#1583;');" shape="RECT" coords="371,34,397,58" />
        <area onclick="add('&#1580;');" shape="RECT" coords="343,35,368,59" />
        <area onclick="add('&#1581;');" shape="RECT" coords="315,33,339,58" />
        <area onclick="add('&#1582;');" shape="RECT" coords="285,35,310,60" />
        <area onclick="add('&#1607;');" shape="RECT" coords="255,34,280,57" />
        <area onclick="add('&#1593;');" shape="RECT" coords="229,34,251,57" />
        <area onclick="add('&#1594;');" shape="RECT" coords="198,35,222,58" />
        <area onclick="add('&#1601;');" shape="RECT" coords="169,34,193,57" />
        <area onclick="add('&#1602;');" shape="RECT" coords="140,33,165,58" />
        <area onclick="add('&#1579;');" shape="RECT" coords="110,35,134,57" />
        <area onclick="add('&#1589;');" shape="RECT" coords="82,36,103,57" />
        <area onclick="add('&#1590;');" shape="RECT" coords="51,35,71,55" />
      </map>
      
      <map name="key2_<?php echo $pocet_klavesnic;?>">
        <area onclick="add('&#1563;');" shape="RECT" coords="318,3,344,31" />
        <area onclick="add('/');" shape="RECT" coords="282,4,308,32" />
        <area onclick="add('&#1548;');" shape="RECT" coords="255,6,277,31" />
        <area onclick="add('&#1600;');" shape="RECT" coords="225,3,248,30" />
        <area onclick="add('&#1571;');" shape="RECT" coords="195,4,222,32" />
        <area onclick="add('&#1604;&#1571;');" shape="RECT" coords="168,6,192,32" />
        <area onclick="add('&#1567;');" shape="RECT" coords="129,5,158,34" />
        <area onclick="add('.');" shape="RECT" coords="102,6,127,32" />
        <area onclick="add(',');" shape="RECT" coords="71,6,96,32" />
        <area onclick="add('&#1570;');" shape="RECT" coords="37,6,62,32" />
        <area onclick="add('&#1604;&#1570;');" shape="RECT" coords="8,6,31,30" />
      </map>

      <map name="key3_<?php echo $pocet_klavesnic;?>">
        <area onclick="add('&#1612;');" shape="RECT" coords="318,3,344,31">
        <!--area onclick="add('');" shape="RECT" coords="282,4,308,32">
        <area onclick="add('');" shape="RECT" coords="255,6,277,31">
        <area onclick="add('');" shape="RECT" coords="225,3,248,30"-->
        <area onclick="add('&#1574;');" shape="RECT" coords="195,4,222,32" />
        <area onclick="add('&#1572;');" shape="RECT" coords="168,6,192,32" />
        <area onclick="add('&#1618;');" shape="RECT" coords="129,5,158,34" />
        <area onclick="add('&#1615;');" shape="RECT" coords="102,6,127,32" />
        <area onclick="add('&#1616;');" shape="RECT" coords="71,6,96,32" />
        <area onclick="add('&#1614;');" shape="RECT" coords="37,6,62,32" />
        <area onclick="add('&#1588;');" shape="RECT" coords="8,6,31,30" />
      </map>
    </td>
  </tr>
  </tbody>
</table>
<?php
  $GLOBALS["pocet_klavesnic"] += 1;
}

function insert_keyboard_ak($text_field) {
  //echo "hebrejska klavesnice";
    
  $cesta_k_obrazkum = "pict/";
  global $pocet_klavesnic;
 

?>

<table align="center" border="0" cellpadding="10" cellspacing="0" width="600">
  <tbody>
  <tr>
    <td class="bodyline">
      <p align="center">
      <table>
  <tr>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value='&#x00E1;' onclick="add('&#x00E1;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00E9;" onclick="add('&#x00E9;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00ED;" onclick="add('&#x00ED;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00FA;" onclick="add('&#x00FA;')"></td>
    <td></td><td></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value='&#x00C1;' onclick="add('&#x00C1;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00C9;" onclick="add('&#x00C9;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00CD;" onclick="add('&#x00CD;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00DA;" onclick="add('&#x00DA;')"></td>
  </tr>
  <tr>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value='&#x00E0;' onclick="add('&#x00E0;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00E8;" onclick="add('&#x00E8;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00EC;" onclick="add('&#x00EC;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00F9;" onclick="add('&#x00F9;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00F2;" onclick="add('&#x00F2;')"></td>
    <td></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00C0;" onclick="add('&#x00C0;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00C8;" onclick="add('&#x00C8;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00CC;" onclick="add('&#x00CC;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00D9;" onclick="add('&#x00D9;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00D2;" onclick="add('&#x00D2;')"></td>
  </tr>
  <tr>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value='&#x00E2;' onclick="add('&#x00E2;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00EA;" onclick="add('&#x00EA;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00EE;" onclick="add('&#x00EE;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00FB;" onclick="add('&#x00FB;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00F4;" onclick="add('&#x00F4;')"></td>
    <td></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00C2;" onclick="add('&#x00C2;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00CA;" onclick="add('&#x00CA;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00DB;" onclick="add('&#x00DB;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x00D4;" onclick="add('&#x00D4;')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:15" TYPE=button value="&#x2308;" onclick="add('&#x2308;')">
      <input class=tlacitko2 style="height:25;width:15" TYPE=button value="&#x2309;" onclick="add('&#x2309;')"></td>
</tr>


<tr>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value='&#x0101;' onclick="add('&#x0101;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x0113;" onclick="add('&#x0113;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x012B;" onclick="add('&#x012B;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x016B;" onclick="add('&#x016B;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x014D;" onclick="add('&#x014D;')"></td>
    <td></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x0100;" onclick="add('&#x0100;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x0112;" onclick="add('&#x0112;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x012A;" onclick="add('&#x012A;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x016A;" onclick="add('&#x016A;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x014C;" onclick="add('&#x014C;')"></td>
  </tr>
  <tr>
    <td>
      <input class=tlacitko2 style="height:25;width:25" TYPE=button value="?" onclick="add('?')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:25" TYPE=button value="?" onclick="add('?')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x1E63;" onclick="add('&#x1E63;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x0161;" onclick="add('&#x0161;')"></td>
    <td>
      <input class=tlacitko1 style="height:25;width:25" TYPE=button value="&#x1E6D;" onclick="add('&#x1E6D;')"></td>
    <td>
      <input class=tlacitko2 style="height:30;width:25" TYPE=button value="?" onclick="add('?')"></td>
    <td>
      <input class=tlacitko2 style="height:30;width:25" TYPE=button value="&#x1E62;" onclick="add('&#x1E62;')"></td>
    <td>
      <input class=tlacitko2 style="height:30;width:25" TYPE=button value="&#x0160;" onclick="add('&#x0160;')"></td>
    <td>
      <input class=tlacitko2 style="height:30;width:25" TYPE=button value="&#x1E6C;" onclick="add('&#x1E6C;')"></td>
    <td>
      <input class=tlacitko2 style="height:30;width:25" TYPE=button value="&#x1E2A;" onclick="add('&#x1E2A;')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:15" TYPE=button value="[" onclick="add('[')">
      <input class=tlacitko2 style="height:25;width:15" TYPE=button value="]" onclick="add(']')"></td>
  </tr>
  <tr>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="1" onclick="add('1')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="2" onclick="add('2')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="3" onclick="add('3')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="4" onclick="add('4')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="5" onclick="add('5')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="6" onclick="add('6')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="7" onclick="add('7')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="8" onclick="add('8')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="9" onclick="add('9')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="0" onclick="add('0')"></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" TYPE=button value="x" onclick="add('x')"></td>
  </tr>
</table>
      </p>
    </td>
  </tr>
  </tbody>
</table>
<?php
  $GLOBALS["pocet_klavesnic"] += 1;
}
?>
