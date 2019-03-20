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

    $ref = new OldReference($this->result['id_transliteration']);
    $vysledek = $ref->getResult();
    //p_g($ref->getResult());
    if (!empty($vysledek)) {
	   foreach ($vysledek as $key=>$val) {
	      $this->result['series'][] = $val['series'];
	      $this->result['number'][] = $val['number'];
	      $this->result['page'][] = $val['plate'];
	    }
	}

    //p_g($this->db_result->Record);
  } // END function search

}

