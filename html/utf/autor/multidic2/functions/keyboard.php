<?php


/**
 * pro zpetnou konpatibilitu po pridani hebrejstiny
 */
function insert_keyboard($text_field, $extended = false) {
  global $language;

  ?>
<script language="JavaScript" type="text/javascript">
  <!--
  var kam = "<?php echo $text_field ?>";
  
  function aktivujKlavesnici(param){
    kam = param;
  }
  function add(znak) {
    //alert(kam);
    eval("document."+kam+".value = document."+kam+".value + znak");
    //document.getElementById(kam).value = document.getElementById(kam).value + znak;
    eval("document."+kam+".focus()");
  }
  function putchar(znak) {
    add(znak);
  }
  
  /*function putchar(character)
  {
    eval("document."+kam+".focus()");
    if (eval("document."+kam+".createTextRange")) {
      document.selection.createRange().text += character;
    }
    else if (kam.setSelectionRange) {
      var len = kam.selectionEnd;
      kam.value = kam.value.substr(0,len)
                       +
                       character
                       +
                       kam.value.substr(len);
      kam.setSelectionRange(len+character.length,len+character.length);
    }
    else {
      kam.value += character;
    }
  }*/
  -->
</script>
<?php
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

<?php
  }

  //echo $language;
  if ($language == 2)
    insert_keyboard_he($text_field);
  else if ($language == 3)
    insert_keyboard_ak($text_field);
  else
    insert_keyboard_ar($text_field, $extended);
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

