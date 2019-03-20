<?php
class BookController extends AppController {

	var $name = 'Book';
	var $helpers = array('Html', 'Form' , 'Error', 'Pagination');
	
	var $components = array('Pagination');

	function index() {
		$criteria = $this->Pagination->getCriteria();
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		
		if ($order == "Book.id ASC")
			$order = "Book.book_abrev ASC";
		$data = $this->Book->findAll($criteria, NULL, $order, $limit, $page, 0);
		$this->set('book', $data);
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Book.');
			$this->redirect('/book/index');
		}
		$this->set('book', $this->Book->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash('The Book has been saved');
				$this->redirect('/book/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Book');
				$this->redirect('/book/index');
			}
			$this->data = $this->Book->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash('The Book has been saved');
				$this->redirect('/book/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Book');
			$this->redirect('/book/index');
		}
		if ($this->Book->del($id)) {
			$this->Session->setFlash('The Book deleted: id '.$id.'');
			$this->redirect('/book/index');
		}
	}

}
?>