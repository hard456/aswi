<?php
require_once('./sql/db.php');


class Transliteration
{ // BEGIN class Transliteration
	// variables
	var $db_result = NULL;
	var $id_transliteration = -1;
	
	var $result = NULL;

	// constructor
	function Transliteration($id_transliteration)
	{ // BEGIN constructor
	  if (Empty($id_transliteration))
	   $id_transliteration = 0;
		$this->db_result = new DB_Sql();
		$na_radky = new DB_Sql();
		
		$this->id_transliteration = $id_transliteration;
		$dotaz = "SELECT * FROM surface s, object_type ot, surface_type st
                WHERE s.id_object_type=ot.id_object_type
                  AND s.id_surface_type=st.id_surface_type
                  AND s.id_transliteration=".pg_escape_string($id_transliteration);
		$this->db_result->query($dotaz);
		while($this->db_result->next_record()) {
		  $surface = $this->db_result->Record;
		  $dotaz2 = "SELECT * FROM line 
			             WHERE id_surface = ".pg_escape_string($surface['id_surface'])." 
			             ORDER BY nobtc_getbrokencount(line_number::text), 
									          nobtc_text2int(line_number::text);";
		  $na_radky->query($dotaz2);
		  while($na_radky->next_record()) {
		    $result[$surface['object_type'].'-'.$surface['surface_type'].'-count'] ++;
		    $result[$surface['object_type'].'-'.$surface['surface_type'].'-line'][] = $na_radky->Record['transliteration'];
		    $result[$surface['object_type'].'-'.$surface['surface_type'].'-line-no'][] = $na_radky->Record['line_number'];
		    $result[$surface['object_type'].'-'.$surface['surface_type'].'-line-broken'][] = $na_radky->Record['broken'];
		  }
		}
		//p_g($this->result);
		$this->result = $result;
	} // END constructor
	
	function getResult()
  { // BEGIN function getResult
  	return $this->result;
  } // END function getResult
	
	function getRevHistory() {
	  $dotaz = "SELECT * FROM rev_history
                WHERE id_transliteration=".pg_escape_string($this->id_transliteration)." ORDER BY id_rev_history";
		$this->db_result->query($dotaz);
		while($this->db_result->next_record()) {
		  $result[$this->db_result->Record['id_rev_history']] = $this->db_result->Record;
		}
	  return $result;
	}
	
	function getPhotos() {
	  	  $dotaz = "SELECT * FROM picture
                WHERE id_transliteration=".pg_escape_string($this->id_transliteration)." AND type = 'photo' ORDER BY id_picture";
		$this->db_result->query($dotaz);
		while($this->db_result->next_record()) {
		  $result[] = $this->db_result->Record;
		}
	  return $result;
	}
	
	function getHandcopies() {
	  $dotaz = "SELECT * FROM picture
                WHERE id_transliteration=".pg_escape_string($this->id_transliteration)." AND type = 'handcopy' ORDER BY id_picture";
		$this->db_result->query($dotaz);
		while($this->db_result->next_record()) {
		  $result[] = $this->db_result->Record;
		}
	  return $result;
	}
} // END class Transliteration
