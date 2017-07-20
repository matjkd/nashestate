<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Images Admin
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Images extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		
		$this->load->model('Gallery_model');
		
	}
	
	function index()
	{
		redirect('admin/images/view_images');
	}
	
	function upload_image()
	{
		
		$id = $this->input->post('id');
		if($this->input->post('upload'))
		{
			$this->Gallery_model->do_upload($id);
		}
		
		
		
		redirect('admin/properties/update/'.$id.'#tabs-3');   // or whatever logic needs to occur
		
	}
	function convert_image()
	{
		$id = $this->input->post('id');
		$path = $this->input->post('path');
		$filename = $this->input->post('filename');
		$this->Gallery_model->do_uploader($id, $path, $filename);
		
	}
	
	function editable_images()
	{
		
		$data['id'] = $this->input->post('elementid');
		$data['field'] = 'printable';
		$data['value'] = $this->input->post('value');
		$this->Gallery_model->edit_images($data['id'], $data['field'], $data['value']);
		
	
					
			if($data['value'] == 0 ) {$update = 'No';}
					
			if($data['value'] == 1 ) {$update = 'Yes';}
		
		
		
		$this->output->set_output($update);
	}
	
	function image_order()
	{
		
		$data['id'] = $this->input->post('elementid');
		$data['field'] = 'print_order';
		$data['value'] = $this->input->post('value');
		$this->Gallery_model->edit_images($data['id'], $data['field'], $data['value']);
			
		$update = $this->input->post('value');
		
		$this->output->set_output($update);
	}
	
	function delete_image()
	{
		$property_id = $this->input->post('id');
		$image_id = $this->input->post('image_id');
		$this->Gallery_model->delete_image($image_id);
		
		redirect('admin/properties/update/'.$property_id.'#tabs-3'); 
	}
    
    
    function update_watermark()
    {
        $property_id = $this->input->post('id');
		$image_id = $this->input->post('image_id');
		$this->Gallery_model->update_watermark($property_id, $image_id);
		
		
    }
	
	function ajaxsort()
	{
			$pages = $this->input->post('pageorder');
			
			
			
			$pages = str_replace("pageorder;[]", "pageorder[]",  $pages);
			echo $pages;
			parse_str($pages, $pageOrder);
		
			foreach ($pageOrder['pageorder'] as $key => $value):
				echo $key;
			mysql_query("UPDATE ignite_property_images SET `print_order` = '$key' WHERE `image_id` = '$value'") or die(mysql_error());
			
			
			
			endforeach;

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