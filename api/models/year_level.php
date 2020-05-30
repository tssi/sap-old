<?php
class YearLevel extends AppModel {
	var $name = 'YearLevel';
	var $displayField = 'name';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	//This Association Slow Student Query if set on Recursive 2 on Student Model 
	// For concern contact Paulo Biscocho
	/* var $hasMany = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'year_level_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	); */
	
}
