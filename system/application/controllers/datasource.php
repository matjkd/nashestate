<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Datasource extends MY_Controller {

    /**
     * 
     */
    function Datasource() {
        parent::__construct();
        $this->load->model('products_model');
        $this->is_logged_in();
    }

    public function index() {
        
    }

   
    
     public function json_features() {
        $term = $this->input->post('term');
        $data['source'] = $this->properties_model->autocomplete_features($term);
        $this->load->vars($data);
        $this->load->view('template/json');
    }
    
    
    

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $data['message'] = "You don't have permission";
            redirect('user/login');
        }
    }

}

/* End of file datasource.php */
/* Location: ./application/controllers/datasource.php */