<table border="0" cellpadding="10" cellspacing="0" width="530">
  <tbody>
  <tr>
    <td class="bodyline">
      <p align="center">
      <map name="keybd<?php echo $pocet_klavesnic;     ?>">

        <area shape="rect" coords="27,3,50,31" onclick="add('/');" alt="/" />
        <area shape="rect" coords="56,3,80,31" onclick="add('\'');" alt="\" />
        <area shape="rect" coords="86,3,107,31" onclick="add('&#1511;');" alt="&#1511;" />
        <area shape="rect" coords="114,3,139,31" onclick="add('&#1512;');" alt="&#1512;" />
        <area shape="rect" coords="145,3,167,31" onclick="add('&#1488;');" alt="&#1488;" />
        <area shape="rect" coords="174,3,196,31" onclick="add('&#1496;');" alt="&#1496;" />
        <area shape="rect" coords="202,3,226,31" onclick="add('&#1493;');" alt="&#1493;" />
        <area shape="rect" coords="232,3,256,31" onclick="add('&#1503;');" alt="&#1503;" />
        <area shape="rect" coords="261,3,285,31" onclick="add('&#1501;');" alt="&#1501;" />
        <area shape="rect" coords="290,3,312,31" onclick="add('&#1508;');" alt="&#1508;" />
        <area shape="rect" coords="318,3,342,31" onclick="add('_');" alt="_" />

        <!--area shape="rect" coords="348,3,384,31" onclick="javascript:del_letter();" />
        <area shape="rect" coords="389,3,416,31" onclick="add(' ĺŕ ');" />
        <area shape="rect" coords="423,3,449,31" onclick="add(' íâ ');" /-->
        
        <area shape="rect" coords="4,37,30,61" onclick="add('&gt;');" alt="&gt;" /> 
        <area shape="rect" coords="34,37,56,61" onclick="add('&#1513;');" alt="&#1513;" />
        <area shape="rect" coords="61,37,85,61" onclick="add('&#1491;');" alt="&#1491;" />
        <area shape="rect" coords="92,37,114,61" onclick="add('&#1490;');" alt="&#1490;" />
        <area shape="rect" coords="121,37,144,61" onclick="add('&#x05DB;');" alt="&#x05DB;" />
        <area shape="rect" coords="151,37,173,61" onclick="add('&#1506;');" alt="&#1506;" />
        <area shape="rect" coords="181,37,204,61" onclick="add('&#1497;');" alt="&#1497;" />
        <area shape="rect" coords="209,37,232,61" onclick="add('&#1495;');" alt="&#1495;" />
        <area shape="rect" coords="239,37,261,61" onclick="add('&#1500;');" alt="&#1500;" />
        <area shape="rect" coords="268,37,291,61" onclick="add('&#1498;');" alt="&#1498;" />
        <area shape="rect" coords="296,37,319,61" onclick="add('&#1507;');" alt="&#1507;" />
        <area shape="rect" coords="326,37,354,61" onclick="add('\"');" alt="\"" />
        <!--area shape="rect" coords="357,37,435,61" onclick="javascript:search();" /-->
        <!--area shape="rect" coords="442,37,477,61" onclick="javascript:emptyfield();" /-->
        
        <!--area shape="rect" coords="3,66,46,90" onclick="javascript:shiftlock();" /-->
        <area shape="rect" coords="51,66,71,90" onclick="add('&#1494;');" alt="&#1494;" />
        <area shape="rect" coords="79,66,100,90" onclick="add('&#1505;');" alt="&#1505;" />
        <area shape="rect" coords="107,66,129,90" onclick="add('&#1489;');" alt="&#1489;" />
        <area shape="rect" coords="136,66,157,90" onclick="add('&#1492;');" alt="&#1492;" />
        <area shape="rect" coords="165,66,187,89" onclick="add('&#1504;');" alt="&#1504;" />
        <area shape="rect" coords="194,66,218,90" onclick="add('&#1502;');" alt="&#1502;" />
        <area shape="rect" coords="225,66,247,90" onclick="add('&#1510;');" alt="&#1510;" />
        <area shape="rect" coords="254,66,276,90" onclick="add('&#1514;');" alt="&#1514;" />
        <area shape="rect" coords="282,66,305,90" onclick="add('&#1509;');" alt="&#1509;" />
        <area shape="rect" coords="312,66,334,90" onclick="add('/');" alt="/" />
        <area shape="rect" coords="340,66,477,90" onclick="add(' ');" alt=" " />
        
        <area shape="rect" coords="456,3,479,31" onclick="add('0');" alt="0" />
        <area shape="rect" coords="484,3,507,31" onclick="add('7');" alt="7" />
        <area shape="rect" coords="512,3,535,31" onclick="add('8');" alt="8" />
        <area shape="rect" coords="540,3,565,31" onclick="add('9');" alt="9" />
        <area shape="rect" coords="484,37,507,61" onclick="add('4');" alt="4" />
        <area shape="rect" coords="512,37,535,61" onclick="add('5');" alt="5" />
        <area shape="rect" coords="540,37,565,61" onclick="add('6');" alt="6" />
        <area shape="rect" coords="484,66,507,90" onclick="add('1');" alt="1" />
        <area shape="rect" coords="512,66,535,90" onclick="add('2');" alt="2" />
        <area shape="rect" coords="540,66,565,90" onclick="add('3');" alt="3" />

        <!--area shape="default" nohref-->
      </map>

      <img src="<?php echo $cesta_k_obrazkum?>heb-keybd.gif" 
           usemap="#keybd<?php echo $pocet_klavesnic;?>" 
           border="0"
           alt="hebrejská klávesnice" />
      </p>
    </td>
    <td>
      <table>
        <tr>
           <td>
              <button type="button" onClick=putchar("&#1463;") tabindex="-1" title="patah פתח">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/patah.gif"  />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1464;") tabindex="-1" title="qamaz קמץ">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/kamaz.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1465;") tabindex="-1" title="holam חולם">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/holam.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1468;") tabindex="-1" title="dagesh דגש">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/dagesh.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1467;") tabindex="-1" title="qubuz קובוץ">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/kubuz.gif" />
              </button>
          </td>
        </tr>
        <tr>
           <td>
              <button type="button" onClick=putchar("&#1471;") tabindex="-1" title="rafe רפה">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/rafe.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1456;") tabindex="-1" title="shva שוא">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/shva.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1457;") tabindex="-1" title="hataf-segol חטף-סגול">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/htf-sgl.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1458;") tabindex="-1" title="hataf-patah חטף-פתח">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/htf-pth.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1459;") tabindex="-1" title="hataf-qamaz חטף-קמץ">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/htf-kmz.gif" />
              </button>
           </td>
        </tr>
        <tr>
           <td>
              <button type="button" onClick=putchar("&#1460;") tabindex="-1" title="hiriq חיריק">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/hirik.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1461;") tabindex="-1" title="tsere צירה">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/zere.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1462;") tabindex="-1" title="segol סגול">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/segol.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#148;") tabindex="-1" title="close quote&#13;סגור מרכאות">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/ruqt.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#132;") tabindex="-1" title="open hebrew quote&#13;פתח מרכאות">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/rlqt.gif" />
              </button>
           </td>
        </tr>
        <tr>
           <td>
              <button type="button" onClick=putchar("&#1470;") tabindex="-1" title="maqaf מקף">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/makaf.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#8211;") tabindex="-1" title="en dash קו מפריד">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/mafrid.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1474;") tabindex="-1" title="sin ש שמאלית">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/sin.gif" />
              </button>
          </td>
          <td>
              <button type="button" onClick=putchar("&#1473;") tabindex="-1" title="shin ש ימנית">
                <img src="<?php echo $cesta_k_obrazkum?>hebrew/shin.gif" />
              </button>
            </td>
         </tr>
       </table>
    </td>
  </tr>
  </tbody>
