<?php
class CakeUser extends AppModel {

	var $name          = 'CakeUser';
	var $displayField  = 'username';
  	var $primaryKey    = 'id';
  	var $useTable      = 'users';
  	var $recursive     = '2';
  	var $transactional = false;
  	var $displayName   = 'ACL - Utenti';

  	var $validate = array(
    	'username' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Zadejte prosím jméno uživatele')
    	),
    	'login' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Zadejte prosím login uživatele')
    	),
    	'passwd' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Zadejte prosím heslo')
    	),
    	'passwd1' =>
    		array(
    			array(VALID_NOT_EMPTY, 'Zadejte prosím heslo')
    	),
    	'security_level' =>
    		array(
    			array(VALID_INTEGER, 'Zadejete prosím úroveň zabezpečení')
    	),
/*    	'email' =>
    		array(
    			array(VALID_EMAIL, 'E-mailová adresa je zadána chybně')
    	)
*/
	);

  	var $hasAndBelongsToMany = array(
		'CakeGroup' => array(
			'className'        => 'CakeGroup',
			'joinTable'            => 'users_groups',
          	'foreignKey'           => 'user_id',
          	'associationForeignKey'=> 'group_id',
          	'conditions'           => '',
          	'order'                => '',
          	'limit'                => '',
          	'uniq'                 => true,
          	'finderSql'            => '',
          	'deleteQuery'          => ''
        )
	);

  	function getAclData( $login='zxcjgjhsw', $passwd='') {
    	$this->recursive = 1;
    	$data = $this->find("login = '$login' AND passwd = '$passwd'");
    	if( $data ) {
      		$data['CakeUser']['group_id'] = '(-1,0';
      		if( $data['CakeGroup'] ) {
        		foreach( $data['CakeGroup'] as $group)
          		$data['CakeUser']['group_id'] .= ',' . $group['id'];
      		}
			$data['CakeUser']['group_id'] .= ')';
    	}
    	return $data;
  	}

  	function beforeSave( ) {
    	return true;
  	}

  	function setFieldNames( $fieldNames ) {
    	unset($fieldNames['updated']);
    	unset($fieldNames['created']);
    	// unset($fieldNames['security_level']);
    	$fieldNames['username']['prompt'] = 'Nome completo';
    	$fieldNames['passwd']['prompt']   = 'Password';
    	return $fieldNames;
  	}

	function getLogData($id) {
		$query = "SELECT max(logged) as last, count(id) as count from user_log where user_id = ".$id;
		$ret = $this->query($query);
		return $ret[0][0];
	}
}
