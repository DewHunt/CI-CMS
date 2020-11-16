<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('User_model');
    }

    public function index() {
        if (!empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url());
        } else {
	        $this->data['title'] = "Login";
	        $this->load->view('admin/login/login',$this->data);
        }
    }

    public function login_action()
    {
    	$userNameOrEmail = $this->input->post('userNameOrEmail');
    	$password = sha1(trim($this->input->post('password')));

    	$loginStatus = $this->User_model->get_user_info_by_user_name_or_email_and_password($userNameOrEmail,$password);

    	if (!empty($loginStatus)) {
    		// $userInformationData = array(
    		// 	'id' => $loginStatus->id,
    		// 	'name' => $loginStatus->name,
    		// 	'email' => $loginStatus->email,
    		// 	'user_name' => $loginStatus->user_name,
    		// 	'role' => $loginStatus->role,
    		// 	'status' => $loginStatus->status,
    		// );
    		$this->session->set_userdata('sessionUserInfo',$loginStatus);

    		redirect(base_url());
    	} else {
    		redirect(base_url('login'));
    	}    	
    }

    public function logout() {
        if (!empty($this->session->userdata('sessionUserInfo'))) {
            $this->session->sess_destroy();
            //$this->get_all_session_clear();
            redirect(base_url('login'));
        } else {
            redirect(base_url('login'));
        }
    }
}
