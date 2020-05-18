<?php
/* MasterModule Test cases generated on: 2020-05-18 08:12:55 : 1589782375*/
App::import('Model', 'MasterModule');

class MasterModuleTestCase extends CakeTestCase {
	var $fixtures = array('app.master_module', 'app.user_grant', 'app.user_type', 'app.user', 'app.department');

	function startTest() {
		$this->MasterModule =& ClassRegistry::init('MasterModule');
	}

	function endTest() {
		unset($this->MasterModule);
		ClassRegistry::flush();
	}

}
