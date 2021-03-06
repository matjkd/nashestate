<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @name 	Search controller
 * @author 	 Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */
class Search extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ajax_model');
        $this->load->model('search_model');
        $this->load->library('pagination');
        $this->load->model('gallery_model');
		
    }

    function index() {
        redirect('/search/content');
    }

    /**
     * 
     */
    function content() {

        $data['search_type'] = $this->input->post('search_type');
        $data['title'] = "searchpage";
        $data['page'] = "search";
        $data['menu'] = $this->content_model->get_menus();
        $data['main_text'] = "searchpage";
        $data['content'] = "search/search_list";
        $data['general_areas'] = $this->ajax_model->get_general_area();
        $data['area_groups'] = $this->ajax_model->get_area_groups();
        $data['side2'] = 'sidebar/refine';
        $data['leftbox'] = 'search/searchbox';
        
        
        // store the search data, unless it is already stored
        if($this->input->post('location') == NULL) {
            
           $area = $this->session->userdata('area');
        $data['search_type'] = $this->session->userdata('search_type');
            
        } else {
            
            
           $storedsearch = array(
               'search_type' => $this->input->post('search_type'),
              'area' => $this->input->post('location') 
              );
      $this->session->set_userdata($storedsearch);
      $area = $this->input->post('location');
            
        }
            
           
            
       
       
        
     




        // Deal with data sent from search form
        $data['beds'] = $this->input->post('beds');
        $data['maxbeds'] = $this->input->post('maxbeds');

        if ($data['maxbeds'] <= $data['beds']) {
            $data['maxbeds'] = 999;
        }

        $data['buyfrom'] = $this->input->post('buyfrom');
        $data['buyto'] = $this->input->post('buyto');


        $data['rentfrom'] = $this->input->post('rentfrom');
        $data['rentto'] = $this->input->post('rentto');


        // location, and if selected find out what group OR groups it is in
        //if($this->input->post('location')==NULL){
        //    $area = $this->session->userdata('area');
       // } else {
       // $area = $this->input->post('location');
      // }
        $group = $this->search_model->find_group($area);



        // Search Both rent and purchase with no limit on price
        if ($data['rentto'] == 0 && $data['buyto'] == 0) {
            $data['list'] = 'both unlimited';
            $data['search_desc'] = "All properties";
           
            
            if ($area != "any") {
                $data['nearby'] = $this->search_model->search_sales(0, 0, $data['beds'], $data['maxbeds'], $area, 1);
               
                $data['nearbyrentals'] = $this->search_model->search_sales(0, 0, $data['beds'], $data['maxbeds'], $area, 1);
            }
            
            $data['properties'] = $this->search_model->search_sales(0, 0, $data['beds'], $data['maxbeds'], $area, 0);
             
            $data['rentals'] = $this->search_model->search_rentals(0, 0, $data['beds'], $data['maxbeds'], $area, 0);
            
        
        }
        // Purchase Only
        if ($data['search_type'] == 1) {
            $data['list'] = 'purchase only';
           // $data['search_desc'] = "Properties for Sale between " . number_format($data['buyfrom']) . "&euro; and " . number_format($data['buyto']) . "&euro;";
             $data['search_desc'] = "Properties for Sale";
            $data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 0);
            
            if ($area != "any") {
                $data['nearby'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 1);
            }
            $data['rentals'] = NULL;
        }

        // Rent Only
        if ($data['search_type'] == 2) {
            $data['list'] = 'rent only';
            //$data['search_desc'] = "Properties for Rent between " . number_format($data['rentfrom']) . "&euro; and " . number_format($data['rentto']) . "&euro; per month";
                $data['search_desc'] = "Properties for Rent";
            $data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 0);
            if ($area != "any") {
                $data['nearbyrentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 1);
            }
            $data['properties'] = NULL;
        }

        // Search Both rental and purchase limited by price
        if ($data['search_type'] == 3) {
       //  if ($data['rentto'] > 0 && $data['buyto'] > 0) {
            $data['list'] = 'both limited';
            //$data['search_desc'] = "Properties for Sale between " . number_format($data['buyfrom']) . "&euro; and " . number_format($data['buyto']) . "&euro; and for Rent between " . number_format($data['rentfrom']) . "&euro; and " . number_format($data['rentto']) . "&euro; per month";
            $data['search_desc'] = "Properties for Sale and Rent";
            $data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 0);
            $data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 0);
            if ($area != "any") {
                $data['nearby'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 1);
                $data['nearbyrentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 1);
            }
        // }
        }


        //convert rental period to something that works

        $data['rental_period'] = "month";

        //get property of the week
        if ($data['search_type']  == 2) {
            $data['featured_property'] = $this->properties_model->get_featured_rental();
            
        } else {
            $data['featured_property'] = $this->properties_model->get_featured_property();
        }
        
        //get property of the week images
        
         if($data['featured_property'] != NULL){
        foreach($data['featured_property'] as $row):
            $featuredpropertyid = $row['property_id'];
            $data['featured_images'] = $this->gallery_model->get_property_images($featuredpropertyid);
            
        endforeach;
         }
        
        	$data['references'] = $this->content_model->get_testimonials();
        // Load Template
        $this->load->vars($data);
        $this->load->view('template/standard/main');
    }

	
	
    /**
     * 
     */
    function property_id() {

        $this->form_validation->set_rules('property_id', 'property_id', 'trim|required');

        //need to add a check to see if property exists, or it will direct to a page with errors

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('message', 'You must enter a property id');

            redirect('/');
        }
        $id = $this->input->post('property_id');
        redirect('/property/display/' . $id);
    }

}
