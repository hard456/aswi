<?php 

// Vasek Marik pro KAR
// $where - co zobrazit
// $order - poradi
// $ids - predzpracovane IDcka
// $poradi - kolikaty z kolekce zobrazit


#require "global.inc.php" ;

include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();


$datadir = "/home/webowner/html/pub/";
$htmldir = "147.228.3.184/pub/";
// tempdir musi byt vytvoren
$tempdir = "/home/webowner/html/pub/temp/";
$temphtmldir = "147.228.3.184/pub/temp/";

?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="css/ksa.css" TYPE="text/css" MEDIA="screen, print">
  <title>-----------view------------------</title>
</HEAD>
<body onresize = "if (zvetseni == -1) resize_image_start('artefakt', 'W')">

<?

$MERITKO = Array(0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1, 1.2, 1.4, 1.6, 1.8, 2, 2.2, 2.4, 2.6, 2.8, 3);
$VYSKA = Array(100, 200, 300, 400, 490, 590, 680, 780, 870, 1000, 1200, 1400, 1600, 2000, 2500);
$MAX_SIRKA = Array(133, 267, 400, 533, 653, 787, 907, 1040, 1160, 1333, 1600, 1867, 2133, 2667, 3333);
$MERITKO_START = -1;
$VYSKA_START = 10;
$FIT_TO_WIDTH = -1;
$ORIGINAL_SIZE = -2;

