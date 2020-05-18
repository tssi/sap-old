<?php
/* MasterPeriods Test cases generated on: 2020-05-18 08:14:11 : 1589782451*/
App::import('Controller', 'MasterPeriods');

class TestMasterPeriodsController extends MasterPeriodsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MasterPeriodsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.master_period');

	function startTest() {
		$this->MasterPeriods =& new TestMasterPeriodsController();
		$this->MasterPeriods->constructClasses();
	}

	function endTest() {
		unset($this->MasterPeriods);
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
