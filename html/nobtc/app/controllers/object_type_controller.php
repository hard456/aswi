<?php
class ObjectTypeController extends AppController {

	var $name = 'ObjectType';
	var $helpers = array('Html', 'Form' , 'Error');

	function index() {
		$this->ObjectType->recursive = 0;
		$this->set('objectType', $this->ObjectType->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Object Type.');
			$this->redirect('/object_type/index');
		}
		$this->set('objectType', $this->ObjectType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->ObjectType->save($this->data)) {
				$this->Session->setFlash('The Object Type has been saved');
				$this->redirect('/object_type/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Object Type');
				$this->redirect('/object_type/index');
			}
			$this->data = $this->ObjectType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->ObjectType->save($this->data)) {
				$this->Session->setFlash('The ObjectType has been saved');
				$this->redirect('/object_type/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Object Type');
			$this->redirect('/object_type/index');
		}
		if ($this->ObjectType->del($id)) {
			$this->Session->setFlash('The Object Type deleted: id '.$id.'');
			$this->redirect('/object_type/index');
		}
	}

}
?>