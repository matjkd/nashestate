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
	
	function search_sales()
	{
		
	}
	
	function search_rentals()
	{
		
	}
}