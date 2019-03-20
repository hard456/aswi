<?
include "autorizace.inc.php";
ksa_authorize();
//if ($auth_level == 0) ksa_unauthorized();
if ($auth_level < 10) ksa_unauthorized();
?>
<HTML>
<META http-equiv=Content-Type content=text/html; charset=utf-8>
<head>
  <title>Delete an entry from the Old Babylonian dictionary</title>
</head>

<body>
<h3><center>Delete an entry from the old version</center></h3>


<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Nepoda詬o se p詰ojit k databẩ!";
    break;
  endif;
  @$result = Pg_Exec(
		"delete from obdict WHERE oid=$co");
  if (!$result):
    echo "Doڬo k chyb젰詠zpracovᮭ SQL dotazu!";
    break;
  endif;
  echo "$oid, $item was deleted!";
</body>
</html>