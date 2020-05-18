<?php
/* MasterPeriod Test cases generated on: 2020-05-18 08:12:55 : 1589782375*/
App::import('Model', 'MasterPeriod');

class MasterPeriodTestCase extends CakeTestCase {
	var $fixtures = array('app.master_period');

	function startTest() {
		$this->MasterPeriod =& ClassRegistry::init('MasterPeriod');
	}

	function endTest() {
		unset($this->MasterPeriod);
		ClassRegistry::flush();
	}

}
