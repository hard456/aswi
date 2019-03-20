<?php
class Line extends AppModel {

	var $name = 'Line';
	var $useTable = 'line';
	var $primaryKey = 'id_line';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Name' =>
				array('className' => 'Names',
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

	var $belongsTo = array(
		'Surface' => array(
			'className'  => 'Surface',
          	'conditions' => '',
          	'order'      => '',
          	'foreignKey' => 'id_surface'
        ),
	);
	
	var $hasMany = array(
		'NameLine' => array(
			'className'  => 'NameLine',
			'exclusive'  => '',
			'dependent'  => '',
			'foreignKey' => 'id_line',
			'conditions' => '',
			'order'      => '',
			'limit'      => '',
			'finderSql'  => ''
		),
	);

}
?>
