<?php

require('./admin/core/adminconf.class.php');
require('./admin/my_adminconf.class.php');


class Administration {

  //Konfigurace
  var $k;

  //public
  function Administration(  ) {
    $this->k = new MyAdminConfig();
  }

  function get_value_for_chooser( $nazevTab ) {
	  $ts = $this->k->getTableSetting($nazevTab);
	  return $ts->value;
  } // END function get_value_for_chooser

  function get_value_from_table( $tableName, $value ) {
    if ($tableName == $value) return $tableName;
  	$q = new Db_Sql();
    $dotaz = "SELECT * FROM `$tableName` WHERE `ID` LIKE '$value'; ";
    //echo $dotaz;
    $q->Execute( $dotaz );
    $q->next_record();
    $zaznam = $q->f( $this->get_value_for_chooser($tableName) );
    return ($zaznam == NULL) ? "Nic" : $zaznam ;
  } // END function getValueFromTable

  //private
  function remove_binary_chars( $data ) {
    $data = str_replace("\x00", '\0', $data);
    $data = str_replace("\x08", '\b', $data);
    $data = str_replace("\x0a", '\n', $data);
    $data = str_replace("\x0d", '\r', $data);
    $data = str_replace("\x1a", '\Z', $data);
    return $data;
  }

  //private
  function get_choice_from_table_setter( $nazevTab, $row_table_def, $data, $content ) {
    $hodnota = $this->get_value_for_chooser($nazevTab);
    print_g( $tableSetting);
    $field     = $row_table_def["Field"];
    $dotaz = "SELECT * FROM `$nazevTab`";
    $q = new Db_Sql();
    $q->Execute( $dotaz );

  	$navrat .= "       <td>\n";
    $navrat .= "         <select name=\"fields[".urlencode($field)."]\">\n";
    $navrat .= "           <option value=\"0\"";
    if ($content == 0) $navrat .= " selected=\"selected\"";
    $navrat .= ">Pr�zdn�</option>\n";
    while ($q->next_record()) {
    	$navrat .= "           <option value=\"".$q->Record['ID']."\"";
    	if ($content == $q->Record['ID']) $navrat .= " selected=\"selected\"";
      $navrat .= ">".$q->Record[$hodnota]."</option>\n";
    }
    $navrat .= "         </select>\n";
  	$navrat .= "       </td>\n";

  	return $navrat;
  } // END function

  //private
  function get_text_setter( $row_table_def, $data, $content ) {
    $navrat .= "        <td>             \n
            <textarea name=\"fields[".urlencode($row_table_def["Field"])."]\"
                      rows=\"".$this->k->TextareaRows."\"
                      cols=\"".$this->k->TextareaCols."\">$content</textarea>
        </td>
        \n";

    if (strlen($content) > 32000) {
      $navrat .= '        <td>' . $strTextAreaLength . '</td>' . "\n";
    }
    return $navrat;
  }

  //private
  function get_enum_setter( $row_table_def, $data, $content ) {
    $field     = $row_table_def["Field"];
    $type      = $row_table_def['Type'];
    //print_g($row_table_def);
    $enum        = str_replace('enum(', '', $type);
    $enum        = ereg_replace('\\)$', '', $enum);
    $enum        = explode('\',\'', substr($enum, 1, -1));
    $enum_cnt    = count($enum);
    $navrat .= "
        <td>
            <input type=\"hidden\" name=\"fields[".urlencode($field)."]\" value=\"\$enum$\" />\n\n            ";

     // show dropdown or radio depend on length
     if (strlen($type) > 20) {
     //if (true) {
       $navrat .= "\n           <select name=\"field_".md5($field)."[]\">
                <option value=\"\"></option>\n            ";
       for ($j = 0; $j < $enum_cnt; $j++) {
          // Removes automatic MySQL escape format
          $enum_atom = str_replace('\'\'', '\'', str_replace('\\\\', '\\', $enum[$j]));
          $navrat .= '                <option value="' . urlencode($enum_atom) . '"';
          if ($data == $enum_atom || ($data == '' && (!isset($primary_key) || $row_table_def['Null'] != 'YES')
                        && isset($row_table_def['Default']) && $enum_atom == $row_table_def['Default'])) {
            $navrat .= ' selected="selected"';
          }
          $navrat .= '>' . htmlspecialchars($enum_atom) . '</option>' . "\n";
       } // end for
       $navrat .="\n            </select>\n            ";
     } // end if
     else {
       $navrat .= "\n";
       for ($j = 0; $j < $enum_cnt; $j++) {
         // Removes automatic MySQL escape format
         $enum_atom = str_replace('\'\'', '\'', str_replace('\\\\', '\\', $enum[$j]));
         $navrat .= '            <input type="radio" name="field_' . md5($field) . '[]" value="' . urlencode($enum_atom) . '"';
         if ($data == $enum_atom || ($data == '' && (!isset($primary_key) || $row_table_def['Null'] != 'YES')
                       && isset($row_table_def['Default']) && $enum_atom == $row_table_def['Default'])) {
           $navrat .= ' checked="checked"';
         } // end if
         $navrat .= ' />' . "\n" . '            ' . htmlspecialchars($enum_atom) . "\n";
       } // end for
     } // end else
     $navrat .= "       \n      </td>        \n";
     return $navrat;
  }

  //private
  function get_set_setter( $row_table_def, $data, $content  ) {
    $field = $row_table_def["Field"];
    $set = str_replace('set(', '', $row_table_def['Type']);
    $set = ereg_replace('\)$', '', $set);
    $set = explode(',', $set);
    if (isset($vset)) {  unset($vset);  }
    for ($vals = explode(',', $data); list($t, $k) = each($vals);) {
      $vset[$k] = 1;
    }
    $size = min(4, count($set));
    $navrat .= "
      <td>
          <input type=\"hidden\" name=\"fields[".urlencode($field)."]\" value=\"$set$\" />
          <select name=\"field_".md5($field)."[]\" size=\"$size\" multiple=\"multiple\">
      \n";
    $countset = count($set);
    for ($j = 0; $j < $countset;$j++) {
      $subset = substr($set[$j], 1, -1);
      // Removes automatic MySQL escape format
      $subset = str_replace('\'\'', '\'', str_replace('\\\\', '\\', $subset));
      $navrat .= '                <option value="'. urlencode($subset) . '"';
      if (isset($vset[$subset]) && $vset[$subset]) {
        $navrat .= ' selected="selected"';
      }
      $navrat .= '>' . htmlspecialchars($subset) . '</option>' . "\n";
    } // end for
    $navrat .="\n            </select\n        </td>\n        ";
    return $navrat;
  }

  //private
  function get_bin_blob_setter( $row_table_def, $data, $content ) {
    $field     = $row_table_def['Field'];
    $is_binary = $row_table_def['Is_Binary'];
    $is_blob   = $row_table_def['Is_Blob'];
    if ( $is_binary ) {
      $navrat .= "\n
        <td align=\"center\">
            binary - please do not edit here.\n
        </td>\n              ";
    }
    else if ( $is_blob ) {
      $navrat .= "\n
        <td> \n
            <textarea name=\"fields[".urlencode($field)."]\"
                      rows=\"".$this->k->TextareaRows."\"
                      cols=\"".$this->k->TextareaCols."\">$content</textarea>
        </td>";

    }
    else {
      if ($len < 4) {
        $fieldsize = $maxlength = 4;
      }
      else {
        $fieldsize = (($len > 40) ? 40 : $len);
        $maxlength = $len;
      }
      $navrat .= "\n
        <td>
            <input type=\"text\"
                   name=\"fields[".urlencode($field)."]\"
                   value=\"$content\"
                   size=\"$fieldsize\"
                   maxlength=\"$maxlength\" />
        </td>";
    } // end if...elseif...else
    return $navrat;
  }

