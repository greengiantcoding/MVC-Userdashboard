<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$this->howManyUsers();
		$this->load->view('register_screen');
	}

	//--Check number of users to assign first to admin--//
	public function howManyUsers()
	{
		$thisMany = $this->databank->checkUserCount();
		$userCount = count($thisMany);
		$this->session->set_userdata('userNum', $userCount);
		return;
	}


	//--Check users inputs for acceptable entries--//
	public function checkUserRegister()
	{
		$errors = array();
		$userCredentials = $this->input->post();
		if(empty($userCredentials['email']))
		{
			$errors[] = 'Please enter a valid email address';
		}
		else
		{
			$emailCheck = $this->databank->checkEmailAvailable($userCredentials['email']);
			if(count($emailCheck) > 0)
			{
				$errors[] = 'Email address is already registered';
				$errors[] = 'Please register with another email';
			}
		}
		if(empty($userCredentials['firstName']))
		{
			$errors[] = 'Please enter your first name';
		}
		if(empty($userCredentials['lastName']))
		{
			$errors[] = 'Please enter your last name';
		}
		if(empty($userCredentials['password']))
		{
			$errors[] = 'Please enter a password';
		}
		else if(empty($userCredentials['confirmPassword']))
		{
			$errors[] = 'Please re-enter your password for confirmation';
		}
		else if($userCredentials['password'] != $userCredentials['confirmPassword'])
		{
			$errors[] = 'Password/Confirmation do not match';
		}
		if($this->session->userdata('userNum') === 0)
		{
			$userCredentials['rights'] = 'Admin';
		}
		else
		{
			$userCredentials['rights'] = 'Public';
		}
		if(empty($errors))
		{
			$salt = random_string('cryptType', '32');
			$userCredentials['crypt'] = $salt;
			$userCredentials['password'] = crypt($userCredentials['password'], $salt);
			$this->session->set_userdata('registerUser', $userCredentials);
			redirect('register/registerDatabase');
		}
		else
		{
			$this->session->set_userdata('errors', $errors);
			redirect('register/');
		}
	}
	
	//--Send user credentials to database to complete registration--//
	public function registerDatabase()
	{
		$userCredentials = $this->session->userdata('registerUser');
		$userID = $this->databank->registerDatabase($userCredentials);
		redirect('login/loadSignin');	
	}

	public function uploadProfilePic($id)
	{
		$config['upload_path'] = './profilePictures/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$data = $this->upload->data();
		var_dump($data);
		die(var_dump($id));
	}
}
