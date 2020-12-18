<?php

    class Pages extends CI_Controller {

        public function view($page = "home") {

            if(!file_exists(APPPATH . "views/pages/" . $page . ".php")) {
                show_404();
            }
            $this->load->helper("url");
            $data["title"] = ucfirst($page) . " Page";

            $this->load->view("template/header.php");
            $this->load->view("pages/" . $page . ".php", $data);
            $this->load->view("template/footer.php");
        }
    }

?>