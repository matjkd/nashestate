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

    function properties_sold($active=1) {

        $this->db->having('sold_rented', 1);

        $this->db->having('sale_rent', 1);

        $this->db->where('active', $active);
        if ($active == 0) {
            $this->db->or_where('active', NULL);
        }
        $this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');
        $this->db->join('company', 'company.company_id=property_main.company_id', 'left');
        $query = $this->db->get('property_main');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
            $query->free_result();
            return $data;
        }
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

    function properties_rented($active=1) {

        $this->db->having('sold_rented', 1);

        $this->db->having('sale_rent', 2);

        $this->db->where('active', $active);
        if ($active == 0) {
            $this->db->or_where('active', NULL);
        }
        $this->db->join('property_types', 'property_types.property_type_id=property_main.property_type', 'left');
        $this->db->join('company', 'company.company_id=property_main.company_id', 'left');
        $query = $this->db->get('property_main');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
            $query->free_result();
            return $data;
        }
    }

}