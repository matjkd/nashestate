<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends Model {
	
	
	
function __construct()
    {
        parent::__construct();
    }

    function list_contacts()
    {
    	$data = array();
		$this->db->from('users');
		$this->db->join('company', 'company.company_id=users.company_id', 'right');
		$this->db->join('company_types', 'company_types.type_id=company.company_type_id', 'left');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
    function get_contact($id)
    {
    	$data = array();
		$this->db->from('users');
		$this->db->join('company', 'company.company_id=users.company_id', 'right');
		$this->db->join('company_types', 'company_types.type_id=company.company_type_id', 'right');
		$this->db->where('user_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
  function get_company($id)
    {
    	$data = array();
		$this->db->from('company');
		$this->db->join('company_types', 'company_types.type_id=company.company_type_id', 'right');
		$this->db->where('company_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
    
    function create_contact()
    {
    $new_company_insert_data = array(
			'company_name' => $this->input->post('company_name'),
			'company_desc' => $this->input->post('company_desc'),
			'company_phone' => $this->input->post('company_phone'),
			'company_fax' => $this->input->post('company_fax'),			
			'company_email' => $this->input->post('company_email'),
			'company_website' => $this->input->post('company_website'),
			'company_type' => $this->input->post('company_type')
			
		);
		
		
		$this->db->insert('companies', $new_company_insert_data);
		$this->db->from('companies');
		$this->db->select('idcompany');
		$this->db->where('company_name', $this->input->post('company_name'));
		$data = $this->db->get();
		if($data->num_rows == 1)
			{
				return $data->result();
			}
    }
function edit_user($id, $field, $value)
	{
		$user_update_data = array(
					$field => $value
					);
		$this->db->where('user_id', $id);
		$update = $this->db->update('users', $user_update_data);
		return $update;
	}
function edit_company($id, $field, $value)
	{
		$company_update_data = array(
					$field => $value
					);
		$this->db->where('company_id', $id);
		$update = $this->db->update('company', $company_update_data);
		return $update;
	}
	function edit_address($id, $field, $value)
		{
			$address_update_data = array(
						$field => $value
						);
			$this->db->where('company_address_id', $id);
			$update = $this->db->update('company_address', $address_update_data);
			return $update;
		}
	function edit_contact_detail($id, $field, $value)
		{
			$contact_update_data = array(
						$field => $value
						);
			$this->db->where('company_contact_id', $id);
			$update = $this->db->update('company_contact', $contact_update_data);
			return $update;
		}
	function add_user()
		{
			//add validation here
			$id_company = $this->input->post('id_company');
			
			$new_user_insert_data = array(
				'company_id' => $id_company,
				'firstname' => $this->input->post('first_name'),
				'lastname' => $this->input->post('last_name'),
				'short_desc' => $this->input->post('short_desc')
			);
			
			$this->db->insert('users', $new_user_insert_data);
			
		}
	
	function quick_add_user($id)
		{
			//add validation here
			$id_company = $id;
			
			$new_user_insert_data = array(
				'company_id' => $id_company,
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname')
			);
			
			$this->db->insert('users', $new_user_insert_data);
			
			$results['user_id'] = $this->db->insert_id();
			
			$data[] = $results;
			
			return $data;
			
		}
	function get_users($id)
		{
			$this->db->where('company_id', $id);
			$query = $this->db->get('users');
			if($query->num_rows > 0);
			{
				return $query->result();
			}
		}
		
	function make_main_user($id, $company)
		{
			$main_user_update = array(
						'main_user' => $id
						);
			$this->db->where('company_id', $company);
			$update = $this->db->update('company', $main_user_update);
			return $update;
		}
	function add_company()
	{

		$company_name = $this->input->post('company_name');
		
		if($company_name == "N/A")
		{
			$company_name =  "".$this->input->post('firstname')." ".$this->input->post('lastname')."s Group";
		}
		else
		{
			$company_name = $this->input->post('company_name');
		}
		$new_company_insert_data = array(
			'company_name' =>  $company_name,
			'company_type_id' =>  $this->input->post('company_type'),
			'added_by' => $this->session->userdata('user_id'),
			'date_added' => unix_to_human(now(), TRUE, 'eu')
		);
		
			$this->db->insert('company', $new_company_insert_data);
		
		
			$results['company_id'] = $this->db->insert_id();
			
			$data[] = $results;
			
		
		
		
		
		return $data;
		
	}
function add_address()
	{
	//add validation here	
		$id_company = $this->input->post('id_company');
		
		$new_address_insert_data = array(
			'company_id' => $id_company,
			'company_address1' => $this->input->post('address1'),
			'company_address2' => $this->input->post('address2'),
			'company_address3' => $this->input->post('address3'),
			'company_address4' => $this->input->post('address4'),
			'company_address5' => $this->input->post('postcode'),
			'company_userid' => $this->input->post('company_userid')
		);
		
		$this->db->insert('company_address', $new_address_insert_data);
		
		
	
	}
function add_contact_detail()
	{
		//add validation  here	
		$id_company = $this->input->post('id_company');
		
		$new_contact_insert_data = array(
			'company_id' => $id_company,
			'company_contact_type' => $this->input->post('contact_type'),
			'company_contact_detail' => $this->input->post('contact_detail'),
			'company_userid' => $this->input->post('company_userid')
		);
		
		$this->db->insert('company_contact', $new_contact_insert_data);
		
		
	
	}
function add_contact_detail2($type, $value, $company_id, $userid)
	{
		//add validation  here	
		
		
		$new_contact_insert_data = array(
			'company_id' => $company_id,
			'company_contact_type' => $type,
			'company_contact_detail' => $value,
			'company_userid' => $userid
		);
		
		$this->db->insert('company_contact', $new_contact_insert_data);
		
		
	
	}
function get_addresses($id, $type)
	{
		$this->db->from('company_address');
		$this->db->where('company_address.'.$type.'', $id);
		
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
	}	
function get_contact_details($id, $type)
	{
		$this->db->from('company_contact');
		$this->db->where("company_contact.".$type."", $id);
		$this->db->join('users', 'users.user_id = company_contact.company_userid', 'left');
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
	}
function get_address($id)
	{
	
		
		$this->db->where('company_address_id', $id);
		$query = $this->db->get('company_address');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
function get_contact_detail($id)
	{
	
		
		$this->db->where('company_contact_id', $id);
		$query = $this->db->get('company_contact');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
function get_company_users($id)
	{
		$this->db->from('users');
		$this->db->where('users.company_id', $id);
		
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
	}
function delete_address($id_address) 
	{
		$this->db->where('company_address_id', $id_address);
		$this->db->delete('company_address');
		
		
		return TRUE;
		
	}	
function delete_contact_detail($id_contact) 
	{
			
		$this->db->where('company_contact_id', $id_contact);
		$this->db->delete('company_contact');
		
		return TRUE;
		
	}
function delete_user($id) 
	{
		$this->db->where('user_id', $id);
		$this->db->delete('users');
		
		return TRUE;
		
	}
function delete_company($id) // group id
	{
		//delete all addresses associated with company(group)
		$this->delete_address($id);
		
		//delete contact details, like phonenumbers etc
		$this->delete_contact_detail($id);
		
		//delete group
		$this->db->where('company_id', $id);
		$this->db->delete('company');
		
		
		return TRUE;
		
	}		
	
}