?>
    <script language="JavaScript">
	<!--

		var VYSKA = new Array(<? echo sizeof($VYSKA) ?>);
		<? for ($i=0; $i < sizeof($VYSKA); $i++) echo "VYSKA[$i] = $VYSKA[$i];\n"; ?>

		var MAX_SIRKA = new Array(<? echo sizeof($MAX_SIRKA) ?>);
		<? for ($i=0; $i < sizeof($MAX_SIRKA); $i++) echo "MAX_SIRKA[$i] = $MAX_SIRKA[$i];\n"; ?>

		<?	if (!IsSet($zvetseni) || $zvetseni == "") echo "var zvetseni= $VYSKA_START;\n";
			else echo "var zvetseni=$zvetseni;\n"; ?>
		var VYSKA_START = <? echo $VYSKA_START ?>;
		var ORIGINAL_SIZE = <? echo $ORIGINAL_SIZE ?>;
		var FIT_TO_WIDTH = <? echo $FIT_TO_WIDTH ?>;
		var VYSKA_MIN = 0;
		var VYSKA_MAX = <? echo (sizeof($VYSKA)-1) ?>;
        var FROMPAGE = 0; 
        var TOPAGE = 0; 
        var AUTOPHOTO = 0; 

		<?	if (!IsSet($poradi) || $poradi == "") echo "var poradi = 0;\n";
			else echo "var poradi=$poradi;\n"; ?>
		var poradi_max = <? echo sizeof($ids)-1 ?>;

			
		function set_className(objekt_name, class_name) {
			for (i = 0; i < document.getElementsByName(objekt_name).length; i++)  {
				if ((document.getElementsByName(objekt_name).item(i).className != 'hover') || (class_name != 'active')) document.getElementsByName(objekt_name).item(i).className = class_name;
			}
		}

		function change_urls() {

			var pw;
            var constant;

			if (zvetseni == FIT_TO_WIDTH) pw = '&pw=' + (document.body.offsetWidth - 40);
			else pw = '';
            constant = '&autophoto=' + AUTOPHOTO + '&frompage=' + FROMPAGE + '&topage=' + TOPAGE;

			for (i = 0; i < document.getElementsByName("firstref").length; i++)  {
				if (document.getElementsByName("firstref").item(i).className == "active") document.getElementsByName("firstref").item(i).href = "jdata.php?poradi=0&zvetseni=" + zvetseni + pw + constant;
			}
			for (i = 0; i < document.getElementsByName("prevref").length; i++)  {
				if (document.getElementsByName("prevref").item(i).className == "active") document.getElementsByName("prevref").item(i).href = "jdata.php?poradi=" + (poradi-1) + "&zvetseni=" + zvetseni + pw + constant;
			}
			for (i = 0; i < document.getElementsByName("nextref").length; i++)  {
				if (document.getElementsByName("nextref").item(i).className == "active") document.getElementsByName("nextref").item(i).href = "jdata.php?poradi=" + (poradi+1) + "&zvetseni=" + zvetseni + pw + constant;
			}
			for (i = 0; i < document.getElementsByName("lastref").length; i++)  {
				if (document.getElementsByName("lastref").item(i).className == "active") document.getElementsByName("lastref").item(i).href = "jdata.php?poradi=" + poradi_max + "&zvetseni=" + zvetseni + pw + constant;
			}
			
		}

		function resize_image_start(obrazek, status) {
			if (status=="W") zvetseni = FIT_TO_WIDTH;
			if (status=="O") zvetseni = ORIGINAL_SIZE;
			if ((status==1) && (zvetseni < VYSKA_MAX) && (zvetseni != ORIGINAL_SIZE) && (zvetseni != FIT_TO_WIDTH)) zvetseni = zvetseni + 1;
			if ((status==-1) && (zvetseni > VYSKA_MIN) && (zvetseni != ORIGINAL_SIZE) && (zvetseni != FIT_TO_WIDTH)) zvetseni = zvetseni - 1;
			if (status==0) zvetseni = VYSKA_START;
			if (status >= 100) zvetseni = VYSKA_MAX;
			if (status <= -100) zvetseni = VYSKA_MIN;
			if (zvetseni >= 0) {
				height = VYSKA[zvetseni];
				width = REAL_WIDTH * (height/REAL_HEIGHT);
				// zmenseni kvuli prekroceni maximalni sirky
				if (width > MAX_SIRKA[zvetseni]) {
					scale = MAX_SIRKA[zvetseni]/width;
					height = height * scale;
					width = MAX_SIRKA[zvetseni];
				}
			}
			else {
				if (zvetseni == FIT_TO_WIDTH) {
					width = document.body.offsetWidth - 40;
					height = REAL_HEIGHT * (width/REAL_WIDTH);
				}
				else {
					width = REAL_WIDTH;
					height  = REAL_HEIGHT;
				}
			}


			set_className("fitzoom", "active");
			set_className("origzoom", "active");
			set_className("pluszoom", "active");
			set_className("minuszoom", "active");
			set_className("optzoom", "active");
			set_className("minzoom", "active");
			set_className("maxzoom", "active");

			if (zvetseni == ORIGINAL_SIZE) {
				set_className("origzoom", "passive");
				set_className("pluszoom", "passive");
				set_className("minuszoom", "passive");
			}
			if (zvetseni == FIT_TO_WIDTH) {
				set_className("fitzoom", "passive");
				set_className("pluszoom", "passive");
				set_className("minuszoom", "passive");
			}
			if (zvetseni == VYSKA_MIN) {
				set_className("minzoom", "passive");
				set_className("minuszoom", "passive");
			}
			if (zvetseni == VYSKA_MAX) {
				set_className("maxzoom", "passive");
				set_className("pluszoom", "passive");
			}
			if (zvetseni == VYSKA_START) set_className("optzoom", "passive");

			change_urls();
			
			document.images.item(obrazek).width = width;
			document.images.item(obrazek).height = height;

		}

		function resize_image(obrazek, status, objekt) {

			if (objekt.className != "passive") {
				resize_image_start(obrazek, status);
			}

		}

	-->
	</script>

