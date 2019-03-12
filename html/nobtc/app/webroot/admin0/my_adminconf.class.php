<?php

class MyAdminConfig extends AdminConfig {


  function MyAdminConfig() {
    //
  }

  function getTableSetting( $name ) {
  	$ts = parent :: getTableSetting($name);

  	switch ($name) {
  	  case "book_type":
         $ts->visible = true;
  	    $ts->value = "book_type";
     	break;
      case "origin":
         $ts->visible = true;
  	    $ts->value = "origin";
     	break;
      case "museum":
         $ts->visible = true;
  	    $ts->value = "museum";
     	break;
      case "object_type":
         $ts->visible = true;
  	    $ts->value = "object_type";
     	break;
      case "surface_type":
         $ts->visible = true;
  	    $ts->value = "surface_type";
     	break;
      default:
        $ts->visible = false;
      break;

  	}
  	return $ts;
  }//end function


}//end class
