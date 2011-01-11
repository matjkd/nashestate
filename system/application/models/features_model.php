<?php 
class Features_model extends Model {
	
	function __construct()
    {
        parent::__construct();
    }
    
    function list_features()
    {
    	$data = array();
		$this->db->from('features');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
    
    function update_feature()
    {
    	
    }
    
    function delete_feature()
    {
    	//delete feature from all properties
    	
    	//delete feature from features table
    }
}