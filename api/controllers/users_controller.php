<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Email');

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
				if($this->data['Student']['user_id']){
					$this->data['User']['id']=  $this->User->id;
					$this->updateUser($this->data);
				}
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
		//pr('wew');exit;
		$studentId =  $data['User']['id'];
		$userObj = $this->User->findById($studentId);
		$student =  $userObj['Student'];
		//pr($student);	exit;
		$student['status'] = $data['Student']['status'];		
		$student['year_level_id'] = $data['YearLevel']['id'];	
		unset($student['Department']);
		unset($student['UserType']);
		unset($student['Student']);
		//pr($student);	exit;	
		$this->User->Student->save($student);
	}

	function check(){
		if($this->data['User']['validation'] == "sno"){
			$user = $this->User->findBySno($this->data['User']['sno']);
			echo json_encode($user);
			exit;
		}
		
		if($this->data['User']['validation'] == "email"){
			$conditions =  array(
				'User.sno'=>$this->data['User']['sno'],
				'User.email'=>$this->data['User']['email']
			);
			$user = $this->User->find('first',array('conditions'=>$conditions));
			echo json_encode($user);
			exit;
		}
		
	}
	
	
	function send_verification(){
		//GENERATE TOKEN
		$token = openssl_random_pseudo_bytes(20);//Generate a random string.
		$token = bin2hex($token);//Convert the binary data into hexadecimal representation.
		$this->data['User']['reset_token'] = $token ;
		//END
		
		//TOKEN EXPIRATION DATE
		$now = date("Y-m-d H:i:s", strtotime("now"));
		$expiration  = date("Y-m-d H:i:s", strtotime("+30 minutes"));
		$this->data['User']['request_datetime'] = $now ;
		$this->data['User']['reset_expiry'] = $expiration;
		//END
		
		//GET THE IP OF THE USER TYRING TO RESET PASSWORD
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {$this->data['User']['ip_forget'] = $_SERVER['HTTP_CLIENT_IP'];}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {$this->data['User']['ip_forget'] = $_SERVER['HTTP_X_FORWARDED_FOR'];}
		else{$this->data['User']['ip_forget'] = $_SERVER['REMOTE_ADDR'];}
		//END
		
		
		//SAVE COMMAND
		$this->User->save($this->data);//UPDATE USER ROW
				
		//EMAIL COMMAND
		$from = 'SAP <sap@mytssi-erb.com>';
		$to = trim($this->data['User']['email']);
		$subject = 'Verification';
		$body = 'Are you trying to sign in? Click on the verification link to approve your sign in request:  <a href="http://localhost/sap/#/signin/change_password?token='.$token.'">http://localhost/sap/#/signin/change_password?token='.$token.'</a>';
		$this->email($from,$to,$subject,$body);
		
	}

	function email($from,$to,$subject,$body,$attachement = null){
		//$from ="SAP by The Simplified Solutions Inc. <sap@mytssi-erb.com>",
		//$to="paulobiscocho@gmail.com",
		//$subject= "SAP",
		//$body="body",
		//$attachement = null
		
		//A2 HOSTING
		$this->Email->smtpOptions = array( 
			'port'=>'587',
			'timeout'=>'30',
			'host' => 'mail.mytssi-erb.com',
			'username'=>'sap@mytssi-erb.com',
			'password'=>'tBKLVU1mDk85',
			'client'=>'a2ss55.a2hosting.com'
		);
		
		
	    $this->Email->delivery = 'smtp'; //Set delivery method
		$this->Email->to = $to;
		$this->Email->bcc = array('sap@mytssi-erb.com');
		$this->Email->from = $from;
		$this->Email->replyTo = $from;
		$this->Email->subject = $subject;
		$this->Email->attachments = $attachement;
		$this->Email->template = 'inquiry'; // note no '.ctp'
		$this->Email->sendAs = 'both'; //Send as 'html', 'text' or 'both' (default is 'text')
		$this->set('body',$body);
		
		//$this->Email->delivery = 'debug';
		//Do not pass any args to send()
		if($this->Email->send()){
			$email_response = 'EMAIL SENT';
			$is_sent = true;
		}else{
			$email_response ='FAILED SENDING EMAIL';
			$is_sent = false;
		}
		
		
		/* Check for SMTP errors. */
		$smtp_errors = $this->Email->smtpError;
		$response = array();
		$response['smtp_errors '] = $smtp_errors;
		$response['email_response '] = $email_response;
		$response['is_sent '] = $is_sent;
		
		echo json_encode($response);
		exit;
		//$this->set(compact('smtp_errors','email_response'));
		
	}

	function verify_token(){
		$data = $this->User->findByResetToken($this->data['User']['token']);
	
		if( date("Y-m-d H:i:s", strtotime("now")) <= $data['User']['reset_expiry']){
			$data['User']['token_status'] = 1;
			$data['User']['token_status_msg'] = 'Valid Token';
		}else{
			$data['User']['token_status'] = 0;
			$data['User']['token_status_msg'] = 'Expired Token';
		}
		echo json_encode($data);
		exit;
	}
	
	function verify_email_account(){
		//EMAIL COMMAND
		$from = 'SAP <sap@mytssi-erb.com>';
		$to = trim($this->data['User']['email']);
		$subject = 'Account Verification';
		$body = 'Please click  this link to activate your account:  <a href="http://localhost/sap/#/signin/verify_email_account?token='.$token.'">http://localhost/sap/#/signin/verify_email_account?token='.$token.'</a>';
		$this->email($from,$to,$subject,$body);
	
	}
}
