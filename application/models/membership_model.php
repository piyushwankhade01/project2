<?php

class membership_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		
		$query = $this->db->get('users');
		
		if($query->num_rows==1)
		{
			return TRUE;
		}
			
	}
	
	public function create_member()
	{
		$username = $this->input->post('username');
		
		$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
		);
		
		$insert = $this->db->insert('users',$new_member_insert_data);
		return $insert;
	}
}

?>
