<?php
class SearchTextController extends AppController {

	var $name = 'SearchText';
	var $helpers = array('Html', 'Form' );
	var $uses = array();

	function index() {

	}

	function result() {
		if (!empty($_REQUEST['work-with-lists']) && $_REQUEST['work-with-lists'] == 'on') {
			$_REQUEST['r_limit'] = 1000;
		}

		$exactMatch = (!empty($_REQUEST['exact-match']) && $_REQUEST['exact-match'] == 'on');
		$SearchText = new SearchText($exactMatch);
		$SearchText->setOffset($_REQUEST['r_offset']);
		$SearchText->setLimit($_REQUEST['r_limit']);
		$SearchText->setWord($_REQUEST["word1"]);
		$SearchText->setWord2($_REQUEST['word2'], $_REQUEST['word2-op']);
		$SearchText->setWord3($_REQUEST['word3'], $_REQUEST['word3-op']);

		$SearchText->addConstrain("book", "book_name", $_REQUEST['book-op'], $_REQUEST['book']);
		$SearchText->addConstrain("transliteration", "museum_no", $_REQUEST['museum-no-op'], $_REQUEST['museum-no']);
		$SearchText->addConstrain("transliteration", "id_book_type", $_REQUEST['book-type-op'], $_REQUEST['id_book_type']);
		$SearchText->addConstrain("transliteration", "id_origin", $_REQUEST['origin-op'], $_REQUEST['id_origin']);
		$SearchText->addConstrain("transliteration", "reg_no", $_REQUEST['reg_no-op'], $_REQUEST['reg_no']);
		$SearchText->addConstrain("transliteration", "date", $_REQUEST['date-op'], $_REQUEST['date']);

		$SearchText->search();
		$SearchText->setLinesAround($_REQUEST['line-count']);

		$Sorter = new Sorter($SearchText->getOffset(), $SearchText->getLimit(), $SearchText->getCount() );

		$this->set('SearchText', $SearchText);
		$this->set('Sorter', $Sorter);
		$this->set('isDivine', ($_REQUEST['list-of-names-radio'] === 'divine'));

		if (!empty($_REQUEST['work-with-lists']) && $_REQUEST['work-with-lists'] == 'on') {
			$this->render('add_to_name_list_preview');
		}
	}


	function add_to_name_list() {
		if (empty($_REQUEST['id_name'])) {
		    $connection = new DB_Sql();
		    $dotaz = "INSERT INTO name (name) VALUES ('".
		            pg_escape_string($_REQUEST['word1'])."')";

		    $connection->query($dotaz);
		  	$_REQUEST['id_name'] = $connection->currval('name_id_name_seq');
		  }
		  foreach ($_REQUEST['line'] as $key=>$value) {
		  	  $dotaz = "INSERT INTO name_line (id_name, id_line) VALUES ('".
		            pg_escape_string($_REQUEST['id_name'])."', '".
		            pg_escape_string($key)."')";
		      $connection->query($dotaz);
		  }
		  $this->redirect('names/index');
	}
}