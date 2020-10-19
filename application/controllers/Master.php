<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('MenuModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function Index()
    {        
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->IndexLink())) {
            redirect(base_url('login'));
        } else {
            $data = $this->HelperModel->GetAllData($tableName,$fieldName,$order);

            $this->data['title'] = "Menu";
            $this->data['data'] = $data;

            $this->load->view('admin/folder_name/index', $this->data);
        }        
    }

    public function Add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
            $this->data['title'] = "Add New Menu";
            $this->data['formLink'] = "menu/save/";
            $this->data['buttonName'] = "Save";

            $this->load->view('admin/folder_name/add', $this->data);
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
        		redirect(base_url('master/add'));
        	} else {
                $data = array(
                    'field_name' => trim($this->input->post('inputName')),
                );

                $this->db->insert('tbl_menus', $data);
        		$this->session->set_flashdata('message', 'Menu Save Successfully.');
        		redirect(base_url('master'));
        	}
        }
    }

    public function Edit($id)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
            $dataInfo = $this->HelperModel->GetDataById($tableName,$id);

            $this->data['title'] = "Edit Data";
            $this->data['formLink'] = "/update/";
            $this->data['buttonName'] = "Update";
            $this->data['dataInfo'] = $dataInfo;

            $this->load->view('admin/folder_name/edit', $this->data);
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
        		redirect(base_url('master/edit/'.$id));
        	} else {
                $data = array(
                    'field_name' => trim($this->input->post('inputName')),
                );

                $this->db->where('id',$id);
                $this->db->update($tableName, $data);
        		$this->session->set_flashdata('message', 'Data Updated Successfully.');
        		redirect(base_url('master'));
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
