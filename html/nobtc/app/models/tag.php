<?php
class Tag extends AppModel {

	var $name = 'Tag';
	var $primaryKey = 'id_tag';
	var $useTable = 'tag';

	var $validate = array(
//		'id_tag' => VALID_NOT_EMPTY,
	);

/*
	var $belongsTo = array(
		'Names' => array(
			'className'  => 'Names',
          	'conditions' => '',
          	'order'      => '',
          	'foreignKey' => 'id_name'
        )
	);
	*/
}
