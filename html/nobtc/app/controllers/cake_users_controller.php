<?php
class CakeUsersController extends AppController {

	var $name = 'CakeUsers';
	var $helpers = array('Html', 'Form', 'Error');
	var $uses = array('CakeUser', 'CakeGroup');

	function index() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		$this->CakeUser->recursive = 0;
		$this->set('users', $this->CakeUser->findAll(null, null, 'CakeUser.username'));
	}

	function view($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(!$id) {
			$this->Session->setFlash('Neplatný identifikátor uživatele');
			$this->redirect('/cake_users/index');
		}
		$this->set('userLogData', $this->CakeUser->getLogData($id));
		$this->set('user', $this->CakeUser->read(null, $id));
	}

	function add() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			$this->data['CakeUser']['external_id'] = 0;
			$this->render();
		} else {
			$errorMessage = null;
			$doSave = true;
			$securityLevel = $this->data['CakeUser']['security_level'];
			if ($securityLevel < 0 || $securityLevel > 99) $this->data['CakeUser']['security_level'] = 'cislo';
			$heslo = $this->data['CakeUser']['passwd'];
			$potvrzeniHesla = $this->data['CakeUser']['passwd1'];
			if ($heslo === $potvrzeniHesla && !empty($heslo)) $this->data['CakeUser']['passwd'] = md5($heslo);
			if ($heslo !== $potvrzeniHesla) $errorMessage = '<br />'.'Chybně zadané heslo';

			$user = $this->CakeUser->find('CakeUser.login = \'' . $this->data['CakeUser']['login'] . '\'');
			if (!empty($user)) {
				$doSave = false;
				$errorMessage .= '<br />' . 'Login je již používán, zvolte jiný';
			}


			$this->cleanUpFields();
			if ($doSave == true && $this->CakeUser->save($this->data)) {
				$this->Session->setFlash('Nový uživatel byl přidán');
				$this->redirect('/cake_users/index');
			} else {
				$this->Session->setFlash('Opravte prosím níže uvedené chyby' . $errorMessage);
			}

			$this->data['CakeUser']['passwd'] = null;
			$this->data['CakeUser']['passwd1'] = null;
			$this->data['CakeUser']['security_level'] = $securityLevel;
		}
	}

	function edit($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Neplatný identifikátor uživatele');
				$this->redirect('/cake_users/index');
			}
			$this->data = $this->CakeUser->read(null, $id);
		} else {
			$errorMessage = '';
			$doSave = true;
			$puvodniHeslo = $this->data['CakeUser']['passwd'];
			$this->data['CakeUser']['passwd1'] = $puvodniHeslo;

			$securityLevel = $this->data['CakeUser']['security_level'];
			if ($securityLevel < 0 || $securityLevel > 99) $this->data['CakeUser']['security_level'] = 'cislo';
			if ($puvodniHeslo !== md5($this->data['CakeUser']['passwd_puvodni_zadano'])) {
				$doSave = false;
				$errorMessage = '<br />' . 'Původní heslo je chybné';
			}
			//kontrola noveho hesla
			if ($doSave == true) {
				if ($this->data['CakeUser']['passwd_nove'] !== $this->data['CakeUser']['passwd_nove1']) {
					$errorMessage .= '<br />' . 'Nové heslo je zadáno chybně';
				}
				else if (!empty($this->data['CakeUser']['passwd_nove'])) {
					$this->data['CakeUser']['passwd'] = md5($this->data['CakeUser']['passwd_nove']);
					$this->data['CakeUser']['passwd1'] = md5($this->data['CakeUser']['passwd_nove']);
				}
			}

			$user = $this->CakeUser->find('CakeUser.login = \'' . $this->data['CakeUser']['login'] . '\'');
			if (!empty($user) && $user['CakeUser']['id'] != $this->data['CakeUser']['id']) {
				$doSave = false;
				$errorMessage .= '<br />' . 'Login je již používán, zvolte jiný';
			}

			$this->cleanUpFields();
			if($doSave === true && $this->CakeUser->save($this->data)) {
				$this->Session->setFlash('Změny byly uloženy');
				$this->redirect('/cake_users/index');
			} else {
				$this->Session->setFlash('Opravte prosím níže uvedené chyby'.$errorMessage);
			}

			$this->data['CakeUser']['passwd_puvodni_zadano'] = null;
			$this->data['CakeUser']['passwd_nove'] = null;
			$this->data['CakeUser']['passwd_nove1'] = null;
			$this->data['CakeUser']['passwd'] = $puvodniHeslo;
			$this->data['CakeUser']['security_level'] = $securityLevel;
		}
	}

	function delete($id = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(!$id) {
			$this->Session->setFlash('Neplatný identifikátor uživatele');
			$this->redirect('/cake_users/index');
		}
		if($this->CakeUser->del($id)) {
			$this->Session->setFlash('Uživatel byl vymazán');
			$this->redirect('/cake_users/index');
		}
	}

	//funkce pro pridani a odebrani role uzivatele
	function add_role() {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(empty($this->data)) {
			$this->set('groups', $this->CakeGroup->generateList(null, 'CakeGroup.groupname', null, null, '{n}.CakeGroup.groupname'));
			$this->set('users', $this->CakeUser->generateList(null, 'CakeUser.login', null, null, '{n}.CakeUser.login'));
			$this->render();
		} else {
			$this->cleanUpFields();

			$user = $this->CakeUser->findAll('CakeUser.id = ' . $this->data['CakeUserGroup']['user_id']);
			$doSave = true;
			if (!empty($user)) foreach ($user[0]['CakeGroup'] as $group) {
				if ($group['id'] === $this->data['CakeUserGroup']['group_id']) $doSave = false;
			}

			if ($doSave == true) {
				$this->CakeUser->query('INSERT INTO users_groups (user_id, group_id) VALUES ('.$this->data['CakeUserGroup']['user_id'].', '.$this->data['CakeUserGroup']['group_id'].')');
				$this->Session->setFlash('Uživateli byla přiřazena role');
				$this->redirect('/cake_users/view/' . $this->data['CakeUserGroup']['user_id']);
			}
			else {
				$this->Session->setFlash('Tuto roli má uživatel již přiřazenu');
				$this->set('groups', $this->CakeGroup->generateList(null, 'CakeGroup.groupname', null, null, '{n}.CakeGroup.groupname'));
				$this->set('users', $this->CakeUser->generateList(null, 'CakeUser.login', null, null, '{n}.CakeUser.login'));
			}
		}
	}

	function delete_role($userId = null, $groupId = null) {
		$_SESSION['web_section'] = 'administrace_sprava_uzivatelu';

		if(!$userId || !$groupId) {
			$this->Session->setFlash('Neplatný identifikátor záznamu');
			$this->redirect('/cake_users/view/'.$userId);
		}
		else {
			$this->CakeUser->query('DELETE FROM users_groups WHERE user_id = ' . $userId . ' and group_id = ' . $groupId);
			$this->Session->setFlash('Role byla odebrána');
			$this->redirect('/cake_users/view/' . $userId);
		}
	}

	function change_my_password() {
		$this->change_password($this->CakeAuth->id);
		$this->render('change_password');
	}

	function change_password($id = null) {
		$_SESSION['web_section'] = 'administrace_zmena_hesla';

		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Neplatný identifikátor uživatele');
				$this->redirect('/cake_users/index');
			}
			$this->data = $this->CakeUser->read(null, $id);
			$this->data['CakeUser']['passwd'] = null;
		} else {
			$errorMessage = null;
			$doSave = true;
			if (empty($this->data['CakeUser']['passwd']) || ($this->data['CakeUser']['passwd'] != $this->data['CakeUser']['passwd1'])) {
				$doSave = false;
				$errorMessage = 'Chybně zadané heslo';
			}
			else {
				$this->data['CakeUser']['passwd'] = md5($this->data['CakeUser']['passwd']);
			}

			$this->cleanUpFields();
			if($doSave === true && $this->CakeUser->save($this->data)) {
				$this->Session->setFlash('Password changed');
				$this->redirect('/pages/index/');
			} else {
				$this->Session->setFlash($errorMessage);
			}

			$this->data['CakeUser']['passwd'] = null;
			$this->data['CakeUser']['passwd1'] = null;
		}
		//pr($this->data);
		//exit();
	}

}