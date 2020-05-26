<?php
/* User Test cases generated on: 2020-05-26 07:07:02 : 1590469622*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.department');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