<?
function menu($info = "", $akce = "") {

global $poradi, $zvetseni, $actualpage, $frompage, $topage, $autophoto, $VYSKA, $VYSKA_START, $FIT_TO_WIDTH, $ORIGINAL_SIZE, $pw;

?>
	
			<script language="JavaScript">
			<!--

				function set_hover(objekt) {
					if (objekt.className == "active") {
						objekt.className="hover";
						window.status=objekt.title;
					}
				}


				function unset_hover(objekt) { 
					if (objekt.className == "hover") {
						objekt.className='active';
						window.status=window.defaultStatus;
					}
				}
	
			-->
			</script>
<?

		echo "<table width=\"100%\"><tr>\n";

		echo "<td class=\"menu\" align=\"left\" width=\"20%\" nowrap>";
		echo "$info&nbsp;";
		echo "</td>\n";
		
		
		echo "<td class=\"menu\" align=\"right\" width=\"20%\" nowrap>&nbsp;";
                     
		if (IsSet($pw)) $xpw = "&pw=$pw";	
		if ($actualpage > $frompage) echo "<a href=\"jdata.php?autophoto=$autophoto&frompage=$frompage&topage=$topage&poradi=1&zvetseni=$zvetseni$xpw\" class=\"active\" id=\"firstref\" name=\"firstref\" title=\"first record\">&lt;&lt;</a> ";
		else echo "<a class=\"passive\" id=\"firstref\" name=\"firstref\" title=\"first record\">&lt;&lt;</a> ";
		if ($actualpage > $frompage) echo "| <a href=\"jdata.php?autophoto=$autophoto&frompage=$frompage&topage=$topage&poradi=" . ($poradi-1) . "&zvetseni=$zvetseni$xpw\" class=\"active\" id=\"prevref\" name=\"prevref\" title=\"previous record\">&lt;</a> ";
		else echo "| <a class=\"passive\" id=\"prevref\" name=\"prevref\" title=\"previous record\">&lt;</a> ";
		if ($actualpage < $topage) echo "| <a href=\"jdata.php?autophoto=$autophoto&frompage=$frompage&topage=$topage&poradi=" . ($poradi+1) . "&zvetseni=$zvetseni$xpw\" class=\"active\" id=\"nextref\" name=\"nextref\" title=\"next record\">&gt;</a> ";
		else echo "| <a class=\"passive\" id=\"nextref\" name=\"nextref\" title=\"next record\">&gt;</a> ";
		if ($actualpage < $topage) echo "| <a href=\"jdata.php?autophoto=$autophoto&frompage=$frompage&topage=$topage&poradi=" . ($topage - $frompage + 1) . "&zvetseni=$zvetseni$xpw\" class=\"active\" id=\"lastref\" name=\"lastref\" title=\"last record\">&gt;&gt;</a> ";
		else echo "| <a class=\"passive\" title=\"last record\">&gt;&gt;</a> ";
	
		echo "&nbsp;&nbsp;</td>\n<td class=\"menu\" align=\"left\" width=\"20%\" nowrap>&nbsp;&nbsp;";
	
		if ($zvetseni != 0) echo "<span class=\"active\" id=\"minzoom\" name=\"minzoom\" title=\"minimal size\" onclick=\"resize_image('artefakt', -100, this);\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">--</span> ";
		else echo "<span class=\"passive\" id=\"minzoom\" name=\"minzoom\" title=\"minimal size\" onclick=\"resize_image('artefakt', -100, this);\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">--</span>";
		if ($zvetseni > 0 && $zvetseni != $ORIGINAL_SIZE && $zvetseni != $FIT_TO_WIDTH) echo "| <span class=\"active\" id=\"minuszoom\" name=\"minuszoom\" title=\"decrease size\" onclick=\"resize_image('artefakt', -1, this);\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">-</span> ";
		else echo "| <span class=\"passive\" id=\"minuszoom\" name=\"minuszoom\" title=\"decrease size\" onclick=\"resize_image('artefakt', -1, this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">-</span> ";
		if ($zvetseni != $VYSKA_START) echo "| <span class=\"active\" id=\"optzoom\" name=\"optzoom\" title=\"optimal size\" onclick=\"resize_image('artefakt', 0, this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">=</span> ";
		else echo "| <span class=\"passive\" id=\"optzoom\" name=\"optzoom\" title=\"optimal size\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\" onclick=\"resize_image('artefakt', 0, this)\">=</span> ";
		if ($zvetseni != $ORIGINAL_SIZE) echo "| <span class=\"active\" id=\"origzoom\" name=\"origzoom\" title=\"real size\" onclick=\"resize_image('artefakt', 'O', this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">1:1</span> ";
		else echo "| <span class=\"passive\" id=\"origzoom\" name=\"origzoom\" title=\"real size\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\" onclick=\"resize_image('artefakt', 'O', this)\">1:1</span> ";
		if ($zvetseni != $FIT_TO_WIDTH) echo "| <span class=\"active\" id=\"fitzoom\" name=\"fitzoom\" title=\"fit to monitor width\" onclick=\"resize_image('artefakt', 'W', this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">&hArr;</span> ";
		else echo "| <span class=\"passive\" id=\"fitzoom\" name=\"fitzoom\" title=\"fit to monitor width\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\" onclick=\"resize_image('artefakt', 'W', this)\">&hArr;</span> ";
		if ($zvetseni < (sizeof($VYSKA)-1) && $zvetseni != $ORIGINAL_SIZE && $zvetseni != $FIT_TO_WIDTH) echo "| <span class=\"active\" id=\"pluszoom\" name=\"pluszoom\" title=\"increase size\" onclick=\"resize_image('artefakt', 1, this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">+</span> ";
		else echo "| <span class=\"passive\" id=\"pluszoom\" name=\"pluszoom\" title=\"increase size\" onclick=\"resize_image('artefakt', 1, this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">+</span> ";
		if ($zvetseni != sizeof($VYSKA)-1) echo "| <span class=\"active\" id=\"maxzoom\" name=\"maxzoom\" title=\"maximal size\" onclick=\"resize_image('artefakt', 100, this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">++</span> ";
		else echo "| <span class=\"passive\" id=\"maxzoom\" name=\"maxzoom\" title=\"maximal size\" onclick=\"resize_image('artefakt', 100, this)\" onmouseover=\"set_hover(this);\" onmouseout=\"unset_hover(this);\">++</span> ";

		echo "&nbsp;</td>\n";
		
		echo "<td class=\"menu\" align=\"right\" width=\"30%\" nowrap>&nbsp;";
		echo "$akce";
		echo "</td>\n";
		
		echo "</tr></table>";
		echo "<br>";

}



