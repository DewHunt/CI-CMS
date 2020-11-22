<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

    public function __construct() {
        parent:: __construct();
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index() {
        $this->data['title'] = "Dashboard";

        // $this->load->view('header');
        // $this->load->view('navigation');
        $this->load->view('admin/home/index', $this->data);
    }
}
