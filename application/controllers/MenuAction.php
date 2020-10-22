<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuAction extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('MenuModel');
        $this->load->model('MenuActionModel');
        $this->load->model('MenuActionTypeModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function Index($menuId)
    {
        $menuActionsList = $this->MenuActionModel->GetMenuActionListByMenuId($menuId);
        $menuInfo = $this->HelperModel->GetDataById('tbl_menus',$menuId);
    	// echo "<pre>"; print_r($menuInfo); exit();

        $this->data['title'] = "Menu Actions";
        $this->data['addButtonLink'] = "menuaction/add/".$menuId;
        $this->data['deleteLink'] = "menuaction/delete/";
        $this->data['statusLink'] = "menuaction/status/";
        $this->data['goBackLink'] = "menu/";
        $this->data['menuActionsList'] = $menuActionsList;
        $this->data['menuInfo'] = $menuInfo;

        $this->load->view('admin/menu_action/index', $this->data);
    }

    public function Add($menuId)
    {
        $menuActionTypes = $this->HelperModel->GetAllData('tbl_menu_action_type','name','ASC');
        $menuInfo = $this->HelperModel->GetDataById('tbl_menus',$menuId);

        $menuActionMaxOrder = $this->MenuActionModel->GetMenuActionMaxOrder($menuId);

        if ($menuActionMaxOrder) {
        	$orderBy = $menuActionMaxOrder->maxOrder + 1;
        } else {
        	$orderBy = 1;
        }

        $this->data['title'] = "Add New Menu Action";
        $this->data['formLink'] = "menuaction/save/";
        $this->data['buttonName'] = "Save";
        $this->data['goBackLink'] = "menuaction/index/".$menuId;
        $this->data['menuActionTypes'] = $menuActionTypes;
        $this->data['menuInfo'] = $menuInfo;
        $this->data['orderBy'] = $orderBy;
        $this->data['menuId'] = $menuId;

        $this->load->view('admin/menu_action/add', $this->data);
    }

    public function Save()
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$actionLink = $this->input->post('actionLink');
    	$parentMenuId = $this->input->post('parentMenuId');

    	$isExists = $this->HelperModel->CheckDataDuplicityByField('tbl_menu_actions','action_link',$actionLink);

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Action Link Already Exists.');
    		redirect(base_url('menuaction/add'.$parentMenuId));
    	} else {
            $data = array(
                'parent_menu_id' => $parentMenuId,
                'menu_type' => trim($this->input->post('actionTypeId')),
                'action_name' => $this->input->post('actionName'),
                'action_link' => $actionLink,
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->insert('tbl_menu_actions', $data);
    		$this->session->set_flashdata('message', 'Menu Action Saved Successfully.');
    		redirect(base_url('menuaction/add/'.$parentMenuId));
    	}
    }

    public function Edit($menuActionId)
    {
        $menuActionTypes = $this->HelperModel->GetAllData('tbl_menu_action_type','name','ASC');
        $menuActionInfo = $this->HelperModel->GetDataById('tbl_menu_actions',$menuActionId);
        $menuInfo = $this->HelperModel->GetDataById('tbl_menus',$menuActionInfo->parent_menu_id);

        $this->data['title'] = "Edit Menu Action";
        $this->data['formLink'] = "menuaction/update/";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "menuaction/index/".$menuActionInfo->parent_menu_id;
        $this->data['menuActionTypes'] = $menuActionTypes;
        $this->data['menuInfo'] = $menuInfo;
        $this->data['menuActionInfo'] = $menuActionInfo;

        $this->load->view('admin/menu_action/edit', $this->data);
    }

    public function Update()
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$actionLink = $this->input->post('actionLink');
    	$menuActionId = $this->input->post('menuActionId');
    	$parentMenuId = $this->input->post('parentMenuId');

    	$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId('tbl_menu_actions','action_link',$actionLink,$menuActionId);

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Action Link Already Exists.');
    		redirect(base_url('menuaction/edit/'.$menuActionId));
    	} else {
            $data = array(
                'parent_menu_id' => $parentMenuId,
                'menu_type' => trim($this->input->post('actionTypeId')),
                'action_name' => $this->input->post('actionName'),
                'action_link' => $actionLink,
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->where('id',$menuActionId);
            $this->db->update('tbl_menu_actions', $data);
    		$this->session->set_flashdata('message', 'Menu Action Updated Successfully.');
    		redirect(base_url('menuaction/index/'.$parentMenuId));
    	}
    }

    public function Delete()
    {
    	$id = $this->input->post('id');
    	$this->db->delete('tbl_menu_actions', array('id' => $id));
    }

    public function Status()
    {
    	$id = $this->input->post('id');
    	$this->HelperModel->UpdateStatus('tbl_menu_actions',$id);
    }

    public function MaxOrder()
    {
    	$parentMenuId = $this->input->post('parentMenuId');

    	if ($parentMenuId != "") {
            $menuMaxOrder = $this->MenuModel->GetMaxOrder($parentMenuId);
    	} else {
        	$menuMaxOrder = $this->MenuModel->GetParentMenuMaxOrder();
    	}

        if ($menuMaxOrder) {
            $orderBy = $menuMaxOrder->maxOrder + 1;
        }
        else {
            $orderBy = 1;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(array(
            'orderBy' => $orderBy,
        )));   
    }
}
