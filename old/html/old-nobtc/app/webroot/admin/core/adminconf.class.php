<?php

  class TableSetting {
    var $name;
    var $visible = true;

    var $unique = 'ID';
    var $cb = 'created_by';
    var $cd = 'created_date';
    var $mb = 'modified_by';
    var $md = 'modified_date';

    /*var $non_visible_fields = array('ID'            => 'yes',
                                    'created_by'    => 'yes',
                                    'created_date'  => 'yes',
                                    'modified_by'   => 'yes',
                                    'modified_date' => 'yes');

    var $non_editable_fields = array();*/

    var $value = 'ID';

    var $add_action    = true;
    var $edit_action   = true;
    var $delete_action = true;

    var $psw = NULL;
    var $display_only_one_row = NULL;

    function TableSetting( $name ) {
      $this->name = $name;
      $this->unique = 'id_'.$name;
    }

    function isVisible() {
    	return $this->visible;
    }
    function isNonEditableField( $field ) {
      //print_g($this->non_editable_fields);
      return ( ereg("id_", $field) );
    }
    function isNonVisibleField( $field ) {
      return ( ereg("id_", $field) );
    }
    function isUnique( $field ) {
      return ( $field == $this->unique );
    }
    function isCreatedBy( $field ) {
      return ( $field == $this->cb );
    }
    function isCreatedDate( $field ) {
      return ( $field == $this->cd );
    }
    function isModifiedBy( $field ) {
      return ( $field == $this->mb );
    }
    function isModifiedDate( $field ) {
      return ( $field == $this->md );
    }
  }

class AdminConfig {
  var $TextareaRows = 7;
  var $TextareaCols = 40;

  function getTableSetting( $name ) {
    $o = new TableSetting( $name );
    return $o;
  }
}

