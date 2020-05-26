<?php
/* Student Test cases generated on: 2020-05-26 07:05:48 : 1590469548*/
App::import('Model', 'Student');

class StudentTestCase extends CakeTestCase {
	var $fixtures = array('app.student', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.department');

	function startTest() {
		$this->Student =& ClassRegistry::init('Student');
	}

	function endTest() {
		unset($this->Student);
		ClassRegistry::flush();
	}

}
