<?php
class NameLinesController extends AppController {

	var $name = 'NameLines';
	var $helpers = array('Html', 'Form' );
//
//	function index() {
//		$this->NameLine->recursive = 0;
//		$this->set('nameLines', $this->NameLine->findAll());
//	}
//
//	function view($id = null) {
//		if(!$id) {
//			$this->Session->setFlash('Invalid id for Name Line.');
//			$this->redirect('/name_line/index');
//		}
//		$this->set('nameLine', $this->NameLine->read(null, $id));
//	}
//
//	function add() {
//		if(empty($this->data)) {
//			$this->render();
//		} else {
//			$this->cleanUpFields();
//			if($this->NameLine->save($this->data)) {
//				$this->Session->setFlash('The Name Line has been saved');
//				$this->redirect('/name_line/index');
//			} else {
//				$this->Session->setFlash('Please correct errors below.');
//			}
//		}
//	}
//
//	function edit($id = null) {
//		if(empty($this->data)) {
//			if(!$id) {
//				$this->Session->setFlash('Invalid id for Name Line');
//				$this->redirect('/name_line/index');
//			}
//			$this->data = $this->NameLine->read(null, $id);
//		} else {
//			$this->cleanUpFields();
//			if($this->NameLine->save($this->data)) {
//				$this->Session->setFlash('The NameLine has been saved');
//				$this->redirect('/name_line/index');
//			} else {
//				$this->Session->setFlash('Please correct errors below.');
//			}
//		}
//	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Name Line');
			$this->redirect('/name_line/index');
		}
		if($this->NameLine->del($id)) {
			$this->Session->setFlash('The Name Line deleted: id '.$id.'');
			$this->redirect('/name_line/index');
		}
	}

}
?>