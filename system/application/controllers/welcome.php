<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Main site controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */

class Welcome extends MY_Controller  
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ajax_model');	
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
					
					if($row['slideshow'] != NULL)
					{
					$data['slideshow'] = $row['slideshow'];
					}
				endforeach;		
			$data['leftbox'] = 'search/searchbox';
			$data['side1'] = 'sidebar/property_menu';
			$data['side2'] = 'sidebar/property_of_week';
			$data['general_areas'] = $this->ajax_model->get_general_area();	
		
			$data['menu'] =	$this->content_model->get_menus();
			$data['content'] = "content/standard";
			$this->load->vars($data);
		
			$this->load->view('template');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */