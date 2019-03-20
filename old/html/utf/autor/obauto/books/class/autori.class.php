<?php

class Autori {

    private $DB;
  
    function __construct() {
      //$this->DB->debug = true;
      $this->DB = NewDB();
    }
    
    
    function getAutory() { 
    	//$this->DB->debug = true;
      return $this->DB->GetAssoc('select * from author order by surname, name');
    } // END function getAutory 
    
    function addAutor($REQUEST) { 
    	//$this->DB->debug = true;
    	
      $array['titlebefore'] = $REQUEST['titlebefore'];
      $array['name'] = $REQUEST['name'];
      $array['surname'] = $REQUEST['surname'];
      $array['titleafter'] = $REQUEST['titleafter'];
      $array['actual'] = "A";
      if ( ! $this->DB->AutoExecute("author", $array, 'INSERT') )
        return "Error: Author not inserted.";
      return "Author was inserted.";
    } // END function addAutor

    function updateAutor($REQUEST) { 
    	//$this->DB->debug = true;
      if (empty ($REQUEST['idauthor']))
        return "Something not set.";
      $array['titlebefore'] = $REQUEST['titlebefore'];
      $array['name'] = $REQUEST['name'];
      $array['surname'] = $REQUEST['surname'];
      $array['titleafter'] = $REQUEST['titleafter'];
      if ( $this->DB->AutoExecute("author", $array, 'UPDATE', 'idauthor = '.$REQUEST['idauthor']) )
        return "Author was saved.";
      return "Error: Author not saved.";
    } // END function updateAuhor
    
    function deleteAutor($id) { 
    	//$this->DB->debug = true;
      if ( $this->DB->Execute("delete from author where idauthor = ?", $id) )
        return "Author deleted.";
      return "Error: Author was not deleted.";
    } // END function deleteAutor
    
    function menuAutor($name, $vybrane = NULL) {
      //$this->DB->debug = true;
      $rs = $this->DB->Execute("SELECT 
                   
                  titlebefore || ' ' || 
                  name || ' ' || 
                  surname || ' ' || 
                  titleafter as whole_name
                  ,idauthor 
                FROM author 
                WHERE actual='A' ORDER BY surname");
      return $rs->GetMenu2($name, $vybrane, "-1:&lt;-- choose author --&gt;", false, 0);
    }
    
    function menuSubject($name, $vybrane = NULL) {
      //$this->DB->debug = true;
      $rs = $this->DB->Execute("SELECT  name, abb FROM subject ORDER BY idsubject");
      return $rs->GetMenu2($name, $vybrane, "-1:&lt;-- choose subject --&gt;", false, 0);
    } 
    
    function menuType($name, $vybrane = NULL) {
      //$this->DB->debug = true;
      $rs = $this->DB->Execute("SELECT  name, abb FROM type ORDER BY idtype");
      return $rs->GetMenu2($name, $vybrane, "-1:&lt;-- choose type --&gt;", false, 0);
    } 
    
    function getAutorsBooks($idautor) {
      //$this->DB->debug = true;
      return $this->DB->GetAssoc('select * from 
                                         author a, 
                                         book_author ba, 
                                         book b 
                                  where a.idauthor=ba.idauthor 
                                    and ba.idbook=b.idbook 
                                    and a.idauthor=?',
                                 array($idautor));
    }
} // END class Autori


