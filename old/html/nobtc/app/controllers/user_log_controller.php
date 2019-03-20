<?php
class UserLogController extends AppController {

	var $name = 'UserLog';
	var $helpers = array('Html', 'Form' , 'Error');

	function index($userId) {
		$this->UserLog->recursive = 0;
		$cond = null;
		if (!empty($userId)) {
		    $cond = "UserLog.user_id = ".$userId;
		}
		$this->set('userLog', $this->UserLog->findAll($cond, null, 'UserLog.logged DESC'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for User Log.');
			$this->redirect('/user_log/index');
		}
		$this->set('userLog', $this->UserLog->read(null, $id));
	}

}
