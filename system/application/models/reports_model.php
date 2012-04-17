<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports_model extends Model {

    function __construct() {
        parent::Model();
    }

    function count_properties_for_sale($active=1) {

        $this->db->where('active', $active);
        if ($active == 0) {
            $this->db->or_where('active', NULL);
        }
        $this->db->having('sale_rent', 1);
        $query = $this->db->get('property_main');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function count_properties_for_rent($active=1) {

        $this->db->where('active', $active);
        if ($active == 0) {
            $this->db->or_where('active', NULL);
        }
        $this->db->having('sale_rent', 2);
        $query = $this->db->get('property_main');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function count_properties_sold($active=1) {

        $this->db->having('sold_rented', 1);

        $this->db->having('sale_rent', 1);
        
        $this->db->where('active', $active);
        if ($active == 0) {
            $this->db->or_where('active', NULL);
        }
        
        $query = $this->db->get('property_main');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function count_properties_rented($active=1) {

        $this->db->having('sold_rented', 1);
          $this->db->where('active', $active);
        if ($active == 0) {
            $this->db->or_where('active', NULL);
        }
        $this->db->having('sale_rent', 2);

        $query = $this->db->get('property_main');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

}