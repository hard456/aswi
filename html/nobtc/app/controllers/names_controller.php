<?php
class NamesController extends AppController {

	var $name = 'Names';
	var $helpers = array('Html', 'Form', 'Transliteration' );
	var $uses = array('Names', 'Line', 'Tag');

	function index($divine = 'divine') {
		$this->Names->recursive = 0;
		if ($divine == 'divine') {
			$cond = 'Names.divine_name IS NULL OR Names.divine_name != false';
		}
		else {
			$cond = 'Names.divine_name = false';
		}
		$this->set('names', $this->Names->findAll($cond));
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Name.');
			$this->redirect('/names/index');
		}
		$this->Names->recursive = 5;
		
		$this->Names->unbindModel(
			array('hasAndBelongsToMany'=> array('Line'))
		);
		$this->Names->Line->unbindModel(
			array('hasMany'=> array('NameLine'))
		);
		$this->Names->Line->Surface->Transliteration->unbindModel(
			array('belongsTo'=> array('Museum','Origin', 'BookType'))
		);
		$this->Names->Line->unbindModel(
			array('hasAndBelongsToMany'=> array('Name'))
		);
		
		$tags = $this->Tag->findAll("Tag.id_name = ".$id);
		$name = $this->Names->read(null, $id);
		
		$lines = $this->Names->vratLineSimpleStrukturu($name);
		
		
		$this->Names->priradKTagum($lines, $tags);

		foreach ($tags as $k=>$tag) {
			//pr($tag['Lines']);
			$tags[$k]['Lines'] = $this->Names->upravSeznamy($tag['Lines'], $name);
			//pr($tag['Lines']);
		}
		
		//pr($lines);
		$lines = $this->Names->upravSeznamy($lines, $name);
		//pr($lines);
		
		$this->set('tags', $tags);
		$this->set('names', $name);
		$this->set('lines', $lines);
	}


	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Name');
				$this->redirect('/names/index');
			}
			$this->data = $this->Names->read(null, $id);
			//$this->set('lines', $this->Name->Line->generateList());
			//if(empty($this->data['Line'])) { $this->data['Line'] = null; }
			//$this->set('selectedLines', $this->_selectedArray($this->data['Line']));
		} else {
			$this->cleanUpFields();
			if($this->Names->save($this->data)) {
				$this->Session->setFlash('The Name has been saved');
				$this->redirect('/names/index');
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
			$this->redirect('/names/index');
		}
		if($this->Names->del($id)) {
			$this->Session->setFlash('The Name deleted: id '.$id.'');
			$this->redirect('/names/index');
		}
	}

}
?>