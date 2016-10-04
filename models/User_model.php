<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
	// `user_id`, `referer_id`, `referer_code`, `password`, `username`, `phone`, `email`, `created_date`
	function sellCode()
	{
		$feild_for_the_code = $this->input->post("code_field");
		$referer_code = $this->get_code_string($this->input->post("code_field"));
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$referer_id =  $this->input->post("referer_id");
		$created_date = time();

		$data = array("referer_code"=>$referer_code, "email"=>$email, "phone"=>$phone , "referer_id"=>$referer_id, "created_date"=>$created_date);
		if(!empty($referer_code))
		{
				if( $this->checkEmailOrPhone($email, $phone) ){
				$code_sold = $this->db->insert("credentials" , $data);
				if($code_sold)
				{
				if($this->removeCode($feild_for_the_code))
				{
					return array("result"=>"yes", "message"=>"Code was sold Please use your client to check their email to registered");
				//send email here.....
				}
				else
				{
					return array("result"=>"no", "message"=>"Code was not sold  sold Please  ptry again");
				}
				}
				else
				{
					return array("result"=>"no", "message"=>"Error selling code");
				}
				}
				else
				{
				//send seller message that user already exists....
					return array("result"=>"no", "message"=>"Person alreday in database");
				}
		}
		else
		{
				return array("result"=>"no", "message"=>"code is empty Please buy more or sell another ");
		}
	}

	function checkEmailOrPhone($email, $phone)
	{
		if( !empty($email) )
		{
			$this->db->where("email", $email);
		}

		if( !empty($phone) )
		{
			$this->db->where("phone", $phone);
		}

		$row = $this->db->get("credentials");

		$user = $row->row();
		if(count($user)== 1 )
		{
			return false;
		}
		else
		{
			return true; 
		}
	}

	function removeCode($feild_for_the_code)
	{
        //getting the code cleared after selling
		$user_id =$this->session->userdata("user_id");
		$user_id = $this->db->where("user_id", $user_id);
		$data = array($feild_for_the_code =>"");
		$update  =  $this->db->update("user_codes", $data );
		if($update)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_code_string($feild_for_the_code)
	{
		$user_id =$this->session->userdata("user_id");
		$user_id = $this->db->where("user_id", $user_id);
		$response  = $this->db->get("user_codes");
		$code  =  $response->row();
		return $code->$feild_for_the_code;
	}

	function signup_user()
	{
		$referer_id = $this->uri->segment(3);
		$code = $this->uri->segment(4);
		$password = sha1($this->input->post("password"));
		$username =$this->input->post("username");
		$phone  = $this->input->post("phone");
		$email = $this->input->post("email");
		$data = array("password"=>$password, "phone"=>$phone, "email"=>$email, "username"=>$username);
		$this->db->where("referer_code", $referer_code);
		$this->db->where("referer_id", $referer_id );
		$response = $this->db->get("credentials");
		$information = $response->row();
		if(empty($information->username))
		{
			$this->db->where("referer_code", $referer_code);
			$this->db->where("referer_id", $referer_id );
			$update = $this->db->update("credentials", $data);
			if($update)
			{
				//create first friend here
				$this->db->insert("relations", array("resq_id"=>$information->user_id, "accept_id"=>$referer_id, "relation_date"=> time(), "status"=>"yes", "seen"=>"yes"));
				$session_data = array("user_id"=>$row->user_id, "referer_id"=>$referer_id , "username"=>$username, "phone"=>$phone, "email"=>$email, "isLoggedIn"=>true);
				$this->session->set_userdate($session_data);

				return  array('login' =>'yes', "message"=>"welcome to microx.");
				
			}
			else
			{
				//failed to update
				return  array('login' =>'no', "message"=>"User alreday exits.");
			}

		}else{

			return  array('login' =>'no', "message"=>"sorry an error occured.");
		}
	}

	function login_user()
	{
		$password =  sha1($this->input->post("password"));
		$email = $this->input->post("email");
		$this->db->where("password", $password);
		$this->db->where("email", $email);
		$getData = $this->db->get("credentials");
		$row = $getData->row();
		if($getData->num_rows() == 1 )
		{
			$session_data = array("user_id"=>$row->user_id, "referer_id"=>$row->referer_id, "username"=>$row->username, "phone"=>$row->phone, "email"=>$row->email, "isLoggedIn"=>true);
			$this->session->set_userdate($session_data);
			return  array('login' =>'yes', "message"=>"welcome back to microx.");

		}else{
			if( $row->password != $password )
			{
				//password provided is wrong
				return  array('login' =>'no', "message"=>"Wrong password and email combination.");
			}
			else if( $row->email != $email)
			{
				//email is wrong..
				return  array('login' =>'no', "message"=>"Wrong email and password combination.");
			}
		}
	}

	function getUserInfo($user_id)
	{
		$this->db->select("*");
		$this->db->from("credentials");
		$this->db->join("user_details", 'user_details.user_id=credentials.user_id');
		$this->db->where("user_details.user_id", $user_id);
		$data = $this->db->get();
		return $data->row();
	}

	function getCode()
	{
		$logged_user_id = $this->session->userdata("user_id");
		$this->db->where("user_id", $logged_user_id );
		$data = $this->db->get("user_codes");
		if($data->num_rows() == 1 )
		{
			return $data->row();
		}
		else
		{
			return array();
		}
	}

}

