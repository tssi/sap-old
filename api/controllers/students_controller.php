<?php
class StudentsController extends AppController {

	var $name = 'Students';
	var $components = array('Email');

	function index() {
		 $this->Student->recursive = 2;
		$students = $this->paginate();
		//pr($students);exit;
		if($this->isAPIRequest()){
			foreach($students as $i =>$STU){
				$student = $STU['Student'];
				$student['department_id'] = $STU['YearLevel']['department_id'];
				$STU['Student'] = $student;
				//pr($STU['Student']);
				$students[$i]=$STU;
			}
		} 
		
		//A2 HOSTING
		$this->Email->smtpOptions = array( 
			'port'=>'587',
			'timeout'=>'30',
			'host' => 'mail.mytssi-erb.com',
			'username'=>'sap@mytssi-erb.com',
			'password'=>'tBKLVU1mDk85',
			'client'=>'a2ss55.a2hosting.com'
		);
		
		$body = 'From SAP website '. date("M d, Y h:ia");

		/* Set delivery method */
        //$this->Email->delivery = 'mail';
	    $this->Email->delivery = 'smtp'; // Some a2hosting error
		$this->Email->to = 'paulobiscocho@gmail.com';
		$this->Email->bcc = array('steplerpaulo@yahoo.com','sap@mytssi-erb.com','joeytdy@gmail.com','arroyo.daveil@gmail.com');
		$this->Email->subject = 'From SAP website '. date("M d, Y h:ia");
		$this->Email->replyTo = 'sap@mytssi-erb.com' ;
		$this->Email->from = 'SAP by The Simplified Solutions Inc. <sap@mytssi-erb.com>';
		$this->Email->attachments = array();
		$this->Email->template = 'inquiry'; // note no '.ctp'
		$this->Email->sendAs = 'both'; //Send as 'html', 'text' or 'both' (default is 'text')
		
		$this->set(compact('body'));
		
		//Do not pass any args to send()
		//$this->Email->delivery = 'debug';
		if($this->Email->send()){
			$email_response = 'EMAIL SENT';
		}else{
			$email_response ='FAILED SENDING EMAIL';
		}
		pr($this->Email->smtpError);
		pr($email_response);
		
		/* Check for SMTP errors. */
		$smtp_errors = $this->Email->smtpError;
		$this->set(compact('smtp_errors','students','email_response'));
		
		
		
		
		
		
		
		
		
		
	//	$this->set('students', $students);
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

	
	
	//EMAIL SENDING
	function send_mail_using_smtp($from,$subject,$body,$attachement = null){
		//GMAIL
		/* $this->Email->smtpOptions = array( 
			'port'=>'465',
			'timeout'=>'30',
			'host' => 'ssl://box967.bluehost.com',
			'username'=>'paulobiscocho@tssilive.com',
			'password'=>'P@ssw0rd123',
		); */
		
		//A2 HOSTING
		$this->Email->smtpOptions = array( 
			'port'=>'587',
			'timeout'=>'30',
			'host' => 'mail.mytssi-erb.com',
			'username'=>'sap@mytssi-erb.com',
			'password'=>'tBKLVU1mDk85',
			'client'=>'a2ss55.a2hosting.com'
		);

		/* Set delivery method */
		$this->Email->delivery = 'smtp';
		$this->Email->to = 'paulobiscocho@gmail.com';
		$this->Email->bcc = array('steplerpaulo@yahoo.com','sap@mytssi-erb.com','joeytdy@gmail.com','arroyo.daveil@gmail.com');
		$this->Email->subject = $subject;
		$this->Email->replyTo = 'sap@mytssi-erb.com';
		$this->Email->from = 'SAP by The Simplified Solutions Inc. <sap@mytssi-erb.com>';
		$this->Email->attachments = array($attachement);
		$this->Email->template = 'inquiry'; // note no '.ctp'
		$this->Email->sendAs = 'both'; //Send as 'html', 'text' or 'both' (default is 'text')
		
		$this->set(compact('body'));
		
		//Do not pass any args to send()
		//$this->Email->delivery = 'debug';
		$this->Email->send();
		
		/* Check for SMTP errors. */
		$smtp_errors = $this->Email->smtpError;
		pr($smtp_errors);
		$this->set(compact('smtp_errors'));
	}
	
	//CREATING NEW FOLDER SAMPLE
	function create_directory(){
		$dir = new Folder(WWW_ROOT . 'img' . DS . 'inquiry files'. DS . 'Inquiry ID 2', true);
		//pr(WWW_ROOT . 'img' . DS . 'inquiry files'. DS . 'Inquiry ID 2'.'/');exit;
	}
	
	//TEST SMTP
	function test_smtp(){
		$from = 'pkerroj@gmail.com';
		$subject = 'From SAP website '. date("M d, Y h:ia");
		$body = 'This is a test for secured smtp';
		$attachement = null;
		$this->send_mail_using_smtp($from,$subject,$body,$attachement);
	}
}