  //private
  function get_value_column( $form_name, $tableSetting, $row_table_def, $data, $content ) {

    $field     = $row_table_def['Field'];
    $type      = $row_table_def['Type'];
    $true_type = $row_table_def['True_Type'];
    $null      = $row_table_def['Null'];
    $default   = $row_table_def['Default'];
    $is_binary = $row_table_def['Is_Binary'];
    $is_blob   = $row_table_def['Is_Blob'];
    $len       = $row_table_def['Len'];


  	if (eregi("^([^\"]*)ID$", $field, $token)) {//specialni tvar pro referenci 1:n
      $nazevTab = $token[1];
      $navrat .= $this->get_choice_from_table_setter( $nazevTab, $row_table_def, $data, $content );
    }
    else if (strstr($true_type, 'text')) {//text
      $navrat .= $this->get_text_setter( $row_table_def, $data, $content );
    }
    else if (strstr($true_type, 'enum')) {//enum
      $navrat .= $this->get_enum_setter( $row_table_def, $data, $content );
    }
    else if (strstr($type, 'set')) {//set
      $navrat .= $this->get_set_setter( $row_table_def, $data, $content );
    }
    // We don't want binary data destroyed
    else if ($is_binary || $is_blob) {//binary or blob
      $navrat .= $this->get_bin_blob_setter( $row_table_def, $data, $content );
    } // end else if
    else {
        if ($len < 4) {
            $fieldsize = $maxlength = 4;
        } else {
            $fieldsize = (($len > 40) ? 40 : $len);
            $maxlength = $len;
        }
        $navrat .= "\n        <td>
            <input type=\"text\"
                   name=\"fields[".urlencode($field)."]\"
                   value=\"$content\"
                   size=\"$fieldsize\"
                   maxlength=\"$maxlength\"
                   id=\"fields_".urlencode($field)."\" />";

        if ($tableSetting->psw == $field) {
        	$navrat .= "&nbsp;<strong><a href=\"javascript:OpenPsw('".
                      $form_name."', 'fields_".urlencode($field)."')\">zm�na hesla</a></strong>";
        }
        $navrat .= "</td>";
    }

    return $navrat;
  }

  //private
  function get_null_column( $i, $row_table_def, $data, $form_name ) {
    $field           = $row_table_def['Field'];
    $navrat .= '        <td>' . "\n";
    if ($row_table_def['Null'] == 'YES') {
        $navrat .= '            <input type="checkbox"'
             . ' name="fields_null[' . urlencode($field) . ']"';
        if ($data == 'NULL') {
            $navrat .= ' checked="checked"';
        }
        if (strstr($row_table_def['True_Type'], 'enum')) {
            if (strlen($row_table_def['Type']) > 20) {
                $navrat .= ' onclick="if (this.checked) {document.forms[\''.$form_name.'\'].elements[\'field_' . md5($field) . '[]\'].selectedIndex = -1}; return true" />' . "\n";
            } else {
                $navrat .= ' onclick="if (this.checked) {var elts = document.forms[\''.$form_name.'\'].elements[\'field_' . md5($field) . '[]\']; var elts_cnt = elts.length; for (var i = 0; i < elts_cnt; i++ ) {elts[i].checked = false}}; return true" />' . "\n";
            }
        } else if (strstr($row_table_def['True_Type'], 'set')) {
            $navrat .= ' onclick="if (this.checked) {document.forms[\''.$form_name.'\'].elements[\'field_' . md5($field) . '[]\'].selectedIndex = -1}; return true" />' . "\n";
	      } else {
            $navrat .= ' onclick="if (this.checked) {document.forms[\''.$form_name.'\'].elements[\'fields[' . urlencode($field) . ']\'].value = \'\'}; return true" />' . "\n";
        }
    } else {
        $navrat .= '            &nbsp;' . "\n";
    }
    $navrat .= '        </td>' . "\n";
    return $navrat;
  }

