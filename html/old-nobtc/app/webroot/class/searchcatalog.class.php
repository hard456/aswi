<?php

class SearchCatalog extends Search
{ // BEGIN class SearchCatalog
	// variables

	// constructor
	function SearchCatalog()
	{ // BEGIN constructor
		parent::Search();
    $this->operation = NULL;
	} // END constructor

  function search()
  { // BEGIN function search
  	$dotaz = " FROM transliteration t, book b, origin o, museum m, book_type bt
                WHERE t.id_book=b.id_book
                  AND t.id_origin=o.id_origin 
                  AND t.id_museum=m.id_museum
                  AND t.id_book_type=bt.id_book_type ";
    
  	$dotaz .= parent::getConstrainSql();
    
    $pocet = $this->buildCount($dotaz);
    $dotaz .= " ORDER BY nobtc_text2int(t.chapter::text), t.chapter ";
    //echo "pocet:$pocet\n<br />";
    $dotaz = "SELECT * " . $dotaz;
    $dotaz .= ' LIMIT ' . $this->limit . ' OFFSET ' . $this->offset;
    
    //echo $dotaz;
    
    $this->db_result->query($dotaz);
    //$this->db_result->next_record(); 
    //$this->result = $this->db_result->Record;
  } // END function search

  function next_record()
  {
    $return = $this->db_result->next_record(); 
    $this->result = $this->db_result->Record;
    return $return;
  }
} // END class SearchCatalog

