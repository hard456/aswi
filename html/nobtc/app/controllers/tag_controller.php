<?php
class TagController extends AppController {

	var $name = 'Tag';
	var $helpers = array('Html', 'Form' , 'Error');
	var $uses = array('Tag', 'Names');

	function index() {
		$this->Tag->recursive = 0;
		$this->set('tag', $this->Tag->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Tag.');
			$this->redirect('/tag/index');
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

	function add($idName) {
		if (empty($this->data)) {
			$this->set('names', $this->Names->generateList());
			$this->set('selectedName',$idName);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash('The Tag has been saved');
				$this->redirect('/names/view/'.$idName);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('names', $this->Names->generateList());
				$this->set('selectedName',$idName);
			}
		}
	}

	function edit($id = null, $idName = NULL) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Tag');
				$this->set('selectedName',$idName);
				$this->redirect('/names/view/'.$idName);
			}
			$this->data = $this->Tag->read(null, $id);
			$this->set('names', $this->Names->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash('The Tag has been saved');
				$this->set('selectedName',$idName);
				$this->redirect('/names/view/'.$idName);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('names', $this->Names->generateList());
			}
		}
	}

	function delete($id = null, $idNameBack = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Tag');
			$this->redirect('/names/view/'.$idNameBack);
		}
		if ($this->Tag->del($id)) {
			$this->Session->setFlash('The Tag deleted: id '.$id.'');
			$this->redirect('/names/view/'.$idNameBack);
		}
	}

}
?>