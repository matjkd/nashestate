<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * @name 		Main site controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */
class Welcome extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('ajax_model');
		$this->load->model('reports_model');
		$this->load->model('properties_model');
		$this->load->model('gallery_model');
	}

	/**
	 *
	 */
	function index() {
		
		//TODO make loading a fancy animated gif or something
		echo "Loading...";
		//run a date check on rented properties...
		//get active rented properties
		$activeRented = $this->reports_model->properties_rented(1);
		foreach($activeRented as $row):
			
			$id = $row['property_ref_no'];
			
			$data['rentedEndDate'] = $this->properties_model->get_last_rented_date($id);
			
			if ($data['rentedEndDate'] != NULL) {
	            	
	            foreach ($data['rentedEndDate'] as $row1):
	
	                $data['endDate'] = $row1->rented_end;
	                $data['startDate'] = $row1->rented_date;
	
	            endforeach;
            
            
            	//check if rented to date has passed

	            if (now() > $data['endDate'] || now() < $data['startDate']) {
	                //make property unrented
	                $this->properties_model->mark_unrented($id);
	            }
	
	            if (now() < $data['endDate'] && now() > $data['startDate']) {
	                //make property rented
	                $this->properties_model->mark_sold($id);
	            }
	        }
			
			
		endforeach; 
		
		
		
		redirect('/home');
	}

	/**
	 *
	 */
	function content($id = "home") {
		
		if (($this->uri->segment(3)) == NULL) {
			if (($this->uri->segment(1)) == NULL) {
				$id = "home";
				$data['main'] = "pages/dynamic";
			} else {
				$id = $this->uri->segment(1);
				$data['main'] = "pages/dynamic";
			}
		} else {
			$id = $this->uri->segment(3);
			$data['main'] = "pages/dynamic";
		}
		//get the page content
		$data['content'] = $this->content_model->get_content($id);
		foreach ($data['content'] as $row):

		$data['title'] = $row['content_title'];
		$data['content_menu'] = $row['content_menu'];
		$data['main_text'] = $row['content'];
		$data['extra'] = $row['extra'];
		$data['page'] = $row['menu_top'];

		if ($row['slideshow'] != NULL) {
			$data['slideshow'] = $row['slideshow'];
		}
		endforeach;

		//get the references
		 
		 
		$data['references'] = $this->content_model->get_testimonials();
		 
// $data['latest_properties'] = $this->properties_model->get_latest_properties();


		//load block content
		$data['leftbox'] = 'search/searchbox';
		$data['side1'] = 'sidebar/property_menu';
		$data['side2'] = 'sidebar/property_of_week';

		//list general areas for search box
		$data['general_areas'] = $this->ajax_model->get_general_area();

		 
		//get property of the week
		if (isset($data['search_rentals'])) {
			echo $data['search_rentals'];
			$data['featured_property'] = $this->properties_model->get_featured_rental();
			 
		} else {
			$data['featured_property'] = $this->properties_model->get_featured_property();
		}
		//get property of the week images
		foreach($data['featured_property'] as $row):
		$featuredpropertyid = $row['property_id'];
		$data['featured_images'] = $this->gallery_model->get_property_images($featuredpropertyid);

		endforeach;

		$data['menu'] = $this->content_model->get_menus();
		$data['content'] = "content/standard";
		$this->load->vars($data);
		$this->load->view('template/standard/main');
	}

