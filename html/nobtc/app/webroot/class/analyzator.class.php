<?php
  class Analyzator {
  	// variables
    var $object_type;// tablet, envelope
    var $surface_type;// obverse, reverse, lower edge, left edge, sealing, upper edge...
    var $byl_envelop;
    var $byl_sealing;

  	// constructor
  	function Analyzator() {
  		$this->reset();
  	} // END constructor

  	function analyzuj_pred2($priznak) {
    //echo "priznak: $priznak <br>";
    $priznak = trim($priznak);
  	/*
  	  if ($priznak == 'T') {
     	  $this->object_type = "tablet";
      }*/
      if ($priznak == 'C') {
     	  $this->object_type = "envelope";
     	  $this->surface_type = 'obverse';
      }
     /* if ($priznak == 'S1') {
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
      */
  	}

	/**
	 * Historicka metoda pro import z old school korpusu.
	 */
  	function analyzuj_pred($bookandchapter) {
      //echo "fce analyzujpred $bookandchapter ".$this->toString()."\n<br />";
   	  	if (ereg("C,$", Trim($bookandchapter)) && !$this->byl_envelop) {
          $this->object_type = "envelope";
          $this->byl_envelop = true;
        }
        else if (ereg("S,$", Trim($bookandchapter)) && !$this->byl_sealing) {
          $this->surface_type = "seal1";
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
                  eregi("left edge e.", $regs[$i])) {
          	$this->surface_type = "left edge";
          }
          elseif (eregi("r.e.", $regs[$i]) ||
                  eregi("ri.e.", $regs[$i])) {
          	$this->surface_type = "right edge";
          }
          elseif (eregi("u.e.", $regs[$i]) ||
          		  eregi("upper e.", $regs[$i]) ||
          		  eregi("ob. rd.", $regs[$i])) {
          	$this->surface_type = "upper edge";
          }
          elseif (eregi("lo.e.", $regs[$i]) ||
          		  eregi("lower e.", $regs[$i]) ||
          		  eregi("unt. rd.", $regs[$i])) {
          	$this->surface_type = "lower edge";
          }
          elseif (eregi("s1", $regs[$i])) {
          	$this->surface_type = "seal impression 1";
          }
          elseif (eregi("s2", $regs[$i])) {
          	$this->surface_type = "seal impression 2";
          }
          elseif (eregi("s3", $regs[$i])) {
          	$this->surface_type = "seal impression 3";
          }
          elseif (eregi("s4", $regs[$i])) {
          	$this->surface_type = "seal impression 4";
          }
          elseif (eregi("s5", $regs[$i])) {
          	$this->surface_type = "seal impression 5";
          }
          elseif (eregi("s6", $regs[$i])) {
          	$this->surface_type = "seal impression 6";
          }
          elseif (eregi("s7", $regs[$i])) {
          	$this->surface_type = "seal impression 7";
          }
          elseif (eregi("s8", $regs[$i])) {
          	$this->surface_type = "seal impression 8";
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

