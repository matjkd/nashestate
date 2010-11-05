<?php 
class Content_model extends Model {
	
	function __construct()
    {
        parent::__construct();
    }
    
	function get_content($id)
		{
			$data = array();
			$this->db->where('content_menu', $id);
		
			$query = $this->db->get('content');
			if ($query->num_rows() == 1)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
		}
	
	function get_all_content()
		{
			$data = array();
				
			$query = $this->db->get('content');
			if ($query->num_rows() == 1)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
		}
		
	function get_menus()
		{
			$data = array();
			
			

			$this->db->order_by('content_order', 'ASC');
			$query = $this->db->get('content');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				$data[] = $row;
			}
			
		$query->free_result();
		
		return $data;
		}
	
}