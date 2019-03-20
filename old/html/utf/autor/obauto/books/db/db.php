<?php

include('ado/adodb.inc.php');
/*
 * php5
 * Implementace databazoveho rozhrani - pouziva Ado DB Abstraction library.
 *
 */ 

$_GLOB_DB = NULL;

function &NewDB($db='postgres') {
    global $_GLOB_DB;
    if( $_GLOB_DB != NULL)
      return $_GLOB_DB;
    $_GLOB_DB = & ADONewConnection($db);
    //parametry
    $server = '';
    $user = 'dbowner';
    $pwd = 'ex684dld';
    $db = 'books';
    //pripojeni
    $_GLOB_DB->PConnect($server, $user, $pwd, $db);
    $_GLOB_DB->debug = false;
    return $_GLOB_DB;
  }
 
