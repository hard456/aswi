<?php
class TransliterationController extends AppController {

	var $name = 'Transliteration';
	var $helpers = array('Html', 'Form' , 'Error', 'Pagination', 'Javascript', 'Ajax');
	
	var $components = array('Pagination');
	var $uses = array('Transliteration', 'Book', 'Origin', 'Museum', 'BookType', 'Line', 'Surface');

	function index() {
		$criteria = $this->Pagination->getCriteria();
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		if ($order == "Transliteration.id ASC")
			$order = "Transliteration.chapter ASC";
		//$order = 'Transliteration.chapter ASC';
		$data = $this->Transliteration->findAll($criteria, NULL, $order, $limit, $page, 1);
		//pr($data);
		$this->set('transliteration', $data);
		
		$list = $this->Book->generateList(null, 'Book.book_abrev', null, null, '{n}.Book.book_abrev');
		$array = array('' => 'All books');
		if (!empty($list)) foreach ($list as $key => $item) {
			$array['Book.id_book = ' . $key] = $item;
		}
		$this->set('bookArray', $array);
		
		$list = $this->Museum->generateList(null, 'Museum.museum', null, null, '{n}.Museum.museum');
		$array = array('' => 'All museums');
		if (!empty($list)) foreach ($list as $key => $item) {
			$array['Museum.id_museum = ' . $key] = $item;
		}
		$this->set('museumArray', $array);
		
		$list = $this->Origin->generateList(null, 'Origin.origin', null, null, '{n}.Origin.origin');
		$array = array('' => 'All origins');
		if (!empty($list)) foreach ($list as $key => $item) {
			$array['Origin.id_origin = ' . $key] = $item;
		}
		$this->set('originArray', $array);
		
		$list = $this->BookType->generateList(null, 'BookType.book_type', null, null, '{n}.BookType.book_type');
		$array = array('' => 'All origins');
		if (!empty($list)) foreach ($list as $key => $item) {
			$array['BookType.book_type = ' . $key] = $item;
		}
		$this->set('bookTypeArray', $array);
	}

	function view($id = NULL, $search1 = "", $search2 = "", $search3 = "", $search4 = "") {
		$SearchCatalog = new SearchCatalog();
		$SearchCatalog->addConstrain("transliteration", "id_transliteration", "is", $id);

		$SearchCatalog->search();
		$SearchCatalog->next_record();
		$result = $SearchCatalog->getResult();
		$Transliteration = new OldTransliteration($result['id_transliteration']);

		$Reference = new OldReference($result['id_transliteration']);

		$this->set('found_cat', $SearchCatalog->getResult());
		$this->set('transliteration_count', $SearchCatalog->getCount());
		$this->set('POST', $Transliteration->getResult());
		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		$this->set('id_transliteration', $result['id_transliteration']);
		$this->set('searchtext1', $search1);
		$this->set('searchtext2', $search2);
		$this->set('searchtext3', $search2);
		$this->set('references', $Reference->getResult());
		$this->set('rev_history', $Transliteration->getRevHistory());
		$this->set('photos', $Transliteration->getPhotos());
		$this->set('handcopies', $Transliteration->getHandcopies());
	}

