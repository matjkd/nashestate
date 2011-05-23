<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Import extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		$this->load->model('import_model');
		$this->load->model('features_model');
		$this->load->model('properties_model');
		$this->load->model('area_model');
	}
	
	function index()
	{
		
	}
	function import_properties()
	{
		echo "this function has been disabled as it is no longer needed";
	}
	
	function import_property()
	{
	
		echo "this function has been disabled as it is no longer needed";

	}
	
	function images()
	{
		echo "this function has been disabled as it is no longer needed";
	
		
		
	}
	
	function convert_images()
	{
		echo "this function has been disabled as it is no longer needed";
		
	}
	function bulk_convert_images()
	{
		echo "this function has been disabled as it is no longer needed";
		
		
		
	}
	function convert_rentals()
	{
		echo "this function has been disabled as it is no longer needed";
		
	}
	function convert_salerent()
	{
		echo "this function has been disabled as it is no longer needed";
		
	}
	
	function check_image_order()
	{
		$form_data = array(
				
				'print_order' => 0
			
				);
		
		$this->db->where('print_order', 1);
		$this->db->or_where('print_order', NULL);
		$this->db->update('property_images', $form_data);
	}
	
	function is_logged_in()
	{
		
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		$role = $this->session->userdata('role');
		
		if(!isset($is_logged_in) || $role != 1)
			
			{
				$this->session->set_flashdata('message', 'You are not logged in');
				
				redirect('welcome', 'refresh');
	        }	
			
	}	
	
}