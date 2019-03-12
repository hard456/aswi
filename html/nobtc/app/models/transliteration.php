<?php
class Transliteration extends AppModel {

	var $name = 'Transliteration';
	var $primaryKey = 'id_transliteration';
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Book' =>
				array('className' => 'Book',
						'foreignKey' => 'id_book',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
			'Museum' =>
				array('className' => 'Museum',
						'foreignKey' => 'id_museum',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
			'Origin' =>
				array('className' => 'Origin',
						'foreignKey' => 'id_origin',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
			'BookType' =>
				array('className' => 'BookType',
						'foreignKey' => 'id_book_type',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
/*	  	var $hasMany = array(
		'Reference' => array(
			'className'  => 'Reference',
			'exclusive'  => false,
			'dependent'  => true,
			'foreignKey' => 'id_transliteration',
			'conditions' => '',
			'order'      => 'Reference.series ASC',
			'limit'      => '',
			'finderSql'  => ''
		)
	);*/

	function bindModelsForTables() {
		$this->bindModel(
			array(
				'hasMany' => array(
					'Surface' => array(
						'className'  => 'Surface',
						'foreignKey' => 'id_transliteration',
					)
				)
			)
		);
		$this->Surface->unbindModel( array('belongsTo' => array('Transliteration')));
		
		$this->Surface->bindModel(
			array(
				'hasMany' => array(
					'Line' => array(
						'className'  => 'Line',
						'foreignKey' => 'id_surface',
					)
				),
				'belongsTo' => array(
					'SurfaceType' => array(
						'className' => 'SurfaceType',
						'foreignKey' => 'id_surface_type',
					),
					'ObjectType' => array(
						'className' => 'ObjectType',
						'foreignKey' => 'id_object_type',
					)
				),
			)
		);
	}
	
	function organizeLines($trans) {
		$ret = array();
		foreach ($trans as  $surface) {
		$ret[$surface['ObjectType']['object_type']]
					[$surface['SurfaceType']['surface_type']]
					['id_surface'] = $surface['id_surface'];
			
			foreach ($surface['Line'] as $line) {
				
				$ret[$surface['ObjectType']['object_type']]
					[$surface['SurfaceType']['surface_type']]
					['lines']
					[$line['id_line']] = 
					array(
						'line_number' => $line['line_number'],
						'transliteration' => $line['transliteration'],
						);
			}
		}
		return $ret;
	}
	
	function saveSReferences($data = null, $validate = true, $fieldList = array()) {
		//pr($_REQUEST);
		//return;
		$connection = new DB_Sql();
		$POST = $_REQUEST;
		$id_transliteration = $_REQUEST['data']['Transliteration']['id_transliteration'];
		if (!empty($POST['series']) && is_array($POST['series'])) {
		  $dotaz = "DELETE FROM lit_reference WHERE id_transliteration = '$id_transliteration'";
		  $connection->query($dotaz);
		  foreach(array_keys($POST['series']) as $id) {
		    $dotaz = "INSERT INTO lit_reference(series, number, plate, id_transliteration) VALUES ('".
		              pg_escape_string($POST['series'][$id])."', '".
		              pg_escape_string($POST['number'][$id])."', '".
		              pg_escape_string($POST['page'][$id])."', '".
		              pg_escape_string($id_transliteration)."');";
		    $connection->query($dotaz);
		  }
		}
		
		return $this->save($data, $validate, $fieldList);
		//pr($this->invalidFields());
	}
	
	function saveTexts($request) {
		$Line = new Line();
		foreach ($request['data'] as $object) {
			foreach ($object as $surface) {
				foreach ($surface['lines'] as $line) {
					$Line->create();
					$Line->save($line);
				}
			}
		}
		
		return true;
	}
}
