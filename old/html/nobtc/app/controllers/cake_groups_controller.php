<?php
class CakeGroupsController extends AppController {

	var $name = 'CakeGroups';
	var $helpers = array('Html', 'Form', 'Error');
	var $uses = array('CakeGroup', 'CakeUser');

	function index() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		$this->Group->recursive = 0;
		$this->set('groups', $this->CakeGroup->findAll(null, null, 'CakeGroup.groupname'));
	}

	function view($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(!$id) {
			$this->Session->setFlash('Neplatný identifikátor role');
			$this->redirect('/cake_groups/index');
		}
		$this->set('group', $this->CakeGroup->read(null, $id));
		//pr($this->CakeGroup->read(null, $id));
	}

	function add() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			$this->set('cakeUsers', $this->CakeGroup->CakeUser->generateList());
			$this->set('selectedCakeUsers', null);
			$this->render();
		} else {
			$securityLevel = $this->data['CakeGroup']['security_level'];
			if ($securityLevel < 0 || $securityLevel > 99) $this->data['CakeGroup']['security_level'] = 'cislo';

			$this->cleanUpFields();
			if($this->CakeGroup->save($this->data)) {
				$this->Session->setFlash('Nova role byla přidána');
				$this->redirect('/cake_groups/index');
			} else {
				$this->Session->setFlash('Opravte prosím níže uvedené chyby');
				$this->set('cakeUsers', $this->CakeUser->generateList());
				if(empty($this->data['CakeUser']['CakeUser'])) { $this->data['CakeUser']['CakeUser'] = null; }
				$this->set('selectedCakeUsers', $this->data['CakeUser']['CakeUser']);
			}

			$this->data['CakeUser']['security_level'] = $securityLevel;
		}
	}

	function edit($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Neplatný identifikátor role');
				$this->redirect('/cake_groups/index');
			}
			$this->data = $this->CakeGroup->read(null, $id);
			$this->set('cakeUsers', $this->CakeUser->generateList());
			if(empty($this->data['CakeUser'])) { $this->data['CakeUser'] = null; }
			$this->set('selectedCakeUsers', $this->_selectedArray($this->data['CakeUser']));
		} else {
			$this->cleanUpFields();
			if($this->CakeGroup->save($this->data)) {
				$this->Session->setFlash('Změny byly uloženy');
				$this->redirect('/cake_groups/index');
			} else {
				$this->Session->setFlash('Opravte prosím níže uvedené chyby');
				$this->set('cakeUsers', $this->CakeGroup->CakeUser->generateList());
				if(empty($this->data['CakeUser']['CakeUser'])) { $this->data['CakeUser']['CakeUser'] = null; }
				$this->set('selectedCakeUsers', $this->data['CakeUser']['CakeUser']);
			}
		}
	}

	function delete($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(!$id) {
			$this->Session->setFlash('Neplatný identifikátor role');
			$this->redirect('/cake_groups/index');
		}
		if($this->CakeGroup->del($id)) {
			$this->Session->setFlash('Role byla vymazána');
			$this->redirect('/cake_groups/index');
		}
	}

}