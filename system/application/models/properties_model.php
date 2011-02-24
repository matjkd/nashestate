<?php

class Properties_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	
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
	function delete_property($id)
	{
		//Delete Property
		$this->db->where('property_ref_no', $id);
		$this->db->delete('property_main');
		
		//Delete features with $id
		$this->db->where('property_id', $id);
		$this->db->delete('property_features');
		
		//Delete rooms with $id
		$this->db->where('property_id', $id);
		$this->db->delete('property_rooms');
		
		//Delete images with $id and remove from server
		$this->db->where('property_id', $id);
		$this->db->delete('property_images');
		
		
				
		
		//delete featured properties with $id
		$this->db->where('property_ref', $id);
		$this->db->delete('featured_properties');
		
		//delete premiere properties with $id
		$this->db->where('property_ref', $id);
		$this->db->delete('premiere_properties');
	}
	function check_id($id)
	{
		
		$this->db->where('property_ref_no', $id);
		$this->db->from('property_main');
		
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		return $rowcount;
		
		
		
		
	}
	
	function create_sales_data($id)
	{
		$new_sales_data = array(
				'property_id' => $id
		);
		$this->db->insert('sales_data', $new_sales_data);
		
			
		return;
	}
	
	function get_property($id)
	{
	$this->db->from('property_main');
	$this->db->join('company', 'company.company_id=property_main.company_id', 'left');	
	$this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');	
	$this->db->join('general_area', 'general_area.general_area_id=property_main.general_area', 'left');	
	$this->db->join('sales_data', 'sales_data.property_id=property_main.property_ref_no', 'left');	
	$this->db->where('property_ref_no', $id);
	$query = $this->db->get();
		
		if($query->num_rows == 1);
			{
				return $query->result();
			}
			
		return FALSE;
	}
	
	function get_contact_properties($id, $type)
	{
		$this->db->from('property_main');
		$this->db->where("property_main.".$type."", $id);
		$this->db->join('users', 'users.user_id=property_main.user_id', 'right');
		$this->db->where('archived', '0');
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
	
	function list_properties($type)
    {
    	
    	$data = array();
		$this->db->from('property_main');
		$this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');
		$this->db->join('company', 'company.company_id=property_main.company_id', 'left');
		
		
   		 if($type==99)
			{
				$this->db->where('archived', '1');
			}
		
		if($type==1)
			{
				$this->db->where('sale_rent', $type);
				$this->db->where('archived', '0');
			}
    	if($type==2)
			{
				$this->db->where('sale_rent', $type);
				$this->db->where('archived', '0');
			}
		if($type==0)
			{
				$this->db->where('archived', '0');
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
		'property_address5' => '',
		'user_id' => ''
		);
		return $new_array;
	}
	function change_owner($id, $new_owner)
	{
		
			$this->db->where('company_id', $new_owner);
			$query = $this->db->get('users');
			if($query->num_rows > 0);
			{
				foreach($query->result_array() as $row):
					
				$user_id = $row['user_id'];
					
				endforeach;
			}
					
		$form_data = array(
				
				'company_id' => $new_owner,
				'user_id' => $user_id
				
				);
		
		$this->db->where('property_ref_no', $id);
		$this->db->update('property_main', $form_data);
		
	
		
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
    				'property_type' => $this->input->post('property_type'),
    				'user_id' => $this->input->post('individuals')
    				
    				
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
	
	function change_property_ref($id, $newref)
	{
				$data1 = array(
               'property_ref_no' => $newref,
				);
				$data2 = array(
               'property_id' => $newref,
				);
				$data3 = array(
               'property_ref' => $newref,
				);
		
		//change property ref in property_main (property_ref_no)
		$this->db->where('property_ref_no', $id);
		$this->db->update('property_main', $data1); 
				
		//change proeprty ref on images (property_id)
		$this->db->where('property_id', $id);
		$this->db->update('property_images', $data2); 
		
		//change property ref on rooms (property id)
		$this->db->where('property_id', $id);
		$this->db->update('property_rooms', $data2); 
		
		//change property ref on features (property_id)
		$this->db->where('property_id', $id);
		$this->db->update('property_features', $data2); 
		
		//change proprty ref on featured properties (property_ref)
		$this->db->where('property_ref', $id);
		$this->db->update('featured_properties', $data3); 
		
		//change property ref on premiere properties (property_ref)
		$this->db->where('property_ref', $id);
		$this->db->update('premiere_properties', $data3); 
		
		return TRUE;
	}
	
	
	function edit_property1($id, $field, $value)
	{
		
	if($field == 'rent_price')
		{
			$this->db->from('property_main');
			$this->db->where('property_ref_no', $id);
			$Q = $this->db->get();
			if ($Q->num_rows() == 1)
				{
					foreach ($Q->result_array() as $row)
					
					if($row['rent_period'] == "Yearly")
					{
						$monthly_rent = $value/12;
						$rent_update = array(
											'monthly_rent' => $monthly_rent
											);
								$this->db->where('property_ref_no', $id);
								$update = $this->db->update('property_main', $rent_update);
					}
					
					if($row['rent_period'] == "Monthly")
					{
						$monthly_rent = $value;
						$rent_update = array(
											'monthly_rent' => $monthly_rent
											);
								$this->db->where('property_ref_no', $id);
								$update = $this->db->update('property_main', $rent_update);
					}
					
					
					if($row['rent_period'] == "Weekly")
					{
						$monthly_rent = ($value*52)/12;
						$rent_update = array(
											'monthly_rent' => $monthly_rent
											);
								$this->db->where('property_ref_no', $id);
								$update = $this->db->update('property_main', $rent_update);
					}
				}
		}
		
	if($field == 'rent_period')
		{
			$this->db->from('property_main');
			$this->db->where('property_ref_no', $id);
			$Q = $this->db->get();
			if ($Q->num_rows() == 1)
				{
					foreach ($Q->result_array() as $row)
					
					if($value == "Yearly")
					{
						$monthly_rent = $row['rent_price']/12;
						$rent_update = array(
											'monthly_rent' => $monthly_rent
											);
								$this->db->where('property_ref_no', $id);
								$update = $this->db->update('property_main', $rent_update);
					}
					
					if($value == "Monthly")
					{
						$monthly_rent =  $row['rent_price'];
						$rent_update = array(
											'monthly_rent' => $monthly_rent
											);
								$this->db->where('property_ref_no', $id);
								$update = $this->db->update('property_main', $rent_update);
					}
					
					
					if($value == "Weekly")
					{
						$monthly_rent = ($row['rent_price']*52)/12;;
						$rent_update = array(
											'monthly_rent' => $monthly_rent
											);
								$this->db->where('property_ref_no', $id);
								$update = $this->db->update('property_main', $rent_update);
					}
				}
		}
		
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

	function list_all_features()
	{
		//move this and reference to it to features model
		$data = array();
		$this->db->from('features');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	
	function list_features_property($id)
	{
		$data = array();
	
		$this->db->where('property_id', $id);
		$this->db->join('features', 'features.features_id=property_features.features_id', 'left');
		$Q = $this->db->get('property_features');
		if ($Q->num_rows() > 0) {
			
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
	
	function edit_images($id, $field, $value)
	{
		//move this to gallery model
		$update_data = array(
					$field => $value
					);
		$this->db->where('image_id', $id);
		$update2 = $this->db->update('property_images', $update_data);
		return $update2;
	}
	
	function edit_sales_data($id, $field, $value)
	{
		$update_data = array(
					$field => $value
					);
		$this->db->where('property_id', $id);
		$update = $this->db->update('sales_data', $update_data);
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
	function add_feature($id)
	{
		$feature = $this->input->post('feature');
		$data = array();
		$this->db->from('features');
		$this->db->where('features', $feature);
		$Q = $this->db->get();
		// check if feature exists, if not add it to database
		if ($Q->num_rows() < 1)
			{
				$new_feature_data = array(
				'features' => $feature,
				'features_category' => 0
			);
		
			$this->db->insert('features', $new_feature_data);
			}
			$Q->free_result();
			
		//now add feature to list of property features.	
		$this->db->from('features');
		$this->db->where('features', $feature);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)	
		{
			foreach ($Q->result_array() as $row)
			
			$new_property_feature_data = array(
				'features_id' => $row['features_id'],
				'property_id' => $id
		);
		$this->db->insert('property_features', $new_property_feature_data);
		}
			
		return;
	}
	
	
	function get_assigned_features($id)
	{
		$data = array();
		
		$this->db->where('property_id', $id);
		$this->db->join('features', 'features.features_id = property_features.features_id', 'left');
		$Q = $this->db->get('property_features');
		
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	function delete_assigned_feature($id)
	{
		//grab the property id before deleting feature, and return property id to controller
		$data = array();
		$this->db->select('property_id');
		$this->db->where('pf_id', $id);
		
		$Q = $this->db->get('property_features');
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		
		$this->db->where('pf_id', $id);
		$this->db->delete('ignite_property_features');
		
		return $data;
	}
	function archive_property($id)
	{
		
		$archive = array(
						'archived' => '1',
						'active' => '0'
						);
								
		
		$this->db->where('property_ref_no', $id);
		$this->db->update('property_main', $archive);
			
		if ($this->db->affected_rows() == '1')
		{
			
			return TRUE;
		}
		
		return FALSE;
	}
	function unarchive_property($id)
	{
		
		$archive = array(
						'archived' => '0',
						'active' => '0'
						);
								
		
		$this->db->where('property_ref_no', $id);
		$this->db->update('property_main', $archive);
			
		if ($this->db->affected_rows() == '1')
		{
			
			return TRUE;
		}
		
		return FALSE;
	}
	function make_featured($id, $date)
	{

		
		$new_featured_property = array(
				'date_featured' => $date,
				'property_ref' => $id
		);
		
		$this->db->insert('featured_properties', $new_featured_property);
		
			
		
		return;
	}
	
	function list_featured_properties($id)
	{
		
		$data = array();
		
		$this->db->where('property_ref', $id);
		$Q = $this->db->get('featured_properties');
		
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	function delete_featured_property($id)
	{
		
		$this->db->where('featured_property_id', $id);
		$Q = $this->db->get('featured_properties');
			if ($Q->num_rows() > 0) 
				{
					foreach ($Q->result_array() as $row)
						{
							$data[] = $row;
						}
				}
		$Q->free_result();
		$this->db->delete('featured_properties', array('featured_property_id' => $id)); 	
		return $data;
	}
	function get_featured_property()
	{
		$time = time();
		$this->db->from('featured_properties');
		$this->db->order_by('date_featured', 'desc');
		$this->db->where('date_featured <', $time);
		$this->db->where('sale_rent', 1);
		$this->db->limit('1');
		$this->db->join('property_main', 'property_main.property_ref_no=featured_properties.property_ref', 'left');
		$this->db->join('property_images', 'property_images.property_id=featured_properties.property_ref', 'left');
		$this->db->where('property_main.active', 1);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
				$Q->free_result();
				return $data;
			}
		}
		
		
	}
	
	function get_featured_rental()
	{
		$time = time();
		$this->db->from('featured_properties');
		$this->db->order_by('date_featured', 'desc');
		$this->db->where('date_featured <', $time);
		$this->db->where('sale_rent', 2);
		$this->db->limit('1');
		$this->db->join('property_main', 'property_main.property_ref_no=featured_properties.property_ref', 'left');
		$this->db->join('property_images', 'property_images.property_id=featured_properties.property_ref', 'left');
		$this->db->where('property_main.active', 1);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
				$Q->free_result();
				return $data;
			}
		}
		
		
	}
	
	function make_premiere($id, $datestart, $dateend)
	{

		
		$new_premiere_property = array(
				'date_featured' => $datestart,
				'date_ends' => $dateend,
				'property_ref' => $id
		);
		
		$this->db->insert('premiere_properties', $new_premiere_property);
		
			
		
		return;
	}
	function next_property($id)
	{
		$this->db->select('property_ref_no');
		$this->db->from('property_main');
		$this->db->order_by('property_ref_no', 'asc');
		$this->db->where('property_ref_no >', $id);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			
			$data = $row['property_ref_no'];
			return $data;
		}
		$Q->free_result();
		
	}
	
	function previous_property($id)
	{
		$this->db->select('property_ref_no');
		$this->db->from('property_main');
		$this->db->order_by('property_ref_no', 'desc');
		$this->db->where('property_ref_no <', $id);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{
			foreach ($Q->result_array() as $row)
			
			$data = $row['property_ref_no'];
			return $data;
		}
		$Q->free_result();
		
	}
	
	function list_premiere_properties($id)
	{
		
		$data = array();
		
		$this->db->where('property_ref', $id);
		$Q = $this->db->get('premiere_properties');
		
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	function delete_premiere_property($id)
	{
		$this->db->where('premiere_property_id', $id);
		$Q = $this->db->get('premiere_properties');
			if ($Q->num_rows() > 0) 
				{
					foreach ($Q->result_array() as $row)
						{
							$data[] = $row;
						}
				}
		$Q->free_result();
		$this->db->delete('premiere_properties', array('premiere_property_id' => $id)); 	
		return $data;
	}
	
	function add_rooms($room_id, $number_of_rooms, $property_id)
	{
		//add something to check rooms haven't already been added
		
		
		// add room to property_rooms
		// room_type is $room_id, property_id is $property_id.
		// Repeat $number_of_rooms times
		$x = 0;
	 	while($x < $number_of_rooms)
	 	{
			$new_room = array(
				'room_type' => $room_id,
				'property_id' => $property_id,
						
			);
			
			
			$this->db->insert('property_rooms', $new_room);
			$x=$x+1;
	 	}
		
	}
	
	
}