  //public
  function table_of_new_edit( $table , $form_name, $row = NULL ) {
    $q_meta = new Db_Sql();
    $q_meta->Query("SELECT pg_attribute.* FROM pg_class,pg_attribute WHERE pg_class.relname='".AddSlashes($table)."' AND pg_attribute.attrelid=pg_class.oid AND attnum > 0 ORDER BY attnum");

    $q_data = new Db_Sql();
    $q_data->Query('SELECT * FROM '.$table.' LIMIT 1');
    //pocet policek radku (sloupcu)
    $fields_cnt     = $q_meta->num_rows();

    //z nastaveni admina precteme nastaveni tabulky
    $tableSetting = $this->k->getTableSetting( $table );

    for ($i = 0; $i < $fields_cnt; $i++) {
      //zobrazeni
      $cssClassOne = "akt";
      $cssClassTwo = "akt2";
      $cssClass = ($i % 2) ? $cssClassOne : $cssClassTwo;
      //ziskame meta-info o sloupecku
      $q_meta->next_record();
      //hack pro postgresql
      //$q_meta->next_record();
      $meta_pgsql   = $q_meta->Record;
      $row_table_def['Type'] = "Text";
      $row_table_def['Field'] = $meta_pgsql['attname'];
      $row_table_def['Len']  = $meta_pgsql['attlen'];


      //doplnime nezrejme informace
      $row_table_def['Is_Binary'] = eregi(' binary', $row_table_def['Type']);
      $row_table_def['Is_Blob']   = eregi('blob', $row_table_def['Type']);
      $row_table_def['True_Type'] = ereg_replace('\\(.*', '', $row_table_def['Type']);

      if( $row_table_def['Len'] < 0 )
        $row_table_def['Len'] = 100;
      $field           = $row_table_def['Field'];

      //z nastaveni tabulky zjistime, zda se zaznam bude tisknout
      if ($tableSetting->isUnique( $field )) {  }
      else if ($tableSetting->isCreatedBy( $field )) {  }
      else if ($tableSetting->isCreatedDate( $field )) {  }
      else if ($tableSetting->isModifiedBy( $field )) {  }
      else if ($tableSetting->isModifiedDate( $field )) {  }
      else if ($tableSetting->isNonVisibleField( $field )) {  }
      else {

        if ($row_table_def['Type'] == 'datetime' && empty($row[$field])) {
          $row[$field] = date('Y-m-d H:i:s', time());
        }

        $navrat .= "
        <tr class=\"$cssClass\">
            <td align=\"center\">".htmlspecialchars($field)."</td>
         \n";

        // Prepares the field value
        if (isset($row)) { // pro edit
          if (!isset($row[$field])) {
            $row[$field]   = 'NULL';
            $content = '';
            $data          = $row[$field];
          }
          else {
            //  special binary "characters"
            if ($row_table_def['Is_Binary'] || $row_table_def['Is_Blob']) {
              $row[$field] = remove_binary_chars($row[$field]);
            } // end if
            $content         = htmlspecialchars($row[$field]);
            $data            = $row[$field];
          } // end if... else...
        }
        else {     //pro vlozeni noveho
          //  display default values
          if (!isset($row_table_def['Default'])) {
            $row_table_def['Default'] = '';
            $data                     = 'NULL';
          } else {
            $data                     = $row_table_def['Default'];
          }
          $content       = htmlspecialchars( $row_table_def['Default'] );
        }

        // The value column (depends on type)
        // ----------------------------------
        if ($tableSetting->isNonEditableField( $field )) {
          $navrat .= '<td>'.$data.'</td>';
        }
        else {
        	$navrat .= $this->get_value_column( $form_name, $tableSetting, $row_table_def, $data, $content );
        }

        // The null column
        // ---------------
        $navrat .= $this->get_null_column( $i, $row_table_def, $data, $form_name );

        $navrat .= "\n\n    </tr>\n    \n";
      }
    } // end for
    return $navrat;
  }

