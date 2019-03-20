<?php
class NameLine extends AppModel {

	var $name = 'NameLine';
	var $useTable = 'name_line';
	var $primaryKey = 'id_name_line';
	var $validate = array(
		'id_name_line' => VALID_NOT_EMPTY,
		'id_name' => VALID_NOT_EMPTY,
		'id_line' => VALID_NOT_EMPTY,
	);
	
	var $belongsTo = array(
		'Line' => array(
			'className'  => 'Line',
          	'conditions' => '',
          	'order'      => 'Line.transliteration ASC',
          	'foreignKey' => 'id_line'
        )
	);

}

