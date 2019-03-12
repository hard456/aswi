<?php

mb_internal_encoding('UTF-8');

define(SELECT_TEXT, '- NOT SELECTED -');


$first_button_label = 'Next step ->';
$sec_button_label = 'Save to database ->';
$sec_button_label_back = '<- Correct something';


/////////////////////////////////////
////  PREZENTACNI FCE


  function get_contain_chooser($name)
  { // BEGIN function get_contain_chooser
  	return '   <select name="'.$name.'-op">
								<option value="equals">
									equals
								</option>
                <option value="not equals">
									not equals
								</option>
                <option  value="contains" selected="selected">
									contains
								</option>
                <option value="begins with">
									begins with
								</option>
                <option value="ends with">
									ends with
                </option>
          </select> ';
  } // END function get_contain_chooser

  function get_is_or_isnot($name) {
    return '<select name="'.$name.'-op">
 					<option value="is">
 						is
 					</option>
 					<option value="is not">
 						is not
 					</option>
 				</select>';
  }

function chooser_get_book_type($selected_value = NULL)
{
  $book_type_array = utils_get_book_types();
  ?> <select name="id_book_type" id="id_book_type">

            <?php foreach($book_type_array as $type): ?>
              <option value="<?php echo $type['id_book_type']?>"
                      label="<?php echo $type['book_type']?>" <?php echo ($selected_value == $type['id_book_type']) ? 'selected="selected"' : ''; ?> >
                  <?php echo $type['book_type']?>
              </option>
            <?php endforeach; ?>

            </select>

  <?php
}

function chooser_get_origin ($selected_value = NULL)
{
  $origin_array = utils_get_origins();
  ?> <select name="id_origin" id="id_origin">

            <?php foreach($origin_array as $origin): ?>
              <option value="<?php echo $origin['id_origin']?>"
                      label="<?php echo $origin['origin']?>" <?php echo ($selected_value == $origin['id_origin']) ? 'selected="selected"' : ''; ?> >
                  <?php echo $origin['old_name']?> / <?php echo $origin['origin']?>
              </option>
            <?php endforeach; ?>

          </select>

  <?php
}

function chooser_get_museum ($selected_value = NULL)
{
  $museum_array = utils_get_museums();
?>      <select name="id_museum" id="id_museum">

            <?php foreach($museum_array as $museum): ?>
              <option value="<?php echo $museum['id_museum']?>"
                      label="<?php echo $museum['museum']?>" <?php echo ($selected_value == $museum['id_museum']) ? 'selected="selected"' : ''; ?> >
                  <?php echo $museum['museum']." - ".$museum['place']?>
              </option>
            <?php endforeach; ?>

          </select>
<?php
}

function chooser_get_book($selected_value = NULL)
{
$book_array = utils_get_books();
?>  <select name="id_book" id="id_book">

            <?php foreach($book_array as $book): ?>
              <option value="<?php echo $book['id_book']?>"
                      label="<?php echo $book['book_abrev']?>" <?php echo ($selected_value == $book['id_book']) ? 'selected="selected"' : ''; ?> >
                  <?php echo $book['book_abrev']?>
              </option>
            <?php endforeach; ?>

            </select><?php
}

function chooser_get_name($isDivine, $selected_value = NULL)
{
  $name_array = utils_get_names($isDivine);
?>  <select name="id_name" id="id_name">

            <?php foreach($name_array as $name): ?>
              <option value="<?php echo $name['id_name']?>"
                      label="<?php echo $name['name']?>"
                      <?php echo ($selected_value == $name['id_name']) ? 'selected="selected"' : ''; ?> >
                  <?php echo $name['name']?>
              </option>
            <?php endforeach; ?>

            </select><?php
}

function n_radku($str, $radku, $delka = 75)
{
  $sep = "<br />\n";
  $pole = explode( $sep, wordwrap( $str, $delka, $sep, 1 ) );
  $delka_pole = count($pole);
  $mez = min($delka_pole, $radku);
  //foreach($pole as $kousek) echo $kousek.$sep;
  for( $i = 0; $i < $mez ; $i++ ) {
    $navrat .= $pole[$i];
    //posledni radek bude bez separatoru ale s teckami
    if (($i+1) < $mez)              $navrat .= $sep;
    else if ($delka_pole > $radku) $navrat .= "...";
  }
  return $navrat;
}

//// KONEC PREZENTACICH FCI
//////////////////////////////////