  //public
  function get_table_chooser( $table ) {
    $data = '<script type="text/javascript" language="javascript">
        <!--
        function ChangeTable() {
          document.location.href = "admin.php?table=" + document.select_table_form.table.value +
                                     "&unique=id_" + document.select_table_form.table.value +
                                     "&nav_id=" + document.select_table_form.nav_id.value;
          return true;
        }
        -->
    </script>
    <form method="post" name="select_table_form" action="admin.php">
    ';
    $q = new Db_Sql();
    $tables = $q->table_names();

    $pocet = Count( $tables );
    $vyber = "\n<select name=\"table\" onChange=\"return ChangeTable();\" size=\"1\">\n";
    $vyber .= "    <option value=\"\"";
    if (Empty($table)) $vyber .= " selected=\"selected\"";
    $vyber .= ">--- Vyber data ---</option>\n";
    foreach($tables as $tabulka) {
      $nazev = $tabulka["table_name"];
      $ts = $this->k->getTableSetting( $nazev );
      if (!$ts->isVisible())  continue;
      $vyber .= "    <option value=\"$nazev\"";
      if ($nazev == $table) $vyber .= " selected=\"selected\"";
      $vyber .= ">$nazev</option>\n";
    }
    $vyber .= "</select>\n";

    $data .= $vyber;
    $data .= '
              <!--input type="hidden" name="unique" value="id_" /-->
              <input type="hidden" name="nav_id" value="list" />
              <input type="submit" value="Show" />
              </form>';
    return $data;
  }

  //private
  function add_column_if_visible( $tableSetting, $field, $dato = NULL ) {
    //z nastaveni tabulky zjistime, zda se zaznam bude tisknout
    if ($tableSetting->isUnique( $field )) {  }
    else if ($tableSetting->isCreatedBy( $field )) {  }
    else if ($tableSetting->isCreatedDate( $field )) {  }
    else if ($tableSetting->isModifiedBy( $field )) {  }
    else if ($tableSetting->isModifiedDate( $field )) {  }
    else if ($tableSetting->isNonVisibleField( $field )) {  }
    else {
      if (eregi("^([^\"]*)ID$", $field, $token)) {
        $nazevTab = $token[1];
        if ($field == $dato)    $dato = $nazevTab;
        else if ($dato != NULL) $dato = $this->get_value_from_table($nazevTab, $dato);
      }
      else {
      	//echo "nevyhovuje\n<br />";
      }
      $navrat .= "<td>";
      if ($dato != NULL) $navrat .= n_radku( $dato, 2, 23 );
      $navrat .= "&nbsp;</td>\n";
    }
    return $navrat;
  }

  //private
  function get_header_of_table( $tableSetting , $meta ) {
    $navrat = "<tr class=\"nadpissekce\">\n    <td>&nbsp;</td>\n    <td>&nbsp;</td>\n";
    foreach($meta as $m) {
      $field           = $m['name'];
      $navrat .= $this->add_column_if_visible($tableSetting, $field, $field);
    }
    $navrat .= "</tr>\n";
    return $navrat;
  }

  //private
  function get_row_of_table( $tableSetting, $meta, $pocet_sloupcu, $Record ) {

    $unique = $tableSetting->unique;

    $navrat .= "<tr class=\"akt\">\n     ";
    $navrat .= '<td>';
    if ($tableSetting->delete_action)
      $navrat .= '<input type="checkbox" name="smaz['.$Record[$unique].']" value="true" />';
    $navrat .= '</td>';
    $navrat .= '<td>';
    if ($tableSetting->edit_action)
      $navrat .= '<a href="admin.php?table='.$tableSetting->name.'&amp;nav_id=edit&amp;unique='.$unique.'&amp;unique_id='.$Record[$unique].'">edit</a>';
    $navrat .= '&nbsp;</td>';
    foreach($meta as $m) {
      $field           = $m['name'];
      $navrat .= $this->add_column_if_visible($tableSetting, $field, $Record[$field]);
    }//end foreach
    $navrat .= "</tr> \n  ";
    return $navrat;
  }

  //private
  function get_foot_of_table( $tableSetting, $meta ) {
    $navrat .= '<tr class="nadpissekce">
              <td><input type="submit" name="delete" value="Delete" /></td>
              <td></td>';
    foreach($meta as $m) {
      $field           = $m['name'];
      $navrat .= $this->add_column_if_visible($tableSetting, $field);
    }
    $navrat .= "</tr>\n";
    return $navrat;
  }

