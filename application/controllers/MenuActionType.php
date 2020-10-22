<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuActionType extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('MenuActionTypeModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function Index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->IndexLink())) {
            redirect(base_url('login'));
        } else {
	        $menuActionTypes = $this->HelperModel->GetAllData('tbl_menu_action_type','action_id','ASC');

	        $this->data['title'] = "Menu Action Type";
	        $this->data['menuActionTypes'] = $menuActionTypes;

	        $this->load->view('admin/menu_action_type/index', $this->data);
        }
    }

    public function Add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
	        $maxActionId = $this->MenuActionTypeModel->GetMaxAction();

	        if ($maxActionId) {
	        	$actionId = $maxActionId->maxActionId + 1;
	        } else {
	        	$actionId = 1;
	        }

	        $this->data['title'] = "Add New Menu Action Type";
	        $this->data['formLink'] = "menuactiontype/save/";
	        $this->data['buttonName'] = "Save";
	        $this->data['actionId'] = $actionId;

	        $this->load->view('admin/menu_action_type/add', $this->data);
	    }
    }

    public function Save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
	    	// echo "<pre>"; print_r($this->input->post()); exit();

	    	$actionId = $this->input->post('actionId');
	    	$isExists = $this->HelperModel->CheckDataDuplicityByField('tbl_menu_action_type','action_id',$actionId);

	    	if ($isExists) {
	    		$this->session->set_flashdata('error', 'Menu Action Id Already Exists.');
	    		redirect(base_url('menuactiontype/add'));
	    	} else {
	            $data = array(
	                'name' => trim($this->input->post('name')),
	                'action_id' => $actionId,
	            );

	            $this->db->insert('tbl_menu_action_type', $data);
	    		$this->session->set_flashdata('message', 'Menu Action Type Save Successfully.');
	    		redirect(base_url('menuactiontype'));
	    	}
	    }
    }

    public function Edit($menuActionTypeId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
	        $menuActionTypeInfo = $this->HelperModel->GetDataById('tbl_menu_action_type',$menuActionTypeId);

	        $this->data['title'] = "Edit Menu Action Type";
	        $this->data['formLink'] = "menuactiontype/update/";
	        $this->data['buttonName'] = "Update";
	        $this->data['menuActionTypeInfo'] = $menuActionTypeInfo;

	        $this->load->view('admin/menu_action_type/edit', $this->data);
	    }
    }

    public function Update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
	    	// echo "<pre>"; print_r($this->input->post()); exit();

	    	$actionId = $this->input->post('actionId');
	    	$menuActionTypeId = $this->input->post('menuActionTypeId');

	    	$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId('tbl_menu_action_type','action_id',$actionId,$menuActionTypeId);

	    	if ($isExists) {
	    		$this->session->set_flashdata('error', 'Menu Action Type Id Already Exists.');
	    		redirect(base_url('menuactiontype/edit/'.$menuActionTypeId));
	    	} else {
	            $data = array(
	                'name' => trim($this->input->post('name')),
	                'action_id' => $actionId,
	            );

	            $this->db->where('id',$menuActionTypeId);
	            $this->db->update('tbl_menu_action_type', $data);
	    		$this->session->set_flashdata('message', 'Menu Action Type Updated Successfully.');
	    		redirect(base_url('menuactiontype'));
	    	}
	    }
    }

    public function Delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->DeleteLink())) {
            redirect(base_url('login'));
        } else {
	    	$id = $this->input->post('id');
	    	$this->db->delete('tbl_menu_action_type', array('id' => $id));
	    }	
    }

    public function Status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->StatusLink())) {
            redirect(base_url('login'));
        } else {
	    	$id = $this->input->post('id');
	    	$this->HelperModel->UpdateStatus('tbl_menu_action_type',$id);
	    }
    }
}
