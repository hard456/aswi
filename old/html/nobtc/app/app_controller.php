<?php
/* SVN FILE: $Id: app_controller.php 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppController extends Controller {

	var $components = array('CakeAuth');
	
	 var $helpers = array('Html', 'Javascript');

	function beforeFilter() {
		$this->CakeAuth->set();


///		$this->log('testuji uzivatel: '. $this->CakeAuth->login."\n" .
///				" name:".$this->name."\n" .
///				" akce:".$this->action."\n");

		//nastavit anonymous, kdyz neprihlasen
		if (	empty($this->CakeAuth->login) &&
				$this->name != 'CakeLogin' &&
				$this->action != 'anonymous') {
///			$this->log('PRESMEROVANI na anonym');
			$this->redirect('cake_login/anonymous');exit();
		}
		else if (!$this->CakeAuth->check($this->name, $this->action)) {
      		//$this->Session->setFlash('Varování: Přístup byl zamítnut.');
///			$this->log('PRESMEROVANI na login - pristup zamitnut');

      		$this->redirect('cake_login');exit();
    	}
///    	$this->log('OK');

		$this->canView = ($this->CakeAuth->security >= 10);
    	$this->canAdd = $this->canEdit = ($this->CakeAuth->security >= 60);
    	$this->canDelete = ($this->CakeAuth->security >= 99);

		//pr($this->canEdit);

    	$this->set('CakeAuth', $this->CakeAuth);
    	$this->set('canView', $this->canView);
    	$this->set('canAdd', $this->canAdd);
    	$this->set('canEdit', $this->canEdit);
    	$this->set('canDelete', $this->canDelete);

    	return true;
	}

	function beforeRender() {
		$this->set('ac', $this->CakeAuth);
	}
}