function contenttest($id = "home") {
		
		if (($this->uri->segment(3)) == NULL) {
			if (($this->uri->segment(1)) == NULL) {
				$id = "home";
				$data['main'] = "pages/dynamic";
			} else {
				$id = $this->uri->segment(1);
				$data['main'] = "pages/dynamic";
			}
		} else {
			$id = $this->uri->segment(3);
			$data['main'] = "pages/dynamic";
		}
		//get the page content
		$data['content'] = $this->content_model->get_content($id);
		foreach ($data['content'] as $row):

		$data['title'] = $row['content_title'];
		$data['content_menu'] = $row['content_menu'];
		$data['main_text'] = $row['content'];
		$data['extra'] = $row['extra'];
		$data['page'] = $row['menu_top'];

		if ($row['slideshow'] != NULL) {
			$data['slideshow'] = $row['slideshow'];
		}
		endforeach;

		//get the references
		 
		 
		$data['references'] = $this->content_model->get_testimonials();
		$data['latest_properties'] = $this->properties_model->get_latest_properties();



		//load block content
		$data['leftbox'] = 'search/searchbox';
		$data['side1'] = 'sidebar/property_menu';
		$data['side2'] = 'sidebar/property_of_week';

		//list general areas for search box
		$data['general_areas'] = $this->ajax_model->get_general_area();

		 
		//get property of the week
		if (isset($data['search_rentals'])) {
			echo $data['search_rentals'];
			$data['featured_property'] = $this->properties_model->get_featured_rental();
			 
		} else {
			$data['featured_property'] = $this->properties_model->get_featured_property();
		}
		//get property of the week images
		foreach($data['featured_property'] as $row):
		$featuredpropertyid = $row['property_id'];
		$data['featured_images'] = $this->gallery_model->get_property_images($featuredpropertyid);

		endforeach;

		$data['menu'] = $this->content_model->get_menus();
		$data['content'] = "content/standard";
		$this->load->vars($data);
		$this->load->view('template/crystal/main');
	}

	function show($id)
	{
		$this->ref_id = $this->uri->segment(4);
		 
		$this->content();

	}

	/**
	 *
	 */
	function contact_page() {
		if (($this->uri->segment(3)) == NULL) {
			$id = "home";
			$data['main'] = "pages/dynamic";
		} else {
			$id = $this->uri->segment(3);
			$data['main'] = "pages/dynamic";
		}
		$data['content'] = $this->content_model->get_content($id);
		foreach ($data['content'] as $row):
		$data['title'] = $row['content_title'];
		$data['main_text'] = $row['content'];
		$data['page'] = $row['menu_top'];
		if ($row['slideshow'] != NULL) {
			$data['slideshow'] = $row['slideshow'];
		}
		endforeach;
		$data['leftbox'] = 'search/searchbox';
		//data['side1'] = 'sidebar/property_menu';
		$data['side2'] = 'sidebar/property_of_week';
		$data['general_areas'] = $this->ajax_model->get_general_area();
		$data['featured_property'] = $this->properties_model->get_featured_property();
		$data['menu'] = $this->content_model->get_menus();
		$data['content'] = "content/standard";
		$this->load->vars($data);
		$this->load->view('template');
	}

	function news() {
		$this->load->helper('xml');
		$source ="http://nashhomesmallorca.blogspot.com/feeds/posts/default";
		$data['news'] = simplexml_load_string(file_get_contents($source));
		

			$data['main'] = "pages/dynamic";
		
		//get the page content
		$data['content'] = $this->content_model->get_content('news');
		foreach ($data['content'] as $row):

		$data['title'] = $row['content_title'];
		$data['content_menu'] = $row['content_menu'];
		$data['main_text'] = $row['content'];
		$data['extra'] = $row['extra'];
		$data['page'] = $row['menu_top'];

		if ($row['slideshow'] != NULL) {
			$data['slideshow'] = $row['slideshow'];
		}
		endforeach;

		//get the references
		 
		 
		$data['references'] = $this->content_model->get_testimonials();
		 



		//load block content
		$data['leftbox'] = 'search/searchbox';
		$data['side1'] = 'sidebar/property_menu';
		$data['side2'] = 'sidebar/property_of_week';

		//list general areas for search box
		$data['general_areas'] = $this->ajax_model->get_general_area();

		 
		//get property of the week
		if (isset($data['search_rentals'])) {
			echo $data['search_rentals'];
			$data['featured_property'] = $this->properties_model->get_featured_rental();
			 
		} else {
			$data['featured_property'] = $this->properties_model->get_featured_property();
		}
		//get property of the week images
		foreach($data['featured_property'] as $row):
		$featuredpropertyid = $row['property_id'];
		$data['featured_images'] = $this->gallery_model->get_property_images($featuredpropertyid);

		endforeach;

		$data['menu'] = $this->content_model->get_menus();
		
		
		$data['content'] = "content/news";
		$this->load->vars($data);
		$this->load->view('template/standard/main');
		
	}



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */