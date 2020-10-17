<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Helper extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('HelperModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }
}
