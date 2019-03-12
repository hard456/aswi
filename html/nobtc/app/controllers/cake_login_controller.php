<?php

class CakeLoginController extends AppController {
  	var $name = 'CakeLogin';
  	var $uses = array('CakeUser', 'UserLog');
  	var $helpers = array('Html', 'Form', 'Error');

  	function beforeFilter() {
    	return true;
  	}

  	function index() {
    	$this->render('index');
  	}

	function anonymous() {
		$data   = $this->CakeUser->getAclData('anonymous', md5('anonymous'));
		//pr($data);
    	if(!empty( $data ) ) {
      		$this->CakeAuth->set( $data['CakeUser'] );
      		$this->redirect('pages/index');
	  		exit();
    	}
    	else {
    		$this->Session->setFlash('Wrong login or password');

      		$this->redirect('pages/index');
	  		exit();
    	}
	}

  	function login() {
    	$login  = $this->data['CakeUser']['login'];
    	$passwd = $this->data['CakeUser']['passwd'];
    	$data   = $this->CakeUser->getAclData($login, md5($passwd));

    	if(!empty( $data ) ) {
      		$this->CakeAuth->set( $data['CakeUser'] );
      		$this->UserLog->log($data['CakeUser']['id']);
      		$this->redirect('/pages/index');
	  		exit();
    	}
    	else {
    		$this->Session->setFlash('Wrong login or password');

      		$this->redirect('/cake_login/');
	  		exit();
    	}
  	}

  	function logout() {
    	$this->CakeAuth->logout();
    	$this->redirect('/');
		exit();
  	}
}
