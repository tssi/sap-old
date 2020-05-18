<?php
class MasterPeriodsController extends AppController {

	var $name = 'MasterPeriods';

	function index() {
		$this->MasterPeriod->recursive = 0;
		$this->set('masterPeriods', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid master period', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('masterPeriod', $this->MasterPeriod->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MasterPeriod->create();
			if ($this->MasterPeriod->save($this->data)) {
				$this->Session->setFlash(__('The master period has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master period could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid master period', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MasterPeriod->save($this->data)) {
				$this->Session->setFlash(__('The master period has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master period could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MasterPeriod->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for master period', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MasterPeriod->delete($id)) {
			$this->Session->setFlash(__('Master period deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Master period was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
