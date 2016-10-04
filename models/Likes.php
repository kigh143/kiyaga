<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Likes extends CI_Model {
	
	public $logged_user_id;
	function __construct()
	{
		parent::__construct();
		$this->logged_user_id = $this->session->userdata("user_id");
	}

	//SELECT `like_id`, `user_id`, `post_id`, `date_liked`, `seen` FROM `likes` WHERE 1
	function likePost($post_id)
	{
		$data = array("post_id"=>$post_id, "user_id"=>$this->logged_user_id, "date_liked"=>time()); 
		$likeit = $this->db->insert("likes", $data);
		if($likeit)
		{
			return array("result"=>"yes");
		}else{
			return array("result"=>"no");	
		}
	}

	function getwhatUserLikes()
	{
		$userLikedPosted = array();
		$this->db->select("post_id");
		$this->db->where("user_id", $this->logged_user_id);
		$getlikes = $this->db->get("like");
		if(	$getlikes->num_rows() > 0 )
		{
			foreach ($getlikes->result() as $postinfo) {
				$sql = "SELECT * FROM user_details, user_posts 	WHERE user_details.user_id=user_post.user_id AND user_posts.post_id='".$postinfo->post_id."'";
				$data = $this->db->query($sql);
				array_push($userLikedPosted, $data->row());
			}
		}
		return $userLikedPosted;
	}

	function unlike($post_id)
	{
		$this->db->where('user_id', $this->logged_user_id);
		$this->db->where('post_id', $post_id);
		$delete = $this->db->delete('mytable');
		if($delete)
		{
			return array("result"=>"yes");
		}else{
			return array("result"=>"no");
		}

	}
}

