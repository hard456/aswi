<?php
class Line extends AppModel {

	var $name = 'Line';
	var $useTable = 'line';
	var $primaryKey = 'id_line';
	var $validate = array(
		'id_line' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Name' =>
				array('className' => 'Name',
						'joinTable' => 'name_line',
						'foreignKey' => 'id_line',
						'associationForeignKey' => 'id_name',
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