	function add() {
		if (empty($this->data)) {
			$this->set('book', $this->Transliteration->Book->generateList());
			$this->set('museum', $this->Transliteration->Museum->generateList());
			$this->set('origin', $this->Transliteration->Origin->generateList());
			$this->set('bookType', $this->Transliteration->BookType->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Transliteration->save($this->data)) {
				$this->Session->setFlash('The Transliteration has been saved');
				$this->redirect('/transliteration/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('book', $this->Transliteration->Book->generateList());
				$this->set('museum', $this->Transliteration->Museum->generateList());
				$this->set('origin', $this->Transliteration->Origin->generateList());
				$this->set('bookType', $this->Transliteration->BookType->generateList());
			}
		}
	}

	function edit($id = null) {
		$SearchTranslInfo = new SearchTransliterationInfo();
		$SearchTranslInfo->addConstrain("transliteration", "id_transliteration", "is", $id);
		$SearchTranslInfo->search();
		$result = $SearchTranslInfo->getResult();
		
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Transliteration');
				$this->redirect('/transliteration/index');
			}
			$this->data = $this->Transliteration->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Transliteration->saveSReferences($this->data)) {
				$this->Session->setFlash('The Transliteration has been saved');
				$this->redirect('/transliteration/view/'.$this->data['Transliteration']['id_transliteration']);
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
		$this->set('book', $this->Transliteration->Book->generateList('', '', '', '', '{n}.Book.book_abrev'));
		$this->set('museum', $this->Transliteration->Museum->generateList('', '', '', '', '{n}.Museum.museum'));
		$this->set('origin', $this->Transliteration->Origin->generateList('', '', '', '', '{n}.Origin.origin'));
		$this->set('bookType', $this->Transliteration->BookType->generateList('', '', '', '', '{n}.BookType.book_type'));
		$this->set('POST', $result);
		
	}
	
