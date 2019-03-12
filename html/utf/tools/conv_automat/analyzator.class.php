<?php
  class Analyzator {
  	// variables
    var $object_type;// tablet, envelope
    var $surface_type;// obverse, reverse, bottom, left, sealing, top...
    var $byl_envelop;
    var $byl_sealing;
  
  	// constructor
  	function Analyzator() {
  		$this->reset();
  	} // END constructor
  	
  	function analyzuj_pred2($priznak) {
  	  if ($priznak == 'T') {
     	  $this->object_type = "tablet";
      }
      if ($priznak == 'C') {
     	  $this->object_type = "envelope";
      }
      if ($priznak == 'S1') {
     	  $this->surface_type = "seal1";
      }
      if ($priznak == 'S2') {
     	  $this->surface_type = "seal2";
      }
      if ($priznak == 'S3') {
     	  $this->surface_type = "seal3";
      }
      if ($priznak == 'S4') {
     	  $this->surface_type = "seal4";
      }
      if ($priznak == 'S5') {
     	  $this->surface_type = "seal5";
      }
      if ($priznak == 'S6') {
     	  $this->surface_type = "seal6";
      }
      if ($priznak == 'S7') {
     	  $this->surface_type = "seal7";
      }
      if ($priznak == 'S8') {
     	  $this->surface_type = "seal8";
      }
  	}
  	
  	function analyzuj_pred($bookandchapter) {
      //echo "fce analyzujpred $bookandchapter ".$this->toString()."\n<br />";
   	  	if (ereg("C,$", Trim($bookandchapter)) && !$this->byl_envelop) {
          $this->object_type = "envelope";
          $this->byl_envelop = true;
        }
        else if (ereg("S,$", Trim($bookandchapter)) && !$this->byl_sealing) {
          $this->surface_type = "seal";
          $this->byl_sealing = true;
        }
      	else if (!$this->byl_envelop) {
          $this->object_type = "tablet";
          //$this->object++;
        }  
      //echo "konecfce analyzujpred $bookandchapter ".$this->toString()."\n<br />";
    } // end function analyzuj_pred
    
    /*
    Prepsat
    detekovat vyskyt ridici sekvence a podle ni logicky (trochu ui :)
    usoudit na typ.
    */

    function analyzuj_za($bookandchapter, $transliteration) {
    //TODO: dodelat predikci....
      if (ereg("&[^;]+\$", $transliteration, $regs)) {
        for ($i = 0; $i < Count($regs) ; $i++) {
          if (ereg("rev", $regs[$i])) {
          	 $this->surface_type = "reverse";
          }
          elseif (eregi("l.e.", $regs[$i]) || 
                  eregi("le.e.", $regs[$i]) ||
                  eregi("left e.", $regs[$i])) {
          	$this->surface_type = "left";
          }        
          elseif (eregi("u.e.", $regs[$i])) {
          	$this->surface_type = "top";
          }
          elseif (eregi("upper e.", $regs[$i])) {
          	$this->surface_type = "top";
          }
          elseif (eregi("lo.e.", $regs[$i])) {
          	$this->surface_type = "bottom";
          }
          elseif (eregi("lower e.", $regs[$i])) {
          	$this->surface_type = "bottom";
          }
          elseif (eregi("unt. rd.", $regs[$i])) {
          	$this->surface_type = "bottom";
          }
          elseif (eregi("ob. rd.", $regs[$i])) {
          	$this->surface_type = "top";
          }
          else {
            echo "Upozorneni: Nezatrideny ridici znak - ".$regs[$i]."\n<br />";
          }
          $transliteration = ereg_replace("&[^;]+\$", "", $transliteration);
        } //end for
        
        //print_g($regs); 
      	//echo "\n<br />pripad: $transliteration\n<br />";
      	
      }  // end if
      
      return $transliteration;
    } //end function analyzuj_za
    
    function reset() {
    	$this->object_type = 'tablet';
      $this->surface_type = 'obverse';
      $this->byl_envelop = false;
      $this->byl_sealing = false;
    } // end function reset
  	
  } // END class Analyzator
  
?>
