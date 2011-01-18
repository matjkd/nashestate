<?php

class Import extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		$this->load->model('import_model');
	}
	
	function index()
	{
		
	}
	function import_properties()
	{
		$data['old_properties'] = $this->import_model->get_old_properties();
		
			
		$this->load->vars($data);
		$this->load->view('import');
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