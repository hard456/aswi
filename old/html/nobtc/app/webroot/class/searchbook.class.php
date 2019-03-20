<?php

class SearchBook extends Search {
  
  function SearchBook() {
    parent::Search();
    $this->operation = NULL;
  }
  
  function search() {
    $dotaz = " FROM book b WHERE true ";
    
  	$dotaz .= parent::getConstrainSql();
    
    $pocet = $this->buildCount($dotaz);
    //echo "pocet:$pocet\n<br />";
    $dotaz = "SELECT * " . $dotaz;
    $dotaz .= ' LIMIT ' . $this->limit . ' OFFSET ' . $this->offset;
    
    //echo $dotaz;
    
    $this->db_result->query($dotaz);
    $this->db_result->next_record(); 
    $this->result = $this->db_result->Record;
  } // END function search
  
}
