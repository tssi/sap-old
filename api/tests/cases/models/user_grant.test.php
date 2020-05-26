<?php
/* UserGrant Test cases generated on: 2020-05-26 07:06:12 : 1590469572*/
App::import('Model', 'UserGrant');

class UserGrantTestCase extends CakeTestCase {
	var $fixtures = array('app.user_grant', 'app.user_type', 'app.user', 'app.department', 'app.master_module');

	function startTest() {
		$this->UserGrant =& ClassRegistry::init('UserGrant');
	}

	function endTest() {
		unset($this->UserGrant);
		ClassRegistry::flush();
	}

}
