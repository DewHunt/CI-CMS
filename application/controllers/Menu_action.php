<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_action extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('Menu_model');
        $this->load->model('Menu_action_model');
        $this->load->model('Menu_action_type_model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index($menuId)
    {
        $menuActionsList = $this->Menu_action_model->get_menu_action_list_by_menu_id($menuId);
        $menuInfo = $this->Helper_model->get_data_by_id('tbl_menus',$menuId);
    	// echo "<pre>"; print_r($menuInfo); exit();

        $this->data['title'] = "Menu Actions";
        $this->data['addButtonLink'] = "menu_action/add/".$menuId;
        $this->data['deleteLink'] = "menu_action/delete/";
        $this->data['statusLink'] = "menu_action/status/";
        $this->data['goBackLink'] = "menu/";
        $this->data['menuActionsList'] = $menuActionsList;
        $this->data['menuInfo'] = $menuInfo;

        $this->load->view('admin/menu_action/index', $this->data);
    }

    public function add($menuId)
    {
        $menuActionTypes = $this->Helper_model->get_all_data('tbl_menu_action_type','name','ASC');
        $menuInfo = $this->Helper_model->get_data_by_id('tbl_menus',$menuId);

        $menuActionMaxOrder = $this->Menu_action_model->get_menu_action_max_order($menuId);

        if ($menuActionMaxOrder) {
        	$orderBy = $menuActionMaxOrder->maxOrder + 1;
        } else {
        	$orderBy = 1;
        }

        $this->data['title'] = "Add New Menu Action";
        $this->data['formLink'] = "menu_action/save/";
        $this->data['buttonName'] = "Save";
        $this->data['goBackLink'] = "menu_action/index/".$menuId;
        $this->data['menuActionTypes'] = $menuActionTypes;
        $this->data['menuInfo'] = $menuInfo;
        $this->data['orderBy'] = $orderBy;
        $this->data['menuId'] = $menuId;

        $this->load->view('admin/menu_action/add', $this->data);
    }

    public function save()
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$actionLink = $this->input->post('actionLink');
    	$parentMenuId = $this->input->post('parentMenuId');

    	$isExists = $this->Helper_model->check_data_duplicity_by_field('tbl_menu_actions','action_link',$actionLink);

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Action Link Already Exists.');
    		redirect(base_url('menu_action/add'.$parentMenuId));
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
    		redirect(base_url('menu_action/add/'.$parentMenuId));
    	}
    }

    public function edit($menuActionId)
    {
        $menuActionTypes = $this->Helper_model->get_all_data('tbl_menu_action_type','name','ASC');
        $menuActionInfo = $this->Helper_model->get_data_by_id('tbl_menu_actions',$menuActionId);
        $menuInfo = $this->Helper_model->get_data_by_id('tbl_menus',$menuActionInfo->parent_menu_id);

        $this->data['title'] = "Edit Menu Action";
        $this->data['formLink'] = "menu_action/update/";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "menu_action/index/".$menuActionInfo->parent_menu_id;
        $this->data['menuActionTypes'] = $menuActionTypes;
        $this->data['menuInfo'] = $menuInfo;
        $this->data['menuActionInfo'] = $menuActionInfo;

        $this->load->view('admin/menu_action/edit', $this->data);
    }

    public function update()
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$actionLink = $this->input->post('actionLink');
    	$menuActionId = $this->input->post('menuActionId');
    	$parentMenuId = $this->input->post('parentMenuId');

    	$isExists = $this->Helper_model->check_data_duplicity_by_field_and_id('tbl_menu_actions','action_link',$actionLink,$menuActionId);

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Action Link Already Exists.');
    		redirect(base_url('menu_action/edit/'.$menuActionId));
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
    		redirect(base_url('menu_action/index/'.$parentMenuId));
    	}
    }

    public function delete()
    {
    	$id = $this->input->post('id');
    	$this->db->delete('tbl_menu_actions', array('id' => $id));
    }

    public function status()
    {
    	$id = $this->input->post('id');
    	$this->Helper_model->update_status('tbl_menu_actions',$id);
    }
}
