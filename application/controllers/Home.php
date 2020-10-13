<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        // $this->load->model('Company_Model');
        // $this->load->model('User_Model');
        // $this->load->model('Login_log_details_Model');
        // $this->load->model('Notification_Model');
        // $this->load->model('Notification_assign_Model');
        // $this->load->model('Weekend_settings_Model');
        // $this->load->model('Calendar_Model');
        // $this->load->model('Events_Model');
        // $this->load->model('Product_Model');
        // $this->load->model('Product_reorder_level_Model');
        
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
