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
		
		$query = $this->db->get();
		
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
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