	function edit_transliteration($id = null) {
		if (empty($this->data)) {
			if (empty($id)) {
				$this->Session->setFlash('Invalid id for Transliteration');
				$this->redirect('/transliteration/index');
			}
		}
		else {
			if ($this->Transliteration->saveTexts($_REQUEST)) {
				$this->Session->setFlash('The Transliteration has been saved');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
			
		}
		
		$this->Transliteration->recursive = 2;
		$this->Transliteration->bindModelsForTables();
		$transliteration = $this->Transliteration->read(null, $id);
		//pr($transliteration);
		$this->data['surfaces'] = $this->Transliteration->organizeLines($transliteration['Surface']);
		
		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		$this->set('transliteration', $transliteration);
		$this->set('surfaces', $this->data['surfaces']);
	}
	
	function delete_line($id_transliteration,$id_surface, $id_line ) {
		if (empty($id_line) || empty($id_surface)) {
			return;
		}
		$this->Line->delete($id_line);
		
		$this->Surface->recursive = 1;
		$this->Surface->bindModelsForTables();
		$surface = $this->Surface->read(null, $id_surface);
		//pr($surface);
		if (!empty($surface['Line'])) {

			$surface =  $this->Surface->organizeLines($surface);
			$this->set('surface', $surface);
			
		}
		else {
			$this->Surface->delete($id_surface);
		}
		//todo nastavit id_transliterace
		$transliteration = $this->Transliteration->read(null, $id_transliteration);
		$this->set('transliteration', $transliteration);
		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		$this->render('surface', 'ajax');
	}
	
	function add_line($id_transliteration,$id_object_type,$id_surface_type,$id_surface = null) {
		if (empty($id_object_type) || 
			empty($id_surface_type) || 
			empty($id_transliteration)) {
				
			return;
		}
		if (empty($id_surface)) {
			$data['Surface']['id_object_type'] = $id_object_type;
			$data['Surface']['id_surface_type'] = $id_surface_type;
			$data['Surface']['id_transliteration'] = $id_transliteration;
			$this->Surface->save($data);
			
			$id_surface = $this->Surface->getLastInsertID();
		}
		$data['Line']['id_surface'] = $id_surface;
		$this->Line->save($data);
		
		
		$this->Surface->recursive = 1;
		$this->Surface->bindModelsForTables();
		$surface = $this->Surface->read(null, $id_surface);
		//pr($surface);
		$surface =  $this->Surface->organizeLines($surface);
		$this->set('surface', $surface);
		
		$transliteration = $this->Transliteration->read(null, $id_transliteration);
		$this->set('transliteration', $transliteration);
		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		$this->render('surface', 'ajax');
	}
/*
	function old_edit_transliteration($id = null) {
		$SearchCatalog = new SearchCatalog();
		$SearchCatalog->addConstrain("transliteration", "id_transliteration", "is", $id);

		$SearchCatalog->search();
		$SearchCatalog->next_record();
		$result = $SearchCatalog->getResult();
		$Transliteration = new OldTransliteration($id);

		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		$this->set('button_label', "Next Step ->");
		$this->set('id_transliteration', $id);
		$this->set('POST', $Transliteration->getResult());
	}

	function edit_transliteration_save () {
		pr($_REQUEST);
		$this->render();
		return;
		$object_type_array = utils_get_object_types();
  		$surface_type_array = utils_get_surface_types();
		$POST = $_REQUEST;
		$connection = new DB_Sql();

		// vymazat vse z tabulky line a surface, kde id_transliteration = this
		$mazaci_line = "DELETE FROM line WHERE id_surface IN ( SELECT id_surface FROM surface WHERE id_transliteration = ".$POST['id_transliteration']." )";
		$mazaci_surface = "DELETE FROM surface WHERE id_transliteration = ".$POST['id_transliteration'];
		//spustit a vyhodnotit
		$connection->query($mazaci_line);
		$connection->query($mazaci_surface);

		//$pomocny = "SELECT Count(*) FROM surface WHERE id_transliteration = ".$POST['id_transliteration'];
		//$connection->query($pomocny);
		//$connection->next_record();
		//p_g($connection);

		//a znovu vlozit jako je to v inssert transliteration

		$id_transliteration = $POST['id_transliteration'];


		//vlozeni revision history
		$dotaz = "INSERT INTO rev_history (id_transliteration, date, name, description) VALUES ('".
		            pg_escape_string($POST['id_transliteration'])."',
		            '".date("Y-m-d")."', '".
		            pg_escape_string($_SERVER['PHP_AUTH_USER'])."', '".
		            pg_escape_string("Edited transliteration. ")."')";

		$connection->query($dotaz);

		foreach($object_type_array as $object_type_object) {
			  $object_type = StrTr($object_type_object['object_type'], " ", "_");

			  //p_g("$object_type \n");

			  foreach($surface_type_array as $surface_type_object) {
			    $surface_type = StrTr($surface_type_object['surface_type'], " ", "_");

			    //p_g("$surface_type \n");

			    $count = $POST["$object_type-$surface_type-count"];

			    //p_g("count: $count  \n");


			    if (!Empty($count) && $count > 0) {

			      $id_object_type = $object_type_object['id_object_type'];
			      $id_surface_type = $surface_type_object['id_surface_type'];

			      $dotaz = "INSERT INTO surface (column_number, id_transliteration, id_object_type, id_surface_type) VALUES (0, ".
			                $id_transliteration . ", " . $id_object_type . ", " . $id_surface_type . ")";
			      $connection->query($dotaz);
			      $id = $connection->currval('surface_id_surface_seq');
			      $id_surface = $id;

			        //a pro kazdou radku v tomu object-surface
			        //vlozit radek do line
			      //p_g($POST["$object_type-$surface_type-line"]);
			      $keys = array_keys($POST["$object_type-$surface_type-line"]);
			      foreach ($keys as $k=>$i) {

			        $line_broken = (Empty($POST["$object_type-$surface_type-line-broken"][$i]))? 'false' : 'true' ;
			      	$dotaz = "INSERT INTO line (transliteration, line_number, id_surface, broken) VALUES ('".
			                  pg_escape_string(Trim( $POST["$object_type-$surface_type-line"][$i] ))."', '".
			                  pg_escape_string(Trim( $POST["$object_type-$surface_type-line-no"][$i] ))."', ".
			                  $id_surface.", ".
			                  $line_broken.")";
			       //p_g($dotaz);
			      	$connection->query($dotaz);

			      }
			    }
			  }
			}
		$this->Session->setFlash('Transliteration saved');
		$this->redirect('/transliteration/view/'.$POST['id_transliteration']);
	}
*/
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Transliteration');
			$this->redirect('/transliteration/index');
		}
		if ($this->Transliteration->del($id)) {
			$this->Session->setFlash('The Transliteration deleted: id '.$id.'');
			$this->redirect('/transliteration/index');
		}
	}

	function js_inserttext () {
		$this->render('js_inserttext', 'javascript');
	}

	
}
?>