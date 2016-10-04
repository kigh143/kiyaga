<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments extends CI_Model {
	
	public $logged_user_id;
	function __construct()
	{
		parent::__construct();
		$this->logged_user_id = $this->session->userdata("user_id");
	}
	
	//SELECT `comment_id`, `user_id`, `post_id`, `comment`, `image_comment`, `date_comment`, `seen` FROM `comments` WHERE 1
	function commentOnPost()
	{
		$post_id = $this->input->post("post_id");
		$comment = $this->input->post("comment");
		$data = array("user_id"=>$this->logged_user_id, "post_id"=>$post_id, "comment"=>$comment, "image_comment"=>"", "date_comment"=>time());
		$comment = $this->db->insert("comments", $data );
		if($comment)
		{
			return array("result"=>"yes");
		}
		else
		{
			return array("result"=>"no");
		}
	}

	function getCommentsOnPost($post_id)
	{
		$data = array();
		$sql = "SELECT * FROM comments, user_details 
				WHERE comments.user_id=user_details.user_id 
				AND comments.post_id='".$post_id."'";
				
		$comments = $this->db->query($sql);
		if($comments->num_rows() > 0 )
		{
			foreach ($comments as $comment) {

				$data[] = $comment;
			}
		}

		return $data ;
	}



}

