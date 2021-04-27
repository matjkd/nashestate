<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Area_model extends Model {
	
	
	
function __construct()
    {
        parent::__construct();
    }
    
    function add_area()
    {
    	
    $new_area_insert_data = array(
			'area' => $this->input->post('area'),
						
		);
		
		
		$this->db->insert('general_area', $new_area_insert_data);
	
    	
    }
    
    function add_group()
    {
    $group = $this->input->post('group');

    $this->db->where('group_name', $group);

		$query = $this->db->get('general_area_group');

		if($query->num_rows < 1)
		{

                 $new_group_insert_data = array(
			'group_name' => $group,
						
		);

		
		$this->db->insert('general_area_group', $new_group_insert_data);
                }
    }
    
    function list_areas()
    {
    	$data = array();
		$this->db->from('general_area');
		$this->db->order_by('general_area.area', 'asc');
		$this->db->join('general_area_link', 'general_area_link.area_id = general_area.general_area_id', 'left');
		$this->db->group_by('general_area.general_area_id');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
    
 	function list_areas_groups()
    {
    	$data = array();
		$this->db->from('general_area');
		$this->db->order_by('general_area.area', 'asc');
		$this->db->join('general_area_link', 'general_area_link.area_id = general_area.general_area_id', 'left');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
    function assign_area($id)
    {
    	$area = $this->input->post('area');
		$data = array();
		
		$new_area_data = array(
				'area_id' => $area,
				'group_id' => $id
		);
		$this->db->insert('general_area_link', $new_area_data);
		
			
		return;
    }
    
    function remove_area($id)
    {
    	$this->db->where('link_id', $id);
    	$this->db->delete('general_area_link');
    }
 function delete_group($id)
    {
    	$this->db->where('general_area_group_id', $id);
    	$this->db->delete('general_area_group');
    	
    	$this->db->where('group_id', $id);
    	$this->db->delete('general_area_link');
    }
 function delete_area($id)
    {
    	$this->db->where('area_id', $id);
    	$this->db->delete('general_area_link');
    	
    	$this->db->where('general_area_id', $id);
    	$this->db->delete('general_area');
    	
    	$area_remove = array(
					'general_area' => ''
					);
		$this->db->where('general_area', $id);
		$update = $this->db->update('property_main', $area_remove);
	
    	
    
    }
	
	function get_group($id)
	{
	$data = array();
		$this->db->from('general_area_link');
		$this->db->where('general_area_link.area_id', $id); 
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
    
 	function list_groups()
    {
    	$data = array();
		$this->db->from('general_area_group');
                $this->db->join('general_area', 'general_area.general_area_id = general_area_group.group_name', 'left');
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
