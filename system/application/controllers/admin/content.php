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
    
    function list_references()
    {
        
        $data['list_references'] = $this->content_model->get_testimonials();
        $data['page'] = 'content';
		$data['title'] = 'Nash Homes: Edit Content';
		$data['right_main'] = 'admin/content/list_references';
		$data['heading'] = 'Edit References';
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
    
    function edit_testimonial($id)
    {
        
        $data['testimonial_id'] = $id;
        $data['edit_testimonial'] = $this->content_model->get_testimonial($id);
        $data['page'] = 'content';
		$data['title'] = 'Nash Homes: Edit Content';
		$data['right_main'] = 'admin/content/edit_testimonial';
		$data['heading'] = 'Edit Testimonial';
		$this->load->vars($data);
		$this->load->view('admin/admin');
        
    }
    
    function add_testimonial()
    {
        
           $data['page'] = 'content';
		$data['title'] = 'Nash Homes: Add testimonial';
		$data['right_main'] = 'admin/content/add_testimonial';
		$data['heading'] = 'Add Testimonial';
		$this->load->vars($data);
		$this->load->view('admin/admin');
    }
    
    function add_new_testimonial()
    {
        $this->content_model->add_testimonial();
		redirect('admin/list_references/');
    }
	
	function update_content($id)
	{
		
		$this->content_model->update_content($id); 
		redirect('admin/content/edit_content/'.$id.'');  
	}
    
    
    function update_testimonial($id)
	{
		
		$this->content_model->update_testimonial($id); 
		redirect('admin/content/edit_testimonial/'.$id.'');  
	}
    
        function new_content()
        {


		$data['page'] = 'content';
		$data['title'] = 'Nash Homes: add Content';
		$data['right_main'] = 'admin/content/add_content';
		$data['heading'] = 'Add Content';
		$this->load->vars($data);
		$this->load->view('admin/admin');
        }

	function add_content()
	{

		$this->content_model->add_content();
		redirect('admin/content/');
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