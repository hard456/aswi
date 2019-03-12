<?php

class SearchTransliterationInfo extends Search {
  
  function SearchTransliterationInfo() {
    parent::Search();
    $this->operation = NULL;
  }
  
  function search() {
    $dotaz = " FROM transliteration t WHERE true ";
    
  	$dotaz .= parent::getConstrainSql();
    
    $pocet = $this->buildCount($dotaz);
    $dotaz = "SELECT * " . $dotaz;
    $dotaz .= ' LIMIT ' . $this->limit . ' OFFSET ' . $this->offset;
    
    //echo $dotaz;
    
    $this->db_result->query($dotaz);
    $this->db_result->next_record(); 
    $this->result = $this->db_result->Record;
    
    $ref = new Reference($this->result['id_transliteration']);
    //p_g($ref->getResult());
    foreach ($ref->getResult() as $key=>$val) {
      $this->result['series'][] = $val['series'];
      $this->result['number'][] = $val['number'];
      $this->result['page'][] = $val['plate'];
    }
    
    //p_g($this->db_result->Record);
  } // END function search
  
}

