<?php

class Areas extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		$this->load->model('area_model');	
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
	
	function area_config()
	{
		$data['right_main'] = 'admin/config/area_config';
		
		$data['page'] = 'config';
		
		$data['title'] = 'Nash Homes Configuration';
		
		$data['heading'] = 'Area Config';
		
		$data['areas'] = $this->area_model->list_areas();
		
		$data['groups'] = $this->area_model->list_groups();
		
		$data['areas_groups'] = $this->area_model->list_areas_groups();
		
		$this->load->vars($data);
		
		$this->load->view('admin/admin');
	}
	
	function add_area()
	{
		$this->area_model->add_area();
		redirect('admin/areas/area_config', 'refresh');
	}
	
	function assign_area()
	{
		$segment_active = $this->uri->segment(4);
			if($segment_active==NULL)
			{
				$this->session->set_flashdata('message', 'no group was selected');
				redirect('admin/areas/area_config', 'refresh');
			}
			else
			{
				$this->area_model->assign_area($segment_active);
				
				redirect('admin/areas/area_config', 'refresh');  
			}
	}
	function remove_area($id)
	{
		$this->area_model->remove_area($id);
				
		redirect('admin/areas/area_config', 'refresh');  
	}
	
	function delete_group($id)
	{
		$this->area_model->delete_group($id);
				
		redirect('admin/areas/area_config', 'refresh');  
	}
	function delete_area($id)
	{
		$this->area_model->delete_area($id);
				
		redirect('admin/areas/area_config', 'refresh');  
	}
	
	function add_group()
	{
		$this->area_model->add_group();
		redirect('admin/areas/area_config', 'refresh');
	}
	
}
