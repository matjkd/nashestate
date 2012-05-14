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
		$this->load->model('properties_model');
		$this->load->model('gallery_model');
	}

	/**
	 *
	 */
	function index() {
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