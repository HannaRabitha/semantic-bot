<?php


class Posts extends CI_Controller {

    public function index($slug = FALSE) {

        if ($slug == FALSE) {
            show_404();
        }
        $this->load->helper('url');
        $this->load->model("Mymodel");

        $result = $this->Mymodel->get_post($slug);
        $data["post"] = $result;

        $this->load->view("template/header.php");
        $this->load->view("pages/post.php", $data);
        $this->load->view("template/footer.php");
    }
}


?>