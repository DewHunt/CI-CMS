<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('MasterModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/index/'))) {
            redirect(base_url('login'));
        } else {
            $data = $this->HelperModel->GetAllData($tableName,$fieldName,$order);

            $this->data['title'] = "Master";

            $this->contentData['data'] = $data;

            $this->customCss = $this->load->view('admin/folder_name/css', '', TRUE);
            $this->cardBodyContent = $this->load->view('admin/folder_name/index', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/folder_name/js', '', TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }
    }

    public function add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/add/'))) {
            redirect(base_url('login'));
        } else {
            $this->data['title'] = "Add New Master";
            $this->data['formLink'] = "master/save/";
            $this->data['buttonName'] = "Save";

            $this->contentData['variableName'] = "";

            $this->customCss = $this->load->view('admin/folder_name/css', '', TRUE);
            $this->cardBodyContent = $this->load->view('admin/folder_name/add', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/folder_name/js', '', TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/add/'))) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>";
        	// print_r($this->input->post()); exit();

        	$data = $this->input->post('inputName');
        	$isExists = $this->HelperModel->CheckDataDuplicityByField($tableName,$fieldName,$data);

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'Master Already Exists.');
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

    public function edit($id)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/edit/'))) {
            redirect(base_url('login'));
        } else {
            $dataInfo = $this->HelperModel->GetDataById($tableName,$id);

            $this->data['title'] = "Edit Master";
            $this->data['formLink'] = "master/update/";
            $this->data['buttonName'] = "Update";

            $this->contentData['dataInfo'] = $dataInfo;
            $this->contentData['variableName'] = "";

            $this->customCss = $this->load->view('admin/folder_name/css', '', TRUE);
            $this->cardBodyContent = $this->load->view('admin/folder_name/edit', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/folder_name/js', '', TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/update/'))) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>";
        	// print_r($this->input->post()); exit();

        	$id = $this->input->post('id');
        	$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId($tableName,$fieldName,$data,$id);

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'Master Already Exists.');
        		redirect(base_url('master/edit/'.$id));
        	} else {
                $data = array(
                    'field_name' => trim($this->input->post('inputName')),
                );

                $this->db->where('id',$id);
                $this->db->update($tableName, $data);
        		$this->session->set_flashdata('message', 'Master Updated Successfully.');
        		redirect(base_url('master'));
        	}
        }
    }

    public function delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/delete/'))) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete($tableName, array('id' => $id));
        }
    }

    public function status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->link_permission('master/status/'))) {
            redirect(base_url('login'));
        } else {
            $id = $this->input->post('id');
            $this->HelperModel->UpdateStatus($tableName,$id);
        }
    }
}
