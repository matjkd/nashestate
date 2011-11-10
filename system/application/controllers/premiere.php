<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Main site controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */

class Premiere extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ajax_model');
		$this->load->model('properties_model');
                $this->load->model('gallery_model');
	}

        function index()
        {
                $id = "Premiere";

                //Set id for menu to be on
                $data['page'] = 7;

                //set page title
                $data['title'] = "Nash Homes Exclusive Premiere Properties";

                //Set graphic for content menu
                $data['content_menu'] = "premiere";
                
                //load menus
                $data['menu'] =	$this->content_model->get_menus();

                //load view for main content
		$data['content'] = "content/premiere";

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

                 //Get Premiere Properties
                  $data['properties'] = $this->properties_model->get_premiere_properties();


		$this->load->vars($data);

		$this->load->view('template/standard/main');
        }

}
