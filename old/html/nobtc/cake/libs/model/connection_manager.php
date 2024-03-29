<?php
/* SVN FILE: $Id: connection_manager.php 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
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
 * @subpackage		cake.cake.libs.model
 * @since			CakePHP(tm) v 0.10.x.1402
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Load files needed by this class
 */
uses ('model' . DS . 'datasources' . DS . 'datasource');
config('database');
/**
 * Manages loaded instances of DataSource objects
 *
 * Long description for file
 *
 * @package		cake
 * @subpackage	cake.cake.libs.model
 */
class ConnectionManager extends Object{
/**
 * Holds a loaded instance of the Connections object
 *
 * @var class:Connections
 * @access public
 */
	var $config = null;
/**
 * Holds instances DataSource objects
 *
 * @var array
 * @access protected
 */
	var $_dataSources = array();
/**
 * Contains a list of all file and class names used in Connection settings
 *
 * @var array
 * @access protected
 */
	var $_connectionsEnum = array();
/**
 * Constructor.
 *
 */
	function __construct() {
		if (class_exists('DATABASE_CONFIG')) {
			$this->config = new DATABASE_CONFIG();
		}
	}
/**
 * Gets a reference to the ConnectionManger object instance
 *
 * @return object Instance of ConnectionManager
 * @access public
 */
	function &getInstance() {
		static $instance = array();

		if (!isset($instance[0]) || !$instance[0]) {
			$instance[0] = &new ConnectionManager();
		}

		return $instance[0];
	}
/**
 * Gets a reference to a DataSource object
 *
 * @param string $name The name of the DataSource, as defined in app/config/database.php
 * @return object Instance of Dbo
 * @access public
 */
	function &getDataSource($name) {
		$_this =& ConnectionManager::getInstance();

		if (in_array($name, array_keys($_this->_dataSources))) {
			return $_this->_dataSources[$name];
		}

		$connections = $_this->enumConnectionObjects();
		if (in_array($name, array_keys($connections))) {
			$conn = $connections[$name];
			$class = $conn['classname'];
			$_this->loadDataSource($name);
			$_this->_dataSources[$name] =& new $class($_this->config->{$name});
			$_this->_dataSources[$name]->configKeyName = $name;
		} else {
			trigger_error("ConnectionManager::getDataSource - Non-existent data source {$name}", E_USER_ERROR);
			return null;
		}

		return $_this->_dataSources[$name];
	}
/**
 * Gets a DataSource name from an object reference
 *
 * @param object $source
 * @return string
 * @access public
 */
	function getSourceName(&$source) {
		$_this =& ConnectionManager::getInstance();

		$names = array_keys($_this->_dataSources);
		for ($i = 0; $i < count($names); $i++) {
			if ($_this->_dataSources[$names[$i]] === $source) {
				return $names[$i];
			}
		}
		return null;
	}
/**
 * Loads the DataSource class for the given connection name
 *
 * @param string $connName The name of the connection, as defined in Connections config
 * @return boolean True on success, false on failure or if the class is already loaded
 * @access public
 */
	function loadDataSource($connName) {

		$_this =& ConnectionManager::getInstance();
		$connections = $_this->enumConnectionObjects();
		$conn = $connections[$connName];

		if (class_exists($conn['classname'])) {
			return false;
		}

		if(file_exists(MODELS . $conn['filename'] . '.php')) {
			require (MODELS . $conn['filename'] . '.php');
		} else if (fileExistsInPath(LIBS . 'model' . DS . $conn['filename'] . '.php')) {
			require (LIBS . 'model' . DS . $conn['filename'] . '.php');
		} else {
			trigger_error('Unable to load DataSource file ' . $conn['filename'] . '.php', E_USER_ERROR);
			return null;
		}
	}
/**
 * Gets a list of class and file names associated with the user-defined DataSource connections
 *
 * @return array An associative array of elements where the key is the connection name
 *               (as defined in Connections), and the value is an array with keys 'filename' and 'classname'.
 * @access public
 */
	function enumConnectionObjects() {
		$_this =& ConnectionManager::getInstance();

		if (!empty($_this->_connectionsEnum)) {
			return $_this->_connectionsEnum;
		}
		$connections = get_object_vars($_this->config);

		if ($connections != null) {

			foreach($connections as $name => $config) {

				if (!isset($config['datasource'])) {
					$config['datasource'] = 'dbo';
				}

				if (isset($config['driver']) && $config['driver'] != null && !empty($config['driver'])) {
					$filename = $config['datasource'] . DS . $config['datasource'] . '_' . $config['driver'];
					$classname = Inflector::camelize(strtolower($config['datasource'] . '_' . $config['driver']));
				} else {
					$filename = $config['datasource'] . '_source';
					$classname = Inflector::camelize(strtolower($config['datasource'] . '_source'));
				}
				$_this->_connectionsEnum[$name] = array('filename'  => $filename, 'classname' => $classname);
			}
			return $this->_connectionsEnum;
		} else {
			$this->cakeError('missingConnection', array(array('className' => 'ConnectionManager')));
		}
	}
/**
 * Destructor.
 */
	function __destruct() {
		if (CAKE_SESSION_SAVE == 'database' && function_exists('session_write_close')) {
			session_write_close();
		}
	}
}
?>