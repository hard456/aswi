<?php

class Types {

    private $DB;
  
    function __construct() {
      //$this->DB->debug = true;
      $this->DB = NewDB();
    }
    
    
    function getTypes() { 
    	//$this->DB->debug = true;
      return $this->DB->GetAssoc('select * from type order by idtype');
    } // END function getTypes
    
    function addType($REQUEST) { 
    	//$this->DB->debug = true;
    	
      $array['abb'] = $REQUEST['abb'];
      $array['name'] = $REQUEST['name'];
      if ( ! $this->DB->AutoExecute("type", $array, 'INSERT') )
        return "Error: Type not inserted.";
      return "Type was inserted.";
    } // END function addType

    function updateSubject($REQUEST) { 
    	//$this->DB->debug = true;
      if (empty ($REQUEST['idtype']))
        return "Something not set.";
      $array['name'] = $REQUEST['name'];
      if ( $this->DB->AutoExecute("type", $array, 'UPDATE', 'idtype = '.$REQUEST['idtype']) )
        return "Type was saved.";
      return "Error: Type not saved.";
    } // END function updateType
    
    function deleteType($id) { 
    	//$this->DB->debug = true;
      if ( $this->DB->Execute("delete from type where idtype = ?", $id) )
        return "Type deleted.";
      return "Error: Type was not deleted.";
    } // END function deleteType
  
} // END class Types


