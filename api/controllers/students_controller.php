<?php
class StudentsController extends AppController {

	var $name = 'Students';

	function index() {
		$this->Student->recursive = 2;
		$students = $this->paginate();
		//pr($students);exit;
		if($this->isAPIRequest()){
			foreach($students as $i =>$STU){
				//pr($STU);
				
				$student = $STU['Student'];
				$student['department_id'] = $STU['YearLevel']['department_id'];
				$student['department'] = $STU['YearLevel']['Department'];
				$student['user'] = $STU['User'];
				
				if(isset($STU['YearLevel']['name'])){
					unset($STU['YearLevel']['created']);
					unset($STU['YearLevel']['modified']);
					unset($STU['YearLevel']['Department']);
					$student['year_level']=$STU['YearLevel']; 
				}
				if(isset($STU['User']['name'])){
					$student['user']=$STU['User']; 
				}
				
				$STU['Student'] = $student;
				//pr($STU['Student']);
				$students[$i]=$STU;
			}
		}
		
		
		$this->set('students', $students);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid student', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('student', $this->Student->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Student->create();
			
			if ($this->Student->save($this->data)) {
				if($this->data['Student']['user_id']){
					$this->data['Student']['id']=  $this->Student->id;
					$this->updateUser($this->data);
				}
				$this->Session->setFlash(__('The teacher has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Student->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid student', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash(__('The student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Student->read(null, $id);
		}
		$users = $this->Student->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for student', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Student->delete($id)) {
			$this->Session->setFlash(__('Student deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Student was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	protected function updateUser($data){
		$studentId =  $data['Student']['id'];
		$studentObj = $this->Student->findById($studentId);
		$user =  $studentObj['User'];
		//pr($user);	exit;
		$user['status'] = $data['Student']['status'];		
		$user['department_id'] = $data['Student']['department_id'];	
		unset($user['Department']);
		unset($user['UserType']);
		unset($user['Student']);
		//pr($user);	exit;	
		$this->Student->User->save($user);
	}
}
