<?php
class NamesController extends AppController {

	var $name = 'Names';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Name->recursive = 0;
		$this->set('names', $this->Name->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Name.');
			$this->redirect('/name/index');
		}
		$this->set('name', $this->Name->read(null, $id));
	}

//	function add() {
//		if(empty($this->data)) {
//			$this->set('lines', $this->Name->Line->generateList());
//			$this->set('selectedLines', null);
//			$this->render();
//		} else {
//			$this->cleanUpFields();
//			if($this->Name->save($this->data)) {
//				$this->Session->setFlash('The Name has been saved');
//				$this->redirect('/name/index');
//			} else {
//				$this->Session->setFlash('Please correct errors below.');
//				$this->set('lines', $this->Name->Line->generateList());
//				if(empty($this->data['Line']['Line'])) { $this->data['Line']['Line'] = null; }
//				$this->set('selectedLines', $this->data['Line']['Line']);
//			}
//		}
//	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Name');
				$this->redirect('/name/index');
			}
			$this->data = $this->Name->read(null, $id);
			//$this->set('lines', $this->Name->Line->generateList());
			//if(empty($this->data['Line'])) { $this->data['Line'] = null; }
			//$this->set('selectedLines', $this->_selectedArray($this->data['Line']));
		} else {
			$this->cleanUpFields();
			if($this->Name->save($this->data)) {
				$this->Session->setFlash('The Name has been saved');
				$this->redirect('/name/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				//$this->set('lines', $this->Name->Line->generateList());
				//if(empty($this->data['Line']['Line'])) { $this->data['Line']['Line'] = null; }
				//$this->set('selectedLines', $this->data['Line']['Line']);
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Name');
			$this->redirect('/name/index');
		}
		if($this->Name->del($id)) {
			$this->Session->setFlash('The Name deleted: id '.$id.'');
			$this->redirect('/name/index');
		}
	}

}
?>