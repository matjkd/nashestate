<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends Model {

    function __construct() {
        parent::Model();
    }
    
    /**
     *
     * @param type $table
     * @param type $field
     * @param type $value
     * @param type $id 
     */
    function convert_to_unix($table, $field, $value, $id, $id_field) {
        
        $form_data = array(
            $field => $value
        );

        $this->db->where($id_field, $id);
        $this->db->update($table, $form_data);
        return;
        
    }

    function get_old_properties() {
        $this->db->from('Propiedades');

        $this->db->where('Propiedades.imported', NULL);
        $this->db->or_where('Propiedades.imported', '1');
        $this->db->or_where('Propiedades.imported', '2');
        $this->db->join('general_area', 'general_area.area = Propiedades.address', 'left');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0)
             {
            return $query->result();
        }

        return FALSE;
    }

    function get_old_areas() {
        $this->db->from('Localidades');
        $query = $this->db->get();
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }

        return FALSE;
    }

    function add_rooms($room_id, $number_of_rooms, $property_id) {
        //add something to check rooms haven't already been added
        // add room to property_rooms
        // room_type is $room_id, property_id is $property_id.
        // Repeat $number_of_rooms times
        $x = 0;
        while ($x < $number_of_rooms) {
            $new_room = array(
                'room_type' => $room_id,
                'property_id' => $property_id,
            );


            $this->db->insert('property_rooms', $new_room);
            $x = $x + 1;
        }
    }

    function select_rentals() {
        $this->db->from('property_main');

        $this->db->like('property_ref_no', 'R');
        $this->db->where('sale_rent <', 2);
        $query = $this->db->get();
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }

        return FALSE;
    }

    function select_sales() {
        $this->db->from('property_main');

        $this->db->not_like('property_ref_no', 'R', 'after');
        $this->db->where('sale_rent !=', 1);
        //$this->db->or_where('sale_rent', 0);

        $query = $this->db->get();
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }

        return FALSE;
    }

    function change_rentals($id) {
        $form_data = array(
            'sale_rent' => 2
        );

        $this->db->where('property_id', $id);
        $this->db->update('property_main', $form_data);
    }

    function change_sales($id) {
        $form_data = array(
            'sale_rent' => 1
        );

        $this->db->where('property_id', $id);
        $this->db->update('property_main', $form_data);
    }

    function update_address($id, $address) {

        $form_data = array(
            'address' => $address
        );

        $this->db->where('id_property', $id);
        $this->db->update('Propiedades', $form_data);
    }

    function mark_imported($id) {
        $form_data = array(
            'imported' => 4
        );

        $this->db->where('id_property', $id);
        $this->db->update('imagen', $form_data);
    }

    function mark_image_imported($id) {
        $form_data = array(
            'imported' => 6
        );

        $this->db->where('Cod_img', $id);
        $this->db->update('imagen', $form_data);
    }

    function get_images() {
        $this->db->from('imagen');

        $this->db->where('imagen.imported', NULL);
        $this->db->or_where('imagen.imported', '1');
        $this->db->or_where('imagen.imported', '2');
        $this->db->or_where('imagen.imported', '3');
        $this->db->or_where('imagen.imported', '4');
        $this->db->or_where('imagen.imported', '5');
        $this->db->join('Propiedades', 'Propiedades.Cod = imagen.Cod_not', 'right');
        $this->db->order_by('imagen.Cod_not', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }

        return FALSE;
    }

    function do_uploader($id, $fullpath, $param1) {

        $this->gallery_path = './images/properties';
        $this->gallery_path_url = base_url() . 'images/properties/';

        $param1 = str_replace(" ", "_", $param1);
        $filename2 = str_replace(".", "_", $param1);
        $filename = substr_replace($filename2, '.', strrpos($filename2, '_'), strlen('_'));



        $fullpath = $fullpath . $filename;
        //check if filename exists in database for id
        $this->db->where('property_id', $id);
        $this->db->where('filename', $filename);
        $query = $this->db->get('property_images');

        if ($query->num_rows() == 1) {
            $thumblocation = "../public_html/images/properties/" . $id . "/thumbs/" . $filename;
            $config = array(
                'source_image' => $fullpath,
                'new_image' => $this->gallery_path . '/' . $id . '/thumbs',
                'maintain_ratio' => true,
                'width' => 134,
                'height' => 100
            );

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return;
        }



        $config = array(
            'source_image' => $fullpath,
            'new_image' => $this->gallery_path . '/' . $id . '/thumbs',
            'maintain_ratio' => true,
            'width' => 134,
            'height' => 100
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();


        $config2 = array(
            'source_image' => $fullpath,
            'new_image' => $this->gallery_path . '/' . $id . '/medium',
            'maintain_ratio' => true,
            'width' => 400,
            'height' => 300
        );

        $this->image_lib->initialize($config2);
        $this->image_lib->resize();
        $this->image_lib->clear();

        $config3 = array(
            'source_image' => $fullpath,
            'new_image' => $this->gallery_path . '/' . $id . '',
            'maintain_ratio' => true,
        );
        $this->image_lib->initialize($config3);
        $this->image_lib->resize();

        // add this to database $row['file_name'];
        $new_image_data = array(
            'filename' => $filename,
            'property_id' => $id
        );

        $this->db->insert('property_images', $new_image_data);
    }

}