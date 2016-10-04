<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Posts_model extends CI_Model {
	

	//SELECT `post_id`, `user_id`, `text_post`, `image_post`, `date_created`, `seen` FROM `user_posts` WHERE 1//
	public $logged_user_id;
	function __construct()
	{
		parent::__construct();
		$this->logged_user_id = $this->session->userdata("user_id");
	}

	function makePost()
	{
		$text_post = $this->input->post("text_post");
		$user_id = $this->logged_user_id;
		$date_created = time();
		$post_data = array("text_post"=>$text_post, "user_id"=>$user_id,  "date_created"=>$date_created);
		$post = $this->db->insert("user_posts", $post_data);
		if($post)
		{
			return array("result"=>"yes", "message"=>"successfully ");
		}else{
			return array("result"=>"no", "message"=>"Network problem");
		}		
	}

	function getUser_posts($user_id)
	{
		$user_posts = array();
		$this->db->where("user_id", $user_id);
		$posts = $this->db->get("user_posts");
		if( $posts->num_rows() > 0 )
		{
			foreach ($posts as $post) {
				array_push($user_posts, $post);
			}

		}

		return $user_posts;
	}

	function getFriendsIds()
	{
		$freinds_ids = array();
		$sql = "SELECT * FROM relations WHERE (resq_id= '".$this->logged_user_id."' accept_id='".$$this->logged_user_id."') AND status='yes'";
		$user_ids = $this->db->query($sql);
		if($user_ids->num_rows() > 0 )
		{
			foreach ($user_ids as $user) {
				if($user->resq_id == $user_id)
				{
					array_push($freinds_ids, $user->accept_id);
				}
				else
				{
					array_push($freinds_ids, $user->resq_id);
				}
			}
		}
		return $freinds_ids;

	}

	function getFriendsPosts()
	{	
		$posts = array();
		$freinds_ids = $this->getFriendsIds();
		if(	count($freinds_ids) > 0 )
		{
			foreach ($freinds_ids as $user_id) {
				$sql = "SELECT * FROM user_posts, user_details WHERE  user_posts.user_id=user_details.user_id AND  user_posts.user_id='".$user_id."'";
				$get = $this->db->query($sql);
				$row = $get->row();
				$data["post"] = $row;
				$data["likes"] = $this->likeOnPost($row->post_id);
				$data["comments"] = $this->commentsOnPosts($row->post_id);
				$data["loggeInUser"] = $this->loggedInUseEverLikedPost($row->post_id);
				array_push($posts, $data);
			}

		}

		return $posts;
	}

	function likeOnPost($post_id)
	{
		$this->db->where("posts_id", $post_id);
		return $this->db->count_all('likes'); 
	}

	function commentsOnPosts($post_id)
	{
		$this->db->where("posts_id", $post_id);
		return $this->db->count_all('comments'); 
	}

	function loggedInUseEverLikedPost($post_id)
	{
		$this->db->where("post_id", $post_id);
		$this->db->where("user_id", $this->logged_user_id);
		$getLike = $this->db->get("likes");
		if($getLike->num_rows() == 0)
		{
			return "dislike";
		}
		else
		{
			return "like";
		}
	}

	function getSinglePost($post_id)
	{
		$sql = "SELECT * FROM user_posts, user_details WHERE  user_posts.user_id=user_details.user_id  AND post_id='".$post_id."'";
		$get = $this->db->query($sql);
		$row = $get->row();
		$data["post"] = $row;
		$data["likes"] = $this->likeOnPost($row->post_id);
		$data["comments"] = $this->commentsOnPosts($row->post_id);
		$data["loggeInUser"] = $this->loggedInUseEverLikedPost($row->post_id);
		return $data;
	}

}

