<?php
/* UserGrants Test cases generated on: 2020-05-26 07:08:17 : 1590469697*/
App::import('Controller', 'UserGrants');

class TestUserGrantsController extends UserGrantsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UserGrantsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user_grant', 'app.user_type', 'app.user', 'app.department', 'app.master_module');

	function startTest() {
		$this->UserGrants =& new TestUserGrantsController();
		$this->UserGrants->constructClasses();
	}

	function endTest() {
		unset($this->UserGrants);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
