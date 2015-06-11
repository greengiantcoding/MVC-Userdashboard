<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wall extends CI_Controller {

	public function index()
	{
		die("index function of wall controller");
	}

	public function goToWall($id)	//$id is select wall users id
	{
		
		$userInfo = $this->session->userdata('userInfo'); 
		$wallInfo = $this->wallbank->retrieveWallInfo($id);
		$wallPosts = $this->wallbank->retrieveUserPosts($id); //get all posts belonging to current user
		$this->load->view('user_wall', (array('wallInfo' => $wallInfo, 'wallPosts' => $wallPosts)));
		

		// $wallPosts = $this->wallbank->retrieveUserPosts($userInfo['id']); //get all posts belonging to current user
		// $this->load->view('user_wall', array('userInfo' => $userInfo, 'wallPosts' => $wallPosts, 'allUsersInfo' => $allUsersInfo));
		// $allUsersInfo = $this->wallbank->retrieveAllUserInfo($userInfo['id']); //get all users info besides current user
	}

	public function addPost()
	{
		$postInfo = $this->input->post();
		$accepted = $this->wallbank->addPost($postInfo);
		if($accepted)
		{
			$this->goToWall($postInfo['wallId']);
		}
		else
		{
			echo "Server connection down! Sorry!";
		}

	}

	public function privateMessage()
	{
		$privateMessage = $this->input->post();
		$accepted = $this->wallbank->addMessage($privateMessage);
		if($accepted)
		{
			$this->goToWall($privateMessage['messageWallId']);
		}
	}

	public function goToMailbox($id)
	{
		$privateMessages = $this->databank->getPrivateMessages($id);
		$this->load->view('mailbox', array('privateMessages' => $privateMessages));
	}

}
