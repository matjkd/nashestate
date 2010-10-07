<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Search controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Search extends Controller {

	function Search()
	{
		parent::Controller();
		$this->load->model('ajax_model');	
		$this->load->model('search_model');		
	}
	
	function index()
	{
		redirect('/search/content');
	}
	
	function content()
	{
		
			$data['title'] = "searchpage";
			$data['page'] = "search";
			$data['menu'] =	$this->content_model->get_menus();
			$data['main_text'] = "searchpage";
			$data['content'] = "search/searchlist";
			$data['general_areas'] = $this->ajax_model->get_general_area();	
			
			$data['leftbox'] = 'search/searchbox';
			
			// Deal with data sent from search form
			$data['beds'] = $this->input->post('beds');
			
			//split up buy amount
			$amount = $this->input->post('amount');
			$amount = str_replace("€", "", $amount);
			$data['buyfrom']  = substr($amount, 0, strpos($amount, "-") );
			$data['buyto'] = substr($amount, strpos($amount, "-")+strlen('-'));
			
			//split up rent amount
			$rent = $this->input->post('rent');
			$rent = str_replace("€", "", $rent);
			$data['rentfrom']  = substr($rent, 0, strpos($rent, "-") );
			$data['rentto'] = substr($rent, strpos($rent, "-")+strlen('-'));
			
			
			// Purchase Only
			if($data['buyto'] > 0 AND $data['rentto'] == 0)
			{
				$data['list'] = 'purchase only';
				$data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto']);	
				$data['rentals'] = NULL;
			}
			
			// Rent Only
			if($data['rentto'] > 0 AND $data['buyto'] == 0)
			{
				$data['list'] = 'rent only';
				$data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto']);	
				$data['properties'] = NULL;
			}
			
			// Search Both rental and purchase limited by price
			if($data['rentto'] > 0 AND $data['buyto'] > 0)
			{
				$data['list'] = 'both limited';
				$data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto']);	
				$data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto']);	
			}
			
			// Search Both rent and purchase with no limit on price
			if($data['rentto'] == 0 AND $data['buyto'] == 0)
			{
				$data['list'] = 'both unlimited';
				$data['properties'] = $this->search_model->search_sales(0,0);	
				$data['rentals'] = $this->search_model->search_rentals(0,0);		
			}
			
			// Load Template
			$this->load->vars($data);
			$this->load->view('template');
			
	}
	
}