  //public
  function get_pocet_polozek( $table ) {
    $dotaz = "SELECT 1 FROM $table ";
    $q = new Db_Sql($dotaz);
    return $q->num_rows();
  }
  //private
  function get_razeni( $table, $l_order, $l_od, $l_limit, $zobrazeno ) {
    global $order;
    global $od;
    global $limit;
    global $unique;

    $order = $l_order;
    $od    = $l_od;
    $limit = $l_limit;
    $pocet = $this->get_pocet_polozek( $table );
    $nav = "admin.php?nav_id=list&amp;table=$table&amp;actione=sort&amp;unique=$unique";

    //$navrat = "<p class=\"akt\"></p>";
    $navrat .= "
  <form action=\"\" method=\"post\" name=\"razeni\">
    <table class=\"oram\">
       <tr class=\"nadpissekce\">
         <td>
            $zobrazeno Items viewed from $od.  (Total $pocet)<br />
           Sort by
           <select name=\"order\">	";
    $q = new Db_Sql();
    $meta = $q->metadata( $table );
    foreach($meta as $m) {
      $navrat .= "             <option value=\"".$m["name"]."\" ";
      if ($order == $m["name"]) $navrat .= "selected=\"selected\"";
      $navrat .= ">".$m["name"]."</option>\n";
    }
    $navrat .= "
           </select>
           from:
             <input type=\"text\" name=\"od\" value=\"$od\" size=\"5\" />
           count:
             <input type=\"text\" name=\"limit\" value=\"$limit\" size=\"5\" />
             <input type=\"hidden\" name=\"actione\" value=\"sort\" />
             <input type=\"hidden\" name=\"table\" value=\"$table\" />
             <input type=\"hidden\" name=\"nav_id\" value=\"list\" />
             <input type=\"submit\" name=\"serad\" value=\"Show\" />
         </td>
      </tr>
      <tr class=\"nadpissekce\">
        <td align=\"center\">
          <a href=\"$nav&amp;order=$order&amp;od=0&amp;limit=$limit\">
            Start </a> |       \n";
    if ($od-$limit >= 0)
      $navrat .="<a href=\"$nav&amp;order=$order&amp;od=".
              ($od-$limit)."&amp;limit=$limit\">
              Prev. $limit </a> |       \n";
    if ($od+$limit < $pocet)
      $navrat .="<a href=\"$nav&amp;order=$order&amp;od=".
              ($od+$limit)."&amp;limit=$limit\">
              Next $limit </a> |   \n";
    $navrat .="<a href=\"$nav&amp;order=$order&amp;od=".
             ($pocet-$limit)."&amp;limit=$limit\">
             End </a>\n";
    $navrat .= "
        </td>
      </tr>
    </table>
  </form>";
    return $navrat;
  }

  //public
  function get_table( $table, $unique, $order, $od = 0, $limit = 15 ) {
    if (Empty($table)) return;

    $tableSetting = $this->k->getTableSetting( $table );

    if (!Empty( $tableSetting->display_only_one_row ))
      $dotaz = "SELECT * FROM $table WHERE $unique = ".$tableSetting->display_only_one_row;
    else
      $dotaz = "SELECT * FROM $table ORDER BY \"$order\" LIMIT $limit OFFSET $od";

    //echo $dotaz;
    $q = new Db_Sql($dotaz);


    $pocet_sloupcu = $q->num_fields();
    $pocet_radku   = $q->num_rows();

    $q_meta = new Db_Sql();
    $meta = $q_meta->metadata( $table );

    $navrat = "<h1>Table $table</h1>";
    $navrat .= $this->get_razeni( $table, $order, $od, $limit, $pocet_radku );
    $navrat .= "\n<br /><form action=\"admin.php\" method=\"post\"><table class=\"oram\">\n";
    $navrat .= $this->get_header_of_table( $tableSetting, $meta );

    while ($q->next_record()) {
      $navrat .= $this->get_row_of_table( $tableSetting, $meta, $pocet_sloupcu, $q->Record );
    }
    $navrat .= $this->get_foot_of_table( $tableSetting, $meta );
    $navrat .= "</table>";
    $navrat .= "<input type=\"hidden\" name=\"nav_id\"  value=\"list\" />";
    $navrat .= "<input type=\"hidden\" name=\"unique\"  value=\"$unique\" />";
    $navrat .= "<input type=\"hidden\" name=\"actione\" value=\"delete\" />";
    $navrat .= "<input type=\"hidden\" name=\"table\"   value=\"$table\" />";
    $navrat .= "</form>";
    return $navrat;
  }

