<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login  extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model("Likes");
		$this->load->model("Comments");
		$this->load->model("User_model");
		$this->load->model("Messages_model");
		$this->load->model("Search_model");
		$this->load->model("Posts_model");
		$this->load->model("Relation_model");
		
	}

	public function index()
	{
		$this->load->view("login");

	}

	function login()
	{
		echo "this is login ";
	}
	function logout()
	{
		redirect(base_url()."Login/login");
	}
}


