<?php
class Name extends AppModel {

	var $name = 'Name';
	var $useTable = 'name';
	var $primaryKey = 'id_name';
	var $validate = array(
		'id_name' => VALID_NOT_EMPTY,
		'name' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Line' =>
				array('className' => 'Line',
						'joinTable' => 'name_line',
						'foreignKey' => 'id_name',
						'associationForeignKey' => 'id_line',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);

}
?>
