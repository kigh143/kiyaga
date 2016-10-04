<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search_model extends CI_Model {
	
	public $logged_user_id;
	function __construct()
	{
		parent::__construct();
		$this->logged_user_id = $this->session->userdata("user_id");
	}

	
}

