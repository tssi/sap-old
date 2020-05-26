<?php
/* MasterModule Fixture generated on: 2020-05-26 07:01:19 : 1590469279 */
class MasterModuleFixture extends CakeTestFixture {
	var $name = 'MasterModule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'link' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_parent' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_child' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'sequence' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created_by' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'modified_by' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'link' => 'Lorem ipsum dolor sit amet',
			'is_parent' => 1,
			'is_child' => 1,
			'sequence' => 1,
			'created' => '2020-05-26 07:01:18',
			'modified' => '2020-05-26 07:01:18',
			'created_by' => 'Lorem ip',
			'modified_by' => 'Lorem ip'
		),
	);
}
