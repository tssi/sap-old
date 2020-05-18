<?php
/* Department Test cases generated on: 2020-05-18 08:12:54 : 1589782374*/
App::import('Model', 'Department');

class DepartmentTestCase extends CakeTestCase {
	var $fixtures = array('app.department', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Department =& ClassRegistry::init('Department');
	}

	function endTest() {
		unset($this->Department);
		ClassRegistry::flush();
	}

}
