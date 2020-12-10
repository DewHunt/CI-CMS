<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_action_type extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('Menu_action_type_model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/index/'))) {
            redirect(base_url('login'));
        } else {
	        $menuActionTypes = $this->Helper_model->get_all_data('tbl_menu_action_type','action_id','ASC');

	        $this->data['title'] = "Menu Action Type";
	        $this->contentData['menuActionTypes'] = $menuActionTypes;

            $this->cardBodyContent = $this->load->view('admin/menu_action_type/index', $this->contentData, TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }
    }

    public function add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/add/'))) {
            redirect(base_url('login'));
        } else {
	        $maxActionId = $this->Menu_action_type_model->get_max_action();

	        if ($maxActionId) {
	        	$actionId = $maxActionId->maxActionId + 1;
	        } else {
	        	$actionId = 1;
	        }

	        $this->data['title'] = "Add New Menu Action Type";
	        $this->data['formLink'] = "menu_action_type/save/";
	        $this->data['buttonName'] = "Save";

	        $this->contentData['actionId'] = $actionId;

            $this->cardBodyContent = $this->load->view('admin/menu_action_type/add', $this->contentData, TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
	    }
    }

    public function save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/add/'))) {
            redirect(base_url('login'));
        } else {
	    	// echo "<pre>"; print_r($this->input->post()); exit();

	    	$actionId = $this->input->post('actionId');
	    	$isExists = $this->Helper_model->check_data_duplicity_by_field('tbl_menu_action_type','action_id',$actionId);

	    	if ($isExists) {
	    		$this->session->set_flashdata('error', 'Menu Action Id Already Exists.');
	    		redirect(base_url('menu_action_type/add'));
	    	} else {
	            $data = array(
	                'name' => trim($this->input->post('name')),
	                'action_id' => $actionId,
	            );

	            $this->db->insert('tbl_menu_action_type', $data);
	    		$this->session->set_flashdata('message', 'Menu Action Type Save Successfully.');
	    		redirect(base_url('menu_action_type'));
	    	}
	    }
    }

    public function edit($menuActionTypeId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/edit/'))) {
            redirect(base_url('login'));
        } else {
	        $menuActionTypeInfo = $this->Helper_model->get_data_by_id('tbl_menu_action_type',$menuActionTypeId);

	        $this->data['title'] = "Edit Menu Action Type";
	        $this->data['formLink'] = "menu_action_type/update/";
	        $this->data['buttonName'] = "Update";

	        $this->contentData['menuActionTypeInfo'] = $menuActionTypeInfo;

            $this->cardBodyContent = $this->load->view('admin/menu_action_type/edit', $this->contentData, TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
	    }
    }

    public function update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/edit/'))) {
            redirect(base_url('login'));
        } else {
	    	// echo "<pre>"; print_r($this->input->post()); exit();

	    	$actionId = $this->input->post('actionId');
	    	$menuActionTypeId = $this->input->post('menuActionTypeId');

	    	$isExists = $this->Helper_model->check_data_duplicity_by_field_and_id('tbl_menu_action_type','action_id',$actionId,$menuActionTypeId);

	    	if ($isExists) {
	    		$this->session->set_flashdata('error', 'Menu Action Type Id Already Exists.');
	    		redirect(base_url('menu_action_type/edit/'.$menuActionTypeId));
	    	} else {
	            $data = array(
	                'name' => trim($this->input->post('name')),
	                'action_id' => $actionId,
	            );

	            $this->db->where('id',$menuActionTypeId);
	            $this->db->update('tbl_menu_action_type', $data);
	    		$this->session->set_flashdata('message', 'Menu Action Type Updated Successfully.');
	    		redirect(base_url('menu_action_type'));
	    	}
	    }
    }

    public function delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/delete/'))) {
            redirect(base_url('login'));
        } else {
	    	$id = $this->input->post('id');
	    	$this->db->delete('tbl_menu_action_type', array('id' => $id));
	    }	
    }

    public function status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu_action_type/status/'))) {
            redirect(base_url('login'));
        } else {
	    	$id = $this->input->post('id');
	    	$this->Helper_model->update_status('tbl_menu_action_type',$id);
	    }
    }
}
