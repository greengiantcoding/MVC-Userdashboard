<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('user_catalog');
	}

	//--Send user to sign in screen--//
	public function loadSignin()
	{
		if($this->session->userdata('errors'))
		{
			$this->session->set_userdata('errors');
		}
		$this->load->view('signin_screen');
	}

	//--Check users sign in credentials--//
	public function checkSignin()
	{
		$userEPcombo = $this->input->post();
		$errors = array();
		if(empty($userEPcombo['email']))
		{
			$errors[] = 'Please enter the email associated with your account';
		}
		if(empty($userEPcombo['password']))
		{
			$errors[] = 'Please enter the password associated with your account';
		}
		if(count($errors) != 0)
		{
			$this->session->set_userdata('errors', $errors);
			redirect('login/loadSignin');
		}
		else
		{
			$this->session->set_userdata('userEPcombo', $userEPcombo);
			redirect('/login/checkEPcombo');
		}
	}
	public function checkEPcombo()
	{
		$userEPcombo = $this->session->userdata('userEPcombo');
		$requestCPset = $this->databank->getCPcombo($userEPcombo['email']);
		if($requestCPset == Null)
		{
			die("User email is not registered with this website");
		}
		else
		{
			$cryptKeeper = crypt($userEPcombo['password'],$requestCPset['crypt']);
//--//
			if($cryptKeeper !== $requestCPset['password'])
			{
				die("incorrect attempt");
			}
			else
			{
				$this->session->set_userdata('ID', $requestCPset['id']);
				$listOfUsers = $this->databank->getListOfUsers($requestCPset['id']);
				// die(var_dump($listOfUsers));
				$this->session->set_userdata('listOfUsers', $listOfUsers);
				$userInfo = $this->databank->getUserInfo($requestCPset['id']);
				$this->session->set_userdata('userInfo', $userInfo);
				$privateMessage = $this->databank->getPrivateMessages($requestCPset['id']);
				$this->session->set_userdata('privateMessage', $privateMessage);
				$this->load->view('user_catalog');
			}
//--//
		}
	}



	//--Send user to register screen--//
	public function loadRegister()
	{
		if($this->session->userdata('errors'))
		{
			$this->session->unset_userdata('errors');
		}
		$this->load->view('register_screen');
	}

	//--Clear userdata, logout of site--//
	public function logOut()
	{
		$this->session->unset_userdata('userInfo');
		$this->load->view('login_screen');
	}
}
