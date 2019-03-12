<?php
class Names extends AppModel {

	var $name = 'Names';
	var $useTable = 'name';
	var $primaryKey = 'id_name';
	var $validate = array(
		'id_name' => VALID_NOT_EMPTY,
		'name' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Line' =>
				array('className' => 'Line',
						'joinTable' => 'name_line',
						'foreignKey' => 'id_name',
						'associationForeignKey' => 'id_line',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	var $hasMany = array(
		'Tag' => array(
			'className'  => 'Tag',
			'exclusive'  => '',
			'dependent'  => '',
			'foreignKey' => 'id_tag',
			'conditions' => '',
			'order'      => '',
			'limit'      => '',
			'finderSql'  => ''
		),
		'NameLine' => array(
			'className'  => 'NameLine',
			'exclusive'  => '',
			'dependent'  => '',
			'foreignKey' => 'id_name',
			'conditions' => '',
			'order'      => '',
			'limit'      => '',
			'finderSql'  => ''
		),
	);

	function vratLineSimpleStrukturu(&$name) {
		$ret = array();
		foreach ($name['NameLine'] as $index => $nameLine) {
				$line = $nameLine['Line'];
				$ret[]= array(
					"transliteration" => $line['transliteration'],
					"bach" => $line['Surface']['Transliteration']['Book']['book_abrev'].", ".
						$line['Surface']['Transliteration']['chapter'],
					"line_number" => $line['line_number'],
					"id_name_line" => $nameLine['id_name_line']); 
			}
		return $ret;
	}
	
	function priradKTagum(&$lines, &$tags) {
		//return;
//		pr($tags);
//		pr(count($name['NameLine']));
		//pr(count($names['Line']));
		foreach ($tags as $index_tag => $tag) {
			foreach ($lines as $index_line => $line) {
				if (mb_strpos($line['transliteration'],$tag['Tag']['tag'] )>0) {
					//pr($line['transliteration']." ... ".$tag['Tag']['tag']);
					$tags[$index_tag]['Lines'][] = $line;
					unset($lines[$index_line]); 
				}
			}
		}
//		pr("nove:");
//		pr($tags);
//		pr(count($name['NameLine']));
		
	}

	function upravSeznamy($lines, &$name) {
		//pr($lines);
		$count = count($lines);
		$k = array_keys($lines);
		//pr($k);
		for ($i = 0; $i < $count - 1; $i++) {
			for ($j = 0; $j < $count - 1; $j++) {
				$str1 = $this->getNameLine($lines[$k[$j]]['transliteration'],$name['Names']['name']);
				$str2 = $this->getNameLine($lines[$k[$j+1]]['transliteration'],$name['Names']['name']);
				$str1 = trim($str1);
				$str2 = trim($str2);
				//pr("$str1, $str2: ".strcmp($str1, $str2));
				if (strcmp($str1, $str2) > 0) {
					$temp =  $lines[$k[$j]];
					$lines[$k[$j]] = $lines[$k[$j+1]];
					$lines[$k[$j+1]] = $temp;

					//$this->array_move ($j,$j+1, $lines );
				}
			}
		}
		return $lines;
	}
	
	function getNameLine($lineText, $name) {
		$sp = "[:space:]";
		$regExp = add_bracket($name);
		$regExp2 = "[$sp]*[^$sp]*".$regExp."[^$sp]*[$sp]*";
		if(eregi($regExp2, $lineText, $regs)) {
			$lineText = $regs[0];
		}
		$ret = eregi_replace($regExp, "\\0", $lineText);

		return $ret;
	}
	function array_move($which, $where, &$array)
	{
	    $tmp  = array_splice($array, $which, 1);
	    array_splice($array, $where, 0, $tmp);
	    //return $array;
	}
}

