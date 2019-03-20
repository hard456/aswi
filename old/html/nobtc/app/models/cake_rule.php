<?php
class CakeRule extends AppModel {

  	var $name          = 'CakeRule';
  	var $displayField  = 'action';
  	var $primaryKey    = 'id';
  	var $useTable      = 'rules';
  	var $recursive     = '2';
  	var $transactional = false;

  	var $validate = array(
  		'group_id' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Vyberte prosím roli')
    	),
    	'rulenum' =>
    		array(
    			array(VALID_INTEGER, 'Zadejte prosím pořadí pravidla')
    	),
    	'action' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Zadejte prosím pravidlo')
    	)
	);

  	var $belongsTo = array(
		'CakeGroup' => array(
			'className'  => 'CakeGroup',
          	'conditions' => '',
          	'order'      => '',
          	'foreignKey' => 'group_id'
        )
	);

  /*
   * Function now meets Cake Best Practices
   * Thanks to Mariano Iglesias for suggestion
   */
  	function getRules( $groupId = null) {
		$conditions = "CakeRule.group_id IN {$groupId}";
		$fields     = 'CakeRule.rulenum, CakeRule.action, CakeRule.allow ';
		$order      = 'CakeRule.group_id ASC, CakeGroup.security_level DESC, CakeRule.rulenum ASC';
		$data       = $this->findAll( $conditions, $fields, $order, null, 1, 0);

		return $data;
  	}

}
