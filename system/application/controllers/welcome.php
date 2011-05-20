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
		$this->load->model('properties_model');	
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
			
			}
		else
			{
				$id = $this->uri->segment(3);
				$data['main'] = "pages/dynamic";
			
			}
			
			
			
				
			//get the page content
			$data['content'] =	$this->content_model->get_content($id);
				
				foreach($data['content'] as $row):
				
					$data['title'] = $row['content_title'];
					$data['content_menu'] = $row['content_menu'];
					$data['main_text'] = $row['content'];
					$data['extra'] = $row['extra'];
					$data['page'] = $row['menu_top'];
					
					if($row['slideshow'] != NULL)
					{
					$data['slideshow'] = $row['slideshow'];
					}
				endforeach;		
			$data['leftbox'] = 'search/searchbox';
			$data['side1'] = 'sidebar/property_menu';
			$data['side2'] = 'sidebar/property_of_week';
			$data['general_areas'] = $this->ajax_model->get_general_area();	
			
			
			
			if(isset($data['search_rentals']))
				{
					$data['featured_property'] = $this->properties_model->get_featured_rental();	
				}
				else
				{
					$data['featured_property'] = $this->properties_model->get_featured_property();
				}
			
			$data['menu'] =	$this->content_model->get_menus();
			$data['content'] = "content/standard";
			$this->load->vars($data);
		
			$this->load->view('template/standard/main');
	}

	
	function contact_page()
	{
		if(($this->uri->segment(3))==NULL)
			{
				$id = "home";
				$data['main'] = "pages/dynamic";
			
			}
		else
			{
				$id = $this->uri->segment(3);
				$data['main'] = "pages/dynamic";
			
			}
		
			$data['content'] =	$this->content_model->get_content($id);
				
				foreach($data['content'] as $row):
				
					$data['title'] = $row['content_title'];
					$data['main_text'] = $row['content'];
					$data['page'] = $row['menu_top'];
					
					if($row['slideshow'] != NULL)
					{
					$data['slideshow'] = $row['slideshow'];
					}
				endforeach;		
			$data['leftbox'] = 'search/searchbox';
			//data['side1'] = 'sidebar/property_menu';
			$data['side2'] = 'sidebar/property_of_week';
			$data['general_areas'] = $this->ajax_model->get_general_area();	
			$data['featured_property'] = $this->properties_model->get_featured_property();
		
			$data['menu'] =	$this->content_model->get_menus();
			$data['content'] = "content/standard";
			$this->load->vars($data);
		
			$this->load->view('template');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */