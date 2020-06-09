<?php
class UsersController extends AppController {

	var $name = 'Users';

	function index() {
		$this->User->recursive = 1;
		//$users = $this->User->find('all');
		$users = $this->paginate();
		//pr($users);exit;
		if($this->isAPIRequest()){
			foreach($users as $i =>$user){
				//pr($user['User']['status']);
				switch($user['User']['status']){
					case 'ACTIV': 
						$status = array('id'=>'ACTIV','name'=>'Active');
						break;
					case 'ARCVD': 
						$status = array('id'=>'ARCVD','name'=>'Archived');
						break;
				}
				/* if(isset($user['UserType'])){
					$user['User']['user_type']=$user['UserType']; 
				} */
				
				$user['User']['active_status'] = $status;
				unset($user['User']['password']);
				$users[$i]=$user;
			}
		}
		$this->set('users', $users);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
					pr('wew');exit;
				$this->data['User']['id']=  $this->User->id;
				$this->updateUser($this->data);
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$userTypes = $this->User->UserType->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('userTypes', 'departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$userTypes = $this->User->UserType->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('userTypes', 'departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function change_pass(){
		if(isset($this->data)){
			$oldPass =  $this->data['User']['old_password'];
			$oldPass =  $this->Auth->password($oldPass);
			$newPass =  $this->data['User']['new_password'];
			$newPass =  $this->Auth->password($newPass);
			$loggedIn = $this->Auth->user()['User'];
			$user  =$this->User->findById($loggedIn['id'])['User'];
			$currPass =  $user['password'];
			if($currPass==$oldPass){
				if($newPass==$oldPass){
					$this->Session->setFlash(__('Try something new. Password similar to current.', true));
					$this->cakeError('dataNotSet');  
				}else{
					$user['password']=$newPass;
					$user['password_changed'] = date("Y-m-d H:i:s");
					$this->User->save($user);
					$this->Session->setFlash(__('Password updated', true));	
				}
			}else{
				$this->Session->setFlash(__('Incorrect Password', true));
				$this->cakeError('invalidLogin');  
			}
		}
		$this->redirect(array('action'=>'index'));
	}

	protected function updateUser($data){
		pr('wew');exit;
		$studentId =  $data['User']['id'];
		$userObj = $this->User->findById($studentId);
		$student =  $userObj['Student'];
		pr($student);	exit;
		$student['status'] = $data['Student']['status'];		
		$student['year_level_id'] = $data['YearLevel']['id'];	
		unset($student['Department']);
		unset($student['UserType']);
		unset($student['Student']);
		//pr($student);	exit;	
		$this->User->Student->save($student);
	}

	function forget_password(){
		pr($_SERVER);
		
		//pr('HELLO WORLD');
		exit;
		
		
		/* 		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip; */
	}
}
