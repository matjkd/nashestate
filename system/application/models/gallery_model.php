<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends Model {

    var $gallery_path;
    var $gallery_path_url;

    function Gallery_model() {

        parent::Model();

        $this->gallery_path = './images/properties';
        $this->gallery_path_url = base_url() . 'images/properties/';
    }

    /**
     *
     * @param type $id 
     */
    function do_upload($id) {

        //check file path exists.
        //maybe extend this check for each subfolder in future
        $path = $this->config_base_path . 'images/properties/' . $id . '/';

        //create directories if required
        if (file_exists($path)) {

            // folder exists, do nothing
        } else {

            //create folders
            mkdir('' . $this->config_base_path . 'images/properties/' . $id . '/');
            mkdir('' . $this->config_base_path . 'images/properties/' . $id . '/thumbs/');
            mkdir('' . $this->config_base_path . 'images/properties/' . $id . '/medium/');
            mkdir('' . $this->config_base_path . 'images/properties/' . $id . '/large/');
        }


        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png',
            'upload_path' => $this->gallery_path . '/' . $id . '',
            'max_size' => 2000
        );

        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $image_data = $this->upload->data();


        //resize the images
       
        
        
        $config = array(
            'source_image' => $image_data['full_path'],
            'image_library' => 'GD2',
            'wm_text' => 'Nash Homes 2017',
            'new_image' => $this->gallery_path . '/' . $id . '/thumbs',
            'maintain_ratio' => true,
            'width' => 134,
            'height' => 100
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->watermark();
        $this->image_lib->resize();
        $this->image_lib->clear();


        $config2 = array(
            'source_image' => $image_data['full_path'],
            'image_library' => 'GD2',
            'wm_text' => 'Nash Homes 2017',
            'new_image' => $this->gallery_path . '/' . $id . '/medium',
            'maintain_ratio' => true,
            'width' => 400,
            'height' => 300
        );

        $this->image_lib->initialize($config2);
        $this->image_lib->watermark();
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        
          $config3 = array(
            'source_image' => $image_data['full_path'],
            'image_library' => 'GD2',
            'wm_text' => 'Nash Homes 2017',
            'new_image' => $this->gallery_path . '/' . $id . '/',
            'maintain_ratio' => true,
            'width' => 640,
            'height' => 480
        );

         $this->image_lib->initialize($config3);
        $this->image_lib->watermark();
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        
        
        

        $upload_data = array($this->upload->data());

        foreach ($upload_data as $row):

            // add this to database $row['file_name'];
            $new_image_data = array(
                'filename' => $row['file_name'],
                'property_id' => $id,
                'print_order' => 5,
                'test' => $image_data['full_path']
            );

            $this->db->insert('property_images', $new_image_data);

        endforeach;
    }

    function do_uploader($id, $fullpath, $param1) {

        $param1 = str_replace(" ", "_", $param1);
        $filename2 = str_replace(".", "_", $param1);
        $filename = substr_replace($filename2, '.', strrpos($filename2, '_'), strlen('_'));


        $fullpath = $fullpath . $filename;

//check if filename exists in database for id
        $this->db->where('property_id', $id);
        $this->db->where('filename', $filename);
        $query = $this->db->get('property_images');
        if ($query->num_rows() == 1) {
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
            'width' => 800,
            'height' => 600
        );
        $this->image_lib->initialize($config3);
        $this->image_lib->resize();

        // add this to database $row['file_name'];
        $new_image_data = array(
            'filename' => $filename,
            'property_id' => $id,
            'print_order' => 5
        );

        $this->db->insert('property_images', $new_image_data);


        //delete files in uploads folder		



        delete_files('./images/uploads/');
    }

    function get_images($id) {

        $files = scandir('./images/properties/' . $id . '');
        $files = array_diff($files, array('.', '..', 'thumbs', 'medium', 'large'));

        $images = array();

        foreach ($files as $file) {
            $images [] = array(
                'url' => $this->gallery_path_url . '' . $id . '/' . $file . '',
                'thumb_url' => $this->gallery_path_url . '' . $id . '/thumbs/' . $file
            );
        }

        return $images;
    }

    function get_property_images($id) {
        $this->db->from('property_images');
        $this->db->where('property_id', $id);
        $this->db->order_by('print_order');
        $query = $this->db->get();

        if ($query->num_rows > 0)
            ; {

            return $query->result();
        }

        return FALSE;
    }

    function get_pdf_images($id) {
        $this->db->from('property_images');
        $this->db->where('property_id', $id);
        $this->db->where('printable', 1);
        $this->db->order_by('print_order');
        $this->db->limit(6);
        $query = $this->db->get();

        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }

        return FALSE;
    }

    function edit_images($id, $field, $value) {
        $update_data = array(
            $field => $value
        );
        $this->db->where('image_id', $id);
        $update2 = $this->db->update('property_images', $update_data);
        return $update2;
    }

    function delete_image($id) {
        $this->db->from('property_images');
        $this->db->where('image_id', $id);
        $query = $this->db->get();

        if ($query->num_rows == 1)
            ; {

            foreach ($query->result_array() as $row):

                $filename = $row['filename'];
                $property_id = $row['property_id'];

            endforeach;


            //delete image from database
            $this->db->where('image_id', $id);
            $delete = $this->db->delete('property_images');

            //delete images from server

            unlink('./images/properties/' . $property_id . '/' . $filename . '');
            unlink('./images/properties/' . $property_id . '/medium/' . $filename . '');
            unlink('./images/properties/' . $property_id . '/thumbs/' . $filename . '');
        }
    }

}