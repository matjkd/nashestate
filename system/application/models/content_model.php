<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content_model extends Model {

    /**
     * 
     */
    function __construct() {
        parent::__construct();
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_content($id) {
        $data = array();
        $this->db->where('content_menu', $id);

        $query = $this->db->get('content');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    /**
     *
     * @return type 
     */
    function get_all_content() {
        $data = array();

        $query = $this->db->get('content');
        if ($query->num_rows() > 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_content_edit($id) {
        $data = array();
        $this->db->where('content_id', $id);
        $query = $this->db->get('content');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function update_content($id) {

        $content_id = $id;

        $form_data = array(
            'content' => $this->input->post('content'),
            'extra' => $this->input->post('extra')
        );


        $this->db->where('content_id', $content_id);
        $this->db->update('content', $form_data);

        if ($this->db->affected_rows() == '1') {

            return TRUE;
        }

        return FALSE;
    }

    /**
     *
     * @return type 
     */
    function add_content() {
        $form_data = array(
            'content_title' => $this->input->post('title'),
            'content_menu' => $this->input->post('menu'),
            'content' => $this->input->post('content'),
            'extra' => $this->input->post('extra')
        );



        $this->db->insert('content', $form_data);

        if ($this->db->affected_rows() == '1') {

            return TRUE;
        }

        return FALSE;
    }

    /**
     *
     * @return type 
     */
    function get_testimonials() {
        $data = array();



        $this->db->order_by('testimonial_id', 'DESC');
        $query = $this->db->get('testimonials');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }

        $query->free_result();

        return $data;
    }
    
      /**
     *
     * @return type 
     */
    function get_testimonial($id) {
        $data = array();

        $this->db->where('testimonial_id', $id);
        $query = $this->db->get('testimonials');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }

        $query->free_result();

        return $data;
    }
    
     function get_testimonial_edit($id) {
        $data = array();
        $this->db->where('testimonial_id', $id);
        $query = $this->db->get('testimonials');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    /**
     *
     * @return type 
     */
    function get_menus() {
        $data = array();



        $this->db->order_by('content_order', 'ASC');
        $query = $this->db->get('content');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }

        $query->free_result();

        return $data;
    }

}