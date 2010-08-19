<?php

class Ajax extends MY_Controller {

	function Ajax()
	{
		parent::MY_Controller();
		$this->load->model('ajax_model');
		
		
	}
	function index()
	{
		
	}
	
	function nationalities()
	{
		$data['data'] = $this->ajax_model->get_nationalities();
		$this->load->vars($data);
		$this->load->view('ajax/json');
	}


}