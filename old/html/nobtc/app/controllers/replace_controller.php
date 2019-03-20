<?php
class ReplaceController extends AppController {
   var $name = 'Replace';
   var $uses = array();

   var $MAX_LINES = 200;

	function index() {
		$this->set('find', $_REQUEST['find']);
		$this->set('replace', $_REQUEST['replace']);
	}

	function replace_preview() {
		$connection = new DB_Sql();
		$co = pg_escape_string($_POST['find']);
		$dotaz = "SELECT l.*, t.chapter , t.id_transliteration, b.book_abrev
		  FROM line l, surface s, transliteration t, book b
		  WHERE l.id_surface=s.id_surface
		    AND s.id_transliteration=t.id_transliteration
		    AND b.id_book=t.id_book
		    AND transliteration ~ add_bracket('$co') LIMIT ".$this->MAX_LINES;
		//echo $dotaz;
		//spustit a vyhodnotit
		$connection->query($dotaz);

		while($connection->next_record()) {
			$lines[$connection->Record['id_line']] = $connection->Record['transliteration'];
			$bachs[$connection->Record['id_line']] = $connection->Record['book_abrev']. ", " .$connection->Record['chapter'];
			$ids[$connection->Record['id_line']] = $connection->Record['id_transliteration'];
		}
		$this->set('lines', $lines);
		$this->set('bachs', $bachs);
		$this->set('ids', $ids);
		$this->set('find', $_POST['find']);
		$this->set('POST', $_POST);
	}

	function replace() {
		$connection = new DB_Sql();
		$counter = 0;

		foreach($_POST['lines'] as $id => $helpa) {
		  //p_g($helpa);
		  $proceed = $helpa['proceed'];
		  $new     = $helpa['new'];

		  if(!empty($proceed)) {
		    $dotaz = "UPDATE line SET transliteration = '".pg_escape_string($new)."' WHERE id_line = $id";
		    //p_g($dotaz);
		    $connection->query($dotaz);
		    $counter++;
		  }
		}

		$this->set('counter', $counter);

		$this->set('find', $_REQUEST['find']);
		$this->set('new', $_REQUEST['replace']);
		$this->set('MAX_LINES', $this->MAX_LINES);
		//pr($_REQUEST);
	}
}