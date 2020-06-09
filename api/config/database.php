<?php
class DATABASE_CONFIG {

	var $default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'sap',
		'prefix' => '',
		'encoding' => 'utf8',
	);
	var $test = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => '',
		'database' => 'test_database_name',
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
?>