  //public
  function insert( $table, $fields ) {
    //seznam policek v sql formatu
    $fieldlist = '';
    //seznam hodnot v sql formatu
    $valuelist = '';
    while (list($key, $val) = each($fields)) {
      $encoded_key = $key;
      $key         = urldecode($key);
      $fieldlist   .= AddSlashes($key) . ', ';
      switch (strtolower($val)) {
        case 'null':
        break;
        case '$enum$':
          // if we have a set, then construct the value
          $f = 'field_' . md5($key);
          global $$f;
          if (!empty($$f)) {
            $val     = implode(',', $$f);
            if ($val == 'null') { /* void */ }
            else {
              $val = "'" . Addslashes(urldecode($val)) . "'";
            }
          }
          else {
            $val     = "''";
          }
        break;
        case '$set$':
          // if we have a set, then construct the value
          $f = 'field_' . md5($key);
          global $$f;
          if (!empty($$f)) {
            $val = implode(',', $$f);
            $val = "'" . Addslashes(urldecode($val)) . "'";
          }
          else {
            $val = "''";
          }
        break;
          default:
            if (get_magic_quotes_gpc()) {
              $val = "'" . str_replace('\\"', '"', $val) . "'";
            }
            else {
              $val = "'" . Addslashes($val) . "'";
            }
        break;
      } // end switch

      // Was the Null checkbox checked for this field?
      if (isset($fields_null) && isset($fields_null[$encoded_key])) {
        $val = 'NULL';
      }
      //pridame do seznamu hodnot
      $valuelist .= $val . ', ';
    } // end while

    // odstranit carky z konce
    $fieldlist = ereg_replace(', $', '', $fieldlist);
    $valuelist = ereg_replace(', $', '', $valuelist);

    $tableSet = $this->k->getTableSetting("$table");
    //$fieldlist .= ", ".$tableSet->cb.", ".$tableSet->cd;
    //$valuelist .= ", '".$_SESSION['auth']->userID."', '".date('Y-m-d H:i:s', time())."'";

    $query     = 'INSERT INTO ' . AddSlashes($table) . ' (' . $fieldlist . ') VALUES (' . $valuelist . ')';
    //echo $query;
    $message   = $strInsertedRows . '&nbsp;';

    $q = new Db_Sql($query);
    if ($q->Errno != 0) {
      $return = "Error.";
      return false;
    }
    $return = "Item was inserted...";
    //print_g("insertID:".$q->insert_id());
    return $return;
  }

  //private
  function possible_to_delete( $id ) {

    return true;
  }

  //public
  function delete( $table, $unique, $ID ) {
    if (!$this->possible_to_delete($table, $ID)) {
      print_hlasku("Kontrola integrity hl�s�: Nelze smazat");
      return false;
    }
    $dotaz = "DELETE FROM $table WHERE $unique = $ID";

    $q = new Db_Sql($dotaz);
    if ($q->Errno != 0 || $q->affected_rows() == 0 ) {
      return false;
    }
    return true;
  }
  //public
  function delete_more_rows($smaz, $table, $unique) {
    $coun_true = 0;
    $coun_false = 0;
    //print_r($smaz);
    if (Is_Array($smaz)) {
      for (Reset($smaz); Current($smaz); Next($smaz)) {
        //print_r($_POST);
        if ($this->delete($table, $unique, Key($smaz))) $coun_true++;
        else $coun_false++;
      }
    }
    if ($coun_false == 0)
      return ("$coun_true item deleted.");
    else
      return ("Unfortunately, $coun_false items was not deleted ($coun_true was)");
  }

