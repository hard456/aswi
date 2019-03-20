<?php
class CatalogueController extends AppController {
   var $name = 'Catalogue';

   var $uses = array();

	function index() {

	}

    function search() {
		$SearchCatalog = new SearchCatalog();
		$SearchCatalog->setOperation($_REQUEST['-lop']);
		$SearchCatalog->setOffset($_REQUEST['r_offset']);
		$SearchCatalog->addConstrain("book", "id_book", $_REQUEST["id_book-op"], $_REQUEST["id_book"]);
		$SearchCatalog->addConstrain("book", "book_name", $_REQUEST["book_name-op"], $_REQUEST["book_name"]);
		$SearchCatalog->addConstrain("book", "book_autor", $_REQUEST["book_autor-op"], $_REQUEST["book_autor"]);
		$SearchCatalog->addConstrain("transliteration", "chapter", $_REQUEST["chapter-op"], $_REQUEST["chapter"]);
		$SearchCatalog->addConstrain("transliteration", "id_museum", $_REQUEST["id_museum-op"], $_REQUEST["id_museum"]);
		$SearchCatalog->addConstrain("transliteration", "museum_no", $_REQUEST["museum_no-op"], $_REQUEST["museum_no"]);
		$SearchCatalog->addConstrain("transliteration", "id_origin", $_REQUEST["id_origin-op"], $_REQUEST["id_origin"]);
		$SearchCatalog->addConstrain("transliteration", "id_book_type", $_REQUEST["id_book_type-op"], $_REQUEST["id_book_type"]);

		if ( !empty($_REQUEST['view-all']) ) {
			$SearchCatalog->setLimit(10000);
		}

		$SearchCatalog->search();

		while ($SearchCatalog->next_record()) {
		  $Found_catc[] = $SearchCatalog->getResult();
		  if ( empty($_REQUEST['view-only-catalogue'])) {
		  	$only_catalogue = false;
		  }
		  else {
		  	$only_catalogue = true;
		  }
		  $Transliterations[] = new OldTransliteration($SearchCatalog->result['id_transliteration'], $only_catalogue);
		}
		$Sorter = new Sorter($SearchCatalog->getOffset(), $SearchCatalog->getLimit(), $SearchCatalog->getCount() );

		$this->set('Found_catc', $Found_catc);
		$this->set('Transliterations', $Transliterations);
		$this->set('object_type_array', utils_get_object_types());
		$this->set('surface_type_array', utils_get_surface_types());
		$this->set('Sorter_line', $Sorter->getLine());
		$this->set('only_catalogue', $only_catalogue);

   }
}