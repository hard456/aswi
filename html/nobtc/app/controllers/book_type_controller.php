<?php
class BookTypeController extends AppController {

	var $name = 'BookType';
	var $helpers = array('Html', 'Form' , 'Error');

	function index() {
		$this->BookType->recursive = 0;
		$this->set('bookType', $this->BookType->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Book Type.');
			$this->redirect('/book_type/index');
		}
		$this->set('bookType', $this->BookType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->BookType->save($this->data)) {
				$this->Session->setFlash('The Book Type has been saved');
				$this->redirect('/book_type/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Book Type');
				$this->redirect('/book_type/index');
			}
			$this->data = $this->BookType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->BookType->save($this->data)) {
				$this->Session->setFlash('The BookType has been saved');
				$this->redirect('/book_type/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Book Type');
			$this->redirect('/book_type/index');
		}
		if ($this->BookType->del($id)) {
			$this->Session->setFlash('The Book Type deleted: id '.$id.'');
			$this->redirect('/book_type/index');
		}
	}

}
?>