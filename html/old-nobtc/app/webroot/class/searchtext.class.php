<?php

class SearchText extends Search
{ // BEGIN class SearchCatalog
	// variables

	var $lines_around = 0;
	
	var $word1 = '';
	
	var $word2_part = '';
	
	var $word3_part = '';
	
	var $db_res_lines_around = NULL;
	
	var $exactMatch = true;

	// constructor
	function SearchText($exactMatch = true)
	{ // BEGIN constructor
    //super();
    parent::Search();
    $this->operation = ' AND ';
    $this->exactMatch = $exactMatch;
	} // END constructor
  
  function setWord($new)
  {
    $this->word1 = $new;
  }
  
  function setWord2($word2, $op)
  { // BEGIN function setWord2
    if (empty($word2) || empty($op)) 
      return;
  	$this->word2_part = ($op == 'or')? " OR " : " AND ";
    $this->word2_part .= " l.transliteration ";
    if (!$this->exactMatch) {
        if ($op == 'not')$this->word2_part .= " !";
        $word2_pom = "~* '". pg_escape_string( add_bracket($word2) ). "' ";
    }
    else {
        if ($op == 'not')$this->word2_part .= " NOT ";
    		$word2_pom = "LIKE '%". pg_escape_string( $word2 ). "%' ";
    }
    $this->word2_part .= $word2_pom;
  } // END function setWord2
  
  function setWord3($word3, $op)
  { // BEGIN function setWord3
    if (empty($word3) || empty($op)) 
      return;
  	$this->word3_part = ($op == 'or')? " OR " : " AND ";
    $this->word3_part .= " l.transliteration ";
    if (!$this->exactMatch) {
        if ($op == 'not')$this->word3_part .= " !";
        $word3_pom = "~* '". pg_escape_string( add_bracket($word3) ). "' ";
    }
    else {
        if ($op == 'not')$this->word3_part .= " NOT ";
    		$word3_pom = "LIKE '%". pg_escape_string( $word3 ). "%' ";
    }
    $this->word3_part .= $word3_pom;
  } // END function setWord3

  function setLinesAround($count)
  { // BEGIN function 
    if (empty($count) || $count < 0) 
      return;
  	$this->lines_around = $count;
  	$this->db_res_lines_around = new DB_Sql();
  } // END function 


  function search()
  { // BEGIN function search
    
    if (!$this->exactMatch) {
      	$word1_pom = "~* '". pg_escape_string( add_bracket($this->word1) ). "' ";
    }
    else {
    		$word1_pom = "LIKE '%". pg_escape_string( $this->word1 ). "%' ";
    }
    
  	$dotaz = " FROM line l, surface s, transliteration t, book b, book_type bt, origin o
                WHERE ( l.transliteration ".$word1_pom;
    
    if (!empty($this->word2_part))
      $dotaz .= $this->word2_part;
    if (!empty($this->word3_part))
      $dotaz .= $this->word3_part; 
    
    $dotaz .= " ) 
                  AND t.id_book_type=bt.id_book_type
                  AND t.id_origin=o.id_origin 
                  AND l.id_surface=s.id_surface 
                  AND s.id_transliteration=t.id_transliteration
                  AND t.id_book=b.id_book
                 ";
    
    $dotaz .= parent::getConstrainSql();
    
    $pocet = $this->buildCount($dotaz);
    //echo "pocet:$pocet\n<br />";
    $dotaz = "SELECT * " . $dotaz;
    if (!empty($this->limit)) {
    	$dotaz .= ' LIMIT ' . $this->limit . ' OFFSET ' . $this->offset;
    }
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
  
  function getLinesBefore()
  {
    if (empty($this->lines_around) || $this->lines_around < 0) 
      return;
    $min = $this->result['line_number'] - $this->lines_around;
    $max = $this->result['line_number'] - 1;
    if ($min <= 0) {
      $min = 1;
    }
    return $this->getLines($this->result['id_surface'], $this->result['line_number'], $min, $max);
  }
  function getLinesAfter()
  {
    if (empty($this->lines_around) || $this->lines_around < 0) 
      return;
    $min = $this->result['line_number'] + 1;
    $max = $this->result['line_number'] + $this->lines_around;

    return $this->getLines($this->result['id_surface'], $this->result['line_number'], $min, $max);
  }
  
  function getLines($id_surface, $line_number, $min, $max) {
    if (empty($this->lines_around) || $this->lines_around < 0) 
      return;
    $ret_array = array();
    $dotaz = "SELECT * from line l 
               WHERE l.id_surface=$id_surface
                 AND nobtc_getbrokencount('".pg_escape_string($line_number)."') = nobtc_getbrokencount(l.line_number::text)
                 AND nobtc_text2int(l.line_number::text) BETWEEN $min AND $max
               ORDER BY nobtc_text2int(l.line_number::text);";
    $this->db_res_lines_around->query($dotaz);
    while ($this->db_res_lines_around->next_record()) {
    $pom = $this->db_res_lines_around->Record;
      $ret_array[$pom['line_number']] = $pom['transliteration'];
    }
    //p_g($this->db_res_lines_around->Record);
    return $ret_array;
  }
  
  function getDotsBefore() {
    return false;
  }
  
  function getDotsAfter() {
    return false;
  }
} // END class SearchCatalog

