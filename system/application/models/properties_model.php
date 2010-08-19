<?php

class Properties_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function create_property($form_data)
	{
		$this->db->insert('property_main', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			
			return TRUE;
		}
		
		return FALSE;
	}
	function create_property_id($id, $data)
	{
		
		$this->db->insert($id, $data);
		
		if ($this->db->affected_rows() == '1')
		{
			
			return TRUE;
		}
		
		return FALSE;
	}
	function get_property($id)
	{
	$this->db->from('property_main');
	$this->db->join('company', 'company.company_id=property_main.company_id', 'left');	
	$this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');	
	$this->db->join('general_area', 'general_area.general_area_id=property_main.general_area', 'left');	
	$this->db->where('property_ref_no', $id);
	$query = $this->db->get();
		
		if($query->num_rows == 1);
			{
				return $query->result();
			}
			
		return FALSE;
	}
	function list_properties($type)
    {
    	
    	$data = array();
		$this->db->from('property_main');
		$this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');
		$this->db->join('company', 'company.company_id=property_main.company_id', 'left');
		
		if($type==1)
			{
				$this->db->where('sale_rent', $type);
			}
    	if($type==2)
			{
				$this->db->where('sale_rent', $type);
			}
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
	function get_empty_property()
	{
		$new_array = array();
	
		$new_array[] = (object) array(
		'sale_rent' => '',
		'property_type' => '',
		'property_address1' => '',
		'property_address2' => '',
		'property_address3' => '',
		'property_address4' => '',
		'property_address5' => ''
		);
		return $new_array;
	}
	function update_property1()
	{
		
		$property_id = $this->input->post('property_id');
			
    				$form_data = array(
    			
					'property_address1' => $this->input->post('property_address1'),
    				'property_address2' => $this->input->post('property_address2'),
    				'property_address3' => $this->input->post('property_address3'),
    				'property_address4' => $this->input->post('property_address4'),
    				'property_address5' => $this->input->post('property_address5'),
    				'property_type' => $this->input->post('property_type')
    				
    				
					);
		
		
		$this->db->where('property_ref_no', $property_id);
		$this->db->update('property_main', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			
			return TRUE;
		}
		
		return FALSE;
	}
	function update_property2($id)
	{
		
		$this->db->where('property_id', $id);
		$this->db->delete('property_features');
		
		if (count($_POST['features'])){
			foreach ($_POST['features'] as $value)
			{
				$data = array(
					'property_id' => $id,
					'features_id' => $value
				);
				$this->db->insert('property_features', $data);
			}
		}
	
		$form_data = array(
    					'description' => $this->input->post('description'),
    					);
		
		$this->db->where('property_ref_no', $id);
		$this->db->update('property_main', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
			
    	
		
	}
	function update_property3()
	{
		
	}
	
	
	function edit_property1($id, $field, $value)
	{
		$user_update_data = array(
					$field => $value
					);
		$this->db->where('property_ref_no', $id);
		$update = $this->db->update('property_main', $user_update_data);
		return $update;
	}
	
	function property_types()
	{
		$data = array();
		$this->db->from('property_types');
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function get_property_type($id)
	{
		$data = array();
		$this->db->from('property_types');
		$this->db->where('property_type_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function get_general_area($id)
	{
		$data = array();
		$this->db->from('general_area');
		$this->db->where('general_area_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	
	
	function features($id)
	{
		$data = array();
		$this->db->from('features');
		$this->db->where('features_category', $id);
		$this->db->or_where('features_category', 0);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function list_rooms()
	{
		$data = array();
		$this->db->from('rooms');
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function list_additional()
	{
		$data = array();
		$this->db->from('rooms_additional');
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function get_rooms_table($id)
	{
		$this->db->from('property_rooms');
		$this->db->where('property_id', $id);
		$this->db->join('rooms', 'rooms.room_id=property_rooms.room_type', 'left');	
		$this->db->join('rooms_additional', 'rooms_additional.additional_id=property_rooms.room_additional', 'left');	
		$this->db->order_by('room_type', 'asc');
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
	
	function room_insert_row($id)
	{
		$new_room_table_data = array(
			'property_id' => $id
			);
		
			$this->db->insert('property_rooms', $new_room_table_data);
			
			return TRUE;
	}
	function delete_room_row($id)
	{
		$this->db->where('property_room_id', $id);
		$this->db->delete('property_rooms');
		return TRUE;
	}
	
	function edit_room($id, $field, $value)
	{
		$update_data = array(
					$field => $value
					);
		$this->db->where('property_room_id', $id);
		$update = $this->db->update('property_rooms', $update_data);
		return $update;
	}
	function get_room_type($id)
	{
		$data = array();
		$this->db->from('rooms');
		$this->db->where('room_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function get_additional_type($id)
	{
		$data = array();
		$this->db->from('rooms_additional');
		$this->db->where('additional_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	
	function get_assigned_features($id)
	{
		$data = array();
		$this->db->select('features_id');
		$this->db->where('property_id', $id);
		$Q = $this->db->get('property_features');
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row['features_id'];
			}
		}
		$Q->free_result();
		return $data;
	}
}
