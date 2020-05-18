<?php
/* MasterModules Test cases generated on: 2020-05-18 08:14:11 : 1589782451*/
App::import('Controller', 'MasterModules');

class TestMasterModulesController extends MasterModulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MasterModulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.master_module', 'app.user_grant', 'app.user_type', 'app.user', 'app.department');

	function startTest() {
		$this->MasterModules =& new TestMasterModulesController();
		$this->MasterModules->constructClasses();
	}

	function endTest() {
		unset($this->MasterModules);
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
