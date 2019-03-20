<?php
class SurfaceTypeController extends AppController {

	var $name = 'SurfaceType';
	var $helpers = array('Html', 'Form' , 'Error');

	function index() {
		$this->SurfaceType->recursive = 0;
		$this->set('surfaceType', $this->SurfaceType->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Surface Type.');
			$this->redirect('/surface_type/index');
		}
		$this->set('surfaceType', $this->SurfaceType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->SurfaceType->save($this->data)) {
				$this->Session->setFlash('The Surface Type has been saved');
				$this->redirect('/surface_type/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Surface Type');
				$this->redirect('/surface_type/index');
			}
			$this->data = $this->SurfaceType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->SurfaceType->save($this->data)) {
				$this->Session->setFlash('The SurfaceType has been saved');
				$this->redirect('/surface_type/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Surface Type');
			$this->redirect('/surface_type/index');
		}
		if ($this->SurfaceType->del($id)) {
			$this->Session->setFlash('The Surface Type deleted: id '.$id.'');
			$this->redirect('/surface_type/index');
		}
	}

}
?>