  //public
  function update ( $table, $unique, $unique_id, $fields ) {
    // Restore the "primary key" to a convenient format
    $unique = urldecode($unique);
    $unique_id = urldecode($unique_id);

    // Defines the SET part of the sql query
    $valuelist = '';
    //print_g($fields);
    while (list($key, $val) = each($fields)) {
      $encoded_key = $key;
      $key         = urldecode($key);
      //print_g($val);
      switch (strtolower($val)) {
        case 'null':
        break;
        case '$enum$':
          // if we have an enum, then construct the value
          $f = 'field_' . md5($key);
          //print_g( $f );
          global $$f;
          //print_g( $$f );

          if (!empty($$f)) {
            $val     = implode(',', $$f);
            if ($val == 'null') { /* void */ }
            else {
            //print_g( $val );
              $val = "'" . Addslashes(urldecode($val)) . "'";
            }
          }
          else {
            $val     = "''";
          }
        break;
        case '$set$':
          // if we have a set, then construct the value
          $f = 'field_' . md5($key);
          global $$f;
          if (!empty($$f)) {
            $val = implode(',', $$f);
            $val = "'" . Addslashes(urldecode($val)) . "'";
          }
          else {
            $val = "''";
          }
        break;
        default:
          if (get_magic_quotes_gpc()) {
            $val = "'" . str_replace('\\"', '"', $val) . "'";
          }
          else {
            $val = "'" . Addslashes($val) . "'";
          }
        break;
      } // end switch
        // Was the Null checkbox checked for this field?
      if (isset($fields_null) && isset($fields_null[$encoded_key])) {
        $val = 'NULL';
      }
      if (!empty($val)) {
        if (empty($funcs[$encoded_key])) {
          $valuelist .= AddSlashes($key) . ' = ' . $val . ', ';
        } else if ($val == '\'\''
                    && (ereg('^(NOW|CURDATE|CURTIME|UNIX_TIMESTAMP|RAND|USER|LAST_INSERT_ID)$', $funcs[$encoded_key]))) {
          $valuelist .= AddSlashes($key) . ' = ' . $funcs[$encoded_key] . '(), ';
        } else {
          $valuelist .= AddSlashes($key) . ' = ' . $funcs[$encoded_key] . "($val), ";
        }
      }
    } // end while
    // Builds the sql upate query
    $valuelist    = ereg_replace(', $', '', $valuelist);
    if (!empty($valuelist)) {
      //$tableSet = $this->k->getTableSetting("$table");
      //$valuelist .= ", ".$tableSet->mb." = '".$_SESSION["auth"]->userID."'".
      //              ", ".$tableSet->md." = '".date('Y-m-d H:i:s', time())."'";
      $query    = 'UPDATE ' . AddSlashes($table) . ' SET ' . $valuelist . ' WHERE ' . $unique . " = " . $unique_id
                 . ((PMA_MYSQL_INT_VERSION >= 32300) ? ' LIMIT 1' : '');
      //print_g( $query );
      $message  = $strAffectedRows . '&nbsp;';

      $q = new Db_Sql($query);
    }
    else {
      //print_hlasku("No changes.");
      return false;
    }
    $back_url = "<a href=\"admin.php?table=".urlencode($table)."&amp;nav_id=list&amp;unique=".urlencode($unique)."\">Zp�t</a>";
    if ($q->Errno != 0) {
      //print_hlasku("Polo�ku se nepoda�ilo upravit.");
      //echo($back_url);
      return "Error";
    }
    //print_hlasku("Polo�ka zm�n�na.");
    //echo($back_url);
    return "Row was saved.";
  }

  //public
  function get_row( $table, $unique, $unique_id ) {
    $dotaz = 'SELECT * FROM '.AddSlashes($table).' WHERE '.$unique.' = '.$unique_id;
    $q = new Db_Sql($dotaz);
    $q->next_record();
    return $q->Record;
  }

  function get_form_field( $meta ) {
    print_r($meta);
  }

}//class Admin

