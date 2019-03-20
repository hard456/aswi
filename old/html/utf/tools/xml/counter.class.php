<?php
  class Counter {
  	// variables
  	//var $prefix;
  	var $prexif_text = "P%06d";
  	var $prefix_no   = 99999;
  	var $museum_no;
  	var $object;
    var $surface;
    var $column;
    var $l;
      
  	// constructor
  	function Counter() {
  		$this->reset();
  	} // END constructor
  	
  	/*function setPrefix($prefix) {
    	$this->prefix = strtr( $prefix, ",", "_" ) ;
    } // end function setPrefix
    */
   	
   	function getPrefix() {
   	  //printf($this->prexif_text, $this->prefix_no);
   	  return sprintf($this->prexif_text, $this->prefix_no);
   	} // end function getPrefix
   	
   	function setMuseumNo($mn) {
    	$this->museum_no = $mn;
    } // end function setMuseumNo
    
  	function toString() {
   	  return  $this->getPrefix().".".
              $this->object.".".
              $this->surface.".".
              $this->column.".".
              $this->l;
    } // end function toString
    
    function toStringColumn() {
   	  return  $this->getPrefix().".".
              $this->object.".".
              $this->surface.".".
              $this->column;
    } // end function toStringColumn
    
    function toStringSurface() {
   	  return  $this->getPrefix().".".
              $this->object.".".
              $this->surface;
    } // end function toStringSurface
    
    function toStringObject() {
    	return  $this->getPrefix().".".
              $this->object;
    } // end function toStringObject
    
    function reset() {
    	$this->object = 1;
      $this->surface = 1;
      $this->column = 1;
      $this->l = 1;
      $this->prefix_no++;
    } // end function reset
    
    function incObject() {
    	$this->object++;
    } // end function incObject
    
    function incSurface() {
    	$this->surface++;
    } // end function incSurface
  	
  	function incL() {
   	  $this->l++;
   } // end function incL
  } // END class Counter
  
?>
