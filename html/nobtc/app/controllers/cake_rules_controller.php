<?php
class CakeRulesController extends AppController {

	var $name = 'CakeRules';
	var $helpers = array('Html', 'Form', 'Error');
	var $uses = array('CakeRule', 'CakeGroup');

	function index() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		$this->CakeRule->recursive = 0;
		$this->set('rules', $this->CakeRule->findAll(null, null, 'CakeGroup.groupname, CakeRule.rulenum'));
	}

	function add() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			$this->data['CakeRule']['allow'] = true;

			$this->set('groups', $this->CakeGroup->generateList(null, 'CakeGroup.groupname', null, null, '{n}.CakeGroup.groupname'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->CakeRule->save($this->data)) {
				$this->Session->setFlash('Nové pravidlo bylo přidáno');
				$this->redirect('/cake_rules/index');
			} else {
				$this->Session->setFlash('Opravte prosím níže uvedené chyby');
				$this->set('groups', $this->CakeGroup->generateList(null, 'CakeGroup.groupname', null, null, '{n}.CakeGroup.groupname'));
			}
		}
	}

	function edit($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Neplatný identifikátor pravidla');
				$this->redirect('/cake_rules/index');
			}
			$this->data = $this->CakeRule->read(null, $id);
			$this->set('groups', $this->CakeGroup->generateList(null, 'CakeGroup.groupname', null, null, '{n}.CakeGroup.groupname'));
		} else {
			$this->cleanUpFields();
			if($this->CakeRule->save($this->data)) {
				$this->Session->setFlash('Změny byly uloženy');
				$this->redirect('/cake_rules/index');
			} else {
				$this->Session->setFlash('Opravte prosím níže uvedené chyby');
				$this->set('groups', $this->CakeGroup->generateList(null, 'CakeGroup.groupname', null, null, '{n}.CakeGroup.groupname'));
			}
		}
	}

	function delete($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(!$id) {
			$this->Session->setFlash('Neplatný identifikátor pravidla');
			$this->redirect('/cake_rules/index');
		}
		if($this->CakeRule->del($id)) {
			$this->Session->setFlash('Pravidlo bylo vymazáno');
			$this->redirect('/cake_rules/index');
		}
	}

}