<?php
class MuseumController extends AppController {

	var $name = 'Museum';
	var $helpers = array('Html', 'Form' , 'Error');

	function index() {
		$this->Museum->recursive = 0;
		$this->set('museum', $this->Museum->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Museum.');
			$this->redirect('/museum/index');
		}
		$this->set('museum', $this->Museum->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Museum->save($this->data)) {
				$this->Session->setFlash('The Museum has been saved');
				$this->redirect('/museum/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Museum');
				$this->redirect('/museum/index');
			}
			$this->data = $this->Museum->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Museum->save($this->data)) {
				$this->Session->setFlash('The Museum has been saved');
				$this->redirect('/museum/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Museum');
			$this->redirect('/museum/index');
		}
		if ($this->Museum->del($id)) {
			$this->Session->setFlash('The Museum deleted: id '.$id.'');
			$this->redirect('/museum/index');
		}
	}

}
?>