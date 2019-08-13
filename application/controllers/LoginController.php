<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel','loginmodel');
	}

	public function index()
	{
		$this->redirect_login();
	}
	
	public function redirect_login()
	{
		//redirect(base_url().'index.php/State_Keeper/redirect_login');
		$this->load->view('login');
	}
	
	public function processLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($this->loginmodel->canLogin($username, $password)){
			
			//$session_data = array(
			//	'username' => $username
			//	);
			//$this->session->set_userdata($session_data);
			$this->enter($username);
		}else{
			
			$this->session->set_flashdata('error', 'Invalid Username or Password');
			$this->redirect_login();
		}
	}
	
	public function loginValidation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$this->processLogin();
		}else{
			$this->redirect_login();
		}
	}

	public function enter($username){
		//$session_data = $this->session->userdata();
		//$session_data['username']
		$singleResult = $this->loginmodel->fetchUserByUsername($username);
		foreach($singleResult as $user){
			$loggedInUser = array(
									'id' => $user->id,
									'first_name' => $user->first_name,
									'last_name' => $user->last_name,
									'username' => $user->username,
									'password' => $user->password,
									'permission' => $user->permission,
									);
			break;
		}

		$this->session->set_userdata('loggedInUser', $loggedInUser);
		

		
		if($loggedInUser['first_name'] != ''){
			redirect(base_url().'index.php/incident');
			
			
		}else{
			$this->redirect_login();
		}
	}
	
	
	public function signupValidation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('firstName', 'FirstName', 'required');
		$this->form_validation->set_rules('lastName', 'LastName', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$this->processSignup();
		}else{
			$this->redirect_login();
		}
	}
	
	public function processSignup()
	{
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($this->loginmodel->canCreateNewUser($username)){
			
			$data = array('first_name' => $firstName,
						'last_name' => $lastName,
						'username' => $username,
						'password' => $password);
						
			$signupSuccess = $this->loginmodel->insertUser($data);
			if($signupSuccess){
				$this->session->set_flashdata('signupSuccess', 'Your account has been created.');
			}else{
				$this->session->set_flashdata('signupSuccess', 'Sorry! Unexpected Error while saving.');
			}
			$this->redirect_login();
		}else{
			
			$this->session->set_flashdata('user_already_exists', 'Username Already Exist!');
			$this->redirect_login();
		}
		
		
	}
	
}
