<?php
class UploadTextsController extends AppController {
	var $name = 'UploadTexts';
	var $uses = array();

	function index() {
		$this->set('first_button_label', "Next Step ->");
	}

	function upload_preview() {

		if (is_uploaded_file($_FILES['soubor']['tmp_name'])) {
			$radky = file($_FILES['soubor']['tmp_name']);
		}
		//echo nl2br($file);
		$analyz = new Analyzator();
		$novakniha = true;
		$book = '';
		$chapter = '';

		for($i = 0; $i < count($radky); $i++) {
		  if ($novakniha) {
		    //echo "nova ".$radky[$i]." <br />";

		    $posit = strpos($radky[$i], "|");
		    $book = Trim( Substr($radky[$i], $posit+1) );
		    $obj_sur = $analyz->object_type."-".$analyz->surface_type;
		    $transliterations[$book]["$obj_sur-count"] = 0;

		    $novakniha = false;
		  }
		  else if (Empty($radky[$i])) {
		    //echo "prazdna ".$radky[$i]." <br />";
		    $analyz->reset();
		    $novakniha = true;
		  }
		  else if(substr($radky[$i], 0, 1) == '|') {
		    //echo "treti ".$radky[$i]." book: $book <br />";
		    $obsah_radky = trim( substr($radky[$i], 1) );
			$analyz->analyzuj_pred2($obsah_radky);
		    if($obsah_radky !== 'C'){
		    	$chapter = $obsah_radky;
		    	$analyz->reset();
		    }
		    $bach = $book."  ".$chapter;

		    $obj_sur = $analyz->object_type."-".$analyz->surface_type;
		    $transliterations['translits'][$bach]["$obj_sur-count"] = 0;
		  }
		  else {
		    //echo "else ".$radky[$i]." <br />";
		    $obj_sur = $analyz->object_type."-".$analyz->surface_type;
		    $transliterations['translits'][$bach]['book'] = $book;
		    $transliterations['translits'][$bach]['chapter'] = $chapter;
		    $pos = strpos($radky[$i], " ");
		    $transliterations['translits'][$bach]["$obj_sur-line-no"][] =
		    	Substr($radky[$i], 0, $pos);

		    $transliterations['translits'][$bach]["$obj_sur-line"][] =
		    	$analyz->analyzuj_za( $chapter, Trim( Substr($radky[$i], $pos+1) ) );

		    $transliterations['translits'][$bach]["$obj_sur-count"] ++;

		  }
		  //echo "&nbsp;&nbsp;&nbsp;&nbsp;$obj_sur<br />";
		}

		$this->set('soubor_name', $_FILES['soubor']['name']);
		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		//
		$this->set('transliterations', $transliterations);
	}

	function upload() {
		$connection = new DB_Sql();
		$connection->debug = true;
		$transliterations = $_POST['translits'];
		$object_type_array = utils_get_object_types();
  		$surface_type_array = utils_get_surface_types();

		foreach($transliterations as $key=>$POST) {
		  $books = utils_get_books();
		  $id_book = -1;

		  foreach($books as $book_key=>$book) {
		    if ($book['book_abrev'] == $POST['book']) {
		      $id_book = $book['id_book'];
		    }
		  }

		  if($id_book < 0) {
		    $dotaz = "INSERT INTO book (book_abrev, book_name, book_autor, book_description) VALUES ('".
		            $POST['book']."', '".
		            $POST['book']."', '', '')";

		    $connection->query($dotaz);
		    $id = $connection->currval('book_id_book_seq');
		    $id_book = $id;
		  }

		  $dotaz = "INSERT INTO transliteration (chapter, id_book, museum_no, id_museum, id_origin, id_book_type) VALUES ('".
		            $POST['chapter']."', '$id_book', '', '0', '0', '0')";

		  $connection->query($dotaz);
		  $id = $connection->currval('transliteration_id_transliteration_seq');
		  $id_transliteration = $id;


		  //require('./logic/insert-transliteration-data.php');
		  //tohle je tam dvakrat - jednou tady, podruhe v input new text controller
		  //je potreba udelat model a vsechnu tuhle apl logiku vytrhnout
		  //nejspis to prepsat z tohohle db rozhrani na cake db
		  foreach($object_type_array as $object_type_object) {
			  $object_type = StrTr($object_type_object['object_type'], " ", " ");

			  //p_g("$object_type \n");

			  foreach($surface_type_array as $surface_type_object) {
			    //$surface_type = StrTr($surface_type_object['surface_type'], " ", "_");
			    $surface_type = StrTr($surface_type_object['surface_type'], " ", " ");

			    //p_g("<b>$surface_type</b> \n");

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
		}
	}
}