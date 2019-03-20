<?php
class UserLog extends AppModel {

  	var $name          = 'UserLog';
  	var $displayField  = 'ip';
  	var $primaryKey    = 'id';
  	var $useTable      = 'user_log';

  	var $belongsTo = array(
		'CakeUser' => array(
			'className'  => 'CakeUser',
          	'conditions' => '',
          	'order'      => '',
          	'foreignKey' => 'user_id'
        )
	);

	function log($idUser) {
		$data['UserLog']['logged']  = date("Y-m-d H:i:s");
		$data['UserLog']['client']  = $_SERVER['HTTP_USER_AGENT'];
		$data['UserLog']['ip']      = $_SERVER['REMOTE_ADDR'];
		$data['UserLog']['cookie']  = $_SERVER['HTTP_COOKIE'];
		$data['UserLog']['user_id'] = $idUser;

		$this->save($data);
	}
}