function utils_get_names($isDivine)
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM name WHERE divine_name = ";
  $dotaz.= ($isDivine)? "true": "false";
  $spojeni->query($dotaz);
  ///pr($dotaz);
  $pole[] = Array('id_name' => '0', 'name' => " -- ADD NEW -- ");
  while($spojeni->next_record()) {
    if ($spojeni->Record['id_name'] == 0) continue;
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function utils_get_object_types()
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM object_type";
  $spojeni->query($dotaz);
  //$pole[] = Array('id_object_type' => '0', 'object_type' => SELECT_TEXT);
  while($spojeni->next_record()) {
    if ($spojeni->Record['id_object_type'] == 0) continue;
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function utils_get_surface_types()
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM surface_type order by sorter";
  $spojeni->query($dotaz);
  //$pole[] = Array('id_surface_type' => '0', 'surface_type' => SELECT_TEXT);
  while($spojeni->next_record()) {
    if ($spojeni->Record['id_surface_type'] == 0) continue;
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function utils_get_book_types()
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM book_type";
  $spojeni->query($dotaz);
  $pole[] = Array('id_book_type' => '0', 'book_type' => SELECT_TEXT);
  while($spojeni->next_record()) {
    if ($spojeni->Record['id_book_type'] == 0) continue;
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function utils_get_books()
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM book ORDER BY book_abrev;";
  $spojeni->query($dotaz);
  $pole[] = Array('id_book' => '0', 'book_abrev' => SELECT_TEXT);
  while($spojeni->next_record()) {
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function utils_get_museums()
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM museum";
  $spojeni->query($dotaz);
  $pole[] = Array('id_museum' => '0', 'museum' => SELECT_TEXT, 'place'=> '');
  while($spojeni->next_record()) {
    if ($spojeni->Record['id_museum'] == 0) continue;
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function utils_get_origins()
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM origin";
  $spojeni->query($dotaz);
  $pole[] = Array('id_origin' => '0', 'origin' => SELECT_TEXT, 'old_name'=> '');
  while($spojeni->next_record()) {
    if ($spojeni->Record['id_origin'] == 0) continue;
    $pole[] = $spojeni->Record;
  }
  return $pole;
}

function get_book($id_book)
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM book WHERE id_book = $id_book";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record;
}

function get_bookandchapter_from_id_transliteration($id_transliteration)
{
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM book b, transliteration t WHERE b.id_book = t.id_book AND t.id_transliteration = '$id_transliteration'";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  return $spojeni->Record['book_abrev'].", ".$spojeni->Record['chapter'];
}

function p_g($var)
{
  echo '<pre>';
  print_r($var);
  echo '</pre>';
}

function get_array_as_get_string($array, $prefix = NULL)
{ // BEGIN function get_array_as_get_string
  $templ = "%s=%s&amp;";
  return serialize_request($templ, $array, $prefix, true);
} // END function get_array_as_get_string

function get_array_as_get_string_direct($array, $prefix = NULL)
{ // BEGIN function get_array_as_get_string
  $templ = "%s=%s&";
  return serialize_request($templ, $array, $prefix, true);
} // END function get_array_as_get_string

function get_array_of_hiddens_html($array, $prefix = NULL)
{ // BEGIN function print_array_of_hiddens

  $templ = "      <input type=\"hidden\" name=\"%s\" value=\"%s\" />\n";
  return serialize_request($templ, $array, $prefix);

} // END function print_array_of_hiddens

function serialize_request($templ, $array, $prefix = NULL, $ignore_empty = false)
{
  $val = '';
  foreach ($array as $key=>$value) {
	  $name = ($prefix == NULL)? $key : $prefix.'['.$key.']' ;
 	  if (is_array($value)) {
    	$val .= serialize_request($templ, $value, $name);
    }
    else {
      if ($ignore_empty && Empty($value))
        continue;
      else
        $val .= sprintf($templ, $name, $value);
    }
  }
  return $val;
}

if (!function_exists('pr')) {
    function pr($neco) {
		echo ("<pre>");
		print_r($neco);
		echo ("</pre>");
	}
}

function print_hlasku ($text) {
  echo "<h3>$text</h3>";
}

function add_bracket($str) {
  $ret = '';
  $mez = mb_strlen($str)-1;
  for($i = 0; $i < $mez; $i++) {
    $znak = mb_substr($str, $i, 1);
    $escZnak = ($znak === '-')? "\\$znak" : $znak ;
    $ret .= $znak . "[][⌈⌉?!><\.₁₂₃₄₅₆₇₈₉₀$escZnak\-]*";
  }
  return $ret . mb_substr($str, $mez, 1);
}

function highlight_found($text, $found) {

  $pomoc = $text;
  foreach($found as $key=>$value) {
    if (!empty($value)) {

      //$pomoc .= $pomoc;
      $pomoc = ereg_replace(add_bracket($value), "<span class=\"found\">\\0</span>", $pomoc);
      //$pomoc .= add_bracket($value);
    }
  }
  return $pomoc;
}
function replace_found($line, $found, $replacement) {
  return ereg_replace(add_bracket($found), $replacement, $line);
}
