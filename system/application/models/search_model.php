<?php

class Search_model extends Model {

	function __construct()
	{
		parent::Model();
	}

	function search()
	{
		$new_search_data = array(
    				'bedrooms' => $this->input->post('beds'),
					'purchase' => $this->input->post('ammount'),
					'rent' => $this->input->post('rent')
		);
	}
	
	function search_sales($from, $to, $beds)
	{
		$data = array();
		$this->db->from('property_main'); 				// main property details
		$this->db->where('sale_rent', 1); 				//select only entries that are for sale
		$this->db->where('active', 1); 					//select if property is active
		$this->db->where('archived', 0); 					//select if property has not been archived
		$this->db->join('property_images', 'property_images.property_id = property_main.property_ref_no', 'left'); 		// link to images table
		$this->db->group_by('property_main.property_ref_no');
		if ($to > 0) 									// if a top price is selected else make it unlimited
				{
						$search = "sale_price <= $to AND $from <= sale_price"; 
						$this->db->where($search);
				}
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row):
				
				$this->db->from('property_rooms'); 
				$this->db->where('property_id', $row['property_ref_no']);
				$this->db->where('room_type', 1);
				$room_count = $this->db->count_all_results();
				
				$row2 = array(
				'rooms' => $room_count
				);
				
				
				$row3 = array_merge($row, $row2);
				
				$data[] = $row3;
			endforeach;
		}
		
		$Q->free_result();
		return $data;
	}
	
	function search_rentals($from, $to)
	{
		
		
		
		$data = array();
		$this->db->from('property_main');
		$this->db->where('sale_rent', 2);
		$this->db->where('active', 1);
		$this->db->where('archived', 0); 					//select if property has not been archived
		$this->db->join('property_images', 'property_images.property_id = property_main.property_ref_no', 'left');
		$this->db->group_by('property_main.property_ref_no');
		
		if ($to > 0)
				{
					$search = "monthly_rent <= $to AND $from <= monthly_rent";
					$this->db->where($search);
				}
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row):
				
				
				$this->db->from('property_rooms'); 
				$this->db->where('property_id', $row['property_ref_no']);
				$this->db->where('room_type', 1);
				$room_count = $this->db->count_all_results();
				
				$row2 = array(
				'rooms' => $room_count
				);
				
				
				$row3 = array_merge($row, $row2);
				
				$data[] = $row3;
			endforeach;
			
		}
		
		$Q->free_result($from, $to);
		return $data;
	}
	
	

}