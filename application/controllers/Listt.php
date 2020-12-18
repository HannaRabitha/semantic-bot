<?php

class Listt extends CI_Controller {

    public function index($id = FALSE) {

        if(!file_exists(APPPATH . "views/pages/list.php")) {
            show_404();
        }

        $this->load->helper("url");
        $this->load->model("Mymodel");

        $result = $this->Mymodel->get_data($id);
        $data["post"] = $result;

        $this->load->view("template/header.php");
        $this->load->view("pages/list.php", $data);
        $this->load->view("template/footer.php");
    }
}


?>
