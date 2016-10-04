<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Messages_model extends CI_Model {

	public $logged_user_id;
	function __construct()
	{
		parent::__construct();
		$this->logged_user_id = $this->session->userdata("user_id");
	}
	//SELECT `message_id`, `sender_id`, `reciever_id`, `message_body`, `message_image`, `message_date`, `seen`, `dont_show` FROM `messages` WHERE 1
	function getSenderAndReciver() 
	{
		$users = array();
		
		$sql = "SELECT sender_id , reciever_id 
				FROM messages 
				WHERE sender_id='".$this->logged_user_id."' 
				OR reciever_id='".$this->logged_user_id."' 
				ORDER BY message_date DESC";

		$user_ids = $this->db->query($sql);
		if(	$user_ids->num_rows() > 0 )
		{
			foreach ($user_ids->result() as $ids) 
			{
				if( $ids->sender_id == $this->logged_user_id )
				{
					array_push($users, $ids->reciever_id);
				}
				else
				{
					array_push($users, $ids->sender_id);
				}
			}
		}
		$unique_ids  = arrary_unique($users);
		return $this->getUser($unique_ids);
	} 

	function getUser($user_array = array())
	{
		$usersData = array();
		if(count($user_array))
		{
			foreach ($user_array as $user) {
				$this->db->where("user_id", $user);
				$getUserdata = $this->db->get("user_details");
				array_push($usersData, $getUserdata->row());
			}
		}
		return $usersData;
	}


	function getMessages($user_id)
	{
		$correctedMessages = array();
		$sql = "SELECT * FROM messages,user_details 
				WHERE ((sender_id='".$this->logged_user_id."' OR reciever_id='".$user_id."')  
				AND (sender_id='".$user_id."' OR reciever_id='".$this->logged_user_id."')) 
				AND user_details.user_id = '".$user_id."'  ORDER BY message_date DESC";

		$messages = $this->db->query($sql);
		if(	$messages->num_rows()  > 0 )
		{
			foreach ($messages->result() as $message) {
				array_push($correctedMessages, $message);
			}

			return $data;
		}
	}

	function sendMessage()
	{
		$message_body = $this->input->post("message_body");
		$reciever_id = $this->input->post("reciever_id");
		$sender_id = $this->logged_user_id;
		$message_date = time();
		$message_data = array("message_body"=>$message_body, "reciever_id"=>$reciever_id, "sender_id"=>$sender_id, "message_date"=>$message_date);
		$sendMessage = $this->db->insert("messages", $message_data);
		if($sendMessage)
		{
			return array("result"=>"yes", "message"=>"successfully sent");
		}else{
			return array("result"=>"no", "message"=>"Network problem");
		}
	}

	function getNewMessagesForUser()
	{
		$sql = "SELECT * FROM messages,user_details 
				WHERE (sender_id='".$this->logged_user_id."' OR reciever_id='".$this->logged_user_id."')
				AND user_details.user_id = '".$user_id."'  ORDER BY message_date DESC";

		$messages = $this->db->query($sql);
		if(	$messages->num_rows()  > 0 )
		{
			foreach ($messages->result() as $message) {
				$data[] = $message;
			}

			return $data;
		}
	}

	function sendImageFile()
	{
		//send image file;
	}
}

