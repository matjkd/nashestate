<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
	
	function find_group($area)
	{
		
		$this->db->select('group_id');	
		$this->db->from('general_area_link');
		$this->db->where('area_id', $area); 
		$Q = $this->db->get();	
		if ($Q->num_rows() > 0)
		{
			return $Q->result();
		}
		
		
	}
	
	function search_sales($from, $to, $beds, $maxbeds, $area)
	{
		$data = array();
		
		$this->db->from('property_main'); 				// main property details
		$this->db->where('property_main.sale_rent', 1); 				//select only entries that are for sale
		$this->db->where('property_main.active', 1); 					//select if property is active
		$this->db->where('property_main.archived', 0); 				//select if property has not been archived
		$this->db->where('property_images.print_order', 0); 
		
		$this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');	//link to property type table
		$this->db->join('general_area', 'general_area.general_area_id = property_main.general_area', 'left'); 		//link to areas table
		$this->db->join('general_area_link', 'general_area_link.area_id = property_main.general_area', 'left'); 		//link to areas-groups link table
		$this->db->join('property_images', 'property_images.property_id = property_main.property_ref_no', 'left'); 		// link to images table
		
		$this->db->order_by('property_main.sale_price', 'asc'); 		// order by price
		
		$this->db->group_by('property_main.property_ref_no');			//groups by property ref so i get a listing per property rather than per image
		
		//if area is not any search by area also
		if($area != "any")
		{
				
			//find out group ids
			//$groups = $this->search_model->find_group($area);	
				
			$this->db->where('general_area.general_area_id', $area); 	
			
		}
		
		if ($to > 0) 			// if a top price is selected else make it unlimited
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
	
	function search_rentals($from, $to, $beds, $maxbeds, $area)
	{
		$data = array();
		$this->db->from('property_main');
		$this->db->where('sale_rent', 2);
		$this->db->where('active', 1);						//if property is active
		$this->db->where('archived', 0); 					//select if property has not been archived
		$this->db->order_by('monthly_rent', 'asc'); 						// order by price
		$this->db->where('property_images.print_order', 0); 
	
		$this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');	//link to property type table
		$this->db->join('general_area', 'general_area.general_area_id = property_main.general_area', 'left'); 		//link to areas table
		$this->db->join('general_area_link', 'general_area_link.area_id = property_main.general_area', 'left'); 		//link to areas-groups link table
		$this->db->join('property_images', 'property_images.property_id = property_main.property_ref_no', 'left'); 		// link to images table
		
		if($area != "any")
		{
				
			//find out group ids
			//$groups = $this->search_model->find_group($area);	
				
			$this->db->where('general_area.general_area_id', $area); 	
			
		}
		
		$this->db->group_by('property_main.property_ref_no');
		
		if ($to > 0) // if a top price is selected else make it unlimited
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