</table>
<?php
  insert_keyboard_ak($text_field);
  $GLOBALS["pocet_klavesnic"] += 1;
}


/**
 *  Funkce vlozi do stranky js/klavesnici pro psani tech klikihacku:)
 *
 *  @param $text_field "adresa" ciloveho vstupniho policka v libovolnem  
 *                      formulari (vcetne toho formulare Pr: 'form1.text1' )
 */
function insert_keyboard_ar($text_field, $extended) {
  
  $cesta_k_obrazkum = "pict/";
  global $pocet_klavesnic;
 

?>

<table border="0" cellpadding="10" cellspacing="0" width="530">
  <tbody>
  <tr>
    <td class="bodyline">
      <p align="center">
      <img src="<?php echo $cesta_k_obrazkum?>key1.gif" 
           usemap="#key_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="156" 
           width="450" 
           alt="arabská klávesnice" /><br />
      <img src="<?php echo $cesta_k_obrazkum?>key2.gif" 
           usemap="#key2_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="43" 
           width="354" 
           alt="arabská klávesnice" /><br />
      <img src="<?php echo $cesta_k_obrazkum?>key3.gif" 
           usemap="#key3_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="43" 
           width="354" 
           alt="arabská klávesnice" /> 
      <img src="<?php echo $cesta_k_obrazkum?>key4.gif" 
           usemap="#key4_<?php echo $pocet_klavesnic;?>" 
           border="0" 
           height="43" 
           width="354" 
           alt="arabská klávesnice" /> 
      </p>
      
      <map name="key_<?php echo $pocet_klavesnic;?>">
        <area onclick="add(' ');" shape="RECT" coords="119,123,292,146" alt=" " />
        <area onclick="add('&#1584;');" shape="RECT" coords="7,5,32,29" alt="&#1584;" />
        <area onclick="add('1');" shape="RECT" coords="37,4,60,26" alt="1" />
        <area onclick="add('2');" shape="RECT" coords="65,4,89,28" alt="2" />
        <area onclick="add('3');" shape="RECT" coords="96,3,117,28" alt="3" />
        <area onclick="add('4');" shape="RECT" coords="125,5,147,27" alt="4" />
        <area onclick="add('5');" shape="RECT" coords="155,5,176,28" alt="5" />
        <area onclick="add('6');" shape="RECT" coords="183,4,205,27" alt="6" />
        <area onclick="add('7');" shape="RECT" coords="212,5,235,27" alt="7" />
        <area onclick="add('8');" shape="RECT" coords="241,6,263,28" alt="8" />
        <area onclick="add('9');" shape="RECT" coords="271,6,292,30" alt="9" />
        <area onclick="add('0');" shape="RECT" coords="298,4,324,30" alt="0" />
        <area onclick="add('&#1592;');" shape="RECT" coords="334,92,361,118" alt="&#1592;" />
        <area onclick="add('&#1586;');" shape="RECT" coords="306,92,331,114" alt="&#1586;" />
        <area onclick="add('&#1608;');" shape="RECT" coords="276,93,300,115" alt="&#1608;" />
        <area onclick="add('&#1577;');" shape="RECT" coords="246,93,271,115" alt="&#1577;" />
        <area onclick="add('&#1609;');" shape="RECT" coords="219,91,245,115" alt="&#1609;" />
        <!--area onclick="add('&#1604;&#1575;');" shape="RECT" coords="190,91,214,115" alt="&#1604;&#1575;" /-->
        <area onclick="add('&#65276;');" shape="RECT" coords="190,91,214,115" alt="&#65276;" />
        <area onclick="add('&#1585;');" shape="RECT" coords="159,93,186,115" alt="&#1585;" />
        <area onclick="add('&#1572;');" shape="RECT" coords="130,95,153,118" alt="&#1572;" />
        <area onclick="add('&#1569;');" shape="RECT" coords="101,90,127,117" alt="&#1569;" />
        <area onclick="add('&#1574;');" shape="RECT" coords="74,92,96,115"  alt="&#1574;" />
        <area onclick="add('&#1591;');" shape="RECT" coords="351,61,376,88" alt="&#1591;" />
        <area onclick="add('&#1603;');" shape="RECT" coords="321,63,348,86" alt="&#1603;" />
        <area onclick="add('&#1605;');" shape="RECT" coords="293,64,315,87" alt="&#1605;" />
        <area onclick="add('&#1606;');" shape="RECT" coords="263,63,286,87" alt="&#1606;" />
        <area onclick="add('&#1578;');" shape="RECT" coords="234,62,258,85" alt="&#1578;" />
        <area onclick="add('&#1575;');" shape="RECT" coords="206,64,229,87" alt="&#1575;" />
        <area onclick="add('&#1604;');" shape="RECT" coords="178,64,200,87" alt="&#1604;" />
        <area onclick="add('&#1576;');" shape="RECT" coords="148,63,170,86" alt="&#1576;" />
        <area onclick="add('&#1610;');" shape="RECT" coords="118,64,142,89" alt="&#1610;" />
        <area onclick="add('&#1587;');" shape="RECT" coords="90,64,112,87"  alt="&#1587;" />
        <area onclick="add('&#1588;');" shape="RECT" coords="60,64,84,86"   alt="&#1588;" />
        <area onclick="add('&#1583;');" shape="RECT" coords="371,34,397,58" alt="&#1583;" />
        <area onclick="add('&#1580;');" shape="RECT" coords="343,35,368,59" alt="&#1580;" />
        <area onclick="add('&#1581;');" shape="RECT" coords="315,33,339,58" alt="&#1581;" />
        <area onclick="add('&#1582;');" shape="RECT" coords="285,35,310,60" alt="&#1582;" />
        <area onclick="add('&#1607;');" shape="RECT" coords="255,34,280,57" alt="&#1607;" />
        <area onclick="add('&#1593;');" shape="RECT" coords="229,34,251,57" alt="&#1593;" />
        <area onclick="add('&#1594;');" shape="RECT" coords="198,35,222,58" alt="&#1594;" />
        <area onclick="add('&#1601;');" shape="RECT" coords="169,34,193,57" alt="&#1601;" />
        <area onclick="add('&#1602;');" shape="RECT" coords="140,33,165,58" alt="&#1602;" />
        <area onclick="add('&#1579;');" shape="RECT" coords="110,35,134,57" alt="&#1579;" />
        <area onclick="add('&#1589;');" shape="RECT" coords="82,36,103,57"  alt="&#1589;" />
        <area onclick="add('&#1590;');" shape="RECT" coords="51,35,71,55"   alt="&#1590;" />
      </map>
      
      <map name="key2_<?php echo $pocet_klavesnic;?>">
        <area onclick="add('&#1563;');"        shape="RECT" coords="318,3,344,31" alt="&#1563;" />
        <area onclick="add('/');"              shape="RECT" coords="282,4,308,32" alt="/" />
        <area onclick="add('&#1548;');"        shape="RECT" coords="255,6,277,31" alt="&#1548;" />
        <area onclick="add('&#1600;');"        shape="RECT" coords="225,3,248,30" alt="&#1600;" />
        <area onclick="add('&#1571;');"        shape="RECT" coords="195,4,222,32" alt="&#1571;" />
        <area onclick="add('&#1604;&#1571;');" shape="RECT" coords="168,6,192,32" alt="&#1604;&#1571;" />
        <area onclick="add('&#1567;');"        shape="RECT" coords="129,5,158,34" alt="&#1567;" />
        <area onclick="add('.');"              shape="RECT" coords="102,6,127,32" alt="." />
        <area onclick="add(',');"              shape="RECT" coords="71,6,96,32"   alt="," />
        <area onclick="add('&#1570;');"        shape="RECT" coords="37,6,62,32"   alt="&#1570;" />
        <area onclick="add('&#1604;&#1570;');" shape="RECT" coords="8,6,31,30"    alt="&#1604;&#1570;" />
      </map>

      <map name="key3_<?php echo $pocet_klavesnic;?>">
        <area onclick="add('&#1612;');"  shape="RECT" coords="318,3,344,31" alt="&#1612;" />
        <area onclick="add('&#x064D;');" shape="RECT" coords="282,4,308,32" alt="&#x064D;" />
        <area onclick="add('&#x064B;');" shape="RECT" coords="255,6,277,31" alt="&#x064B;" />
        <area onclick="add('&#x0651;');" shape="RECT" coords="225,3,248,30" alt="&#x0651;" />
        <area onclick="add('&#1574;');"  shape="RECT" coords="195,4,222,32" alt="&#1574;" />
        <area onclick="add('&#1572;');"  shape="RECT" coords="168,6,192,32" alt="&#1572;" />
        <area onclick="add('&#1618;');"  shape="RECT" coords="129,5,158,34" alt="&#1618;" />
        <area onclick="add('&#1615;');"  shape="RECT" coords="102,6,127,32" alt="&#1615;" />
        <area onclick="add('&#1616;');"  shape="RECT" coords="71,6,96,32"   alt="&#1616;" />
        <area onclick="add('&#1614;');"  shape="RECT" coords="37,6,62,32"   alt="&#1614;" />
        <area onclick="add('&#1588;');"  shape="RECT" coords="8,6,31,30"    alt="&#1588;" />
      </map>
      
      <map name="key4_<?php echo $pocet_klavesnic;?>">
        <!--area onclick="add('&#1612;');" shape="RECT" coords="318,3,344,31" alt="" />
        <area onclick="add('&#x064D;');" shape="RECT" coords="282,4,308,32" alt="" />
        <area onclick="add('&#x064B;');" shape="RECT" coords="255,6,277,31" alt="" />
        <area onclick="add('&#x0651;');" shape="RECT" coords="225,3,248,30" alt="" />
        <area onclick="add('&#1574;');" shape="RECT" coords="195,4,222,32" alt="" /-->
        <area onclick="add('&#x060C;');" shape="RECT" coords="168,6,192,32" alt="&#x060C;" />
        <area onclick="add('&#xFEF7;');" shape="RECT" coords="129,5,158,34" alt="&#xFEF7;" />
        <area onclick="add('&#xFEF9;');" shape="RECT" coords="102,6,127,32" alt="&#xFEF9;" />
        <area onclick="add('&#xFEFB;');" shape="RECT" coords="71,6,96,32"   alt="&#xFEFB;" />
        <area onclick="add('&#x0671;');" shape="RECT" coords="37,6,62,32"   alt="&#x0671;" />
        <area onclick="add('&#x0625;');" shape="RECT" coords="8,6,31,30"    alt="&#x0625;" />
      </map>
      
    </td>
  </tr>
  </tbody>
</table>
<?php
  if ($extended) insert_keyboard_ak($text_field);
  $GLOBALS["pocet_klavesnic"] += 1;
}

