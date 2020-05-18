<?php
/* Departments Test cases generated on: 2020-05-18 08:14:11 : 1589782451*/
App::import('Controller', 'Departments');

class TestDepartmentsController extends DepartmentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DepartmentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.department', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Departments =& new TestDepartmentsController();
		$this->Departments->constructClasses();
	}

	function endTest() {
		unset($this->Departments);
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
