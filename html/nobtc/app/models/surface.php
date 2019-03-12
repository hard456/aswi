<?php
class Surface extends AppModel {

	var $name = 'Surface';
	var $useTable = 'surface';
	var $primaryKey = 'id_surface';
/*	var $validate = array(
		'id_surface' => VALID_NOT_EMPTY,
	);
*/

	var $belongsTo = array(
		'Transliteration' => array(
			'className'  => 'Transliteration',
          	'conditions' => '',
          	'order'      => '',
          	'foreignKey' => 'id_transliteration'
        )
     );
     
	function bindModelsForTables() {

		$this->unbindModel( array('belongsTo' => array('Transliteration')));
		
		$this->bindModel(
			array(
				'hasMany' => array(
					'Line' => array(
						'className'  => 'Line',
						'foreignKey' => 'id_surface',
					)
				),
				'belongsTo' => array(
					'SurfaceType' => array(
						'className' => 'SurfaceType',
						'foreignKey' => 'id_surface_type',
					),
					'ObjectType' => array(
						'className' => 'ObjectType',
						'foreignKey' => 'id_object_type',
					)
				),
			)
		);
	}
	
	function organizeLines($surface) {
		$ret = array();
		$ret[$surface['ObjectType']['object_type']]
					[$surface['SurfaceType']['surface_type']]
					['id_surface'] = $surface['Surface']['id_surface'];
			
			foreach ($surface['Line'] as $line) {
				
				$ret[$surface['ObjectType']['object_type']]
					[$surface['SurfaceType']['surface_type']]
					['lines']
					[$line['id_line']] = 
					array(
						'line_number' => $line['line_number'],
						'transliteration' => $line['transliteration'],
						);
			}
		return $ret;
	}
	
	function isEmpty($id_surface) {
		
	}
}
