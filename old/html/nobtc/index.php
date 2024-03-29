<?php
/* SVN FILE: $Id: index.php 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 * Requests collector.
 *
 *  This file collects requests if:
 *	- no mod_rewrite is avilable or .htaccess files are not supported
 *	-/public is not set as a web root.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *  Get Cake's root directory
 */
	define('APP_DIR', 'app');
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__));
	define('WEBROOT_DIR', 'webroot');
	define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);
/**
 * This only needs to be changed if the cake installed libs are located
 * outside of the distributed directory structure.
 */
	if (!defined('CAKE_CORE_INCLUDE_PATH')) {
		//define ('CAKE_CORE_INCLUDE_PATH', FULL PATH TO DIRECTORY WHERE CAKE CORE IS INSTALLED DO NOT ADD A TRAILING DIRECTORY SEPARATOR';
		define('CAKE_CORE_INCLUDE_PATH', ROOT);
	}
	if (function_exists('ini_set')) {
		ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . CAKE_CORE_INCLUDE_PATH . PATH_SEPARATOR . ROOT . DS . APP_DIR . DS);
		define('APP_PATH', null);
		define('CORE_PATH', null);
	} else {
		define('APP_PATH', ROOT . DS . APP_DIR . DS);
		define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
	}
	require CORE_PATH . 'cake' . DS . 'basics.php';
	require APP_PATH . 'config' . DS . 'core.php';
	require CORE_PATH . 'cake' . DS . 'config' . DS . 'paths.php';
	$bootstrap=true;
	$uri      =setUri();
/**
 * As mod_rewrite (or .htaccess files) is not working, we need to take care
 * of what would normally be rewritten, i.e. the static files in app/webroot/
 */
	if ($uri === '/' || $uri === '/index.php') {
		$_GET['url'] = '/';
		require APP_DIR . DS . WEBROOT_DIR . DS . 'index.php';
	} else {
		$elements=explode('/index.php', $uri);

		if (!empty($elements[1])) {
			$path = $elements[1];
		} else {
			$path = '/';
		}
		$_GET['url']=$path;
		require APP_DIR . DS . WEBROOT_DIR . DS . 'index.php';
	}
