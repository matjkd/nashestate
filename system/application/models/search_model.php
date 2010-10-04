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
	
	function search_sales($from, $to)
	{
		$data = array();
		$this->db->from('property_main');
		$this->db->where('sale_rent', 1);
		
		if ($to > 0)
				{
						$search = "sale_price <= $to AND $from <= sale_price";
						$this->db->where($search);
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
	
	function search_rentals($from, $to)
	{
		
		
		
		$data = array();
		$this->db->from('property_main');
		$this->db->where('sale_rent', 2);
		
		if ($to > 0)
				{
					$search = "rent_price <= $to AND $from <= rent_price";
					$this->db->where($search);
				}
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result($from, $to);
		return $data;
	}
	
	

}