<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        // $this->load->model('Company_Model');
        $this->load->model('UserModel');
        // $this->load->model('Login_log_details_Model');
        // $this->load->model('Notification_Model');
        // $this->load->model('Notification_assign_Model');
        // $this->load->model('Weekend_settings_Model');
        // $this->load->model('Calendar_Model');
        // $this->load->model('Events_Model');
        // $this->load->model('Product_Model');
        // $this->load->model('Product_reorder_level_Model');
    }

    public function Index() {
        if (!empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url());
        } else {
	        $this->data['title'] = "Login";
	        $this->load->view('admin/login/login',$this->data);
        }
    }

    public function LoginAction()
    {
    	$userNameOrEmail = $this->input->post('userNameOrEmail');
    	echo $password = sha1(trim($this->input->post('password')));

    	$loginStatus = $this->UserModel->getUserInfoByUserNameOrEmailAndPassword($userNameOrEmail,$password);

    	if (!empty($loginStatus)) {
    		$userInformationData = array(
    			'id' => $loginStatus->id,
    			'name' => $loginStatus->name,
    			'email' => $loginStatus->email,
    			'user_name' => $loginStatus->user_name,
    			'role' => $loginStatus->role,
    			'staus' => $loginStatus->statu
    		);
    		$this->session->set_userdata('sessionUserInfo',$userInformationData);

    		redirect(base_url());
    	} else {
    		redirect(base_url('login'));
    	}    	
    }

    public function Logout() {
        if (!empty($this->session->userdata('sessionUserInfo'))) {
            $this->session->sess_destroy();
            //$this->get_all_session_clear();
            redirect(base_url('login'));
        } else {
            redirect(base_url('login'));
        }
    }
}
