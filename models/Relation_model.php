<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Relation_model extends CI_Model {
	
	public $logged_user_id;
	function __construct()
	{
		parent::__construct();
		$this->logged_user_id = $this->session->userdata("user_id");
	}

	// SELECT `relation_id`, `resq_id`, `accept_id`, `status`, `relation_date`, `seen`, `blockUser` FROM `relations` WHERE 1

	function makeFriend($user_id)
	{
		$data = array("resq_id"=>$this->logged_user_id, "accept_id"=>$user_id); 
		if(checkIfNotFriends($user_id))
		{
			$insert = $this->db->insert("relations", $data);
			if($insert)
			{
				return array("result"=>"yes", "message"=>"friend resquest send");
			}
			else
			{
				return array("result"=>"no", "message"=>"Network problem");
			}
		}
		else
		{
			return array("result"=>"no", "message"=>"Already friends, Please report problem");
		}
	}

	function acceptFreindRequest($relation_id)
	{
		$this->db->where("relation_id", $relation_id);
		$data = array("status"=>"yes");
		$accept = $this->db->insert("relations", $data);
		
		if($accept)
			
		{
			return array("result"=>"yes", "message"=>"Your are now friends");
		}
		else
		{
			return array("result"=>"no", "message"=>"Network problem");
		}
	}

	function blockUser($relation_id)
	{
		$this->db->where("relation_id", $relation_id);
		$data = array("	blockUser"=>"yes");
		$block = $this->db->insert("relations", $data);
		if($block)
			
		{
			return array("result"=>"yes", "message"=>"has been 	blocked.");
		}
		else
		{
			return array("result"=>"no", "message"=>"Network problem");
		}
	}

	function getFriendsInfo($id = null)
	{
		$friends_data = array();
		if($id == null)
		{
			$freinds_ids = $this->getFriendsIds();
		}
		else
		{
			$freinds_ids = $this->getFriendsIds($id);
		}
		
		
		if(count($freinds_ids) > 0 )
		{
			foreach ($freinds_ids as $user_id) {
				$this->db->where("user_id", $user_id);
				$userdata = $this->db->get("user_details");
				array($friends_data, $userdata->row());
			}
		}

		return $friends_data;

	}

	function getFriendsIds($id = null)
	{
		if($id == null)
		{
			$user_id = $this->logged_user_id;
		}
		else
		{
			$user_id = $id;
		}
		$freinds_ids = array();
		$sql = "SELECT * FROM relations WHERE (resq_id= '".$user_id."' accept_id='".$user_id."') AND status='yes'";
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

	function checkIfNotFriends($user_id)
	{
		$sql = "SELECT COUNT(*) FROM relations WHERE (resq_id= '".$this->logged_user_id."' AND accept_id='".$user_id."') OR (resq_id= '".$user_id."' AND accept_id='".$this->logged_user_id."')";
		$getCount= $this->db->query($sql);
		if($getCount->num_rows() == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function killFriend()
	{

	}
}

