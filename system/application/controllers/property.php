<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @name 		Property controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */
class Property extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ajax_model');
        $this->load->model('search_model');
        $this->load->model('properties_model');
        $this->load->model('gallery_model');
        $this->load->plugin('to_pdf');
    }

    function index() {
        redirect('/property/display');
    }

    function display($id) {
      
        
    if($this->session->userdata('area')){
         $data['previousproperty'] = NULL;
         $data['nextproperty'] = NULL;
        
        $storedlocation = $this->session->userdata('area');
        $storedsearchtype = $this->session->userdata('search_type');
        if($storedsearchtype!=NULL){
        // get next and previous Purchase Only
        if ($storedsearchtype == 1) {
            $fullresults = $this->search_model->search_sales(0, 0, 0, 0, $storedlocation, 0);
            $previousid = 0;
            $previousproperty = 0;
            foreach($fullresults as $resultsfull):
            
           
            $resultid = $resultsfull['property_id']; 
            
            if($resultid == $id) {
                $data['previousproperty'] = $previousid;
            }
            
            if($previousid == $id){
               $data['nextproperty'] = $resultid;
            }
            
            $previousid = $resultid;
           
            
            
            endforeach;
            
             echo "<p hidden>";
            echo  $data['previousproperty']." ";
            echo $id." ";
            echo $data['nextproperty'];
             echo "</p>";
                 
            
        }
        
       
        // get next and previous rentals Only
        if ($storedsearchtype == 2) {
            $fullresults = $this->search_model->search_rentals(0, 0, 0, 0, $storedlocation, 0);
            $previousid = 0;
            $previousproperty = 0;
            foreach($fullresults as $resultsfull):
            
           
            $resultid = $resultsfull['property_id']; 
            
            if($resultid == $id) {
                $data['previousproperty'] = $previousid;
            }
            
            if($previousid == $id){
               $data['nextproperty'] = $resultid;
            }
            
            $previousid = $resultid;
           
            
            
            endforeach;
            
             echo "<p hidden>";
            echo  $data['previousproperty']." ";
            echo $id." ";
            echo $data['nextproperty'];
             echo "</p>";
            
        }
        // get next and previous both
        if ($storedsearchtype == 3) {
        }
        }
        
    }    
     
        
    	$data['property_display'] = 1;
        $data['property_details'] = $this->properties_model->get_active_property($id);
        
        //if property is returned, load other details
        if ($data['property_details']) {
            $data['property_rooms'] = $this->properties_model->get_rooms_table($id);
            $data['property_images'] = $this->gallery_model->get_property_images($id);
            $data['property_features'] = $this->properties_model->get_assigned_features($id);
            $data['property_id'] = $id;
            $data['leftbox'] = 'property/gallery';

            $data['page'] = 'search';
            
            foreach( $data['property_details'] as $row):
            
            $data['title'] = "Nash Homes - ".$row->property_title;
            
            endforeach;
            
            $data['menu'] = $this->content_model->get_menus();

            $data['narrow'] = 1;
           
$data['references'] = $this->content_model->get_testimonials();
            $data['content'] = 'property/main_details_bootstrap';
            $this->load->vars($data);

            $this->load->view('template/standard/main');
        }
        else
        {
            $this->session->set_flashdata('message', 'no property exists');
            redirect('/', 'refresh');
        }
    }

    function pdf($id) {
        $data['property_details'] = $this->properties_model->get_property($id);
        $data['property_rooms'] = $this->properties_model->get_rooms_table($id);
        $data['property_images'] = $this->gallery_model->get_pdf_images($id);
        $data['property_features'] = $this->properties_model->get_assigned_features($id);

        $data['leftbox'] = 'property/gallery';
        $data['page'] = 'search';
        $data['menu'] = $this->content_model->get_menus();

        $data['narrow'] = 1;
        $data['title'] = 'Property View';

        $data['content'] = 'property/main_details';
        $this->load->vars($data);

        $this->load->view('printouts/template1');
        $stream = TRUE;
        $html = $this->load->view('printouts/template1', $data, true);
        pdf_create($html, 'Property_' . $id . '', $stream);
    }

    function window_pdf($id) {
        $data['property_details'] = $this->properties_model->get_property($id);
        $data['property_rooms'] = $this->properties_model->get_rooms_table($id);
        $data['property_images'] = $this->gallery_model->get_pdf_images($id);
        $data['property_features'] = $this->properties_model->get_assigned_features($id);

        $data['leftbox'] = 'property/gallery';
        $data['page'] = 'search';
        $data['menu'] = $this->content_model->get_menus();

        $data['narrow'] = 1;
        $data['title'] = 'Property View';

        $data['content'] = 'property/main_details';
        $this->load->vars($data);

        $this->load->view('printouts/window');
        $stream = TRUE;
        $html = $this->load->view('printouts/window', $data, true);
        pdf_create($html, 'Property_' . $id . '', $stream);
    }

    function pdftest($id) {
        $data['property_details'] = $this->properties_model->get_property($id);
        $data['property_rooms'] = $this->properties_model->get_rooms_table($id);
        $data['property_images'] = $this->gallery_model->get_pdf_images($id);
        $data['property_features'] = $this->properties_model->get_assigned_features($id);

        $data['leftbox'] = 'property/gallery';
        $data['page'] = 'search';
        $data['menu'] = $this->content_model->get_menus();

        $data['narrow'] = 1;
        $data['title'] = 'Property View';

        $data['content'] = 'property/main_details';
        $this->load->vars($data);

        $this->load->view('printouts/template1');
    }

}

