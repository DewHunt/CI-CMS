<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuAction extends CI_Controller {

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
    	// echo "<pre>"; print_r($menuActionsList); exit();

        $this->data['title'] = "Menu Actions";
        $this->data['addButtonLink'] = "menuaction/add/".$menuId;
        $this->data['deleteLink'] = "menuaction/delete/";
        $this->data['statusLink'] = "menuaction/status/";
        $this->data['goBackLink'] = "menu/";
        $this->data['menuActionsList'] = $menuActionsList;

        $this->load->view('admin/menu_action/index', $this->data);
    }

    public function Add($menuId)
    {
        $menuActionTypes = $this->HelperModel->GetAllData('tbl_menu_action_type','name','ASC');

        $menuActionMaxOrder = $this->MenuActionModel->GetMenuActionMaxOrder($menuId);

        if ($menuActionMaxOrder) {
        	$orderBy = $menuActionMaxOrder->maxOrder + 1;
        } else {
        	$orderBy = 1;
        }

        $this->data['title'] = "Add New Menu";
        $this->data['formLink'] = "menuaction/save/";
        $this->data['buttonName'] = "Save";
        $this->data['goBackLink'] = "menuaction/index/".$menuId;
        $this->data['menuActionTypes'] = $menuActionTypes;
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

    public function Edit($menuId)
    {
        $menus = $this->MenuModel->GetAllMenuInfo();
        $menuInfo = $this->MenuModel->GetMenuInfoById($menuId);

        $this->data['title'] = "Edit Menu";
        $this->data['formLink'] = "menu/update/";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "menu/";
        $this->data['menus'] = $menus;
        $this->data['menuInfo'] = $menuInfo;

        $this->load->view('admin/menu/edit', $this->data);
    }

    public function Update()
    {
    	// echo "<pre>";
    	// print_r($this->input->post()); exit();

    	$menuLink = $this->input->post('menuLink');
    	$id = $this->input->post('menuId');

    	if ($menuLink == "") {
    		$isExists == "";
    	} else {
    		$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId('tbl_menus','menu_link',$menuLink,$id);
    	}    	

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Link Already Exists.');
    		redirect(base_url('menu/edit/'.$id));
    	} else {
    		if ($this->input->post('parentMenu') == "") {
    			$parentMenu = NULL;
    		} else {
    			$parentMenu = $this->input->post('parentMenu');
    		}
    		

            $data = array(
                'parent_menu' => $parentMenu,
                'menu_name' => trim($this->input->post('menuName')),
                'menu_link' => $menuLink,
                'menu_icon' => trim($this->input->post('menuIcon')),
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->where('id',$id);
            $this->db->update('tbl_menus', $data);
    		$this->session->set_flashdata('message', 'Menu Updated Successfully.');
    		redirect(base_url('menu'));
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
