<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Databank extends CI_Model {

	
	//--Check count of users with DB to assign admin rights--//
	public function checkUserCount()
	{
		$query = "SELECT id FROM users";
		$userCount = $this->db->query($query)->result_array();
		return $userCount;
	}


	public function registerDatabase($userCredentials)
	{
		// die(var_dump($userCredentials));
		$query = "INSERT INTO users (first_name, last_name, email, rights, created_at) VALUES (?,?,?,?,NOW())";
		$accepted = $this->db->query($query, array($userCredentials['firstName'], $userCredentials['lastName'], $userCredentials['email'], $userCredentials['rights']));
		
		$userID = $this->getRegisterUserID($userCredentials);
		
		$query = "INSERT INTO crypts (password, crypt, user_id) VALUES (?,?,?)";
		// die(var_dump($userID));
		$accepted = $this->db->query($query, array($userCredentials['password'], $userCredentials['crypt'], $userID[0]['id']));
		// $query = "INSERT INTO crypts (password, crypt, user_id) VALUES ($userCredentials['password'], $userCredentials['crypt'], $userID"
		
		return $accepted;
	}

	public function getRegisterUserID($userCredentials)
	{
		$query = "SELECT id FROM users WHERE email=? AND first_name=? AND last_name=?";
		$userID = $this->db->query($query, array($userCredentials['email'], $userCredentials['firstName'], $userCredentials['lastName']))->result_array();
		return $userID;
	}

	public function checkEmailAvailable($email)
	{
		$query = "SELECT * FROM users WHERE email = ?";
		$check = $this->db->query($query, $email)->result_array();
		return $check;
	}
//--//
	public function getCPcombo($userEmail)
	{
		$query = "SELECT crypts.password, crypts.crypt, users.id FROM users LEFT JOIN crypts ON users.id = crypts.user_id WHERE email = ?";
		$match = $this->db->query($query, $userEmail)->row_array();
		return $match;
	}

	public function getListOfUsers($userID)
	{
		$query = "SELECT * FROM users WHERE id != ?";
		$listOfUsers = $this->db->query($query, $userID)->result_array();
		// die(var_dump($listOfUsers));
		return $listOfUsers;
	}

	public function getUserInfo($userID)
	{
		$query = "SELECT * FROM users WHERE id = ?";
		$userInfo = $this->db->query($query, $userID)->row_array();
		return $userInfo;
	}

	public function getPrivateMessages($userID)
	{
		$query = "SELECT * FROM messages LEFT JOIN users ON messages.user_author_id = users.id WHERE user_wall_id = ?";
		$privateMessages = $this->db->query($query, $userID)->result_array();
		return $privateMessages;
	}
}
