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
    
    function list_default_features()
    {
    	$data = array();
		$this->db->from('features');
		$this->db->where('default_feature', 1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
    }
    
    function add_default_features($property_id, $feature_id)
    {
    	$new_property_feature_data = array(
				'features_id' => $feature_id,
				'property_id' => $property_id
		);
		$this->db->insert('property_features', $new_property_feature_data);
    }
    function update_feature()
    {
    	
    }
    
    function toggle_default($id, $value)
    {
   
		$form_data = array(
    				
					'default_feature' => $value    				
    				
					);
		
		
		$this->db->where('features_id', $id);
		$this->db->update('features', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			
			return TRUE;
		}
		
		return FALSE;
    }
    
  	
    function delete_feature($id)
    {
    	//delete feature from all properties
    	$this->db->where('features_id', $id);
    	$this->db->delete('property_features');
    	
    
    	//delete feature from features table
    	$this->db->where('features_id', $id);
    	$this->db->delete('features');
    	
    	
    	
    	return TRUE;
    }
}