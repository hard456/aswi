<?php
require_once('./sql/db.php');


class OldReference
{ // BEGIN class Reference
	// variables
	var $db_result = NULL;
	var $id_transliteration = -1;
	
	var $result = NULL;

	// constructor
	function OldReference($id_transliteration)
	{ // BEGIN constructor
	  if (Empty($id_transliteration))
	   $id_transliteration = 0;
		$this->db_result = new DB_Sql();
		
		$this->id_transliteration = $id_transliteration;
		$dotaz = "SELECT * FROM lit_reference
                WHERE id_transliteration=".pg_escape_string($this->id_transliteration);
		$this->db_result->query($dotaz);
		while($this->db_result->next_record()) {
		  $references[] = $this->db_result->Record;
		}
		//p_g($this->result);
		$this->result = $references;
	} // END constructor
	
	function getResult()
  { // BEGIN function getResult
  	return $this->result;
  } // END function getResult
	
	
} // END class Reference

