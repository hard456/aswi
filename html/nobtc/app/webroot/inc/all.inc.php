<?php

//require_once('autorizace.inc.php');
//ksa_authorize();
//if ($auth_level == 0) ksa_unauthorized();
/*
$auth = $_SERVER['PHP_AUTH_USER'] == "fr02" && $_SERVER['PHP_AUTH_PW'] == "fr03";
if (!$auth) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="New OBTC"');

    echo "<p>Pro přístup na tuto stránku se musíte přihlásit.</p>\n";
    exit;
}*/

define(INDEX_TMPL, './tmpl/index.tmpl.php');

require_once('./inc/templ.class.php');
require_once('./inc/main.inc.php');
require_once("./sql/db.php");

require_once('./class/search.class.php');
require_once('./class/searchtransliterationinfo.class.php');
require_once('./class/searchbook.class.php');
require_once('./class/searchcatalog.class.php');
require_once('./class/searchtext.class.php');
require_once('./class/transliteration.class.php');
require_once('./class/sorter.class.php');
require_once('./class/analyzator.class.php');
require_once('./class/reference.class.php');
require_once('./class/picture.class.php');
