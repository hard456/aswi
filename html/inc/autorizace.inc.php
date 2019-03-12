<?
if (empty($AUTORIZACE_INC_PHP)):
$AUTORIZACE_INC_PHP = 1;
define(LEVEL_WEBMASTER, "10");
define(LEVEL_SUPER_UZIVATEL, "9");
define(LEVEL_UZIVATEL, "1");
$auth_level = 0;
$auth = "";
$auth_userkod = "";
function ksa_authorize() 
{
	global $PHP_AUTH_USER, $PHP_AUTH_PW;
	global $auth_level, $auth_userkod, $auth;
	$auth_level = 0;
	$auth_userkod = "";
	$PHP_AUTH_PW = MD5($PHP_AUTH_PW);
    @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
    if (!$connection):
      //echo "Nepodarilo se pripojit k databázi!";
      return 0;
    endif;
	$uzivatele = pg_exec("select kod, autor, heslo, menu from c_autor where kod = '$PHP_AUTH_USER' AND heslo = '$PHP_AUTH_PW' order by menu DESC");
	$rows = @Pg_NumRows ($uzivatele);
	if ($rows > 0) {
	  List($kod, $autor, $heslo, $menu)= Pg_Fetch_Row($uzivatele, 0, PGSQL_NUM);
	  $auth_level = $menu;
	  $auth_userkod = $kod;
	  $auth = $kod;
	}
	else {
	  $auth_level = 0;
	  $auth_userkod = "";
	  $auth = "";
	}
	Pg_Close ($connection);
	return $auth_level;
}
function ksa_unauthorized()
{
	Header("Pragma: no-cache");
	Header("Cache-Control: no-cache, must-revalidate");        
       Header("WWW-Authenticate: Basic realm=\"OBTC\"");
       Header("HTTP/1.0 401 Unauthorized");
	echo "You don't have a permission to edit something, contact the administrator Mr. <a href=\"mailto:rahman@kbs.zcu.cz\">>F. Rahman</a> if you like to join us.";
	die();
}

endif;
