<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @name 		slideshow Admin
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */
class Slideshow extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('contacts_model');
        $this->load->model('properties_model');
        $this->load->model('ajax_model');
        $this->load->model('reports_model');
        $this->load->model('Gallery_model');
    }

    function index() {
        echo "it works";
    }

   

    function update($id) {
        //get uploader directory
        $id = "slideshow";
        $files = array();
        $files['files'] = array(
            'title' => 'Uploaded Files',
            'files' => get_filenames('./images/uploads/files'),
        );
        $data['upload_url'] = base_url() . 'images/uploads/';
        $data['files'] = $files;
        $data['property_details'] = $this->properties_model->get_property($id);
        
        foreach ($data['property_details'] as $row):

            $data['features'] = $this->properties_model->features($row->sale_rent);
            $company_id = $row->company_id;
            $user_id = $row->user_id;
			
        endforeach;
		
      

     
      

      

        $data['images'] = $this->Gallery_model->get_property_images($id);
         $data['page'] = 'properties';
      
        $data['property_id'] = $id;
        $data['title'] = 'Nash Homes Edit Slides';
        $data['update'] = "yes";
        $data['right_main'] = 'admin/properties/update_slides';
        $this->load->vars($data);
        $this->load->view('admin/admin');
    }

    

    function update_property1() {

        $id = $this->input->post('property_id');
        $this->properties_model->update_property1();

        redirect('admin/properties/update/' . $id . '/#tabs-1');
    }

    function update_property2($id) {


        $this->properties_model->update_property2($id);

        redirect('admin/properties/update/' . $id . '/#tabs-2');
    }

    function sold() {
        //property id
        $id = $this->input->post('property_id');

        //mark as sold in properties table (sold_rented)
        $this->properties_model->mark_sold($id);


        //add sold date to new line in sold table
        //use 'startdate_unix' (because it's a unix timestamp)
        $this->properties_model->add_sold();
        redirect('admin/properties/update/' . $id . '/#tabs-4');
    }

    function unsell($id) {
        //mark as not sold in properties table (sold_rented)
        //add current time to unsold
        $propertyid = $this->properties_model->scalar("sold", "property_id", "sold_id = $id");

        $this->properties_model->mark_unsold($id, $propertyid);



        redirect('admin/properties/update/' . $propertyid . '/#tabs-4');
    }

    function rented() {
        //property id
        $id = $this->input->post('property_id');
        $now = now();
        $from = $this->input->post('startdate_unix');
        $to = $this->input->post('enddate_unix');
        //mark as rented in properties table (sold_rented) if rented to date is later than now

        if ($to > $now) {
            $this->properties_model->mark_sold($id);
        }


        //add sold date to new line in sold table
        //use 'startdate_unix' (because it's a unix timestamp)
        if ($from < $to) {
            $this->properties_model->add_rented();
        }
        redirect('admin/properties/update/' . $id . '/#tabs-4');
    }

    function add_contact($id) {
        //create contact
        $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Enter a Firstname and Lastname');
            redirect('/admin/properties/update/' . $id . '#tabs-5');
        }

        // Create the company called firstname lastnames group

        $companydata['company_id'] = $this->contacts_model->add_company();

        foreach ($companydata['company_id'] as $row2):
            $company_id = $row2['company_id'];

        endforeach;

        // Add the user to above company
        $newuserdata['user_id'] = $this->contacts_model->quick_add_user($company_id);
        foreach ($newuserdata['user_id'] as $row3):
            $user_id = $row3['user_id'];
        endforeach;

        $this->session->set_flashdata('message', 'New Person Created');


        //add email address
        $contact_type = "Email";
        $contact_detail = $this->input->post('email');
        $this->contacts_model->add_contact_detail2($contact_type, $contact_detail, $company_id, $user_id);

        //add home phone
        $contact_type = "Home Tel";
        $contact_detail = $this->input->post('home_phone');
        $this->contacts_model->add_contact_detail2($contact_type, $contact_detail, $company_id, $user_id);

        //add work phone
        $contact_type = "Work Tel";
        $contact_detail = $this->input->post('work_phone');
        $this->contacts_model->add_contact_detail2($contact_type, $contact_detail, $company_id, $user_id);

        //add mobile
        $contact_type = "Mobile";
        $contact_detail = $this->input->post('mobile');
        $this->contacts_model->add_contact_detail2($contact_type, $contact_detail, $company_id, $user_id);


        //Assign User to the current property
        $this->properties_model->change_owner($id, $company_id);

        //refresh back to page 1 of property editing page
        redirect('/admin/properties/update/' . $id . '#tabs-1');
    }

    function change_owner($id) {
        $new_owner = $this->input->post('groups');
        $this->properties_model->change_owner($id, $new_owner);
        redirect('admin/properties/update/' . $id . '/#tabs-1');
    }

    function change_property_ref($id) {
        //check if property ref is not changed
        $newref = $this->input->post('property_ref');

        if ($newref == $id) {
            $this->session->set_flashdata('message', 'The id has not changed');
            redirect('admin/properties/update/' . $id . '');
        }

        //check if property ref already exists
        if ($this->properties_model->get_property($newref)) {
            $this->session->set_flashdata('message', 'property exists');
            redirect('admin/properties/update/' . $id . '');
        }


        //change images folder




        mkdir('' . $this->config_base_path . 'images/properties/' . $newref . '/');
        mkdir('' . $this->config_base_path . 'images/properties/' . $newref . '/thumbs/');
        mkdir('' . $this->config_base_path . 'images/properties/' . $newref . '/medium/');
        mkdir('' . $this->config_base_path . 'images/properties/' . $newref . '/large/');

        //move large files

        $mydir = './images/properties/' . $id . '/large/';
        $newdir = './images/properties/' . $newref . '/large/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {

                if (!copy($mydir . $entry, $newdir . $entry)) {
                    echo "failed to copy $file...\n";
                }
                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //move medium files
        $mydir = './images/properties/' . $id . '/medium/';
        $newdir = './images/properties/' . $newref . '/medium/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {

                if (!copy($mydir . $entry, $newdir . $entry)) {
                    echo "failed to copy $file...\n";
                }

                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //move thumbs
        $mydir = './images/properties/' . $id . '/thumbs/';
        $newdir = './images/properties/' . $newref . '/thumbs/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {

                if (!copy($mydir . $entry, $newdir . $entry)) {
                    echo "failed to copy $file...\n";
                }

                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //move root files	

        $mydir = './images/properties/' . $id . '/';
        $newdir = './images/properties/' . $newref . '/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {

                if (!copy($mydir . $entry, $newdir . $entry)) {
                    echo "failed to copy $file...\n";
                }

                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);









        //change property ref in everything

        if ($this->properties_model->change_property_ref($id, $newref)) {
            $this->session->set_flashdata('message', 'property ref changed');
            redirect('admin/properties/update/' . $newref . '');
        } else {
            $this->session->set_flashdata('message', 'error');
            redirect('admin/properties/update/' . $newref . '');
        }
    }

    function editable_property1() {



        $data['id'] = $this->input->post('id');
        $data['field'] = $this->input->post('elementid');
        $data['value'] = $this->input->post('value');
        $this->properties_model->edit_property1($data['id'], $data['field'], $data['value']);

        $update = $this->input->post('value');

        if ($data['field'] == 'property_type') {

            $data['data'] = $this->properties_model->get_property_type($data['value']);

            foreach ($data['data'] as $row2):
                $update = $row2['property_type_name'];
            endforeach;
        }
        if ($data['field'] == 'general_area') {

            $data['data'] = $this->properties_model->get_general_area($data['value']);

            foreach ($data['data'] as $row2):
                $update = $row2['area'];
            endforeach;
        }
        if ($data['field'] == 'user_id') {

            $data['data'] = $this->contacts_model->get_contact($data['value']);

            foreach ($data['data'] as $row2):
                $update = "" . $row2['firstname'] . " " . $row2['lastname'] . "";
            endforeach;
        }

        if ($data['field'] == 'active') {

            if ($data['value'] == 0) {
                $update = 'No';
            }

            if ($data['value'] == 1) {
                $update = 'Yes';
            }
        }

        //TODO convert to UNIX and return a normal 
        if ($data['field'] == 'date_of_instruction' || $data['field'] == 'available_from') {


            $datestring = "%m/%d/%Y";
            $time = strtotime($data['value']);




            $datetime = mdate($datestring, $time);

            $unixtime = strtotime($datetime);
            $this->properties_model->edit_property1($data['id'], $data['field'], $unixtime);

            //convert back to uk order
            $datestring2 = "%d/%m/%Y";
            $datetime2 = mdate($datestring2, $unixtime);
            $update = $datetime2;
        }


        $this->output->set_output($update);
    }

    function yesnojeditable() {

        $data['id'] = $this->input->post('id');
        $data['field'] = $this->input->post('elementid');
        $data['value'] = $this->input->post('value');

        //create sales data if it doesn't exist already
        $this->properties_model->create_sales_data($data['id']);


        $this->properties_model->edit_sales_data($data['id'], $data['field'], $data['value']);

        if ($data['value'] == 0) {
            $update = 'No';
        }

        if ($data['value'] == 1) {
            $update = 'Yes';
        }

        $this->output->set_output($update);
    }

    function editable_images() {
        //Move this function to the images model
        $data['id'] = $this->input->post('elementid');
        $data['field'] = 'printable';
        $data['value'] = $this->input->post('value');
        $this->properties_model->edit_images($data['id'], $data['field'], $data['value']);



        if ($data['value'] == 0) {
            $update = 'No';
        }

        if ($data['value'] == 1) {
            $update = 'Yes';
        }



        $this->output->set_output($update);
    }

    function image_order() {
        //Move this function to the images model	
        $data['id'] = $this->input->post('elementid');
        $data['field'] = 'print_order';
        $data['value'] = $this->input->post('value');
        $this->properties_model->edit_images($data['id'], $data['field'], $data['value']);

        $update = $this->input->post('value');

        $this->output->set_output($update);
    }

    function editable_salesdata() {
        $data['id'] = $this->input->post('id');
        $data['field'] = $this->input->post('elementid');
        $data['value'] = $this->input->post('value');
        $this->properties_model->edit_sales_data($data['id'], $data['field'], $data['value']);

        $update = $this->input->post('value');


        if ($data['value'] == 0) {
            $update = 'No';
        }

        if ($data['value'] == 1) {
            $update = 'Yes';
        }


        $this->output->set_output($update);
    }

    function rooms_add_row($id) {
        $this->properties_model->room_insert_row($id);
        $data['room_table'] = $this->properties_model->get_rooms_table($id);
        $data['rooms'] = $this->properties_model->list_rooms();
        $data['additional'] = $this->properties_model->list_additional();
        $this->load->vars($data);
        $this->load->view('admin/properties/room_table');
    }

    function delete_room() {
        $id = $this->input->post('id');
        $this->properties_model->delete_room_row($id);
    }

    function rooms_table() {
        $data['id'] = $this->uri->segment(4);

        $data['room_table'] = $this->properties_model->get_rooms_table($data['id']);
        $data['rooms'] = $this->properties_model->list_rooms();
        $data['additional'] = $this->properties_model->list_additional();
        $this->load->vars($data);
        $this->load->view('admin/properties/room_table');
    }

    function edit_room_table() {
        $data['id'] = $this->input->post('id');
        $data['field'] = $this->input->post('elementid');
        $data['value'] = $this->input->post('value');
        $this->properties_model->edit_room($data['id'], $data['field'], $data['value']);
        $update = $this->input->post('value');

        if ($data['field'] == 'room_type') {

            $data['data'] = $this->properties_model->get_room_type($data['value']);

            foreach ($data['data'] as $row2):
                $update = $row2['room_name'];
            endforeach;
        }
        if ($data['field'] == 'room_additional') {

            $data['data'] = $this->properties_model->get_additional_type($data['value']);

            foreach ($data['data'] as $row2):
                $update = $row2['additional'];
            endforeach;
        }


        $this->output->set_output($update);
    }

    function add_rooms() {

        $this->form_validation->set_rules('number_of_rooms', 'number_of_rooms', 'required|numeric');

        $property_id = $this->input->post('property_id');
        $room_id = $this->input->post('room_id');
        $number_of_rooms = $this->input->post('number_of_rooms');

        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            $this->session->set_flashdata('message', 'room number must be a number');
            redirect('admin/properties/update/' . $property_id . '');
        }

        $this->properties_model->add_rooms($room_id, $number_of_rooms, $property_id);

        redirect('admin/properties/update/' . $property_id);
    }

    function add_feature() {
        $segment_active = $this->uri->segment(4);
        if ($segment_active == NULL) {
            redirect('welcome', 'refresh');
        } else {
            $this->properties_model->add_feature($segment_active);

            redirect('admin/properties/update/' . $segment_active . '#tabs-2');
        }
    }

    function delete_property_feature($id) {

        $data['property_id'] = $this->properties_model->delete_assigned_feature($id);
        foreach ($data['property_id'] as $key => $row):
            $property = $row['property_id'];
        endforeach;

        redirect('admin/properties/update/' . $property . '#tabs-2', 'refresh');
    }

    function archive_property($id) {
        $this->properties_model->archive_property($id);

        $check = strpos($id, 'R');
        if ($check !== false) {
            redirect('admin/properties/view_rentals');
        } else {
            redirect('admin/properties/view_sales');
        }
    }

    function unarchive_property($id) {
        $this->properties_model->unarchive_property($id);

        $check = strpos($id, 'R');
        if ($check !== false) {
            redirect('admin/properties/view_rentals');
        } else {
            redirect('admin/properties/view_sales');
        }
    }

    function featured_property($id) {
        $this->form_validation->set_rules('date', 'date', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'You must enter a date');
            redirect('admin/properties/update/' . $id . '/#tabs-4');
        }


        $date = strtotime($this->input->post('date'));


        $this->properties_model->make_featured($id, $date);
        $this->session->set_flashdata('message', 'Feature Property Added ' . $date . '');
        redirect('admin/properties/update/' . $id . '/#tabs-4');
    }

    function delete_featured_property($id) {
        $data['property'] = $this->properties_model->delete_featured_property($id);

        foreach ($data['property'] as $row):
            $propertyref = $row['property_ref'];
        endforeach;

        redirect('admin/properties/update/' . $propertyref . '/#tabs-4');
    }

    function premiere_property($id) {
        $this->form_validation->set_rules('datestart', 'datestart', 'required');
        $this->form_validation->set_rules('dateend', 'dateend', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'You must enter a date');
            redirect('admin/properties/update/' . $id . '/#tabs-4');
        }


        $datestart = strtotime($this->input->post('datestart'));
        $dateend = strtotime($this->input->post('dateend'));

        $this->properties_model->make_premiere($id, $datestart, $dateend);
        $this->session->set_flashdata('message', 'Premiere Property Added ' . $datestart . '');
        redirect('admin/properties/update/' . $id . '/#tabs-4');
    }

    function delete_premiere_property($id) {
        $data['property'] = $this->properties_model->delete_premiere_property($id);

        foreach ($data['property'] as $row):
            $propertyref = $row['property_ref'];
        endforeach;

        redirect('admin/properties/update/' . $propertyref . '/#tabs-4');
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

/* End of file slideshow.php */
/* Location: ./system/application/controllers/admin/slideshow.php */