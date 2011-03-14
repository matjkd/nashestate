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
			
	if(($this->uri->segment(4))=="sales")
			{
				
				$data['search_type'] = 1;
			
			}
	if(($this->uri->segment(4))=="rentals")
			{
				
				$data['search_type'] = 2;
			
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
		
			$this->load->view('template');
	}
function test()
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
			
			//get the max sale and rent price to put in the dropdowns in the search box.
			//This section could probably be moved somewhere so it loads automatically 
			//get highest price of property from database
			$data['max_sale'] = $this->properties_model->get_max_price('1');	
			foreach($data['max_sale'] as $row):
				
				// determines how much to round up by
				$data['saleroundup'] = 50000;
				// determines how much to increment by in dropdown
				$data['saleincrements'] = 50000;
				
				$saleroundup = 1 / $data['saleroundup'];
				$value = $row['sale_price'];
				$data['max_sale_round'] = (ceil($value * $saleroundup) / $saleroundup );
				
			endforeach;
			
			//get highest price of rental property from database
			$data['max_rent'] = $this->properties_model->get_max_price('2');	
			foreach($data['max_rent'] as $row):
				
				// determines how much to round up by
				$data['rentroundup'] = 1000;
				// determines how much to increment by in dropdown
				$data['rentincrements'] = 50;
				
				$rentroundup = 1 / $data['rentroundup'];
				$value = $row['monthly_rent'];
				$data['max_rent_round'] = (ceil($value * $rentroundup) / $rentroundup );
				
			endforeach;
			
			
				// Creates arrays for incremental sale prices and rental prices. This should be moved to a controller eventually
				
				$saleprices = array();
								
				for ($saleprice = $data['saleincrements'] ; $saleprice <= $data['max_sale_round']+1; $saleprice=$saleprice+$data['saleincrements'] ) {
					
					$saleformat = number_format($saleprice);
					$saleprices[$saleprice] = $saleformat;
					
				}
				
				$rentprices = array();
								
				for ($rentprice = $data['rentincrements']; $rentprice <= $data['max_rent_round']+1; $rentprice=$rentprice+$data['rentincrements']) {
					$rentformat = number_format($rentprice);
					$rentprices[$rentprice] = $rentformat;
					
				}
		
				$data['saleprices'] = $saleprices;
				$data['rentprices'] = $rentprices;
			
			//end of getting max prices
			
				
			//get the page content
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