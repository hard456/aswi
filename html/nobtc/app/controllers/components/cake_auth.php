<?php
/*
 * Auth component
 * @author  M.S.
 */
class CakeAuthComponent extends object {
  var $components = array('Session');
  var $externalId = null; // id of external table for specific jobs
  var $id         = null; // id of the logged in user
  var $username   = null; // username of the logged in user
  var $login      = null; // login of the logged in user
  var $security   = null; // security_level of the logged in user
  var $groupId    = null; // group(s) assigned to the logged in user
  var $errors     = null; // error messages to be displayed
  var $lastUrl    = '/' ; // last url saved just in case of redirection
  var $cacheRules = null; // cached rules for best performance

  // Function to save the url that will be chained
  function saveUrl( $url ) {
    $this->Session->write('cakeAuth.lastUrl', $url);
  }

  // Function to Set / Get Session Vars
  function set($data='') {
    if( $data ) {
      $this->Session->write('cakeAuth', $data);
      $this->Session->write('cakeAuth.cacheRules', serialize($this->getRules($data['group_id'])));
      $this->Session->write('cakeAuth.noCheck',   0);
    }
    if($this->Session->check('cakeAuth') && $this->Session->valid('cakeAuth')) {
      $this->id         = $this->Session->read('cakeAuth.id');
      $this->externalId = $this->Session->read('cakeAuth.external_id');
      $this->username   = $this->Session->read('cakeAuth.username');
      $this->login      = $this->Session->read('cakeAuth.login');
      $this->security   = $this->Session->read('cakeAuth.security_level');
      $this->groupId    = $this->Session->read('cakeAuth.group_id');
      $this->lastUrl    = $this->Session->read('cakeAuth.lastUrl');
      $this->cacheRules = unserialize($this->Session->read('cakeAuth.cacheRules') . '');
    }
    elseif($this->Session->error()) {
      return $this->Session->error();
    }
    return ($this->id != null);
  }

  // Logout Clean Session
  function logout() {
    $this->Session->del('cakeAuth');
    if($this->Session->error()) {
      return $this->Session->error();
    }
  }

  function _normalizeCheck($check = "") {
    $check = str_replace('/', '\/', $check);
    $check = str_replace('*', '.*', $check);
    $check = '/' . $check . '/';
    return $check;
  }

  function _normalizeAllow($dbBoolean) {
  	//narychlo pro postgres
	return ($dbBoolean == 't');
  }

  function getRules( $gid=null ) {
    if(empty($this->cacheRules)) {
      loadModel("CakeRule");
      $CakeRule = new CakeRule;
      $this->cacheRules = $CakeRule->getRules( $gid );
      for($i=0; $i<count($this->cacheRules); $i++) {
        $this->cacheRules[$i]['CakeRule']['action'] = $this->_normalizeCheck($this->cacheRules[$i]['CakeRule']['action']);
        $this->cacheRules[$i]['CakeRule']['allow'] = $this->_normalizeAllow($this->cacheRules[$i]['CakeRule']['allow']);
      }
    }
    return $this->cacheRules;
  }

  // Function to check the access for the controller / action
  function check($controller='', $action='') {

    $noCheck = $this->Session->read('cakeAuth.noCheck');
    if($noCheck > 0) {
      $this->noCheck( $noCheck-- );
      return true;
    }

    $checkStr = strtolower("{$controller}/{$action}/");
    $allow = false;
    if($this->groupId) {
      $rules = $this->getRules($this->groupId);
      foreach( $rules as $data ) {
        $check = strtolower($data['CakeRule']['action']);
        if(preg_match($check, $checkStr, $matches)) {
          $allow = $data['CakeRule']['allow'];
			//$this->log( "check: ".$checkStr."\n<br/>" );
			//$this->log( "pravidlo: ".$check."\n<br/>" );
			//$this->log( "nastavuji na ".$allow."\n<br/>" );
        }
      }
    }
    //return true;
    return $allow;
  }

  function noCheck( $forTimes=1 ) {
    $this->Session->write('cakeAuth.noCheck', $forTimes);
  }

  function canDo( $checkStr = "", $debug=false ) {
    $allow = false;
    foreach( $this->cacheRules as $data ) {
      if(preg_match($data['CakeRule']['action'], $checkStr, $matches)) {
        $allow = $data['CakeRule']['allow'];
      }
    }
    return $allow;
  }

  function isGroupId($grp) {
    $a = split(',', $this->groupId);
    return in_array($grp, $a);
  }

}
