<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
<title>OBTC - OBDICT2</title>
</head>
<frameset cols="*,30%">
<frameset rows="75%,*">
          <frame name="MAIN" src="2ob1.php">
          <frame name="help" src="2obhelp.php">
</frameset>
<frameset rows="100%">
<?
if ($auth_level == 10) {
					echo "<frame name=\"right\" src=\"2obshortlistfr.php\">";
				        }
					else {
					echo "<frame name=\"right\" src=\"2obshortlist.php\">";
					}
?>
</frameset>
</frameset>
<noframes>
</body>
</noframes>
</html>
