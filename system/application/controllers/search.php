<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Search controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Search extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ajax_model');	
		$this->load->model('search_model');		
		$this->load->library('pagination');
	}
	
	function index()
	{
		redirect('/search/content');
	}
	
	function content()
	{
	
			$data['search_type'] = $this->input->post('search_type');
			$data['title'] = "searchpage";
			$data['page'] = "search";
			$data['menu'] =	$this->content_model->get_menus();
			$data['main_text'] = "searchpage";
			$data['content'] = "search/search_list";
			$data['general_areas'] = $this->ajax_model->get_general_area();	
			$data['side2'] = 'sidebar/refine';
			$data['leftbox'] = 'search/searchbox';
			
			// Deal with data sent from search form
			$data['beds'] = $this->input->post('beds');
			
			
		
			$data['buyfrom']  = $this->input->post('buyfrom');
			$data['buyto'] =  $this->input->post('buyto');
			
		
			$data['rentfrom']  =  $this->input->post('rentfrom');
			$data['rentto'] =  $this->input->post('rentto');
			
		
			
			
			// Search Both rent and purchase with no limit on price
			if($data['rentto'] == 0 && $data['buyto'] == 0)
			{
				$data['list'] = 'both unlimited';
				$data['properties'] = $this->search_model->search_sales(0,0, $data['beds']);	
				$data['rentals'] = $this->search_model->search_rentals(0,0, $data['beds']);		
			}
			// Purchase Only
			if(($data['buyto'] > 0 && $data['rentto'] == 0) || $data['search_type'] == 1)
			{
				$data['list'] = 'purchase only';
				$data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds']);	
				$data['rentals'] = NULL;
			}
			
			// Rent Only
			if(($data['rentto'] > 0 && $data['buyto'] == 0 ) || $data['search_type'] == 2)
			{
				$data['list'] = 'rent only';
				$data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds']);	
				$data['properties'] = NULL;
			}
			
			// Search Both rental and purchase limited by price
			if($data['rentto'] > 0 && $data['buyto'] > 0)
			{
				$data['list'] = 'both limited';
				$data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds']);	
				$data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds']);	
			}
			
			
			
		
			
			
			// Load Template
			$this->load->vars($data);
			$this->load->view('template/standard/main');
			
	}
	
}