<?php
class CakeGroup extends AppModel {

  	var $name          = 'CakeGroup';
  	var $displayField  = 'groupname';
  	var $primaryKey    = 'id';
  	var $useTable      = 'groups';
  	var $recursive     = '2';
  	var $transactional = false;

  	var $validate = array(
  		'groupname' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Zadejte prosím název role')
    	),
    	'security_level' =>
    		array(
    			array(VALID_INTEGER, 'Zadejte prosím úroveň zabezpečení')
    	)
	);

  	var $hasMany = array(
		'CakeRule' => array(
			'className'  => 'CakeRule',
			'exclusive'  => false,
			'dependent'  => true,
			'foreignKey' => 'group_id',
			'conditions' => '',
			'order'      => 'CakeRule.rulenum ASC',
			'limit'      => '',
			'finderSql'  => ''
		)
	);

  	var $hasAndBelongsToMany = array(
		'CakeUser' => array(
			'className'            => 'CakeUser',
          	'joinTable'            => 'users_groups',
          	'foreignKey'           => 'group_id',
          	'associationForeignKey'=> 'user_id',
          	'conditions'           => '',
          	'order'                => '',
          	'limit'                => '',
          	'uniq'                 => true,
          	'finderSql'            => '',
          	'deleteQuery'          => ''
		)
	);

}
