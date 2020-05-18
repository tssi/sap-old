<?php
/* User Test cases generated on: 2020-05-18 08:12:56 : 1589782376*/
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