if (!IsSet($poradi) || $poradi == "") $poradi = 1;
if (!IsSet($zvetseni) || $zvetseni == "") $zvetseni = $VYSKA_START;

if (!IsSet($where)) $where = "";
if (!IsSet($poradi)) $poradi = false;

do
{

  @$connection = Pg_Connect ("user=dbowner dbname=ksa");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;

$frompage = (int) $frompage;
$topage = (int) $topage;

$dotaz = "select Directory, Rotate, Type, Title, FromPage, ToPage, IDBook from autophoto left join book on (book.Autophoto = autophoto.IDAutophoto) where idbook = $autophoto";
//echo $dotaz;
@$result_auto = Pg_Exec($dotaz);
if (Pg_NumRows ($result_auto) > 0){
  List($directory, $rotate, $type, $title, $tfrompage, $ttopage, $idbook) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);
    $dotaz = "select TitleBefore, Name, Surname, TitleAfter from book_author left join author on (author.IDAuthor = book_author.IDAuthor) where IDBook = $idbook order by Surname";
    //echo $dotaz;
    @$result_authors = Pg_Exec($dotaz);
    $authors = Pg_NumRows ($result_authors);
    $author = "";
    for ($j = 0; $j < $authors; $j++) {
      List($titlebefore, $name, $surname, $titleafter) = Pg_Fetch_Row ($result_authors, $j, PGSQL_NUM);
      if ($author != "") $author .= ", ";
      $author .= "$titlebefore $name $surname $titleafter";
    }
}
else {
  echo "nothing found";
  break;
}

  if ($frompage == 0) $frompage = (int) $tfrompage;
  if ($topage == 0) $topage = (int) $ttopage;

  if ($directory == "") {
    echo "directory not found";
    break;
  }

  $dir = $datadir . $directory;
  

  if (!File_Exists($dir)) {
    echo "directory not found";
    echo $dir;
    break;
  }
  if (($adr = OpenDir($dir)) != false) {
	$file_count = 0;
	$header_exist = false;
	while (($name = ReadDir($adr)) != false) {
		if (FileType("$dir/$name") == "file") $file_count++;
		if ((FileType("$dir/$name") == "dir" && $name != "." && $name != "..")) {
			$header_exist = true;
			$header_name = $name;
        }
	}
    CloseDir($adr);

  }
  else {
    echo "directory not found";
    break;
  }
  if ($view_header == 1) {
    if ($header_exist <> 1) {
      echo "directory not found";
      break;       
    }
    $dir = "$dir/$header_name";	
    if (!File_Exists($dir)) {
      echo "directory not found";
      break;
    }
    if (($adr = OpenDir($dir)) != false) {
      $file_count = 0;
      while (($name = ReadDir($adr)) != false) {
	    if (FileType("./$dir/$name") == "file") $file_count++;
      }
      CloseDir($adr);
    }
  }
  if ($topage <= 0) $topage = $file_count;
 // else $topage = Min($file_count, $topage);
  if ($frompage <= 0) $frompage = 1;

  $actualpage = $frompage + $poradi -1;
  if ($topage < $actualpage) $actualpage = $topage;
  if ($actualpage < $frompage) $actualpage = $frompage;
  
