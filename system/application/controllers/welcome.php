<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		redirect('/welcome/content');
	}
function content()
	{

		
		if(($this->uri->segment(3))==NULL)
			{
				$id = "home";
				$data['main'] = "pages/dynamic";
				$data['page'] = 'home';
			}
		else
			{
				$id = $this->uri->segment(3);
				$data['main'] = "pages/dynamic";
				$data['page'] = $this->uri->segment(3);
			}
		
			$data['content'] =	$this->content_model->get_content($id);
				
				foreach($data['content'] as $row):
				
					$data['title'] = $row['content_title'];
					$data['main_text'] = $row['content'];
					
				endforeach;		
				
			$data['menu'] =	$this->content_model->get_menus();
		
			$this->load->vars($data);
		
			$this->load->view('template');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */