<?php
//public abstract 
class Search {

	var $db_result = NULL;
	var $count = -1;
	var $offset = 0;
	var $limit = 1;
  var $result = NULL;
  
	var $cons_array = Array();
  
  var $operation = NULL;
  
  function Search() {
    $this->db_result = new DB_Sql();
  }
  
  function getCount()
  { // BEGIN function getCount
    return $this->count;
  } // END function getCount

  function getOffset()
  { // BEGIN function getOffset
  	return $this->offset;
  } // END function getOffset
  
  function setOffset($new)
  { // BEGIN function setOffset
    if (Empty($new)) return NULL; 
    if ($new < 0) return NULL;
  	$this->offset = $new;
  } // END function setOffset
  
  
  function getLimit()
  { // BEGIN function getLimit
  	return $this->limit;
  } // END function getLimit
  
  function setLimit($new)
  { // BEGIN function setLimit
    if (Empty($new)) return NULL; 
    if ($new < 0) return NULL;
  	$this->limit = $new;
  } // END function setLimit
  
  
  function setOperation($op)
  { // BEGIN function setOperation
  	if ($op == 'and')
  	   $this->operation = ' AND ';
  	else if ($op == 'or')
  	   $this->operation = ' OR ';
  } // END function setOperation
  
  
  function getResult()
  { // BEGIN function getResult
  	return $this->result;
  } // END function getResult
  
    function addConstrain($table, $name, $operator, $value)
  {
    if (Empty($value) || Empty($operator) || Empty($name)) return NULL;
    
    if ($operator == 'contains')
    $this->cons_array[] = $this->getTableAb($table).".$name LIKE '%$value%' ";
    else if ($operator == 'equals')
      $this->cons_array[] = $this->getTableAb($table).".$name LIKE '$value' ";
    else if ($operator == 'not equals')
      $this->cons_array[] = $this->getTableAb($table).".$name NOT LIKE '$value' ";
    else if ($operator == 'begins with')
     $this->cons_array[] = $this->getTableAb($table).".$name LIKE '$value%' ";
    else if ($operator == 'ends with')
      $this->cons_array[] = $this->getTableAb($table).".$name LIKE '%$value' ";
    else if ($operator == 'is')
      $this->cons_array[] = $this->getTableAb($table).".$name = $value ";
    else if ($operator == 'is not')
      $this->cons_array[] = " NOT ".$this->getTableAb($table).".$name = $value ";
     
  }
  
  
  function getTableAb($table)
  {
    if ($table == 'line') return 'l';
    if ($table == 'surface') return 's';
    if ($table == 'transliteration') return 't';
    if ($table == 'book') return 'b';
    if ($table == 'origin') return 'o';
    if ($table == 'museum') return 'm';
    if ($table == 'book_type') return 'bt';
  }
  
  function buildCount($part_query)
  { // BEGIN function getCount
  	$dotaz = "SELECT Count(*) ".$part_query;
  	$this->db_result->query($dotaz);
  	$this->db_result->next_record();
  	$this->count = $this->db_result->Record['count'];
  	return $this->count;
  } // END function getCount
  
  function getConstrainSql()
  {
    $dotaz = "";
    
    if (Count($this->cons_array) > 0) {
      $dotaz .= ' AND ( ';
      $prvne = true;
      foreach ($this->cons_array as $key=>$value) {
        if($prvne) {
          $prvne = false;
          $dotaz .= " ";
        }
        else {
          $dotaz .= $this->operation;
        }
        $dotaz .= $value."";
      }
      $dotaz .= ' ) ';
    }
    return $dotaz;
  }
  
}
