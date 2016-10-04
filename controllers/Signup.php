<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup  extends CI_Controller {

	public $code, $referer_id, $email;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model("User_model");
		$this->code = $this->uri->segment(3);
		$this->referer_id = $this->uri->segment(4);
		$this->email = $this->uri->segment(5);
		
	}

	public function index()
	{
		$data = array();
		if(	 !empty( $this->code )  &&  !empty( $this->referer_id ) && !empty( $this->email ) )
		{
			$data["result"] = true;
			$this->load->view("signup", $data);
		}
		else
		{
			$data["result"] = false;
			$this->load->view("signup", $data) ;
		}
		
	}

	function signup()
	{
		echo "this is sin(arg) ";
	}
}


