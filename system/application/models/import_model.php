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
		$this->db->join('general_area', 'general_area.area = Propiedades.address', 'left');	
		$this->db->limit(20);
		$query = $this->db->get();
		
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
	}
	
	function add_rooms($room_id, $number_of_rooms, $property_id)
	{
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
	function update_address($id, $address)
	{
						
				$form_data = array(
				
				'address' => $address
			
				);
		
		$this->db->where('id_property', $id);
		$this->db->update('Propiedades', $form_data);
	}
}