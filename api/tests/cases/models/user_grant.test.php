<?php
/* UserGrant Test cases generated on: 2020-05-18 08:12:55 : 1589782375*/
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
