<?php

class login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('login_form');
	}
	
	public function signup()
	{
		$this->load->view('signup_form');
	}
	
	
	public function login_validation()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email','Email','required');
		
		$this->form_validation->set_rules('password','Password','required|md5|trim');
		
		if ($this->form_validation->run())
		{
			redirect('main/members');			
		}
		else
		{
			$this->load->view('login');
		}
	}
	
	
	public function  validate_credentials()
	{
		
		
		$this->load->model('membership_model');
		
		$query = $this->membership_model->validate();
		
		if($query)
		{
			$data = array(
					'username'=>$this->input->post('username'),
					'is_logged_in'=>TRUE
			);
			
			$this->session->set_userdata($data);
			redirect('site/members_area');
		}
		else 
		{	
			echo 'invalid username/password';
			$this->index();
		}
	}
	
	public function create_member()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name','Firstname','required|trim');
		$this->form_validation->set_rules('last_name','Lastname','required|trim');
		$this->form_validation->set_rules('email','Email Address','required|trim|callback_check_if_email_exists');
		$this->form_validation->set_rules('username','Username','required|trim|min_length[4]|callback_check_if_username_exists');
		$this->form_validation->set_rules('password','Password','required|trim|min_length[4]');
		$this->form_validation->set_rules('password_confirm','Confirm Password ','required|trim|matches[password]');
		
		if ($this->form_validation->run())
		{
			$this->load->model('membership_model');
			
			if ($query = $this->membership_model->create_member())
			{
				$data['account created']='your account has been created';
				$this->load->view('login_form');
			
			}
			else 
			{
				echo 'can not create your account';
				$this->load->view('signup_form');
			}
	
		}
		else 
		{
			$this->load->view('signup_form');
		}
		
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('is_logged_in');
		redirect('login');
	}
	
	
}
	

?>
