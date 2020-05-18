<?php
/* MasterConfig Test cases generated on: 2020-05-18 08:12:55 : 1589782375*/
App::import('Model', 'MasterConfig');

class MasterConfigTestCase extends CakeTestCase {
	var $fixtures = array('app.master_config');

	function startTest() {
		$this->MasterConfig =& ClassRegistry::init('MasterConfig');
	}

	function endTest() {
		unset($this->MasterConfig);
		ClassRegistry::flush();
	}

}
