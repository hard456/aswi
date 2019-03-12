<?php
/* SVN FILE: $Id: app_model.php 4409 2007-02-02 13:20:59Z phpnut $ */

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppModel extends Model{


	/**
	 * Pridana jina validace - sestava se z tohoto souboru + error helperu
	 * napsano podle
	 * http://cakebaker.wordpress.com/2006/02/06/yet-another-data-validation-approach/
	 * byly nutne nejake zmeny...
	 *
	 * pouziti:
	 *
	 * v controlleru pridat:
	 * ---------------------
	 * do pole helpers error helper
	 * Pr:
	 * 		var $helpers = array('Html', 'Form', 'Error');
	 *
	 * v pohledech pouzivat:
	 * ---------------------
	 * namisto:
	 * 		echo $html->tagErrorMsg('ModelName/polozka', 'Zadejte prosГ­m polozku.');
	 * jen jednodussi:
	 * 		echo $error->showMessage('ModelName/polozka');
	 *
	 * v modelech se validace definuje takto:
	 * --------------------------------------
	 * Pr:
	 * class User extends AppModel
	 *	{
	 *	    var $validate = array(
 	 *			'username' =>
  	 *				array(
	 *					array(VALID_NOT_EMPTY, 'Username is required'),
	 *					array('isUsernameUnique', 'Not unique')
	 *				)
	 *		);
	 *
	 *	    function isUsernameUnique()
	 *	    {
	 *	        return (!$this->hasAny(array('User.username' =>
	 *	                  $this->data[$this->name]['username'])));
	 *	    }
	 *	}
	 *
	 *
	 *
	 */
	function invalidFields ($data = array())
	{
	    if(!$this->beforeValidate($data))
	    {
	        return false;
	    }

	    if (!isset($this->validate) || !empty($this->validationErrors))
	    {
	        if (!isset($this->validate))
	        {
	            return true;
	        }
	        else
	        {
	            return $this->validationErrors;
	        }
	    }

	    //pr($data);

	    if (isset($this->data))
	    {
	        $data = array_merge($data, $this->data);
	    }

	    //pr($data);

	    $errors = array();
	    $this->set($data);

	    foreach ($data as $table => $field)
	    {
	    	//pridano kvuli wizardu - ale logickyu to sem patri
			if($this->name === $table)
			{
		        foreach ($this->validate as $field_name => $validators)
		        {
		            foreach($validators as $validator)
		            {
		                if (isset($validator[0]))
		                {
		                    if (method_exists($this, $validator[0]))
		                    {
		                        //if (isset($data[$table][$field_name]) &&
		                        if(array_key_exists($field_name, $data[$table]) &&
		                        !call_user_func(array(&$this, $validator[0])))
		                        {
		                            if (!isset($errors[$field_name]))
		                            {
		                                $errors[$field_name] = isset($validator[1]) ?
		                                                               $validator[1] : 1;
		                            }
		                        }
		                    }
		                    else
		                    {
		                    	//echo ($field_name." = ");
		                    	//var_dump($data[$table][$field_name]);
		                    	//var_dump($_POST['data'][$table][$field_name]);
		                    	//pr($validator);

								//pr(bl(isset($data[$table][$field_name])));
								//pr(bl(preg_match($validator[0], $data[$table][$field_name])));

		                        ////////if (isset($data[$table][$field_name]) &&
		                        if(array_key_exists($field_name, $data[$table]) &&
		                			!preg_match($validator[0], $data[$table][$field_name]))
		                        {
		                        	//pr("NEPROSLO");
		                        	if (!isset($errors[$field_name]))
		                            {
		                                $errors[$field_name] = isset($validator[1]) ?
		                                                               $validator[1] : 1;
		                            }
		                        }
		                    }
		                    //slouzi pro extra validaci polozek nastavenych jako not_empty
		                    if ($validator[0] == VALID_NOT_EMPTY &&
		                    		!array_key_exists($field_name, $data[$table]))
		                    {
								if (!isset($errors[$field_name]))
	                            {
	                                $errors[$field_name] = isset($validator[1]) ?
	                                                               $validator[1] : 1;
	                            }
								//var_dump($data[$table][$field_name]);
				            }
		                }
		            }
		        }
			}
	    }
	    //pr($data);
	    //pr($errors);
	    //flush(1);flush(0);
	    $this->validationErrors = $errors;
	    return $errors;
	}

/**
 * Kopirovano z cake/model_php5.php a upraveno, tak, aby misto $valuePath retezce prijimalo $valuePath
 * jako pole a do vystupu je spojovalo mezerami...
 *
 *
 * Returns a resultset array with specified fields from database matching given conditions.
 * Method can be used to generate option lists for SELECT elements.
 *
 * @param mixed $conditions SQL conditions as a string or as an array('field' =>'value',...)
 * @param string $order SQL ORDER BY conditions (e.g. "price DESC" or "name ASC")
 * @param int $limit SQL LIMIT clause, for calculating items per page
 * @param string $keyPath A string path to the key, i.e. "{n}.Post.id"
 * @param string $valuePath A string path to the value, i.e. "{n}.Post.title"
 * @return array An associative array of records, where the id is the key, and the display field is the value
 * @access public
 */
	function generateListArray($conditions = null, $order = null, $limit = null, $keyPath = null, $valuePath = null, $separator = null) {
		if ($separator == null) $separator = ' ';
		if ($keyPath == null && $valuePath == null && $this->hasField($this->displayField)) {
			$fields = array($this->primaryKey, $this->displayField);
		} else {
			$fields = null;
		}
		$recursive = $this->recursive;

		if($recursive >= 1) {
			$this->recursive = -1;
		}
		$result = $this->findAll($conditions, $fields, $order, $limit);
		$this->recursive = $recursive;

		if(!$result) {
			return false;
		}

		if ($keyPath == null) {
			$keyPath = '{n}.' . $this->name . '.' . $this->primaryKey;
		}

		if ($valuePath == null) {
			//tady uprava
			$valuePath = array(
				'{n}.' . $this->name . '.' . $this->displayField
			);
		}

		$keys = Set::extract($result, $keyPath);
		$vals = array();
		//$vals[count($keys)];

		foreach($valuePath as $valueString) {
			$val = Set::extract($result, $valueString);
			$i = 0;
			foreach($val as $str) {
				if(!array_key_exists($i, $vals))
					$vals[$i] = $str;
				else
					$vals[$i] = $vals[$i] . $separator . $str;
				$i++;
			}
		}

		if (!empty($keys) && !empty($vals)) {
			$return = array_combine($keys, $vals);
			return $return;
		}
		return null;
	}

	/**
	 * Tuhle metodu to chce jeste poradne ozkouset!!!
	 * */
	function beforeSave($data = array()) {
		//zkontroluje cisla a prevede je z formatu x,y na format x.y

		if (isset($this->data))
	    {
	        $data = array_merge($data, $this->data);
	    }

	    //echo('$dataStara');pr($data);

		foreach ($this->validate as $validateItemName => $validateItemArray) {
			foreach ($validateItemArray as $validateItem) {
				//echo "ValidateItem: ";pr($validateItem);
				if ($validateItem['0'] == VALID_NUMBER) {
					//echo"zabralo";
					foreach ($data as $dataItemName => $dataArray) {

						if (!empty($data[$dataItemName][$validateItemName])) {
							//pr($data[$dataItemName][$validateItemName]);
							$pattern = '/(\d+),(\d+)/i';
							$data[$dataItemName][$validateItemName] = preg_replace($pattern, '$1' . '.' . '$2', $dataArray[$validateItemName]);
						} else $data[$dataItemName][$validateItemName] = null;
					}
				}
			}
		}

		//echo('$dataNova');pr($data);

		//zkontroluje datum
		/*foreach ($data as $modelDataName => $modelData) {
			foreach ($modelData as $itemName => $item) {
				if ($item == '--') {
					if (array_key_exists($itemName, $this->validate)) {
						$isDate = false;
						$isNotEmpty = false;
						foreach ($this->validate[$itemName] as $validateArray) {
							foreach ($validateArray as $validateItem) {
								if ($validateItem == VALID_DATE) $isDate = true;
								if ($validateItem == VALID_NOT_EMPTY) $isNotEmpty = true;
							}
						}
						if ($isDate == true && $isNotEmpty == false)
								$data[$modelDataName][$itemName] = null;
					}
				}
			}
		}
		//priradit upravena data!!!*/
		$this->data = $data;

		//pr($this->validate);
		//pr($data);

		return true; //musi tu byt
	}

}