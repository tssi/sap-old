<?php
/* UserType Test cases generated on: 2020-05-26 07:06:36 : 1590469596*/
App::import('Model', 'UserType');

class UserTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.user_type', 'app.user_grant', 'app.master_module', 'app.user', 'app.department');

	function startTest() {
		$this->UserType =& ClassRegistry::init('UserType');
	}

	function endTest() {
		unset($this->UserType);
		ClassRegistry::flush();
	}

}
