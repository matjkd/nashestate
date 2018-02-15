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
		$data = array();

		$this->db->from('general_area_group');
		$this->db->where('group_name', $area);
		$Q = $this->db->get();
		if ($Q->num_rows() == 1)
		{


			foreach ($Q->result_array() as $row)

				$data[] = $row;
			 

		}
		$Q->free_result();
		return $data;



	}

	function getareas($groupid)
	{
		$data = array();

		$this->db->from('general_area_link');
		$this->db->where('group_id', $groupid);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{


			foreach ($Q->result_array() as $row)

				$data[] = $row;

		}

		$Q->free_result();
		return $data;

	}

	function search_sales($from, $to, $beds, $maxbeds, $area, $nearby)
	{

		//find out group ids. First get group idwith area id
		if($area != "any")
		{
			$areaGroup = $this->find_group($area);

			foreach($areaGroup as $row):


			$groupID = $row['general_area_group_id'];

			endforeach;

			if(isset($groupID)){
				$relatedAreas = $this->getareas($groupID);
				
			}
		}
		

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

		if ($to > 0) 			// if a top price is selected else make it unlimited
		{
			$search = "sale_price <= $to AND $from <= sale_price";
			$this->db->where($search);

		}


		//if area is not "any", search by area also
		if($area != "any")
		{

				


			//if nearby is set just search nearby locations, if not search main location
			if($nearby == 0){
				$this->db->where('general_area.general_area_id', $area);
			}

			if($nearby == 1){
				$x = 1;
				if(isset($relatedAreas)) {

					foreach($relatedAreas as $row2):

					$otherAreas[] = $row2['area_id'];
					
					endforeach;

					$this->db->where_in('general_area.general_area_id', $otherAreas);
					

				}
				else
				{
					$this->db->where('general_area.general_area_id', 'NO');
				}
			}
				
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

	function search_rentals($from, $to, $beds, $maxbeds, $area, $nearby)
	{
		//find out group ids. First get group idwith area id
		if($area != "any")
		{
			$areaGroup = $this->find_group($area);

			foreach($areaGroup as $row):


			$groupID = $row['general_area_group_id'];

			endforeach;

			if(isset($groupID)){
				$relatedAreas = $this->getareas($groupID);
				 
			}
		}


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
		$this->db->group_by('property_main.property_ref_no');			//groups by property ref so i get a listing per property rather than per image

		if ($to > 0) // if a top price is selected else make it unlimited
		{
			$this->db->order_by('property_main.rent_price', 'asc'); 		// order by price
            $search = "monthly_rent <= $to AND $from <= monthly_rent";
			$this->db->where($search);
		}

		//if area is not any, search by area also
		if($area != "any")
		{

			//if nearby is set just search nearby locations, if not search main location
			if($nearby == 0){
                $this->db->order_by('property_main.rent_price', 'asc'); 		// order by price
				$this->db->where('general_area.general_area_id', $area);
			}

			if($nearby == 1){
				$x = 1;
				if(isset($relatedAreas)) {

					foreach($relatedAreas as $row2):

					$otherAreas[] = $row2['area_id'];

					endforeach;

					$this->db->where_in('general_area.general_area_id', $otherAreas);

				}
				else
				{
					$this->db->where('general_area.general_area_id', 'NO');
				}
			}
				
		}

		$this->db->group_by('property_main.property_ref_no');



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