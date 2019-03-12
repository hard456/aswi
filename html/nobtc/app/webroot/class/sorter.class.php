<?php

class Sorter
{ // BEGIN class Sorter
	// variables
	var $offset;
	var $limit;
	var $total; 
	var $pref = "r_";
	
	var $max = 20;

	// constructor
	function Sorter($offset, $limit, $total)
	{ // BEGIN constructor
		if ($offset < 0) $offset = 0;
		if ($limit < 1) $limit = 1;
		if ($total < 0) $total = 0;
		//spatne if ($offset >= $total/$limit) $offset = $total - ($total % $limit) - 1;
		$this->offset = $offset;
		$this->limit = $limit;
		$this->total = $total;
	} // END constructor
	
	function getLine() {
    $return = '';
    
    $act_site = floor($this->offset/$this->limit)+1;
    $all_sites = ceil($this->total/$this->limit);
    
    if ($this->total <= 0) {
      $return .= "No record found.";
    }
    else{
      $return .= '<div class="raditko">';
      $return .= "Total count: ".$this->total.". ";
      $return .= "Site ".$act_site
                  ." of ".$all_sites." sites found. 
                        Print ".$this->limit." per site.\n<br />";
      $return .= ' <a href="'.$this->get_href_home().'">|&lt;&lt;</a> ';
      $return .= ' <a href="'.$this->get_href_custom($act_site-1).'">&lt;&lt;</a> ';
      
      
      
      $dots_before = $dots_after = true;
      
      if ($this->max < $all_sites) {
        $start = $act_site - $this->max/2;
        $end = $act_site + $this->max/2;
        if ($start <= 1) {
          $start = 1;
          $end = $start + $this->max;
          $dots_before = false;
        }
        if ($end > $all_sites) {
          $end = $all_sites+1;
          $start = $end - $this->max;
          $dots_after = false;
        }
      }
      else {
        $start = 1;
        $end = ceil( $this->total/$this->limit ) + 1;
        $dots_before = $dots_after = false;
      }
      
      if ($dots_before) $return .= " ... ";
      
      for ($i = $start; $i < $end; $i += 1) {
        
        if ($act_site != $i)
          $return .= ' <a href="'.$this->get_href_custom($i).'">' . $i . '</a>  ';
        else
          $return .= "<span class=\"aktualni\">".$i." </span> ";
      }
      
      if ($dots_after) $return .= " ... ";
      
      $return .= ' <a href="'.$this->get_href_custom($act_site+1).'">&gt;&gt;</a> ';
      $return .= ' <a href="'.$this->get_href_end().'">&gt;&gt;|</a> ';
      $return .="<br />\n";
      $return .='</div>';
    }
	  return $return;
	}
	
  function get_href_custom($i) 
  {
    if($i < 1) $i = 1;
    if($i > ceil($this->total/$this->limit)) $i = ceil($this->total/$this->limit);
    //if($i >= $this->total/$this->limit) $i = $this->total - ($this->total % $this->limit) - 1;
    $_REQUEST[$this->pref.'offset'] = ($i-1)*$this->limit;
    $_REQUEST[$this->pref.'limit'] = $this->limit;
    return $PHP_SELF.'?'.get_array_as_get_string($_REQUEST);
	}
	
	
	function get_href_home()
  { // BEGIN function get_href_home
    $_REQUEST[$this->pref.'offset'] = 0;
    $_REQUEST[$this->pref.'limit'] = $this->limit;
 	  return $PHP_SELF.'?'.get_array_as_get_string($_REQUEST);
  } // END function get_href_home
  
  function get_href_end()
  { // BEGIN function get_href_end
    //echo ("total: ".$this->total .", limit: ". $this->limit.", offset: ".$this->offset);
    $_REQUEST[$this->pref.'offset'] = $this->total - (($this->limit == 1) ? 1 : ($this->total % $this->limit) );
    $_REQUEST[$this->pref.'limit'] = $this->limit;
  	return $PHP_SELF.'?'.get_array_as_get_string($_REQUEST);
  } // END function get_href_end
} // END class Sorter

