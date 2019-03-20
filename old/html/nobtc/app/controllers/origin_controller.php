<?php
class OriginController extends AppController {

	var $name = 'Origin';
	var $helpers = array('Html', 'Form' , 'Error');

	function index() {
		$this->Origin->recursive = 0;
		$this->set('origin', $this->Origin->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Origin.');
			$this->redirect('/origin/index');
		}
		$this->set('origin', $this->Origin->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Origin->save($this->data)) {
				$this->Session->setFlash('The Origin has been saved');
				$this->redirect('/origin/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Origin');
				$this->redirect('/origin/index');
			}
			$this->data = $this->Origin->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Origin->save($this->data)) {
				$this->Session->setFlash('The Origin has been saved');
				$this->redirect('/origin/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Origin');
			$this->redirect('/origin/index');
		}
		if ($this->Origin->del($id)) {
			$this->Session->setFlash('The Origin deleted: id '.$id.'');
			$this->redirect('/origin/index');
		}
	}

}
?>