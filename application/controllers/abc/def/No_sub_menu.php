<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class No_sub_menu extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->helper('file');
        $this->load->model('User_model');
        $this->load->model('Menu_model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('abc/def/no_sub_menu/index/') === false) {
            redirect(base_url('login'));
        } else {
        	echo "No Sub Menu Index Function"; exit();
            $allUsers = $this->User_model->get_all_users();

            $this->data['title'] = "User";
            $this->contentData['allUsers'] = $allUsers;

            $this->cardBodyContent = $this->load->view('admin/user/index', $this->contentData, TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }
    }

    public function add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('abc/def/no_sub_menu/add/') === false) {
            redirect(base_url('login'));
        } else {
        	echo "No Sub Menu Add Function"; exit();
        	$allUserRoles = $this->Helper_model->get_all_data('tbl_user_roles','name','ASC');

            $this->data['title'] = "Add New User";
            $this->data['formLink'] = "user/save/";
            $this->data['buttonName'] = "Save";

            $this->contentData['allUserRoles'] = $allUserRoles;

            $this->cardBodyContent = $this->load->view('admin/user/add', $this->contentData, TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function edit($id)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('abc/def/no_sub_menu/add/') === false) {
            redirect(base_url('login'));
        } else {
        	echo "No Sub Menu Add Function"; exit();
        	$allUserRoles = $this->Helper_model->get_all_data('tbl_user_roles','name','ASC');

            $this->data['title'] = "Add New User";
            $this->data['formLink'] = "user/save/";
            $this->data['buttonName'] = "Save";

            $this->contentData['allUserRoles'] = $allUserRoles;

            $this->cardBodyContent = $this->load->view('admin/user/add', $this->contentData, TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }
}
