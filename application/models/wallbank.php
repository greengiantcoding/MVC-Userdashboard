<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallbank extends CI_Model {

	public function index()
	{
		die("in wall model");
	}

	public function retrieveUserPosts($id)
	{
		$query = "SELECT * FROM wallposts LEFT JOIN users ON wallposts.user_author_id = users.id WHERE user_wall_id = ?";
		$allPosts = $this->db->query($query, $id)->result_array();
		return $allPosts;
	}

	public function retrieveWallInfo($id)
	{
		$query = "SELECT * FROM users WHERE id = ?";
		$wallInfo = $this->db->query($query, $id)->row_array();
		return $wallInfo;
	}

	public function addPost($postInfo)
	{
		$query = "INSERT INTO wallposts (content, user_wall_id, user_author_id, created_at) VALUES (?,?,?,NOW())";
		$accepted = $this->db->query($query, array($postInfo['newPostContent'], $postInfo['wallId'], $postInfo['postAuthorId']));
		return $accepted;
	}

	public function addMessage($privateMessage)
	{
		$query = "INSERT INTO messages (content, user_author_id, user_wall_id, created_at) VALUES (?,?,?,NOW())";
		$accepted = $this->db->query($query, array($privateMessage['newMessageContent'], $privateMessage['messageAuthorId'], $privateMessage['messageWallId']));
		return $accepted;
	}

}
