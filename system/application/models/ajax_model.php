<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_model extends Model {
	
	
	
	function __construct()
    {
        parent::__construct();
    }

	function get_nationalities()
	{
		$data = array();
		$this->db->select('nationality');
		$this->db->from('nationalities');
		$this->db->order_by('nationality', 'asc');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function get_general_area()
	{
		$data = array();
		
		$this->db->from('general_area');
		$this->db->order_by('area', 'asc');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
    
    function get_area_groups()
    {
        $data = array();
		$this->db->from('general_area');
		$this->db->order_by('general_area.area', 'asc');
		$this->db->join('general_area_group', 'general_area_group.group_name = general_area.general_area_id', 'right');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
        
    }
    
	function get_property_types()
	{
		$data = array();
		
		$this->db->from('property_types');
		$this->db->order_by('property_type_name', 'asc');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	

}
