<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @name 		Reports
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */
class Reports extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('contacts_model');
        $this->load->model('properties_model');
                $this->load->model('reports_model');
        $this->load->model('ajax_model');
    }

    /**
     * 
     */
    function properties() {
         $data['page'] = 'reports';
        $data['right_main'] = 'admin/reports/report_main';
        $data['title'] = 'Nash Homes: Reports';
        $data['saleactive'] = $this->reports_model->count_properties_for_sale(1);
         $data['salenotactive'] = $this->reports_model->count_properties_for_sale(0);
         $data['sold'] = $this->reports_model->count_properties_sold();
         $data['soldnotactive'] = $this->reports_model->count_properties_sold(0);
         
         $data['rentactive'] = $this->reports_model->count_properties_for_rent(1);
         $data['rentnotactive'] = $this->reports_model->count_properties_for_rent(0);
         $data['rented'] = $this->reports_model->count_properties_rented();
         $data['rentednotactive'] = $this->reports_model->count_properties_rented(0);
        $this->load->vars($data);

        $this->load->view('admin/admin');
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('role');
        if (!isset($is_logged_in) || $role != 1) {
            $this->session->set_flashdata('message', 'You are not logged in');
            redirect('welcome', 'refresh');
        }
    }

}

/* End of file reports.php */
/* Location: ./system/application/controllers/admin/reports.php */