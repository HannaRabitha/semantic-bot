<?php

    class Mymodel extends CI_Model {

        function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function get_data($slug = FALSE) {

           if ($slug == FALSE) {
               $query = $this->db->get("food");
               return $query->result_array();
           }

           $query = $this->db->get_where("food", array("tag" => $slug));
           return $query->result_array();
        }

        public function get_post($slug) {
            $query = $this->db->get_where("food", array("kode_makanan" => $slug));
            return $query->row_array();
        }

    }

?>