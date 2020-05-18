<?php
/* MaintenanceList Test cases generated on: 2020-05-18 08:12:55 : 1589782375*/
App::import('Model', 'MaintenanceList');

class MaintenanceListTestCase extends CakeTestCase {
	var $fixtures = array('app.maintenance_list');

	function startTest() {
		$this->MaintenanceList =& ClassRegistry::init('MaintenanceList');
	}

	function endTest() {
		unset($this->MaintenanceList);
		ClassRegistry::flush();
	}

}
