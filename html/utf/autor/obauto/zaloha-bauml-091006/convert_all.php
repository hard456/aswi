<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <LINK REL=StyleSheet HREF="/utf/obtc1.css" TYPE="text/css" MEDIA="screen, print">
  <title>----------- list ------------------</title>
</HEAD>
<body>


<?

$datadir = "/home/webowner/html/pub/";
//$htmldir = "www.klinopis.cz/pub/";
// tempdir musi byt vytvoren
$tempdir = "/home/webowner/html/pub/temp/";
//$temphtmldir = "www.klinopis.cz/pub/temp/";


do
{

  require_once("sql.php");

$dotaz = "select Directory, Rotate from autophoto where idautophoto = $autophoto";
//echo $dotaz;
@$result_auto = Pg_Exec($dotaz);
List($directory, $rotate) = Pg_Fetch_Row ($result_auto, 0, PGSQL_NUM);

$dir = $datadir . $directory;
  

  if (!File_Exists($dir)) {
    echo "directory not found";
    echo $dir;
    break;
  }
  // zobrazeni obrazku s nadpisem
$tempdir = $tempdir . $directory;

  if (!File_Exists($tempdir)) {
    MkDir($tempdir, 0777);
  }
  
  if (($adr = OpenDir($dir)) != false) {
	$file_count = 0;
	$header_exist = false;
	while (($name = ReadDir($adr)) != false) {
		if (FileType("$dir/$name") == "file") {
		
  			// udelat vzdy if (!File_Exists($name)) {
    			$executable = $datadir . "tiff2png -destdir " . $tempdir . " -force " . $dir . "/$name"; 
			//echo $executable;
			echo "moving file $name to temp directory<br>";
			$str = exec("$executable", $returnvar, $status);
    			//rotace - je treba udelat jen nekdy  
    			if ($rotate != 0) {
				$name = basename($name, ".TIF"); // je treba zmenit v pripade zmeny na 'tif'
				$fname = "$tempdir/$name" . ".png";
				echo "rotating file $fname<br>";
      				$image = imagecreatefrompng($fname);
      				$final_img = ImageRotate($image, $rotate, 0);
      				imagepng($final_img, $fname);
				imagedestroy($image);
				imagedestroy($final_img);
    			}  
		}	
	}	
  } 
} while (false);
?>
</body>
</html>
