<?php

class Search extends Controller {

	function Search()
	{
		parent::Controller();	
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
			
			if($data['buyto'] > 0 AND $data['rentto'] == 0)
			{
				$data['list'] = 'purchase only';
			}
			
			if($data['rentto'] > 0 AND $data['buyto'] == 0)
			{
				$data['list'] = 'rent only';
			}
			
			if($data['rentto'] > 0 AND $data['buyto'] > 0)
			{
				$data['list'] = 'both limited';
			}
			
			if($data['rentto'] == 0 AND $data['buyto'] == 0)
			{
				$data['list'] = 'both unlimited';
			}
			
			$this->load->vars($data);
			$this->load->view('template');
			
	}
	
}