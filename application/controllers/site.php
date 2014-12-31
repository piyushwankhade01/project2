<?php

class Site extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function members_area()
		{
		$this->load->view('members_area');
	}
}


?>