function insert_keyboard_ak($text_field) {
  //echo "hebrejska klavesnice";
    
  $cesta_k_obrazkum = "pict/";
  global $pocet_klavesnic;
 

?>

<table  border="0" cellpadding="10" cellspacing="0">
  <tbody>
  <tr>
    <td class="bodyline">
      <p align="center">
      <table>
  <tr>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00E1;" onclick="add('&#x00E1;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00E9;" onclick="add('&#x00E9;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00ED;" onclick="add('&#x00ED;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00FA;" onclick="add('&#x00FA;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E25;" onclick="add('&#x1E25;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x015B;" onclick="add('&#x015B;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value='&#x00C1;' onclick="add('&#x00C1;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00C9;" onclick="add('&#x00C9;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00CD;" onclick="add('&#x00CD;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00DA;" onclick="add('&#x00DA;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E24;" onclick="add('&#x1E24;')" />
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x015A;" onclick="add('&#x015A;')" /></td>
  </tr>
  <tr>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value='&#x00E0;' onclick="add('&#x00E0;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00E8;" onclick="add('&#x00E8;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00EC;" onclick="add('&#x00EC;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00F9;" onclick="add('&#x00F9;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00F2;" onclick="add('&#x00F2;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E6F;" onclick="add('&#x1E6F;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00C0;" onclick="add('&#x00C0;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00C8;" onclick="add('&#x00C8;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00CC;" onclick="add('&#x00CC;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00D9;" onclick="add('&#x00D9;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00D2;" onclick="add('&#x00D2;')" /></td>
  </tr>
  <tr>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value='&#x00E2;' onclick="add('&#x00E2;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00EA;" onclick="add('&#x00EA;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00EE;" onclick="add('&#x00EE;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00FB;" onclick="add('&#x00FB;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00F4;" onclick="add('&#x00F4;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E0F;" onclick="add('&#x1E0F;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00C2;" onclick="add('&#x00C2;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00CA;" onclick="add('&#x00CA;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00DB;" onclick="add('&#x00DB;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x00D4;" onclick="add('&#x00D4;')" /></td>
    <td>
      <input class="tlacitko2" style="height:25;width:15" type="button" value="&#x2308;" onclick="add('&#x2308;')" />
      <input class="tlacitko2" style="height:25;width:15" type="button" value="&#x2309;" onclick="add('&#x2309;')" /></td>
</tr>
<tr>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value='&#x0101;' onclick="add('&#x0101;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x0113;" onclick="add('&#x0113;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x012B;" onclick="add('&#x012B;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x016B;" onclick="add('&#x016B;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x014D;" onclick="add('&#x014D;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E0D;" onclick="add('&#x1E0D;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x0100;" onclick="add('&#x0100;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x0112;" onclick="add('&#x0112;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x012A;" onclick="add('&#x012A;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x016A;" onclick="add('&#x016A;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x014C;" onclick="add('&#x014C;')" /></td>
  </tr>
  <tr>
    <td>
      <input class="tlacitko2" style="height:25;width:25" type="button" value="&#x02BE;" onclick="add('&#x02BE;')" /></td>
    <td>
      <input class="tlacitko2" style="height:25;width:25" type="button" value="&#x02BF;" onclick="add('&#x02BF;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E63;" onclick="add('&#x1E63;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x0161;" onclick="add('&#x0161;')" /></td>
    <td>
      <input class="tlacitko1" style="height:25;width:25" type="button" value="&#x1E6D;" onclick="add('&#x1E6D;')" /></td>
    <td>
      <input class="tlacitko2" style="height:30;width:25" type="button" value="&#x1E2B;" onclick="add('&#x1E2B;')" /></td>
    <td>
      <input class="tlacitko2" style="height:30;width:25" type="button" value="&#x1E62;" onclick="add('&#x1E62;')" /></td>
    <td>
      <input class="tlacitko2" style="height:30;width:25" type="button" value="&#x0160;" onclick="add('&#x0160;')" /></td>
    <td>
      <input class="tlacitko2" style="height:30;width:25" type="button" value="&#x1E6C;" onclick="add('&#x1E6C;')" /></td>
    <td>
      <input class="tlacitko2" style="height:30;width:25" type="button" value="&#x1E2A;" onclick="add('&#x1E2A;')" /></td>
    <td>
      <input class="tlacitko2" style="height:25;width:15" type="button" value="[" onclick="add('[')" />
      <input class="tlacitko2" style="height:25;width:15" type="button" value="]" onclick="add(']')" /></td>
  </tr>
  <tr>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="1" onclick="add('1')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="2" onclick="add('2')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="3" onclick="add('3')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="4" onclick="add('4')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="5" onclick="add('5')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="6" onclick="add('6')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="7" onclick="add('7')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="8" onclick="add('8')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="9" onclick="add('9')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="0" onclick="add('0')" /></td>
    <td>
      <input class=tlacitko2 style="height:25;width:32" type="button" value="x" onclick="add('x')" /></td>
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
