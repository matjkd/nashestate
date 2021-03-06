<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Features extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('features_model');
    }

    function index() {
        
    }

    function view_features() {
        $data['right_main'] = 'admin/config/features_config';

        $data['page'] = 'config';

        $data['title'] = 'Nash Homes Configuration';

        $data['heading'] = 'Features Config';

        $segment_active = $this->uri->segment(4);

        if ($segment_active > 0) {
            $data['feature_id'] = $segment_active;
            $data['feature_data'] = $this->features_model->get_feature($segment_active);
            foreach ($data['feature_data'] as $row):

                $data['feature_name'] = $row['features'];
            endforeach;
        }

        $data['features'] = $this->features_model->list_features();
        $this->load->vars($data);

        $this->load->view('admin/admin');
    }

    function update_feature() {
        $id = $this->input->post('id');
        $this->features_model->update_feature();
        redirect('admin/features/view_features/' . $id);
    }

    function make_default($id) {
        $this->features_model->toggle_default($id, 1);
        redirect('admin/features/view_features');
    }

    function remove_default($id) {
        $this->features_model->toggle_default($id, 0);
        redirect('admin/features/view_features');
    }

    function delete_feature($id) {
        $this->features_model->delete_feature($id);
        redirect('admin/features/view_features');
    }

     /**
     * change order of list with jquery ui autocomplete
     */
    function sortlist() {
        $pages = $this->input->post('pages');
        $pages = str_replace(";", "",  $pages);
        parse_str($pages, $pageOrder);
print_r($pageOrder);
        // list id is retrieved from the ID on the sortable list
        foreach ($pageOrder['page'] as $key => $value):
           
            mysql_query("UPDATE ignite_property_features SET `features_order` = '$key' WHERE `pf_id` = '$value'") or die(mysql_error());

echo "UPDATE ignite_property_features SET `features_order` = '$key' WHERE `pf_id` = '$value'";
        //$this->db->update('practice_area_links', $pro_update);
        endforeach;
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