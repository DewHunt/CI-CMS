<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('UserModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function Index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->IndexLink())) {
            redirect(base_url('login'));
        } else {
            $allUsers = $this->UserModel->GetAllUsers();

            $this->data['title'] = "User";
            $this->data['allUsers'] = $allUsers;

            $this->load->view('admin/user/index', $this->data);
        }
    }

    public function Add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
        	$allUserRoles = $this->HelperModel->GetAllData('tbl_user_roles','name','ASC');

            $this->data['title'] = "Add New User";
            $this->data['formLink'] = "user/save/";
            $this->data['buttonName'] = "Save";
            $this->data['allUserRoles'] = $allUserRoles;

            $this->load->view('admin/user/add', $this->data);
        }
    }

    public function Save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>";
        	// print_r($this->input->post()); exit();

        	$data = $this->input->post('inputName');
        	$isExists = $this->HelperModel->CheckDataDuplicityByField($tableName,$fieldName,$data);

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'Data Already Exists.');
        		redirect(base_url('user/add'));
        	} else {
                $data = array(
                    'field_name' => trim($this->input->post('inputName')),
                );

                $this->db->insert('tbl_menus', $data);
        		$this->session->set_flashdata('message', 'Menu Save Successfully.');
        		redirect(base_url('user'));
        	}
        }
    }

    public function Edit($userId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
            $userInfo = $this->HelperModel->GetDataById('tbl_users',$userId);
        	$allUserRoles = $this->HelperModel->GetAllData('tbl_user_roles','name','ASC');

            $this->data['title'] = "Edit User";
            $this->data['formLink'] = "user/update/";
            $this->data['buttonName'] = "Update";
            $this->data['userInfo'] = $userInfo;
            $this->data['allUserRoles'] = $allUserRoles;

            $this->load->view('admin/user/edit', $this->data);
        }
    }

    public function Update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>";
        	// print_r($this->input->post()); exit();

        	$id = $this->input->post('id');
        	$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId($tableName,$fieldName,$data,$id);

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'Data Already Exists.');
        		redirect(base_url('user/edit/'.$id));
        	} else {
                $data = array(
                    'field_name' => trim($this->input->post('inputName')),
                );

                $this->db->where('id',$id);
                $this->db->update($tableName, $data);
        		$this->session->set_flashdata('message', 'Data Updated Successfully.');
        		redirect(base_url('user'));
        	}
        }
    }

    public function Delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->DeleteLink())) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete($tableName, array('id' => $id));
        }
    }

    public function Status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->StatusLink())) {
            redirect(base_url('login'));
        } else {
            $id = $this->input->post('id');
            $this->HelperModel->UpdateStatus($tableName,$id);
        }
    }
}