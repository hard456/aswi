<?php

class Reference {
	
	var $name          = 'Reference';
  	var $primaryKey    = 'id_lit_reference';
  	var $useTable      = 'lit_reference';
  	var $recursive     = '0';
  	
  	var $belongsTo = array(
			'Transliteration' =>
				array('className' => 'Transliteration',
						'foreignKey' => 'id_transliteration',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
	);
}