?>

				<script language="JavaScript">
				<!--

                TOPAGE = <? echo $topage ?>;
                FROMPAGE = <? echo $frompage ?>;
                AUTOPHOTO = '<? echo $autophoto ?>';

				-->
				</script>
<?


  // zobrazeni obrazku s nadpisem
  $tempdir = $tempdir . $directory;
  $temphtmldir = $temphtmldir . $directory;
//  echo $tempdir . "<br>";
  if (!File_Exists($tempdir)) {
    MkDir($tempdir, 0777);
  }
  $name = $tempdir."/page".sprintf ("%04d", $actualpage).".png";
  //echo $name;
  
  if (!File_Exists($name)) {
    $executable = $datadir . "tiff2png -destdir " . $tempdir . " -force " . $datadir . $directory . "/page" . sprintf ("%04d", $actualpage) . ".TIF"; 
    //echo $executable;
    $str = exec("$executable", $returnvar, $status);
    //rotace - je treba udelat jen nekdy  
    if ($rotate != 0) {
      $image = imagecreatefrompng($name);
      $final_img = ImageRotate($image, $rotate, 0);
      imagepng($final_img, $name);
      imagedestroy($image);
      imagedestroy($final_img);    
    }  
  } 
  
  $filename = $name;
//  $filename = $dir . "/page" . sprintf ("%04d", $actualpage) . ".tif"; 
  if (!File_Exists($filename)) {
    echo "<br>file $filename not found<br>";
    break;
  }

  $info = "$author: $title<br>";		

  menu($info);
  // zobrazit obrazek
  $size = getimagesize($filename);
  $obr = "http://" . $temphtmldir . "/page" . sprintf ("%04d", $actualpage) . ".png"; 
  //$obr = "www.klinopis.cz/utf/autor/obauto/blob.php?name=$filename";
  //echo "<br>$obr";
  
//  $obr = "http://" . $htmldir . $directory . "/page" . sprintf ("%04d", $actualpage) . ".png"; 
//  $obr = "http://" . $htmldir . $directory . "/page" . sprintf ("%04d", $actualpage) . ".tif"; 
?>

				<script language="JavaScript">
				<!--

                var REAL_WIDTH = <? echo $size[0] ?>;
				var REAL_HEIGHT = <? echo $size[1] ?>;

				-->
				</script>
<?

			if ($zvetseni >= 0) {
				$height = $VYSKA[$zvetseni];
				//echo $size[2];
				$width = $size[0] * ($height/$size[1]);
//				echo "width2:$width";
				// zmenseni kvuli prekroceni maximalni sirky
				if ($width > $MAX_SIRKA[$zvetseni]) {
					$scale = $MAX_SIRKA[$zvetseni]/$width;
					$height = $height * $scale;
					$width = $MAX_SIRKA[$zvetseni];
				}
			}
			elseif ($zvetseni == $FIT_TO_WIDTH && IsSet($pw)) {
				$width = $pw;
				$height = $size[1] * ($width/$size[0]);
			}
			else {
				$height = $size[1];
				$width = $size[0];
			}

			/*$scale = $MERITKO[$zvetseni];
			$width = round($size[0] * $scale);
			$height = round($size[1] * $scale);*/

			echo "<center><img src=\"$obr\" name=\"artefakt\" alt=\"" . HTMLSpecialChars("$author: $title") . "\" align=\"middle\" width=\"$width\" height=\"$height\"></center>";
			echo "<br>";
		
		menu("", $akce);

} while (false);

?>

</body>
</html>
