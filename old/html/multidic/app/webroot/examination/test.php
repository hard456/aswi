<?php
require_once("./functions/dictionary.php");

class TestParser {

    private $text;

    function __construct($text) {
        $this->text = $text;
        
    }
    
    function getParsedText() {
        $parsed = '';
        //pr($this->text);
        //$found = ereg ( "^(([^\{]*)\{([^\}]*)\})*([^\{]*)" , $this->text, $tokens);
        $text = $this->text;
        
        while(ereg('\{', $text)) {
            $found = ereg ( "^([^\{]*)\{([^\}]*)\}(.*)" , $text, $tokens);
            $parsed .= $tokens[1];
            $parsed .= $this->buildSelect($tokens[2]);
            $text = $tokens[3];
        }
        $parsed .= $text;
        
        return $parsed;
    }
    
    function buildSelect($selectString) {
        $select = '';
        $pole = split('/', $selectString);
        
        shuffle($pole);//zamichame!!!
        
        $select .= '<select name="test[]" class="arabic">';
        $pocitadlo = 0;
        $select .= '<option value="0">Vyberte</option>';
        foreach($pole as $polozka) {
            $select .= '<option value="'.$polozka.'">'.$polozka.'</option>';
            $pocitadlo ++;
        }
        $select .= '</select>';
        
        
        return $select;
    }
    
    function getCorrectedTest($answers) {
         $parsed = '';
        $text = $this->text;
        
        //pr($answers);
        
        $pocitadlo = 0;
        while(ereg('\{', $text)) {
            $found = ereg ( "^([^\{]*)\{([^\}]*)\}(.*)" , $text, $tokens);
            $parsed .= $tokens[1];
            $parsed .= $this->buildAnswer($tokens[2], $answers[$pocitadlo]);
            $text = $tokens[3];
            $pocitadlo ++;
        }
        $parsed .= $text;
        
        return $parsed;
    }
    
    function buildAnswer($selectString, $odpoved) {
        $answer = '';
        $pole = split('/', $selectString);
        
        //pr('pole 0');
        //pr($pole[0]);
        //pr('odpoved');
        //pr($odpoved);
        $spravne = $pole[0];
        
        if($pole[0] == $odpoved) {
            $answer .= ' <span style="color:green">'.$spravne.'</span> ';
        }
        else {
            $answer .= ' <span style="color:red">'.$odpoved.' </span> <span style="color:green">('.$spravne.')</span> ';
        }
        
        return $answer;
    }

}

function get_test_chooser($source) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT * FROM test WHERE source = '$source' ";
  $radky = $spojeni->query($dotaz);
  $navrat = " ";
  
  while ($spojeni->next_record()) {
    $navrat .= "  <a href=\"examination.php?nav_id=do_test&test=".$spojeni->Record['IDtest']."\"> lekce ".$spojeni->Record['lection'].": ".$spojeni->Record['title']."  </a> <br/>";
  }
  $navrat .= '';
  return $navrat;
}

function get_test($test_id) {
    require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT * FROM test WHERE \"IDtest\" = '".pg_escape_string($test_id)."' LIMIT 1 ";
  $radky = $spojeni->query($dotaz);
  
  $spojeni->next_record();
  
  return $spojeni->Record;
}

function get_tests_by_category($category_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz  = "SELECT * FROM test WHERE \"test_category_id\" = '".pg_escape_string($category_id)."' ";
  $radky = $spojeni->query($dotaz);
  
  $data = array();
  
  while ($spojeni->next_record()) {
    $data[] = $spojeni->Record;
  }
  
  return $data;

}

function test_form($text) {
    $form = '';
    
    $parser = new TestParser($text);
    
    $form .= $parser->getParsedText();
    
    return $form;
}

function check_test($text, $odpovedi) {
    $form = '';
    
    $parser = new TestParser($text);
    
    $form .= $parser->getCorrectedTest($odpovedi);
    
    return $form;
}



