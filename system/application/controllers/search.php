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
			$this->load->vars($data);
			$this->load->view('template');
	}
	
}