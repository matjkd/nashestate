<?php

class Membership_model extends Model {

	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
		{
			return true;
		}
		
	}
	function create_company()
	{
		$new_company = array (
			'company_name' => $this->input->post('company_name')
		);
		$insert = $this->db->insert('company', $new_company);
		return $insert;
	}
	function get_companies()
	{
		$data = array();
		$Q = $this->db->get('company');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			$data[] = $row;
		}
		$Q->free_result();
		return $data;
	}
	function get_company_detail($id)
	{
		$data = array();
		$this->db->where('company_id', $id);
		$Q = $this->db->get('company');
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			$data[] = $row;
			
		
		}
		$Q->free_result();
		
		return $data;
	
	}
	function delete_company($id)
	{
		$tables = array('company','users');
		$this->db->where('company_id', $id);
		$this->db->delete($tables); 
	}
	function get_employees($id)
	{
			$data = array();
			$this->db->where('company_id', $id);
			$query = $this->db->get('users');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				$data[] = $row;
			}
			$query->free_result();
			
			return $data;
		
	}
	function create_member()
	{
		
		$new_member_insert_data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'email_address' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'company_id' => $this->input->post('company_id'),
		
		);
		
		$insert = $this->db->insert('users', $new_member_insert_data);
		return $insert;
	}
	
	function update_password($id)
	{
		$this->db->where('user_id', $id);
		$new_member_update_data = array(
			
			'password' => md5($this->input->post('password'))
		
		
		);
		
		$insert = $this->db->update('users', $new_member_update_data);
		
		
		return $insert;
	}
	
	function get_user($id)
	{
		$data = array();
		$this->db->where('user_id', $id);
			$query = $this->db->get('users');
			if ($query->num_rows() == 1)
			{
				foreach ($query->result_array() as $row)
				$data[] = $row;
			}
		$query->free_result();
		
		return $data;
	}
	function edit_user($id, $field, $value)
	{
		
		$member_update_data = array(
					$field => $value
					);
		$this->db->where('user_id', $id);
		$update = $this->db->update('users', $member_update_data);
		return $update;
	}
	function delete_user($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('users');
	}


	

}