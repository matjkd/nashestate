<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Content Admin
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Content extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		$this->load->model('contacts_model');
		$this->load->model('content_model');
		$this->load->model('ajax_model');
		$this->load->model('Gallery_model');
		
	}
		
	function index()
	{
		redirect('admin/content/list_content');
	}
	function list_content()
	{
		$data['list_content'] = $this->content_model->get_all_content();
		$data['page'] = 'content';
		$data['title'] = 'Nash Homes: Edit Content';
		$data['right_main'] = 'admin/content/list_content';
		$data['heading'] = 'Edit Content';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	
	
	function edit_content($id)
	{
		$data['content_id'] = $id;
		$data['edit_content'] = $this->content_model->get_content_edit($id);
		$data['page'] = 'content';
		$data['title'] = 'Nash Homes: Edit Content';
		$data['right_main'] = 'admin/content/edit_content';
		$data['heading'] = 'Edit Content';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	
	function update_content($id)
	{
		
		$this->content_model->update_content($id); 
		redirect('admin/content/edit_content/'.$id.'');  
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

/* End of file content */
/* Location: ./system/application/controllers/admin/properties.php */