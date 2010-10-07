<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Property controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Property extends Controller {

	function Property()
	{
		parent::Controller();
		$this->load->model('ajax_model');	
		$this->load->model('search_model');		
		$this->load->model('properties_model');	
	}

	function index()
	{
		redirect('/property/display');
	}
	
	function display($id)
	{
			
			
			$data['property_details'] = $this->properties_model->get_property($id);
			$data['leftbox'] = 'property/gallery';	
			$data['page'] = 'search';	
			$data['menu'] =	$this->content_model->get_menus();
			
			$data['narrow'] = 1;
			$data['title'] = 'Property View';
			
			$data['content'] = 'property/main_details';
			$this->load->vars($data);
		
			$this->load->view('template');
	}
	
}
	