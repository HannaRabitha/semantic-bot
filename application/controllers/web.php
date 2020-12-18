<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Web extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url','html');
	}
 
	public function index(){		
		$data['judul'] = "Home";
		$this->load->view('v_header',$data);
		$this->load->view('v_index',$data);
		$this->load->view('v_footer',$data);
	}
 
	public function about(){		
		$data['judul'] = "Halaman about";
		$this->load->view('v_header',$data);
		$this->load->view('v_about',$data);
		$this->load->view('v_footer',$data);
	}


	public function foodlist(){		
		$data['judul'] = "Halaman about";
		$this->load->view('v_header',$data);
		$this->load->view('v_foodlist',$data);
		$this->load->view('v_footer',$data);
	}

	public function foodlist2(){		
		$data['judul'] = "Halaman about";
		
		$this->load->view('foodlist',$data);
		
	}

	public function komposisi(){		
		$data['judul'] = "Halaman about";
		$this->load->view('v_header',$data);
		$this->load->view('v_komposisi',$data);
		$this->load->view('v_footer',$data);
	}

	public function restaurant(){		
		$data['judul'] = "Halaman about";
		$this->load->view('v_header',$data);
		$this->load->view('v_restaurant',$data);
		$this->load->view('v_footer',$data);
	}


	public function chef(){		
		$data['judul'] = "Halaman about";
		$this->load->view('v_header',$data);
		$this->load->view('v_chef',$data);
		$this->load->view('v_footer',$data);
	}

	public function chef2(){		
		
		$this->load->view('cheflist');
		
	}

	public function biodatachef(){		
		
		$this->load->view('chef');
		
	}


	public function login() {

		$this->load->view('v_login');

	}

	public function newlist(){		
		$data['judul'] = "Halaman about";
		$this->load->view('v_header',$data);
		$this->load->view('v_newlist',$data);
		$this->load->view('v_footer',$data);
	}
}