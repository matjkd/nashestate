<?php

class Import_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	
	function get_old_properties()
	{
		$this->db->from('Propiedades');
		
		$this->db->where('Propiedades.imported', NULL);
		$this->db->or_where('Propiedades.imported', '1');
		$this->db->or_where('Propiedades.imported', '2');
		$this->db->join('general_area', 'general_area.area = Propiedades.address', 'left');	
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
	}
	function get_old_areas()
	{
		$this->db->from('Localidades');
		$query = $this->db->get();
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
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
	
	function select_rentals()
	{
		$this->db->from('property_main');
		
		$this->db->like('property_ref_no', 'R'); 
		$this->db->where('sale_rent <', 2);
		$query = $this->db->get();
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
		
		
	}
	function select_sales()
	{
		$this->db->from('property_main');
		
		$this->db->not_like('property_ref_no', 'R', 'after'); 
		$this->db->where('sale_rent !=', 1);
		//$this->db->or_where('sale_rent', 0);
		
		$query = $this->db->get();
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
		
		
	}
	function change_rentals($id)
	{
		$form_data = array(
				
				'sale_rent' => 2
			
				);
		
		$this->db->where('property_id', $id);
		$this->db->update('property_main', $form_data);
	}
	
	function change_sales($id)
	{
		$form_data = array(
				
				'sale_rent' => 1
			
				);
		
		$this->db->where('property_id', $id);
		$this->db->update('property_main', $form_data);
	}
	function update_address($id, $address)
	{
						
				$form_data = array(
				
				'address' => $address
			
				);
		
		$this->db->where('id_property', $id);
		$this->db->update('Propiedades', $form_data);
	}
	function mark_imported($id)
	{
		$form_data = array(
				
				'imported' => 4
			
				);
		
		$this->db->where('id_property', $id);
		$this->db->update('Propiedades', $form_data);
	}
}