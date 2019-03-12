<?php

class Subjects {

    private $DB;
  
    function __construct() {
      //$this->DB->debug = true;
      $this->DB = NewDB();
    }
    
    
    function getSubjects() { 
    	//$this->DB->debug = true;
      return $this->DB->GetAssoc('select * from subject order by idsubject');
    } // END function getSubjects
    
    function addSubject($REQUEST) { 
    	//$this->DB->debug = true;
    	
      $array['abb'] = $REQUEST['abb'];
      $array['name'] = $REQUEST['name'];
      if ( ! $this->DB->AutoExecute("subject", $array, 'INSERT') )
        return "Error: Subject not inserted.";
      return "Subject was inserted.";
    } // END function addSubject

    function updateSubject($REQUEST) { 
    	//$this->DB->debug = true;
      if (empty ($REQUEST['idsubject']))
        return "Something not set.";
      $array['name'] = $REQUEST['name'];
      if ( $this->DB->AutoExecute("subject", $array, 'UPDATE', 'idsubject = '.$REQUEST['idsubject']) )
        return "Subject was saved.";
      return "Error: Subject not saved.";
    } // END function updateSubject
    
    function deleteSubject($id) { 
    	//$this->DB->debug = true;
      if ( $this->DB->Execute("delete from subject where idsubject = ?", $id) )
        return "Subject deleted.";
      return "Error: Subject was not deleted.";
    } // END function deleteSubject
  
} // END class Subjects


